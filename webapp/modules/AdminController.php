<?php

/**
 * 管理者用のコントローラ
 */
incAdminAuthCheck();
require_once _MODULE_DIR_.'AdminDAO.php';
//DB
$dbh =& new AdminDAO();

$act  = $this->request->getParameter(_REQ_ACTION_);



switch ($act) {
case 'List':
default:

    // セミナー数の集計
    $CountAry = $dbh->CountSeminar();
    $this->renderer->assign('kensu', $CountAry);

    $LockAry = $dbh->SelectAllLock('sy_work','sy_work_id');
    $this->renderer->assign('lockrow', $LockAry);

    $this->tpl_name = 'admin/Admin_List.tpl';
    break;

case 'Unlock':
    // 強制ロック解除

    $semi_id = $this->request->getParameter("semi_id");
    $dbh->LockKaijo($semi_id);
    if ($dbh->getError() !== null) {   //DB変更失敗した場合
	$message = "ロックを解除できません";
    } else {
        header('Location:mypage.php?_mod=Admin');
    }
    $this->renderer->assign('msg', $message);
    $this->tpl_name = 'admin/Admin_List.tpl';

    break;

}

$this->renderer->assign('bpshj', "管理");
$this->renderer->assign('bpshe', "Admin");

?>
