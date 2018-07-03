<?php
require_once '../webapp/config.php';
// require_once '/home/gairai/webkeio/config.php';

$request  =& new Request();
$session  =& new Session();
$renderer =& new MySmarty();

$tpl_name    = null;
$display_flg = null;

$controller =& new Controller($request, $session, $renderer);
$controller->execute();

class Controller
{

    var $request  = null;
    var $session  = null;
    var $renderer = null;


    function Controller($request, $session, $renderer)
    {
        $this->request  =& $request;
        $this->session  =& $session;
        $this->renderer =& $renderer;
    }

    function execute()
    {
        //モジュール名を取得
        $mod =& $this->request->getParameter(_REQ_MODULE_);
        if (preg_match("/^[0-9a-zA-Z]+$/", $mod) == 0 || $mod == ''|| $mod == 'Index') {
            require_once(_MODULE_DIR_ . 'MyPageController.php');
        } else {
            @require_once(_MODULE_DIR_ . $mod . 'Controller.php');
        }

        $this->display();
    }

    function display()
    {
        if (isset($this->display_flg)) {
//      if ($this->display_flg !== null) { // 原文 2008.5.21 修正 PHP Notice:を防ぐ
            return;
        }

        //登録、変更、削除をセット
        $type = $this->request->getParameter('_type');
        $this->renderer->assign('typeNameLabel', $GLOBALS['TYPE_NAME_LABEL'][$type]);

        if (isset($this->tpl_name)) {
//      if ($this->tpl_name != '') {// 原文 2008.5.21 修正 PHP Notice:を防ぐ
            $this->renderer->display($this->tpl_name);
        } else {
            $this->renderer->display('member/mypage.tpl');
        }
    }

}
//echo '<!--' . get_cfg_var("session.gc_maxlifetime") . '-->';
//echo '<!--' . ini_get("session.gc_maxlifetime") . '-->';
?>
