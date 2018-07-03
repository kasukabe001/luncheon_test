<?php
/**
 * 登録申込のコントローラ
 */
incAuthCheck();

require_once _MODULE_DIR_ . 'AdminDAO.php';
require_once _MODULE_DIR_ . 'AdminForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new AdminForm('AdminForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues();
if ($act != 'Input') {
  $qform->buildFormFilters();
}
$qform->buildFormRules();

//メンバーDB
$dbh =& new AdminDAO();


switch ($act) {
//入力、確認部分
case 'Input':
case 'Confirm':
default:

    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);

        $this->tpl_name = 'admin/AdminTantou_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();
            $this->tpl_name = 'admin/AdminTantou_Confirm.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'admin/AdminTantou_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());
    break;


//DB追加
case 'Insert':
    //トークンのチェック
    $checkToken = validateToken2($this->request->getParameter('token'), $this->session->getParameter('token'));

    //トークンチェックが false ならリロード禁止ページを表示
    if ($checkToken === false) {
	$this->tpl_name = '_exception/reloaded_ja.tpl';
        unset($_SESSION['token']);
        break;
    }

    //QFから渡されたPOSTデータを抽出
    $postData = $qform->exportValues();

    //DBへInsert

    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $afterData = $dbh->insert($postData);
    //DBへ追加が成功すれば(errorがnullなら)
    if ($dbh->getError() === null) {
	$dbh->con->commit();  // コミット
	$this->tpl_name = 'admin/AdminTantou_Complete.tpl';
    //DBへ登録失敗した場合
    } else {
        $dbh->con->rollback(); // ロールバック
	$Ret=ErrorLog('AdminMaster',$_SERVER['HTTP_USER_AGENT'],$postData); 
        $this->renderer->assign('error', $GLOBALS['ERROR_ADD_DB']['ja']);
	$this->tpl_name = 'admin/Registration_Error_ja.tpl';
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);

    $this->renderer->assign('form', $renderer->toArray());
    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

    break;

}

?>
