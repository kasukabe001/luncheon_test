<?php
/**
 * プロマネ・学術情報部用座長のコントローラ
 *
 */
// incAuthCheck();

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


switch ($act) {
case 'Display':

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

    $qform->freeze();


    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = 'public/Chairman.tpl';
    break;

}

?>
