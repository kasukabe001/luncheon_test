<?php
/**
 * 一般ユーザがログインした時の主にトップページのコントローラ
 */
incAuthCheck();

require_once _MODULE_DIR_ . 'MembersDAO.php';
require_once _MODULE_DIR_ . 'TehaiDAO.php';
require_once _MODULE_DIR_ . 'TantouForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickForm の設定
$qform =& new TantouForm('TanotuForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues();

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
case 'Reload':
default:
    //トークンのセット
    createToken($this->renderer, $this->session);

    //セミナー情報を取得
    $semi_id=$this->session->getParameter('semi_id');
    $row = $dbh->selectById($semi_id,'semi_id');

    //座長MR・演者MR情報を取得
    $zachorow = $dbh->selectZacho($semi_id,'座長',2); //2は空白を除外
    $ensharow = $dbh->selectZacho($semi_id,'演者',2);
//
    //担当者情報を取得
    $dbh->table = 'lch_tantou';
    $lch_row = $dbh->selectTantouInit('all',0,$semi_id);

    if (count($lch_row)==0) {
	$this->renderer->assign('error', "該当データが登録されていません");
	$this->tpl_name = 'member/Error.tpl';
	break;
    }

    $qform->setDefaults($lch_row);

    //コプロ数判定
    $copronum = 0;
    if (empty($row['syukan'])==false) $copronum ++;
    if (empty($row['syukan2'])==false) $copronum ++;
    $this->session->setParameter('copronum',$copronum);

    //責任者情報取得
    $sekinins = $thdbh->getSekinin($semi_id);

    //担当者デフォルト情報を再取得
/*
    if ($act == 'Reload') {
	$dbh->table = "tantou";
//	$lch_row = $dbh->selectTantouInit('アステラス',0);
//	$qform->setDefaults($lch_row);
        if (empty($row['syukan'])==false) {
	    $lch_row1 = $dbh->selectTantouInit($row['syukan'],1);
	    $qform->setDefaults($lch_row1);
	}
        if (empty($row['syukan2'])==false) {
	    $lch_row2 = $dbh->selectTantouInit($row['syukan2'],2);
	    $qform->setDefaults($lch_row2);
	}
//	$lch_row = $dbh->selectTantouInit('リンケージ',3);
//	$qform->setDefaults($lch_row);
	if ($row['anquete']=="有") {
	    $lch_row6 = $dbh->selectTantouInit('アンケート',6);
	    $qform->setDefaults($lch_row6);
	}
	if ($row['syuroku']=="有") {
	    $lch_row7 = $dbh->selectTantouInit('収録',7);
	    $qform->setDefaults($lch_row7);
	}
    } else {
//    	$qform->setDefaults($lch_row);
    }
*/

    // コプロ,会場名表示
    $qform->setDefaults(array('lch_corp1'=>$row['syukan'],'lch_corp2'=>$row['syukan2'],'lch_corp5'=>$row['place']));
    // 責任者を表示 asとclは基本情報から
//  $qform->setDefaults(array('lch_man0'=>$sekinins['ji_as'],'lch_man1'=>$sekinins['ji_co1'],'lch_man2'=>$sekinins['ji_co2'],'lch_man3'=>$sekinins['ji_cl'],'lch_man4'=>$sekinins['ji_gakkai']));
    $qform->setDefaults(array('lch_man0'=>$row['sekinin'],'lch_man1'=>$sekinins['ji_co1'],'lch_man2'=>$sekinins['ji_co2'],'lch_man3'=>$row['cltantou'],'lch_man4'=>$sekinins['ji_gakkai']));

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


    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->renderer->assign('zacho', $zachorow);
    $this->renderer->assign('ensha', $ensharow);
    $this->renderer->assign('anquete', $row['anquete']); //アンケート有無
    $this->renderer->assign('syuroku', $row['syuroku']); //収録有無

    $this->tpl_name = 'member/Tantou_Input.tpl';
    break;

case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);

        $this->tpl_name = 'member/Tantou_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Tantou_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    //再表示
    $semi_id=$this->session->getParameter('semi_id');
    $row = $dbh->selectById($semi_id,'semi_id');
    //座長MR・演者MR情報を取得
	$zachorow = $dbh->selectZacho($semi_id,'座長',1);
	$ensharow = $dbh->selectZacho($semi_id,'演者',1);
	$this->renderer->assign('gakkai', $row['gakkai']);
	$this->renderer->assign('zacho', $zachorow);
	$this->renderer->assign('ensha', $ensharow);
	$this->renderer->assign('anquete', $row['anquete']); //アンケート有無
	$this->renderer->assign('syuroku', $row['syuroku']); //収録有無


    //変更項目の赤色表示
    if ($act == 'Confirm') {
         //QFから渡されたPOSTデータを抽出
         $postData = $qform->exportValues();

 	//postData はbuildFormFilters()でescapeされているのでunescape してから比較する
        foreach ($postData as $key => $val) { 
	    $postData[$key] = unhtmlspecialchars($val);
        }

	//変更前のデータをDBから取得
	$dbh->table = 'lch_tantou';
	$beforeData = $dbh->selectTantouInit('all',0,$this->session->getParameter('semi_id'));

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
    $dbh->table = 'lch_tantou';
    $beforeData = $dbh->selectTantouInit('all',0,$this->session->getParameter('semi_id'));

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['last_update0'],$postData['last_update0']);
    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData,$postData);

    //DBへUpdate
    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $dbh->TantouUpdate($this->session->getParameter('semi_id'),$postData);

    //変更内容の抽出
    $diff = fetchDiff($beforeData, $postData);
    $diff = remakeDiff($diff, $qform);

    //変更がなければ
    if (count($diff) == 0) {
        $this->renderer->assign('error', "NoData");
        $dbh->con->rollback(); // ロールバック

    //DBへ変更が成功すれば(errorがnullなら)
    } elseif ($dbh->getError() === null) {
        //操作履歴TBLへ追加
        $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // 変更内容
			);
	$dbh->con->commit();  // コミット

    //DBへ変更失敗した場合
    } else {
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('lchtantou',$this->session->getParameter('semi_id'),$diff); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
    }

    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    // セッションクリア
    unset($_SESSION['copronum']);
    break;

}

$this->renderer->assign('bpshj', "担当者");
$this->renderer->assign('bpshe', "Tantou");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}

?>