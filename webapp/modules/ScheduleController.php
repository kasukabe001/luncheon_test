<?php
/**
 * 一般ユーザ用機材・その他管理のコントローラ
 *
 */

incAuthCheck();

require_once _MODULE_DIR_ . 'MembersDAO.php';
require_once _MODULE_DIR_. 'ScheduleForm.php';

$lang = "ja";
$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new ScheduleForm('ScheduleForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
$qform->buildFormFilters();
// $qform->buildFormRules();

//DB
$dbh =& new MembersDAO();

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
default:
    //トークンのセット
    createToken(&$this->renderer, &$this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
    $qform->setDefaults($row); //last_date 対策

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

    $this->tpl_name = 'member/Schedule_Input.tpl';
    break;


case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken(&$this->renderer, &$this->session);
        $this->tpl_name = 'member/Schedule_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Schedule_Input_ja.tpl';
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
        $beforeData = $dbh->selectBasic($this->session->getParameter('semi_id'),'semi_id');

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

    //変更前のデータをDBから取得
    $semi_id = $this->session->getParameter('semi_id');
    $beforeData = $dbh->selectById($semi_id,'semi_id');

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['last_date'],$postData['last_date']);
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
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }

    //DBへUpdate
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $dbh->newupdate($diffA,$postData, $semi_id);

    if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('schedule',$this->session->getParameter('semi_id'),$diff); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, &$qform); //改良の余地あり

    //操作履歴TBLへ追加
    $history->newinsert($this->session->getParameter('semi_id'),
                        $diff // $str 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $dbh->con->commit();  // コミット
    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    break;
}

$this->renderer->assign('bpshj', "スケジュール他");
$this->renderer->assign('bpshe', "Schedule");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}
?>
