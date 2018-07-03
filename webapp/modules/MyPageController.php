<?php
/**
 * ログインとインデックスのコントローラ
 *
 */

$act  = $this->request->getParameter(_REQ_ACTION_);
session_regenerate_id(true); // 2010.5.29 追加

switch ($act) {
case 'Login':
// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//      header("Location:mypage.php?_mod=Exception");
//      exit();
// }
      $uid = $_SESSION['USERID'];
      $pwd = $_SESSION['PWD'];

    //空が渡された時
    if ($uid == '' || $pwd == '') {
      header("Location:mypage.php?_mod=Exception");
      exit();

    //プロマネ
    } elseif ($uid == _ADMIN_UID1_ && $pwd == _ADMIN_PWD1_) {
        $this->session->setParameter('auth_flg',  _USER_AUTH_FLG_);
    //管理者2 - 学術情報部
    } elseif ($uid == _ADMIN_UID2_ && $pwd == _ADMIN_PWD2_) {
        $this->session->setParameter('auth_flg', _ADMIN2_AUTH_FLG_);
    //管理者3 - CL
    } elseif ($uid == _ADMIN_UID3_ && $pwd == _ADMIN_PWD3_) {
        $this->session->setParameter('auth_flg', _ADMIN3_AUTH_FLG_);
    } else {
      header("Location:mypage.php?_mod=Exception");
      exit();
    }

    // セミナー情報を取得
    require_once _MODULE_DIR_ . 'MembersDAO.php';
    $dbh =& new MembersDAO();

    $semi_id = $dbh->Trans_Oid_Semiid($_GET['oid']);
    $this->session->setParameter('semi_id', $semi_id);
    $this->session->setParameter('oid', $_GET['oid']);

    //ロック解除
    $dbh->LockKaijo($_SESSION['logintoken']);

    if ($uid == _ADMIN_UID3_ && $pwd == _ADMIN_PWD3_) {
       header('Location:mypage.php?_mod=Basic');
    } else {
       header('Location:mypage.php?_mod=Info');
    }
    break;

case 'Logout':
    if ($act == 'Logout') {
//      unset($_SESSION['auth_flg']);
	$_SESSION = array();//セッションの初期化
    }

    //テンプレート呼出し
//    $this->tpl_name = 'member/mypage.tpl';
    break;
}
?>
