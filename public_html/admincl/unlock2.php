<?php
//*****************************************************
// unlock2.php  admincl上のプログラムのエラーからback
// ロック解除  sy_workテーブルからデータを削除します。
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';

// 不正遷移チェック
$ret = fuseiSeni(8);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}

incAdminAuthCheck();

//DB
$dbh =& new MembersDAO();

//パラメータ取得
//$semi_id = $_GET['id'];
// $lock_token = $_GET['token'];

//------------------------------------------------------------
// データの削除
//------------------------------------------------------------
$ret = $dbh->LockKaijo($_SESSION['logintoken']);

if ($dbh->getError() !== null) { //ロック解除失敗(errorがnull以外)
//    $Ret=ErrorLog('r','a',"lockkaijo",$_GET); 
} else {
  print "<body onLoad='window.close();'>";
}

?>
