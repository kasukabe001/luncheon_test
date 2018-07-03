<?php
/**
 * プロマネ、学術情報部向けコントローラ
 */
incAuthCheck();
require_once _MODULE_DIR_ . 'MembersDAO.php';
require_once _MODULE_DIR_ . 'InfoForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickForm Admin管理部分の設定
$qform =& new InfoForm('InfoForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues($this->session->getParameter('enshaNum'));
$qform->buildFormFilters();

//DB
$dbh =& new MembersDAO();

//操作履歴DB
$history =& new HistoryDAO();

switch ($act) {

case 'Display':
default:
    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectBasic($this->session->getParameter('semi_id'),'semi_id');
    $qform->setDefaults($row);

    //座長演者の人数をセッションにセット
    $zaenAry = $dbh->getZaenNinzu($this->session->getParameter('semi_id'),1);
    $this->session->setParameter('zachoNum',$zaenAry['座長']);
    $this->session->setParameter('enshaNum',$zaenAry['演者']);

    // ファイル情報取得
    $ret = $dbh->checkFile($this->session->getParameter('semi_id'));
    $fnum = count($ret);
    if ($fnum > 0 ) {
        for ($i=0;$i<$fnum;$i++) {
	    $ipos = $i + 1;
	    $gazou .= "<a href=\"#filelist" . $ipos ."\"><img src=\"images/text.gif\" title=\"". $ret[$i]['org_filename'] . "\"></a>";
	    $ret[$i]['sys_filename'] = urlencode($ret[$i]['sys_filename']); //2012.4.20 追加
        }
	$this->renderer->assign('fnum',$gazou);
        $this->renderer->assign('fileData',$ret);
    }

    // プロマネのデータ更新を防止
//    $auth_flg = $this->session->getParameter('auth_flg');
//    if ($auth_flg == _USER_AUTH_FLG_) {
	$qform->freeze();
//    }


    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = 'public/Info_Input.tpl';

    break;


case 'Input':
case 'Confirm':
    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);
        $this->tpl_name = 'public/Info_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'public/Info_Confirm.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'public/Info_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

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
    foreach ($postData as $key => $val) { 
	$postData[$key] = unhtmlspecialchars($val);
    }

    //変更前のデータをDBから取得
    $semi_id = $this->session->getParameter('semi_id');
    $beforeData = $dbh->selectBasic($semi_id,'semi_id');
    //gakujou画面は変更項目限定
    $beforeData2 = array(
	'amail'=>$beforeData['amail'],
	'tirasi1'=>$beforeData['tirasi1'],
	'tirasi2'=>$beforeData['tirasi2'],
	'tirasi3'=>$beforeData['tirasi3'],
 	'last_date'=>$beforeData['last_date'],
	);

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['last_date'],$postData['last_date']);
    // last_dateは変更する予定　今はtimestampの項目がない

    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'public/Info_Complete.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData2,$postData);
//print_r($diffA);

    //変更がなければ
    if (count($diffA) == 0) {
        $this->renderer->assign('error', "NoData");
	$this->tpl_name = 'public/Info_Complete.tpl';
        break;
    }

    //DBへ変更
    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $dbh->newupdate($diffA,$postData, $semi_id);

    if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
        $dbh->con->rollback(); // ロールバック
//      $Ret=UpdateErrorLog('p','e',$postData['semi_id'],$diff); 
	$this->tpl_name = 'public/Info_Complete.tpl';
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }


    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData2,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, $qform); //改良の余地あり

    //操作履歴TBLへ追加
    $history->newinsert($semi_id,
                        $diff // 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $dbh->con->commit();  // コミット

    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)
    $this->tpl_name = 'public/Info_Complete.tpl';

    break;

}

$this->renderer->assign('bpshj', "基本");
$this->renderer->assign('bpshe', "Info");

?>