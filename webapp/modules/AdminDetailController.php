<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *  セッションにセットされた 'lang' より表示する言語を判断する
 *
 */
incAdminAuthCheck();
require_once _MODULE_DIR_ . 'AdminDAO.php';
require_once _MODULE_DIR_ . 'AdminForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new AdminForm('AdminForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues();
$qform->buildFormFilters($act);
$qform->buildFormRules();

//DB
$dbh =& new AdminDAO();

//操作履歴DB
$history =& new HistoryDAO();

switch ($act) {
case 'List':
default:
    //DBより全件取得

    $search_mode  = $this->request->getParameter('searchMode');
    $search_field = $this->request->getParameter('searchField');

//    $forumType = $this->request->getParameter('forumType');
    $SpInfo = $this->request->getParameter('SpInfo');
//  $AcInfo = $this->request->getParameter('AcInfo');
//  $EqInfo = $this->request->getParameter('EqInfo');

//  $Condition['forumType'] = $forumType;
    $Condition['SpInfo'] = $SpInfo;
//  $Condition['AcInfo'] = $AcInfo;
//  $Condition['EqInfo'] = $EqInfo;

    $row = $dbh->selectAll($search_mode, $search_field,$Condition);
    $n=count($row);

    //ページャ処理
    $pager = createPager($row);

    $this->renderer->assign('row', $pager['result']);
    $this->renderer->assign('pager', $pager['pagerLinks']['all']);

    $this->tpl_name = 'admin/AdminDetail_List.tpl';
    break;


case 'Display':
    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBより参加者情報を取得
    $ta_id = $this->request->getParameter('ta_id');
    $row = $dbh->selectById($ta_id,"ta_id");

    //QFにDBの情報をセット
    $qform->setDefaults($row);

    // アクセス競合対策準備 - 初期データを格納
    foreach ($row as $key => $val) {
	$this->session->setParameter($key, $val);
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    $this->renderer->assign('ta_id', $ta_id); // 
    $this->renderer->assign('last_update', $row['last_update']); // 

    $this->tpl_name = 'admin/AdminDetail_Input.tpl';

    // 画面URLを保存
    $url = $_SERVER['HTTP_REFERER'];
    $vpos =strpos($url,"Confirm");
    if ($vpos == 0 ) { // Confrmなし 確認ページから戻った場合への対策
	$this->session->setParameter('_URL',       $url);
    }
    break;

case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);

        $this->tpl_name = 'admin/AdminDetail_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'admin/AdminDetail_Confirm.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'admin/AdminDetail_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    $this->renderer->assign('ta_id', $this->request->getParameter('ta_id')); // 登録ID表示用

    //変更項目の赤色表示
    if ($act == 'Confirm') {
         //QFから渡されたPOSTデータを抽出
         $postData = $qform->exportValues();

 	//postData はbuildFormFilters()でescapeされているのでunescape してから比較する
	foreach ($postData as $key => $val) { // 配列はunset済み
	    $postData[$key] = unhtmlspecialchars($val);
	}

	//変更前のデータをDBから取得
	$beforeData = $dbh->selectById($this->request->getParameter('ta_id'),"ta_id");

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
    $checkToken = validateToken2($this->request->getParameter('token'), $this->session->getParameter('token'));
    if ($checkToken === false) {
        $this->tpl_name = '_exception/reloaded_ja.tpl';
        break;
    }

    //QFから渡されたPOSTデータを抽出
    $postData = $qform->exportValues();

    //postData はbuildFormFilters()でescapeされているのでunescape してから比較する
    foreach ($postData as $key => $val) { // 配列はunset済み
	$postData[$key] = unhtmlspecialchars($val);
    }

    //変更前のデータをDBから取得
    $ta_id = $this->request->getParameter('ta_id');
    $beforeData = $dbh->selectById($ta_id,"ta_id");

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['last_update'],$postData['last_update']);
    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
        $this->tpl_name = 'admin/AdminDetail_Complete.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData,$postData);
//print_r($diffA);
    //変更がなければ
    if (count($diffA) == 0) {
        $this->renderer->assign('error', "変更データはありませんでした。");
        $dbh->con->rollback(); // ロールバック
 	$this->tpl_name = 'admin/AdminDetail_Complete.tpl';
	break;
    }

    //DBへUpdate
    $this->tpl_name = 'admin/AdminDetail_Complete.tpl';
    $dbh->newupdate($diffA,$postData, $ta_id);

    //DBへ変更が成功すれば(errorがnullなら)
    if ($dbh->getError() === null) {
	$dbh->con->commit();  // コミット

	//変更内容の抽出
	$diff = fetchDiff($beforeData, $postData);
	$diff = remakeDiff($diff, $qform);

        //操作履歴TBLへ追加
        $history->newinsert($ta_id,
                        $diff // $str 変更内容
			);

    //DBへ変更失敗した場合
    } else {
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('AdminDetail',$reg_id,$postData); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	$this->tpl_name = 'admin/Registration_Error.tpl';
    }

    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)
    $this->renderer->assign('oldurl', $this->session->getParameter('_URL'));
    break;

}


?>
