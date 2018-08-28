<?php
//############################################################
// adm_down2012.php ファイルダウンロード
//############################################################
//【使用上の注意】
// adm_down.phpを修正
// ２．プロジェクト名称を設定する
//【作成者】Fujita Kazuhiko
//【作成日】2012/03/23
//############################################################
session_cache_limiter('public'); // SSL対策
set_time_limit(20); // SSL対策
require_once("../../webapp/config.php");
//session_name('AstellasID');
//session_start( );


// 不正遷移チェック
//if( (!$_SESSION['oid']) || !$_SESSION['PWD'] ) { 
if( (isset($_SESSION['oid']) == false) || isset($_SESSION['PWD']) == false ) {
  if (isset($_SESSION['USERID']) == false) { // Top pageからの表示に対応して追加 08/02/16
    include ("../../com212/php/error_header.php");
    print "<font color=red>- Error -</font><br>\n";
    print "File read error" . "<br>";
    include_once ("../../com212/php/close_footer.php");
    exit;
  }
}



// $downfile=$_GET['fname'];
$downfile=urldecode($_GET['fname']); // 2012.4.20追加

//$downfile = replaceKishuizon($downfile); // 機種依存文字対応 2018.8.18
//$downfile = mb_convert_encoding($downfile,"SJIS","UTF-8"); // 2012.4.20追加
$downfile = mb_convert_encoding($downfile,"sjis-win","UTF-8"); // 2012.4.20追加

$downfile = preg_replace("/(\n|\r\n|\t)/","",$downfile); 

// 2018.8.2 追加
if (ctype_alpha(substr($_GET['fname'],0,1))) { 
    $semi_id = substr($_GET['fname'],3,4);
} else {
    $semi_id = substr($_GET['fname'],0,4);
}


$file=$semi_id . "/" . $downfile;  // 2012.4.20追加

if ($semi_id <= '0350') {
    $dirfrom = _UPLOAD_350_ . $file;
} else if ($semi_id < '1000') {
    $dirfrom = _UPLOAD_787_ . $file;
} else {
    $dirfrom = _UPLOAD_DIR_ . $file;
}

$kari_ext = substr($downfile,-4);
$ext_1 = substr($kari_ext,0,1);
if ($ext_1 == ".") $ext = substr($downfile,-3);
 else $ext = $kari_ext;
$ext=strtolower($ext);

if ($ext == "xls") {
  header("Content-type: application/ms-excel");
} else if ($ext == "doc") {
  header("Content-type: application/ms-word");
} else if ($ext == "ppt") {
  header("Content-type: application/ppt");
} else if ($ext == "pdf") {
  header("Content-type: application/pdf");
} else if ($ext == "tif") {
  header("Content-type: image/tif");
} else if ($ext == "xlsx") {
  header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
} else if ($ext == "docx") {
  header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
}

header("Content-Disposition: inline; filename=\"$downfile\"");
readfile($dirfrom);

exit;
?>

