<?php

/**
 * 例外処理用コントローラ
 */

$act  = $this->request->getParameter(_REQ_ACTION_);

switch ($act) {
case 'AuthError':
default:
    header("Content-Type: text/html; charset=UTF-8");

    //まだガイドブックが登録されてないのでガイドブック入力ページへ飛ばすメタを挿入
    $this->renderer->assign('meta', "<meta http-equiv='refresh' content='0; url=mypage.php?_mod=Exception&_act=Auth_Error'>");

    $this->tpl_name = '_exception/auth_error.tpl';
    break;

case 'Auth_Error':

    $this->tpl_name = '_exception/auth_error.tpl';
    break;

}

?>
