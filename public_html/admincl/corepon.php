<?php
//############################################################
// corepon.php
//############################################################
// 1.コレポンデータ修正用
// [Authote] 藤田和彦
// [Date]  2012/3/9
// ファイルアップロード画面表示
// 受取り $semi_idをGETで
// 引渡し $semi_idをPOSTで
//############################################################
//session_start();
//============================================================
// 外部ファイル読込
//============================================================
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';


//------------------------------------------------------------
// 不正遷移チェック
//------------------------------------------------------------
// 呼び出し元が二つある。
/*
$ret = fuseiSeni(2);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}
*/


// IPアドレスチェック
incAdminAuthCheck();

//DB
$dbh =& new MembersDAO();

//============================================================
// パラメータの引継ぎと画面指定
//============================================================
$semi_id = $_GET['p'];  //パラメータ取得
$tmpl = file("./corepon.html"); // 画面指定

//============================================================
// ユーザデータの読込み
//============================================================
$row = $dbh->selectById($semi_id,'semi_id');

	$semi_id = $row['semi_id'];
	$gakkai = $row['gakkai'];
	$seminar = $row['seminar'];
	$corepon = $row['corepon'];

//============================================================
// 申込みフォームの読込み
//============================================================
reset($tmpl);
while(list(,$value) = each($tmpl)) {
	$i = 0;
	$value = ereg_replace("#semi_id#", $semi_id, $value);
	$value = ereg_replace("#gakkai#", $gakkai, $value);
	$value = ereg_replace("#seminar#", $seminar, $value);
	$value = ereg_replace("#corepon#", $corepon, $value);
	print $value;
}
?>
