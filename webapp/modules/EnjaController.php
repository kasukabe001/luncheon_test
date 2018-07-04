<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *
 */
incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'EnjaForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new EnjaForm('EnjaForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
// $qform->buildFormValues($this->session->getParameter('enshaNum'));
$qform->buildFormFilters();
// $qform->buildFormRules();

//DB
$dbh =& new MembersDAO();

//操作履歴DB
$history =& new HistoryDAO();

//座長演者の人数をセッションにセット
$zaenAry = $dbh->getZaenNinzu($this->session->getParameter('semi_id'),1);
$this->session->setParameter('zachoNum',$zaenAry['座長']);
$this->session->setParameter('enshaNum',$zaenAry['演者']);

// 登録して他ページに移動する準備
$btnName=$this->request->getParameter('DirectBtn');
if (empty($btnName)==false) {
    $act ="Direct";
    $toPage=SaveAndGo($btnName);
}

switch ($act) {
case 'Display':
default:

    //トークンのセット
    createToken($this->renderer, $this->session);
    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
//    $qform->setDefaults($row);

    //DBから演者情報を取得し、QFにセット
    $ensharow = $dbh->selectZacho($this->session->getParameter('semi_id'),'演者');
    $qform->setDefaults($ensharow);

    $this->renderer->assign('gakkai', $row['gakkai']);

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

    $this->tpl_name = 'member/Enja_Input.tpl';
    break;


case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
	createToken($this->renderer, $this->session);
        $this->tpl_name = 'member/Enja_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            if (_PANF_DATE_ < date('Ymd')) $this->renderer->assign('fcut', "on");
            $this->tpl_name = 'member/Enja_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    //変更項目の赤色表示
    if ($act == 'Confirm') {
         //QFから渡されたPOSTデータを抽出
         $postData = $qform->exportValues();

	foreach ($postData as $key => $val) { 
	    $postData[$key] = unhtmlspecialchars($val);
	}

	//変更前のデータをDBから取得
        $beforeData = $dbh->selectZacho($this->session->getParameter('semi_id'),'演者');

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

    // 演者ごとに配列化 
    foreach ($postData as $key => $val) { // 
	$length = strlen($key) - 1;
	$varname = substr($key,0,$length);
        if (substr($key,-1) == "1" ) {
	    $postEnsha[0][$varname] = $val;
	} else if (substr($key,-1) == "2" ) {
	    $postEnsha[1][$varname] = $val;
	} else if (substr($key,-1) == "3" ) {
	    $postEnsha[2][$varname] = $val;
	} else if (substr($key,-1) == "4" ) {
	    $postEnsha[3][$varname] = $val;
	} else if (substr($key,-1) == "5" ) {
	    $postEnsha[4][$varname] = $val;
	} else if (substr($key,-1) == "6" ) {
	    $postEnsha[5][$varname] = $val;
	} else if (substr($key,-1) == "7" ) {
	    $postEnsha[6][$varname] = $val;
	} else if (substr($key,-1) == "8" ) {
	    $postEnsha[7][$varname] = $val;
	}
    }

    //変更前のデータをDBから取得
    $beforeData = $dbh->selectZacho($this->session->getParameter('semi_id'),'演者');
    // 演者ごとに配列化  
    foreach ($beforeData as $key => $val) { // 
	$length = strlen($key) - 1;
	$varname = substr($key,0,$length);
        if (substr($key,-1) == "1" ) {
	    $beforeEnsha[0][$varname] = $val;
	} else if (substr($key,-1) == "2" ) {
	    $beforeEnsha[1][$varname] = $val;
	} else if (substr($key,-1) == "3" ) {
	    $beforeEnsha[2][$varname] = $val;
	} else if (substr($key,-1) == "4" ) {
	    $beforeEnsha[3][$varname] = $val;
	} else if (substr($key,-1) == "5" ) {
	    $beforeEnsha[4][$varname] = $val;
	} else if (substr($key,-1) == "6" ) {
	    $beforeEnsha[5][$varname] = $val;
	} else if (substr($key,-1) == "7" ) {
	    $beforeEnsha[6][$varname] = $val;
	} else if (substr($key,-1) == "8" ) {
	    $beforeEnsha[7][$varname] = $val;
	}
    }

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError1 = CheckAccessTime($beforeData['cs_reg_date1'],$postData['cs_reg_date1']);
/*
print $beforeData['cs_reg_date5'];
print ":";
print $postData['cs_reg_date5'];
*/
    $lockError2 = CheckAccessTime($beforeData['cs_reg_date2'],$postData['cs_reg_date2']);
    $lockError3 = CheckAccessTime($beforeData['cs_reg_date3'],$postData['cs_reg_date3']);
    $lockError4 = CheckAccessTime($beforeData['cs_reg_date4'],$postData['cs_reg_date4']);
    $lockError5 = CheckAccessTime($beforeData['cs_reg_date5'],$postData['cs_reg_date5']);
    $lockError6 = CheckAccessTime($beforeData['cs_reg_date6'],$postData['cs_reg_date6']);
    $lockError7 = CheckAccessTime($beforeData['cs_reg_date7'],$postData['cs_reg_date7']);
    $lockError8 = CheckAccessTime($beforeData['cs_reg_date8'],$postData['cs_reg_date8']);

    //DBへUpdate準備  変更項目の抽出
/*
    if ($lockError1 == false || $lockError2 == false || $lockError3 == false || $lockError4 == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }
    if ($lockError5 == false || $lockError6 == false || $lockError7 == false || $lockError7 == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }
*/

    if ($this->session->getParameter('enshaNum') > 0 ){
        if ($lockError1 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffA = array();
	$diffA = diff_Column( $beforeEnsha[0],$postEnsha[0]);
	$diff = $diffA;
    }

    if ($this->session->getParameter('enshaNum') > 1 ){
        if ($lockError2 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffB = array();
	$diffB = diff_Column( $beforeEnsha[1],$postEnsha[1]);
	$diff = $diff + $diffB;
    }

    if ($this->session->getParameter('enshaNum') > 2 ){
        if ($lockError3 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffC = array();
	$diffC = diff_Column( $beforeEnsha[2],$postEnsha[2]);
	$diff = $diff + $diffC;
    }

    if ($this->session->getParameter('enshaNum') > 3 ){
        if ($lockError4 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffD = array();
	$diffD = diff_Column( $beforeEnsha[3],$postEnsha[3]);
	$diff = $diff + $diffD;
    }

    if ($this->session->getParameter('enshaNum') > 4 ){
        if ($lockError5 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffE = array();
	$diffE = diff_Column( $beforeEnsha[4],$postEnsha[4]);
	$diff = $diff + $diffE;
    }

    if ($this->session->getParameter('enshaNum') > 5 ){
        if ($lockError6 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffF = array();
	$diffF = diff_Column( $beforeEnsha[5],$postEnsha[5]);
	$diff = $diff + $diffF;
    }

    if ($this->session->getParameter('enshaNum') > 6 ){
        if ($lockError7 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffG = array();
	$diffG = diff_Column( $beforeEnsha[6],$postEnsha[6]);
	$diff = $diff + $diffG;
    }

    if ($this->session->getParameter('enshaNum') > 7 ){
        if ($lockError8 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffH = array();
	$diffH = diff_Column( $beforeEnsha[7],$postEnsha[7]);
	$diff = $diff + $diffH;
    }

    //変更がなければ
    if (count($diff) == 0) {
        $this->renderer->assign('error', "NoData");
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }

    //DBへUpdate
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $dbh->table="chairspeaker";
    if (count($diffA) > 0) {
	$dbh->updateZaen($diffA,$postEnsha[0]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha1',$postEnsha[0]['cs_id'],$diffA); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffB) > 0) {
	$dbh->updateZaen($diffB,$postEnsha[1]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha2',$postEnsha[1]['cs_id'],$diffB); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffC) > 0) {
	$dbh->updateZaen($diffC,$postEnsha[2]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha3',$postEnsha[2]['cs_id'],$diffC); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffD) > 0) {
	$dbh->updateZaen($diffD,$postEnsha[3]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha4',$postEnsha[3]['cs_id'],$diffD); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffE) > 0) {
	$dbh->updateZaen($diffE,$postEnsha[4]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha5',$postEnsha[4]['cs_id'],$diffE); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffF) > 0) {
	$dbh->updateZaen($diffF,$postEnsha[5]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha6',$postEnsha[5]['cs_id'],$diffF); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffG) > 0) {
	$dbh->updateZaen($diffG,$postEnsha[6]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha7',$postEnsha[6]['cs_id'],$diffG); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if (count($diffH) > 0) {
	$dbh->updateZaen($diffH,$postEnsha[7]); //DBへ変更
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('ensha8',$postEnsha[7]['cs_id'],$diffH); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    // 略歴更新 tehaiテーブル
    if (!empty($postEnsha[0]['ryakureki'])) $ryakureki = $postEnsha[0]['cs_name'] . " ";
    if (!empty($postEnsha[1]['ryakureki'])) $ryakureki .= $postEnsha[1]['cs_name'] . " ";
    if (!empty($postEnsha[2]['ryakureki'])) $ryakureki .= $postEnsha[2]['cs_name'] . " ";
    if (!empty($postEnsha[3]['ryakureki'])) $ryakureki .= $postEnsha[3]['cs_name'] . " ";
    if (!empty($postEnsha[4]['ryakureki'])) $ryakureki .= $postEnsha[4]['cs_name'] . " ";
    if (!empty($postEnsha[5]['ryakureki'])) $ryakureki .= $postEnsha[5]['cs_name'] . " ";
    if (!empty($postEnsha[6]['ryakureki'])) $ryakureki .= $postEnsha[6]['cs_name'] . " ";
    if (!empty($postEnsha[7]['ryakureki'])) $ryakureki .= $postEnsha[7]['cs_name'] . " ";
    $ryakureki = trim($ryakureki);
    $dbh->updateRyakureki($ryakureki, $this->session->getParameter('semi_id'));

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, $qform); //改良の余地あり
    //操作履歴TBLへ追加
    $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $dbh->con->commit();  // コミット
    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    break;

}

$this->renderer->assign('bpshj', "演者");
$this->renderer->assign('bpshe', "Enja");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}
?>
