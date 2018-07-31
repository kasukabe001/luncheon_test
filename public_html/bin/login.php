<?php
//############################################################
// login.php
//############################################################
// [Author] fujita
// [date] 2003/12/1
//############################################################
session_name('AstellasID');
session_start( );


// include file
include_once("../../com212/inc/const.inc");
include_once("../../com212/php/PgLib.php");

$saki = "";
if ($_POST['step'] == "login") {
  $saki = "";
} else if ($_POST['step'] == "kanri") {
  $saki = "admincl/";
}

$Error ="";
if( !$_POST['id'] ) {
  $Error .= "<LI>IDを指定してください\n";
}
if( !$_POST['psw'] ) {
  $Error .= "<LI>パスワードを指定してください\n";
}
$cpos=strpos($_POST['psw'],"or"); //SQLインジェクション対策
if( $cpos > 0) {
  $Error .= "<LI>パスワードに誤りがあります\n";
}
if( $Error ) {
  include "../../com212/php/error_header.php";
  $Error .= "<br><br><a href=\"../" . $saki . "index.html\">再ログイン</a>";
  print $Error . "</html>";
  exit;
}

$postgres = new PgLib( $DBNAME,$DBUSER,$PASSWD );
if( !$_db = $postgres->Select_Recode("select * from username where userid='".$_POST['id']."' and password='".$_POST['psw']."'") )
{
//  include "error.php";
  include "../../com212/php/error_header.php";
  $Error .= "<LI>IDかパスワードに誤りがあります<br><br>";
  $Error .= "<a href=\"../" . $saki . "index.html\">再ログイン</a>";
  print $Error . "</html>";
  exit;
}
$_SESSION['USERID'] = $_POST['id'];
$_SESSION['PWD'] = $_POST['psw'];
$logintoken = md5(microtime()); // 2012.2.25 追加
$_SESSION['logintoken'] = $logintoken; // 2012.2.25 追加

//------------------------------------------------------------
// 受付画面の表示
//------------------------------------------------------------
$err_msg = "URLをご確認ください</a>";
$kubun = trim($_db['junl']);
if ($kubun=="pm") {
	$_SESSION['param'] = $modea;
	header("location: ./part.php?p=a2056d8903487584er8");
	exit;
} else if ($kubun=="as") {
	$_SESSION['param'] = $modeb;
	header("location: ./part.php?p=5c549rw87867667zvfsj");
	exit;
} else if ($kubun=="cl") {
	$_SESSION['param'] =$modec;
	header("location: ./part.php?p=w601e05727868daklb78");
	exit;
}
include ("../../com212/php/error_header.php");
print "<br><br>" . $err_msg . "</html>";
session_destroy();
?>
