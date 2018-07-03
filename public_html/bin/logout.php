<?php
session_name('AstellasID');
session_start();

//------------------------------------------------------------
// ロック解除
//------------------------------------------------------------
include_once("../../com212/inc/const.inc");
$conn = @pg_connect($OPEN);
$str_user="delete from sy_work where lock_token ='" . $_SESSION['logintoken'] . "'";
$result = @pg_exec($conn, $str_user);
pg_close($conn);



	$_SESSION = array();//セッションの初期化
session_destroy();

header("location: ../index.html");

?>
