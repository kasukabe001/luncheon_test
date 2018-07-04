<?php
/**
 * 一般ユーザ用ガイドブック管理のコントローラ
 *
 */
// incAuthCheck();

require_once _MODULE_DIR_.'MembersDAO.php';
require_once _MODULE_DIR_.'ListForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickFormの設定
$qform    =& new ListForm('ListForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);
$qform->buildFormValues();
$qform->buildFormFilters();
//$qform->buildFormRules();

//DB
$dbh =& new MembersDAO();

switch ($act) {
case 'Display':
default:
    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectById($this->session->getParameter('semi_id'),'semi_id');
    $qform->setDefaults($row);

    //DBから座長情報を取得
    $zachorow = $dbh->selectZacho($this->session->getParameter('semi_id'),'座長',2);
    //DBから演者情報を取得
    $ensharow = $dbh->selectZacho($this->session->getParameter('semi_id'),'演者',2);


    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->renderer->assign('gakkai', $row['gakkai']);
    $this->renderer->assign('seminar', $row['seminar']);

    $this->renderer->assign('chair', $zachorow);
    $this->renderer->assign('ensha', $ensharow);
    $this->renderer->assign('ninzu', count($zachorow) + count($ensharow));
//$this->session->setParameter('oid','8889999'); // 2016.8.22追加

    $this->tpl_name = 'member/List.tpl';
    break;

}

?>
