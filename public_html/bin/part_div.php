<?php
//############################################################
// part_div.php
//############################################################
// 1.MR用参加者リストを表示する
// 2.part.phpより検索パラメータを受領
// [Author] fujita
// [date] 2007/12/30
//############################################################
session_cache_limiter("private");
session_cache_expire (30);
session_name('AstellasID');
session_start();

// 不正遷移チェック

$Error ="";
if( !$_SESSION['USERID'] ) {
  $Error .= "<LI>IDを入力してください";
}
if( !$_SESSION['PWD'] ) {
  $Error .= "<LI>パスワードを入力してください";
}

if ($_GET[usersql]) { // 2ページ目以降
//  print ("<body onload=\"senichk(2);hide();\" onunload=\"TopWindowClose();\">");
} else { // 最初のページ
//  print ("<body onload=\"senichk(1);hide();\" onunload=\"TopWindowClose();\">");
// 2ページ目以降の表示がエラーになるので senichk()は使用せず, $_SERVER["HTTP_REFERER"]を使用
// URLからpart_divを直接打ち込んだ場合を検出
  $hantei ="NG";
  $mystring = $_SERVER["HTTP_REFERER"];
  $str1 = "https:";
  $pos1 = strpos($mystring ,$str1);
  $str2 = "linkage-staff.jp/";
//  $str2 = "61.206.45.171";
  $pos2 = strpos($mystring ,$str2);
  if (($pos1 == 0 ) && ($pos2 == 8)) $hantei = "OK";
  if ($hantei == "NG") {
    $Error .= "<LI>不正遷移エラー" & $mystring;
  }
}

if( $Error ) {
  include_once ("../../com212/php/error_header.php");
  $Error .= "<br><br><a href=\"../index.html\" target=_top>ログイン画面</a>";
  print $Error."</html>";
  exit;
}

require("../../com212/inc/const.inc");
require("../../com212/inc/dbconnect.ini");
require("../../com212/inc/pgselect2.ini");
require("../../com212/inc/pgmetadata.ini");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" /> 
<meta http-equiv="Content-Language" content="ja">
<LINK href="../css/stats_top.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="../js/part_body.js"></script>
<script type="text/javascript" src="../js/member.js"></script>
</head>
<!--body onload="senichk();hide();" onunload="TopWindowClose();"-->
<body onload="hide();rCheck();" onunload="TopWindowClose();" topmargin="0" leftmargin="0">

<?php

class myPgSelect2 extends PgSelect2 {
  function printUpdateTag($oid) {
    global $PHP_SELF, $usersql, $offset, $num;
    $usql = urlencode($usersql);
    $cmod = $num % 2;
    if ($cmod == 1) $cc="#FFA07A"; //f0f0f0 FFA07A
	else $cc="#ffffff";

    print ("<td height=35 class=FreezingCol style =\"FONT:mspgothic; FONT-SIZE: 12px; COLOR: #0000ff; LINE-HEIGHT: 130%; BACKGROUND-COLOR: $cc;\" >");
   print ("<input type=button value=\"詳細\" onclick=\"TopWindow($oid,$cmod);\">");
    $num += 1;
  }

}
class myPgMetaData extends PgMetaData {
}
function myCheck($atrlist) {
  return(true);
}

// make SQL Statement
$__table_name__= $TBL_NAME;
$table_name=$__table_name__;
// データベース・オープン
$d = new DbConnect($DBNAME,$DBUSER,$PASSWD);
$m = new myPgMetaData;

//------------------------------------------------------------
// パラメータの判定
//------------------------------------------------------------
$nd="";     // 年度
$stat="";   // 進捗中 終了
$rk="";
$kb="";
$gk="";
$zaen="";
// print $_GET['ifra'];

$n1 = substr($_GET['ifra'],0,2);
$s1 = substr($_GET['ifra'],2,1);
$r1 = substr($_GET['ifra'],3,1);
$k1 = substr($_GET['ifra'],4,2);
$z1 = substr($_GET['ifra'],6,1);
$gk = substr($_GET['ifra'],7);
$gk = urldecode($gk);

// 2010.9 追加
$hm = $_GET['hm'];
$hm = urldecode($hm);
//$hm = mb_convert_encoding($hm,"eucJP-win","UTF-8"); 
$pl = $_GET['pl'];
$pl = urldecode($pl);
//$pl = mb_convert_encoding($pl,"eucJP-win","UTF-8"); 
$ze = $_GET['ze'];
$ze = urldecode($ze);
//$ze = mb_convert_encoding($ze,"eucJP-win","UTF-8"); 

// print "<br>" . $ze;

switch ($n1) {
  case(1):
  $nd="2007";
  break;
  case(2):
  $nd="2008";
  break;
  case(3):
  $nd="2009";
  break;
  case(4):
  $nd="2010";
  break;
  case(5):
  $nd="2011";
  break;
  case(6):
  $nd="2012";
  break;
  case(7):
  $nd="2013";
  break;
  case(8):
  $nd="2014";
  break;
  case(9):
  $nd="2015";
  break;
  case(10):
  $nd="2016";
  break;
  case(11):
  $nd="2017";
  break;
  case(12):
  $nd="2018";
  break;
  case(13):
  $nd="2019";
}

switch ($s1) {
  case(1):
  $stat="進行中";
  break;
  case(2):
  $stat="終了";
}
switch ($r1) {
  case(1):
  $rk="循環器";
  break;
  case(2):
  $rk="免疫";
  break;
  case(3):
  $rk="感染症";
  break;
  case(4):
  $rk="中枢";
  break;
  case(5):
  $rk="泌尿器";
  break;
  case(6):
  $rk="消化器";
  break;
  case(7):
  $rk="マーケ";
  break;
  case(8):
  $rk="その他";
}
if ($z1 == 0) {
  $zaen = "Both";
} else if ($z1 == 1) {
  $zaen = "chair";
} else if ($z1 == 2) {
  $zaen = "ensha";
}
if ($k1 == "00") {
  $kb="";
} else {
  $kb="/" . $k1 . "/";
}
//------------------------------------------------------------
// カラム名の取得
//------------------------------------------------------------
$m->getMetaData($table_name);
if ($mode != "insert" && $mode != "update") {
  $n = count($m->md);
  for($i=0;$i<$n;$i++) {
    $FIELD[$i]= $m->md[$i]["name"];
    $atrlist[$FIELD[$i]]= "";
  }
//  $sort = "semi_id";  // 08_01_22 修正
//  $sort = "narabi";   // 08_01_29 修正
  $sort = "kaisaibi";
  $atrlist["nendo"] = $nd;
  $atrlist["ryoiki"] = $rk;
  $atrlist["status"] = $stat;
  if (!empty($kb)) $atrlist["kaisaibi"] = $kb;
  $atrlist["sys_stat"] = "0";
  if (!empty($gk)) $atrlist["gakkai"] = $gk;
  if (!empty($hm)) $atrlist["hinmoku"] = $hm;
  if (!empty($pl)) $atrlist["place"] = $pl;
  if (!empty($ze)) {
    if ($zaen == 'Both') $atrlist["chair2"] = $ze;      // 両方
    if ($zaen == 'chair') $atrlist["chair1"] = $ze;      // 座長
    if ($zaen == 'ensha') $atrlist["enshaname1"] = $ze;  // 演者
  }
}

// $m->setAliases($Reg_Att_name);

// データ入力or更新／削除フォーム
if ($mode == "inputForm" || $mode == "updateForm") {
  $m->getMetaData($table_name);
  $m->setColumnPrintType(true);
  $m->printDataInputForm($mode);

  // データ入力/変更/削除SQLの実行
} else if ($mode == "insert" || $mode == "update") {
  if ($mode == "insert") {
    $kind = "登録";
    $f = $m->insertSQL(myCheck);
  } else if ($mode == "update" && $update) {
    $kind = "更新";
    $f = $m->updateSQL(myCheck);
  } else {
    $kind = "削除";
    $f = $m->deleteSQL();
  }
  if ($f == false) {
    print("データ".$kind."に失敗しました。");
    $msg = pg_errorMessage();
    if ($msg) {
      printf("理由: %s<br>\n",pg_errorMessage());
    }
  } else {
    print("データ".$kind."に成功しました。<br>\n");
    if ($mode == "insert") {
      print("<a href=\"$PHP_SELF?mode=insert\">データ登録に戻る</a>\n");
    } else {
      $usql = urlencode($usersql);
      $url = "$PHP_SELF?usersql=$usql&offset=$offset";
    }
  }

/*
} else if ($atrlist) {	// 最初のページ
  $s = new myPgSelect2;
$rows= $s->doSelect($m->makeSQL($sort,true),0);
//print "&nbsp;&nbsp;<a href=\"#top\">Top</a><a name=\"btm\"></a>";
*/

} else if ($atrlist) {	// 最初のページ
  $s = new myPgSelect2;
  if ($_GET[usersql]) { // 2ページ目以降
	$sqlimg = $_GET[usersql];
  } else { // 最初のページ
	$sqlimg = $m->makeSQL($sort,true);
  }
  $rows= $s->doSelect($sqlimg,0);

/*
} else if ($usersql) {	// 2ページ以降
  $s = new myPgSelect2;
  $s->doSelect(0);
*/
}

$d->doClose();
$_SESSION['chkkai'] += 1;

?>
<!-- /table --></div>
</body>
</html>
