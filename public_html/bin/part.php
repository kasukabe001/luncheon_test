<?php
//############################################################
// part2018.php
//############################################################
// 1.ログイン後TOPページ表示
// 2.インラインフレーム内に検索結果を表示
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
if( $Error ) {
  include_once ("../../com212/php/error_header.php");
  $Error .= "<br><br><a href=\"../index.html\">ログイン画面</a>";
  print $Error."</html>";
  exit;
}

require_once("../../com212/inc/const.inc");

//------------------------------------------------------------
// データベース・オープン
//------------------------------------------------------------
$conn = @pg_connect($OPEN);

if($conn == false) {
  err_out(1);
  include ("../../com212/php/close_footer2012.php");
  exit;
}

$result = @pg_exec($conn,"select * from sy_seihin order by id");
$num_rows = pg_numrows($result); // レコード数を確認します
$seihin_tantou=array();
for ($i = 0;$i < $num_rows;$i++) {
  $row = pg_fetch_array($result,$i,PGSQL_ASSOC);
  $seihin_tantou[] = $row['name'];
}
$result = @pg_exec($conn,"select * from sy_soshiki order by id");
$num_rows = pg_numrows($result); // レコード数を確認します
$soshiki_tantou=array();
for ($i = 0;$i < $num_rows;$i++) {
  $row = pg_fetch_array($result,$i,PGSQL_ASSOC);
  $soshiki_tantou[] = $row['name'];
}
$result = @pg_exec($conn,"select * from sy_linkage order by id");
$num_rows = pg_numrows($result); // レコード数を確認します
$cl_tantou=array();
for ($i = 0;$i < $num_rows;$i++) {
  $row = pg_fetch_array($result,$i,PGSQL_ASSOC);
  $cl_tantou[] = $row['name'];
}
//------------------------------------------------------------
// データベース・クローズ
//------------------------------------------------------------
pg_close($conn);


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ja">
<LINK href="../css/stats_top.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="../js/part_head.js"></script>

<title>学会一覧</title>

</head>
<body onload='doAction(2);' onunload='SndWindowClose();' topmargin="0">
<div id=container>
<div id=boxA>
<form name=headform style="margin-bottom=1px;"><br>
<table width=100% cellpadding=4 cellspacing=4><tr>
<td width="75%" bgcolor="#FFffff" style="border:double;FONT-SIZE: 12px;white-space: nowrap;">
<div style="line-height:275%;padding-top:0px;padding-bottom:0px;">
&nbsp;<b>年&nbsp;&nbsp;&nbsp;度</b>：&nbsp;<select size=1 name="n" STYLE="background-color:#ffffff;">
    <option value="" > </option>
    <option value="0" >2007</option>
    <option value="1" >2008</option>
    <option value="2" >2009</option>
    <option value="3" >2010</option>
    <option value="4" >2011</option>
    <option value="5" >2012</option>
    <option value="6" >2013</option>
    <option value="7" >2014</option>
    <option value="8" >2015</option>
    <option value="9" >2016</option>
    <option value="10">2017</option>
    <option value="11" selected>2018</option>
    <option value="12" >2019</option>
    </select>年

&nbsp;<select size=1 name="t" STYLE="background-color:#ffffff;">
    <option value="" selected > </option>
    <option value="01" >1</option>
    <option value="02" >2</option>
    <option value="03" >3</option>
    <option value="04" >4</option>
    <option value="05" >5</option>
    <option value="06" >6</option>
    <option value="07" >7</option>
    <option value="08" >8</option>
    <option value="09" >9</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    </select>月

&nbsp;&nbsp;<b>進捗</b>：<select size=1 name="s" STYLE="background-color:#ffffff;" >
    <option value="" > </option>
    <option value="3" selected>進行中</option>
    <option value="4" >終了</option>
    </select>

&nbsp;&nbsp;<b>領域</b>：<select size=1 name="r" STYLE="background-color:#ffffff;" id="r" onchange="selRyoiki(this);">
    <option value="" selected > </option> 
    <option value="11" >循環器・内分泌領域</option>
    <option value="12" >免疫アレルギー領域</option>
    <option value="13" >感染症領域</option>
    <option value="14" >中枢領域</option>
    <option value="15" >泌尿器領域</option>
    <option value="16" >消化器・運動器領域</option>
    <option value="17" >マーケティンク゛統括</option>
    <option value="18" >その他（化血研等）</option>
    </select>

&nbsp;<a href="javascript:void(0);" onclick="SndWindow(4)">品目</a>：
<input type="text" name="h" size=10 id="h" STYLE="border-style:none; background-color:#CFCFCF">

&nbsp;<B>製品担当</B>：
<input type="text" name="seihin" list="seihinmember" autocomplete="on" size=7>
  <datalist id="seihinmember">
    <option value="" >
<?php
	foreach($seihin_tantou as $val) {
	  print "<option value='" . $val . "'>";
	}
?>
  </datalist>

&nbsp;<B>組織化担当</B>：
<input type="text" name="soshiki" list="soshikimember" autocomplete="on" size=7>
  <datalist id="soshikimember">
    <option value="">
<?php
	foreach($soshiki_tantou as $val) {
	  print "<option value='" . $val . "'>";
	}
?>
  </datalist>
&nbsp;<B>CL担当</B>：
<input type="text" name="cl" list="clmember" autocomplete="on" size=7>
  <datalist id="clmember">
    <option value="">
<?php
	foreach($cl_tantou as $val) {
	  print "<option value='" . $val . "'>";
	}
?>
  </datalist>
&emsp;
<input type="button" value="ｸﾘｱ" onclick="clrbtn();" title="年度と進捗以外の項目をクリア">
<img src="../images/spacer.gif" width="130" height="3"><br>
&nbsp;<B>学会名</B>：
<input type="text" name="g" size=32 STYLE="border-style:none; background-color:#CFCFCF">
&nbsp;&nbsp;<B>会場名</B>：
<input type="text" name="p" size=16 STYLE="border-style:none; background-color:#CFCFCF">
&nbsp;&nbsp;
<B><input type=radio name=r1 value="za" >座長 <input type=radio name=r1 value="en">演者</B>
&nbsp;<input type="button" value="BC" onclick="clrbtn2();" STYLE="padding:3px 2px 3px 2px;" title="座長・演者の選択をクリア">
：&nbsp;<input type="text" name="z" size=14 STYLE="border-style:none; background-color:#CFCFCF">
&emsp;<input type="button" value=" 検 索 " onclick="doAction(2);" style="font-size:10pt;color:#ff0000">
&emsp;<span class="salute">
<B><input type=radio name=phase value="2008" onclick="doAction(3);">旧モード<input type=radio name=phase value="2018" onclick="doAction(3);">新モード</B></span>

</div><!-- style="line-height:200%;" -->
</td>
<td width=8% align=center valign=top>
<input type="button" value="To Excel" onclick="SndWindow(2)" style="width:102px;height:28px;"><br>
<?php
if ($_SESSION['param'] == $modec) {
	print "<br><input type=\"button\" value=\"管理機能\" style=\"width:102px;height:28px;\" onclick=\"SndWindow(3);\">";
}
?>
</td>
<td width=8% valign=top align=center>
<?php
if ($_SESSION['param'] == $modec) {
//	print "<input type=\"button\" value=\" ヘ ル プ \" onclick=\"SndWindow(1);\" ><br />";
	print "　<input type=\"button\" value=\"新規登録\" style=\"width:102px;height:28px;\" onclick=\"SndWindow(0);\">";
}
?>
</td>
<td width=9% align=center valign=top><input type="button" value="ログアウト" style="width:102px;height:28px;" onclick="location.href='./logout.php'">
</td>
</tr></table>
</form>
</div>
<div id=boxC >
</div>
</div>
</body>
</html>