<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *
 */
incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'TehaiDAO.php';
require_once _MODULE_DIR_.'JininForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new JininForm('JininForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
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
case 'ReloadJinin':
default:
    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');

    //DBから人員配置情報を取得し、QFにセット
    $thdbh->table="jinin";

    $ary=array();
    $ary = $thdbh->selectAll($this->session->getParameter('semi_id'),'detail');
    if (is_array($ary)==false) {
	$this->renderer->assign('error', "該当データが登録されていません");
	$this->tpl_name = 'member/Error.tpl';
	break;
    }
    $qform->setDefaults($ary);

    // 人員配置数をセッションにセット
    $ninzu = $thdbh->selectJininNum($this->session->getParameter('semi_id'));
    $this->session->setParameter('j_num',$ninzu);

    //コプロ数判定
    $copronum = 0;
    if (empty($row['syukan'])==false) $copronum ++;
    if (empty($row['syukan2'])==false) $copronum ++;
    $this->session->setParameter('copronum',$copronum);

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


    //再取得
/*
    if ($act == 'ReloadJinin') {
        // 責任者を取得します。
        $retSekinin = $thdbh->getSekinin($this->session->getParameter('semi_id'));
	$sekinin=array();
	for ($i=1;$i< $ninzu;$i++) {
	  $varname = "ji_yakuwari" . $i;
	  $var_as = "ji_as" . $i;
	  $var_co1 = "ji_co1" . $i;
	  $var_co2 = "ji_co2" . $i;
	  $var_cl = "ji_cl" . $i;
	  $var_ga = "ji_gakkai" . $i;
	  if ($ary[$varname] == "責任者" ) {
	    $sekinin = array($var_as => $retSekinin[0],
		$var_co1 => $retSekinin['1'],
		$var_co2 => $retSekinin['2'],
		$var_cl => $row['cltantou'],
		$var_ga => $retSekinin['4']);
            $qform->addElement('text', $var_as, "AS" .$i ,array('size'=>15,'style'=>'color:#ff0000'));
            $qform->addElement('text', $var_co1, "コプロ1_" .$i ,array('size'=>15,'style'=>'color:#ff0000'));
            $qform->addElement('text', $var_co2, "コプロ2_" .$i ,array('size'=>15,'style'=>'color:#ff0000'));
            $qform->addElement('text', $var_cl, "CL" .$i ,array('size'=>15,'style'=>'color:#ff0000'));
            $qform->addElement('text', $var_ga, "学会" .$i ,array('size'=>15,'style'=>'color:#ff0000'));
	  }
	}
//	print_r($sekinin);
        $qform->setDefaults($sekinin);
    }
*/

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->renderer->assign('copro1', $row['syukan']);
    $this->renderer->assign('copro2', $row['syukan2']);

    $this->tpl_name = 'member/Jinin_Input.tpl';
    break;


case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
	createToken($this->renderer, $this->session);
//        $qform->setDefaults(array('lang_mode'=>$lang, 'lang'=>$lang, 'agree_flg'=>'t'));

        $this->tpl_name = 'member/Jinin_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Jinin_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    // コプロ情報取得
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
    $retsu = 5;
    if (empty($row['syukan']) == false) $retsu ++;
    if (empty($row['syukan2']) == false) $retsu ++;
    $this->renderer->assign('copro1', $row['syukan']);
    $this->renderer->assign('copro2', $row['syukan2']);
    $this->renderer->assign('retsu', $retsu);

    //変更項目の赤色表示
    if ($act == 'Confirm') {
         //QFから渡されたPOSTデータを抽出
         $postData = $qform->exportValues();

 	//postData はbuildFormFilters()でescapeされているのでunescape してから比較する
        foreach ($postData as $key => $val) { 
	    $postData[$key] = unhtmlspecialchars($val);
        }

	//変更前のデータをDBから取得
	$thdbh->table="jinin";
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
    $thdbh->table='jinin';
    $beforeData  = $thdbh->selectAll($this->session->getParameter('semi_id'),'detail');

    // 精神分析学会で起きた動作不良対策 - 変更前データを正しく引っ張っていないことを想定して、
    // その際は、SESSIONの値を参照する
//    foreach ($beforeData as $key => $val) {
//	if ($beforeData[$key] == $postData[$key]) {
//	    $beforeData[$key] = $this->session->getParameter($key);
//	}
//    }

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['ji_reg_date1'],$postData['ji_reg_date1']);
    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']["ja"]);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData,$postData);

    //変更がなければ
    if (count($diffA) == 0) {
        $this->renderer->assign('error', "NoData");
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }

    //DBへUpdate
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    $thdbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $thdbh->JininUpdate($this->session->getParameter('semi_id'),$postData);

    if ($thdbh->getError() !== null) {   //DBへ変更失敗した場合
        $thdbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('jinin',$this->session->getParameter('semi_id'),$diff); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, $qform); //改良の余地あり

    //操作履歴TBLへ追加
    $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // $str 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $thdbh->con->commit();  // コミット
    $thdbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    // セッションクリア
    unset($_SESSION['copronum']);
    unset($_SESSION['j_num']);

    break;

}

$this->renderer->assign('bpshj', "人員配置");
$this->renderer->assign('bpshe', "Jinin");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}

?>
