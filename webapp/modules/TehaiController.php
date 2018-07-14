<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *
 */
incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'TehaiDAO.php';
require_once _MODULE_DIR_.'TehaiForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new TehaiForm('TehaiForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues($this->session->getParameter('h_num'),$this->session->getParameter('k_num'));
$qform->buildFormFilters();
// $qform->buildFormRules();

//DB
$dbh =& new MembersDAO();
$thdbh =& new TehaiDAO();

//操作履歴DB
$history =& new HistoryDAO();

// 登録して他ページに移動する準備
$btnName=$this->request->getParameter('DirectBtn');
if (empty($btnName)==false) {
    $act ="Direct";
    $toPage=SaveAndGo($btnName);
}

switch ($act) {
case 'Display':
//case 'ReloadZaen':
//case 'ReloadTehai':
default:
    $ary=array();
    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');

    //DBから手配品情報を取得し、QFにセット
    $ary = $thdbh->selectAll($this->session->getParameter('semi_id'),'detail');
    if (is_array($ary)==false) {
	$this->renderer->assign('error', "該当データが登録されていません");
	$this->tpl_name = 'member/Error.tpl';
	break;
    }
    $qform->setDefaults($ary);
    // 手配品数
    $sinakazu = $thdbh->selectTehaiNum($this->session->getParameter('semi_id'));

    // アクセス競合対策 - 同時更新を防止
    $lockinfo = $dbh->LockCheck($this->session->getParameter('semi_id'), $_SESSION['logintoken']);
    if ($lockinfo['status'] == "otherlock") {
	$qform->freeze();
        $this->renderer->assign('locktoken',"unlock");
    } else if ($lockinfo['status'] == "nonlock") {
        $retLock =$dbh->LockById2($this->session->getParameter('semi_id'), $_SESSION['logintoken']);
        if ($retLock == false ) {
	    $qform->freeze();
            $this->renderer->assign('locktoken',"unlock");
	}
    }


    //座長演者数を再取得
/*
    if ($act == 'ReloadZaen') {
	//空データを無視するために再カウント
	$zaennum = $dbh->getZaenNinzu($this->session->getParameter('semi_id'),1);
	$zachonum = $zaennum['座長']; 
	$enshanum = $zaennum['演者']; 
	$zaentotal = $zachonum + $enshanum;
	$hinsu = $sinakazu['hikae'] + $sinakazu['kaijo'];
	$zaen=array();
	for ($i=1;$i< $hinsu;$i++) {
	  $varname = "th_hinmei" . $i;
	  $varsu = "th_su" . $i;
	  if ($ary[$varname] == "講師CV" ) {
	    $zaen += array($varsu => $enshanum);
    $qform->addElement('text', $varsu, "数" . $i ,array('size'=>4,'style'=>'color:#ff0000'));
	  }
	  if ($ary[$varname] == "謝礼" || $ary[$varname] == "当日配布物") {
	    $zaen += array($varsu => $zaentotal);
    $qform->addElement('text', $varsu, "数" . $i ,array('size'=>4,'style'=>'color:#ff0000'));
	  }
	  if ($ary[$varname] == "座長･講師用軽食" || $ary[$varname] == "コーヒー･冷水等") {
    $qform->addElement('text', $varsu, "数" . $i ,array('size'=>4,'style'=>'color:#ff0000'));
	    $zaen += array($varsu => $zaentotal);
	  }
	}
        $qform->setDefaults($zaen);
    }
*/

    //手配情報をBasic情報から取得
/*
    if ($act == 'ReloadTehai') {
	$hinsu = $sinakazu['hikae'] + $sinakazu['kaijo'] + 60;
	$tehaiary=array();
	for ($i=61;$i< $hinsu;$i++) {
	  $varname = "th_hinmei" . $i;
	  $varsu = "th_su" . $i;
	  if ($ary[$varname] == "セミナー用弁当" ) {
	    $tehaiary += array($varsu => $row['bento']);
    $qform->addElement('text', $varsu, "数" . $i ,array('size'=>4,'style'=>'color:#ff0000'));
	  }
	  if ($ary[$varname] == "配布資料" || $ary[$varname] == "アンケート") {
	    $tehaiary += array($varsu => $row['sizaisu']);
    $qform->addElement('text', $varsu, "数" . $i ,array('size'=>4,'style'=>'color:#ff0000'));
	  }
	}
        $qform->setDefaults($tehaiary);
    }
*/

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->session->setParameter('h_num',$sinakazu['hikae']);
    $this->session->setParameter('k_num',$sinakazu['kaijo']);

    $this->tpl_name = 'member/Tehai_Input.tpl';
    break;


case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);
//        $qform->setDefaults(array('lang_mode'=>$lang, 'lang'=>$lang, 'agree_flg'=>'t'));
        $this->tpl_name = 'member/Tehai_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Tehai_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    //変更項目の赤色表示
    if ($act == 'Confirm') {
         //QFから渡されたPOSTデータを抽出
         $postData = $qform->exportValues();

 	//postData はbuildFormFilters()でescapeされているのでunescape してから比較する
        foreach ($postData as $key => $val) { 
	    $postData[$key] = unhtmlspecialchars($val);
        }

	//変更前のデータをDBから取得
        $beforeData  = $thdbh->selectAll($this->session->getParameter('semi_id'),'detail');

	// 変更項目の抽出 
	$diff = array();
	$diff = diff_Column( $beforeData,$postData);

	// 赤色表示
	$amax = count($diff);
	for ($i = 0; $i < $amax; $i++) {
           $this->renderer->assign($diff[$i], "<font color=red>"); 
           $this->renderer->assign("e" . $diff[$i], "</font>"); 
	}
    }

    break;


case 'Update':
case 'Direct':
    $checkToken = validateToken2($this->request->getParameter('token'), $this->session->getParameter('token'));
    if ($checkToken === false) {
        $this->tpl_name = '_exception/reloaded_ja.tpl';
        break;
    }

    //QFから渡されたPOSTデータを抽出
    $postData = $qform->exportValues();

    //postData はbuildFormFilters()でescapeされているのでunescape してから比較する
    foreach ($postData as $key => $val) { 
	$postData[$key] = unhtmlspecialchars($val);
    }
    //変更前のデータをDBから取得
    $beforeData=array();
    $beforeData = $thdbh->selectAll($this->session->getParameter('semi_id'),'detail');

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['th_reg_date1'],$postData['th_reg_date1']);
    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData,$postData);

    //変更がなければ
    if (count($diffA) == 0) {
        $this->renderer->assign('error', "NoData");
        $thdbh->con->rollback(); // ロールバック
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }

    //DBへUpdate
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    $thdbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $thdbh->detailUpdate($this->session->getParameter('semi_id'),$postData);

    if ($thdbh->getError() !== null) {   //DBへ変更失敗した場合
        $thdbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('tehai',$this->session->getParameter('semi_id'),$diff); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData, $postData);
    $diff = remakeDiff($diff, $qform);

    //操作履歴TBLへ追加
    $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // 変更内容
			);

    $thdbh->con->commit();  // コミット
    $thdbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    // セッションクリア
    unset($_SESSION['h_num']);
    unset($_SESSION['k_num']);
    break;

}

$this->renderer->assign('bpshj', "手配");
$this->renderer->assign('bpshe', "Tehai");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}

?>
