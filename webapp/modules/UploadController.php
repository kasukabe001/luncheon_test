<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *
 */
incAuthCheck();
require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'UploadDAO.php';
require_once _MODULE_DIR_.'UploadForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new UploadForm('UploadForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
$qform->buildFormFilters();
$qform->buildFormRules();

//DB
$dbh =& new MembersDAO();
$updbh =& new UploadDAO();

//操作履歴DB
$history =& new HistoryDAO();

switch ($act) {
case 'Display':
default:

    //トークンのセット
    createToken(&$this->renderer, &$this->session);
    //DBからセミナー情報を取得し、QFにセット

    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->renderer->assign('seminar', $row['seminar']);

    // 登録完了フラグ クリア
    unset($_SESSION['endflg']);

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

    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = 'member/Upload.tpl';
    break;


case 'Confirm':
    //入力エラーチェック　エラーが無い時

    if ($qform->validate()) {
//      $qform->freeze();
	$postData = $qform->exportValues();

    } else {
        //入力エラーチェック　エラーがあった時

    //DBからセミナー情報を取得し、QFにセット
	$row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
	$this->renderer->assign('gakkai', $row['gakkai']);
	$this->renderer->assign('seminar', $row['seminar']);

	$qform->accept($renderer);
	$this->renderer->assign('form', $renderer->toArray());

	$this->tpl_name = 'member/Upload.tpl';
	break;
    }


// case 'Insert':

    // URL直接入力対策
    $postToken = $this->request->getParameter('token');
    if (empty($postToken) == true) {
	$this->tpl_name = 'member/Registration_Error_ja.tpl';
	break;
    }

	$postData = $qform->exportValues();

	//Uploadファイルの情報取得
	// ファイル名
	$file_name = $_FILES['org_filename']['name'];
	// ファイル種別
	$extension = strrchr($_FILES['org_filename']['name'],".");

	// sys_numの取得
	$ary=$updbh->getFileNum($this->session->getParameter('semi_id'));
	$max_sys_num=$ary['sys_num'];
	$sys_num=intval($max_sys_num) + 1;

	// ファイル名の置き換え
	$iso1 = sprintf("%04d", $this->session->getParameter('semi_id'));
	$iso2 = sprintf("%03d", $sys_num);
	$sys_num2 = sprintf("%02d", $sys_num);
	if ($postData['remark'] == "開示承諾書") {
	   $sys_filename = "SYK" . $iso1 . $sys_num2 . "-" . $file_name; //同名対策
	} else if ($postData['remark'] == "応諾書") {
	   $sys_filename = "SYD" . $iso1 . $sys_num2 . "-" . $file_name;
	} else {
	   $sys_filename = "SYS" . $iso1 . "-" . $iso2 . $extension;
	}

	// ディレクトリの存在チェック
	if ($this->session->getParameter('semi_id') <= '350') {
	    $dir=_UPLOAD_350_ . $iso1;
	    $uploaddir=_UPLOAD_350_ ;
	} else if ($this->session->getParameter('semi_id') < '1000') {
	    $dir=_UPLOAD_787_ . $iso1;
	    $uploaddir=_UPLOAD_787_ ;
	} else {
	    $dir=_UPLOAD_DIR_ . $iso1;
	    $uploaddir=_UPLOAD_DIR_ ;
	}
	if(!is_dir($dir)) {
 	    $this->renderer->assign('error', "アップロード用ディレクトリがありません");
            $this->tpl_name = 'member/Upload_Complete.tpl';
	    break;
	}

	//Uploadファイルの情報取得と設定
	$val["sys_filename"] = $sys_filename;
	$val["org_filename"] = $_FILES['org_filename']['name'];
	$val["sys_num"] = $sys_num;
	$val["sys_folder"] = $iso1;
	$val["filesize"] = $_FILES['org_filename']['size'];
	$val["remark"] = $postData['remark'];

	$updbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
	// DB登録 
 	$ret = $updbh->insert_file($val,$this->session->getParameter('semi_id'));

	//DBへ追加が成功すれば(errorがnullなら)
	if ($updbh->getError() === null) {
	    // ファイルアップロードとリネームを行う
	    $sys_filename = mb_convert_encoding($sys_filename, "SJIS", "AUTO");// 日本語文字化け対策
//	    $point = _UPLOAD_DIR_ . $iso1 . "/" . $sys_filename;
	    $point = $uploaddir . $iso1 . "/" . $sys_filename;

	    if (is_uploaded_file($_FILES['org_filename']['tmp_name'])) {
		@move_uploaded_file($_FILES['org_filename']['tmp_name'],$point);
	    } else {
	        $updbh->con->rollback(); // ロールバック
		Errorlog("upload",4,$val);
                $this->tpl_name = 'member/Registration_Error_ja.tpl';
		exit;
            }

	    // メール送信
	    CompleteMail('upload',$val);
	    $updbh->con->commit();  // コミット
            $this->tpl_name = 'member/Upload_Complete.tpl';

	    //DBへ登録失敗した場合
	} else {
	    $updbh->con->rollback(); // ロールバック
            $Ret=ErrorLog('upload',5,$val);
            $this->tpl_name = 'member/Registration_Error_ja.tpl';
        }

        $updbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

}

$this->renderer->assign('bpshj', "ファイルアップロード");
$this->renderer->assign('bpshe', "Upload");

?>
