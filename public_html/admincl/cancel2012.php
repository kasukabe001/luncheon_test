<?php
//############################################################
// cancel2012.php
//############################################################
// 1.申込みキャンセル
// 2.Received Parameter
//   $_POST['rd'] $_SESSION['table']
// [Author] fujita
// [date] 2012/03/23
//############################################################
session_name('AstellasID');
session_start( );

//============================================================
// 外部ファイル読込
//============================================================
include_once("../../com212/inc/const.inc");
include_once("../../com212/inc/dbutil.inc");
include_once("../../com212/php/errorcheck.php");

//------------------------------------------------------------
// 不正遷移チェック
//------------------------------------------------------------
$Error ="";
if( !$_SESSION['oid'] ) {
  err_out(9);
  include_once ("../../com212/php/close_footer2012.php");
  exit;
}
if( !$_POST['reg_id'] ) {
  err_out(2);
  include_once ("../../com212/php/close_footer2012.php");
  exit;
}

//------------------------------------------------------------
// データベース・オープン
//------------------------------------------------------------
$conn = @pg_connect("$OPEN");
if($conn == false) {
  err_out(1);
  include ("../../com212/php/close_footer2012.php");
  exit;
}

//-------------------------------------------------------------------
// 既定値の設定
//-------------------------------------------------------------------
$today = date("Y-n-j");
$ima = date("H:i:s");
$reg_id = $_POST['reg_id'];

//-------------------------------------------------------------------
// 削除データの取得
//-------------------------------------------------------------------
$sql ="select * from " . $UP_TBL ." where reg_id = " . $_POST['reg_id'];
$result = pg_exec($conn, $sql);
if (!$result || pg_numrows($result) == 0) {
  err_out(3);
  include ("../../com212/php/close_footer2012.php");
  exit;
}
$arr = pg_fetch_array($result,0);
$file_name = $arr["sys_filename"];
// 日本語対応 2012.1.28
//$file_name = mb_convert_encoding($file_name, "SJIS", "AUTO");
$file_name = mb_convert_encoding($file_name, "sjis-win", "AUTO");

$folder_name = $arr["sys_folder"];
if ($folder_name <= '0350') {
    $upload_path = $UPLOAD_350_PATH;
} else if ($folder_name < '1000') {
    $upload_path = $UPLOAD_787_PATH;
} else {
    $upload_path = $UPLOAD_FILE_PATH;
}

// ファイルの存在チェック
//$file=$UPLOAD_FILE_PATH . $folder_name . "/" . $file_name;
$file=$upload_path . $folder_name . "/" . $file_name;
if(!file_exists($file)) {
  err_out(12);
  include ("../../com212/php/close_footer2012.php");
  exit;
}

//-------------------------------------------------------------------
// データ更新
//-------------------------------------------------------------------
pg_exec("begin"); //トランザクション開始

// fileテーブル statusを1にする
$upd_sql = "UPDATE " . $UP_TBL . " set ";
$upd_sql .= "status =1, del_date='" . $today . "'";
$upd_sql .= " where reg_id =" . $_POST['reg_id'];

$result = @pg_exec($conn, $upd_sql);
if (!$result) {
	Errorlog("cancel",2,$upd_sql);
	err_out(4);
	include ("../../com212/php/close_footer.php");
	pg_exec("rollback");
	exit;
}

//ファイル削除 フォルダ名の追加
   if ($arr['remark'] == "開示承諾書" || $arr['remark'] == "応諾書" || $arr['remark'] == "伝票" || $arr['remark'] == "役割分担表"|| $arr['remark'] == "趣意書" || $arr['remark'] == "アンケート" || $arr['remark'] == "MR宛mail" || $arr['remark'] == "役割分担表") {
	$vpos=strpos($file_name,"-");
	$file_name = substr($file_name,0,$vpos) . "*";
   }

	$str1 = "rm " . $upload_path . $folder_name . "/" . $file_name;

	system($str1,$rt);
	if ($rt != 0) { 
	  Errorlog("cancel",4,$str1);
	  err_out(4);
	  include ("../../com212/php/close_footer2012.php");
	  pg_exec("rollback");
	  exit;
	}

	pg_exec("end"); // Tranzaction 完了

	// データベースのクローズ
	pg_close($conn);

//-------------------------------------------------------------------
// 6 終了画面表示
//-------------------------------------------------------------------
$backto="../mypage.php?_mod=Basic";
header("location: $backto");
exit;

/**
 * 機種依存文字を変換
 * ファイル名に機種依存文字が使用されるのを防ぐため
 * @param  string $subject 
 * @return string 
 */

function replaceKishuizon( $subject='' ){
  $search  = array( '①', '②', '③', '④', '⑤', '⑥', '⑦', '⑧', '⑨', '⑩', 'Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', '㈱','﨑', '髙' );
  $replace = array('(1)','(2)','(3)','(4)','(5)','(6)','(7)','(8)','(9)','(10)','I','II','III','IV','V','崎','高');
  $result = str_replace($search, $replace, $subject);
  return $result;
}

?>

