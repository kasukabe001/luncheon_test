<?php
/**
 * プロマネ・学術情報部用座長のコントローラ
 *
 */
// incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'EnjaForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new EnjaForm('EnjaForm');
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

    //DBから演者情報を取得し、QFにセット
    $ensharow = $dbh->selectZacho($this->session->getParameter('semi_id'),'演者');
    $qform->setDefaults($ensharow);

    $this->renderer->assign('gakkai', $row['gakkai']);

    $qform->freeze();


    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = 'public/Speaker.tpl';
    break;


}

?>
