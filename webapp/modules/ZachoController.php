<?php
/**
 * 座長管理のコントローラ
 *
 */
incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'ZachoForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new ZachoForm('ZachoForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
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
    createToken(&$this->renderer, &$this->session);
    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
//   $qform->setDefaults($row);

    //DBから座長情報を取得し、QFにセット
    $zachorow = $dbh->selectZacho($this->session->getParameter('semi_id'),'座長');
    $qform->setDefaults($zachorow);

    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->renderer->assign('cs_id1', $zachorow['cs_id1']);
    $this->renderer->assign('cs_id2', $zachorow['cs_id2']);
    $this->renderer->assign('cs_id3', $zachorow['cs_id3']);


    // アクセス競合対策 - 同時更新を防止
    $lockinfo = $dbh->LockCheck($this->session->getParameter('semi_id'), $_SESSION['logintoken']);
//print_r($lockinfo);
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

    $this->tpl_name = 'member/Zacho_Input.tpl';
    break;


case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken(&$this->renderer, &$this->session);
        $this->tpl_name = 'member/Zacho_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Zacho_Input.tpl';
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
        $beforeData = $dbh->selectZacho($this->session->getParameter('semi_id'),'座長');

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
    $checkToken = validateToken(&$this->request, &$this->session);
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

    // 座長ごとに配列化  $chairNum = 3;
    foreach ($postData as $key => $val) { // 
	$length = strlen($key) - 1;
	$varname = substr($key,0,$length);
        if (substr($key,-1) == "1" ) {
	    $postZacho[0][$varname] = $val;
	} else if (substr($key,-1) == "2" ) {
	    $postZacho[1][$varname] = $val;
	} else if (substr($key,-1) == "3" ) {
	    $postZacho[2][$varname] = $val;
	}
    }

    //変更前のデータをDBから取得
    $beforeData = $dbh->selectZacho($this->session->getParameter('semi_id'),'座長');
    // 座長ごとに配列化  chairNum 
    foreach ($beforeData as $key => $val) { // 
	$length = strlen($key) - 1;
	$varname = substr($key,0,$length);
        if (substr($key,-1) == "1" ) {
	    $beforeZacho[0][$varname] = $val;
	} else if (substr($key,-1) == "2" ) {
	    $beforeZacho[1][$varname] = $val;
	} else if (substr($key,-1) == "3" ) {
	    $beforeZacho[2][$varname] = $val;
	}
    }

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError1 = CheckAccessTime($beforeData['cs_reg_date1'],$postData['cs_reg_date1']);
    $lockError2 = CheckAccessTime($beforeData['cs_reg_date2'],$postData['cs_reg_date2']);
    $lockError3 = CheckAccessTime($beforeData['cs_reg_date3'],$postData['cs_reg_date3']);


    //DBへUpdate準備  変更項目の抽出
    if ($this->session->getParameter('zachoNum') > 0 ){
        if ($lockError1 == false ) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffA = array();
	$diffA = diff_Column( $beforeZacho[0],$postZacho[0]);
	$diff = $diffA;
    }
    if ($this->session->getParameter('zachoNum') > 1 ) {
        if ($lockError2 == false) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffB = array();
	$diffB = diff_Column( $beforeZacho[1],$postZacho[1]);
	$diff = $diffA + $diffB;
    }
    if ($this->session->getParameter('zachoNum') > 2 ) {
        if ($lockError3 == false) { //競合発生
	    $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	    $this->tpl_name = 'member/All_Complete_ja.tpl';
	    break;
	}
	$diffC = array();
	$diffC = diff_Column( $beforeZacho[2],$postZacho[2]);
	$diff = $diff + $diffC;
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
	//DBへ変更
	$dbh->updateZaen($diffA,$postZacho[0]);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('Zacho',$postZacho[0]['cs_id'],$diffA); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
    }

    if ($this->session->getParameter('zachoNum') > 1 ) {
      if (count($diffB) > 0) {
	//DBへ変更
	$dbh->updateZaen($diffB,$postZacho[1]);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('Zacho',$postZacho[1]['cs_id'],$diffB); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
      }
    }

    if ($this->session->getParameter('zachoNum') > 2 ) {
      if (count($diffC) > 0) {
	//DBへ変更
	$dbh->updateZaen($diffC,$postZacho[2]);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
            $dbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('Zacho',$postZacho[2]['cs_id'],$diffC); 
            $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	    break;
	}
      }
    }

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, &$qform); //改良の余地あり
    //操作履歴TBLへ追加
    $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $dbh->con->commit();  // コミット
    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    break;

}

$this->renderer->assign('bpshj', "座長");
$this->renderer->assign('bpshe', "Zacho");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}

?>
