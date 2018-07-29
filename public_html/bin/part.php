<?php
//############################################################
// part.php
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
<!-- td width=540 bgcolor="#FFffff" style="border:double;"><font size=2 -->
<td width="71%" bgcolor="#FFffff" style="border:double;FONT-SIZE: 12px;">
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

&nbsp;&nbsp;<b>領域</b>：<select size=1 name="r" STYLE="background-color:#ffffff;">
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

&nbsp;<B>品目</B>：
<input type="text" name="h" size=10 STYLE="border-style:none; background-color:#CFCFCF">

&nbsp;<B>製品担当</B>：
<!-- select size=1 name="seihin" STYLE="background-color:#ffffff;" >
    <option value="" selected > </option>
    <option value="Aさん" >Aさん</option>
    <option value="Bさん" >Bさん</option>
    </select -->
<INPUT TYPE=text NAME=seihin size=10 STYLE="border-style:none; background-color:#CFCFCF">
<SELECT onChange="this.form.seihin.value=this.options[this.selectedIndex].text">
    <option value="" selected > </option>
    <option value="池葉 緑" >池葉 緑</option>
    <option value="宇佐美 康仁" >宇佐美 康仁</option>
    <option value="大辻 みなみ" >大辻 みなみ</option>
    <option value="佐藤 良美" >佐藤 良美</option>
    <option value="真 広美" >真 広美</option>
    <option value="谷口 英里" >谷口 英里</option>
    <option value="中野 まり子" >中野 まり子</option>
    <option value="町田 繁章" >町田 繁章</option>
    <option value="三井 英史" >三井 英史</option>
    <option value="山田 篤" >山田 篤</option>
    <option value="八本 晋好" >八本 晋好</option>
    <option value="李 洪圭" >李 洪圭</option>
</SELECT>

&nbsp;<B>組織化担当</B>：
<select size=1 name="soshiki" STYLE="background-color:#ffffff;" >
    <option value="" selected > </option>
    <option value="石郷岡 亮" >石郷岡 亮</option>
    <option value="佐藤 浩晃" >佐藤 浩晃</option>
    <option value="塩崎 泰久" >塩崎 泰久</option>
    <option value="三穂 雅治" >三穂 雅治</option>
    <option value="営推" >営推</option>
    </select>
&nbsp;<B>CL担当</B>：
<input type="text" name="seihin" list="cl" autocomplete="on">
  <datalist id="cl">
    <option value="">
    <option value="池川 香澄">
  　<option value="藤岡 朋子">
  　<option value="佐藤 理子">
  　<option value="皆川 理子">
  　<option value="髙橋 江里子">
  </datalist -->
&emsp;
<input type="button" value="ｸﾘｱ" onclick="clrbtn();">

<img src="../images/spacer.gif" width="530" height="3"><br>
&nbsp;<B>学会名</B>：
<input type="text" name="g" size=32 STYLE="border-style:none; background-color:#CFCFCF">
&nbsp;&nbsp;<B>会場名</B>：
<input type="text" name="p" size=16 STYLE="border-style:none; background-color:#CFCFCF">
&nbsp;&nbsp;
<B><input type=radio name=r1 value="za" >座長 <input type=radio name=r1 value="en">演者：</B>
<input type="text" name="z" size=14 STYLE="border-style:none; background-color:#CFCFCF">
&nbsp;
<input type="button" value="検索" onclick="doAction(2);" style="font-size:10pt;color:#ff0000">
&nbsp;
<B><input type=radio name=phase value="2008" >旧モード<input type=radio name=phase value="2018">新モード</B>


</td>
<td width=9% align=right valign=top>
<input type="button" value="To Excel" onclick="SndWindow(2)"><br>
<?php
if ($_SESSION['param'] == $modec) {
	print "<input type=\"button\" value=\"管理機能\" onclick=\"SndWindow(3);\">";
}
?>
</td>
<td width=10% align=center valign=top>
<?php
if ($_SESSION['param'] == $modec) {
//	print "<input type=\"button\" value=\" ヘ ル プ \" onclick=\"SndWindow(1);\" ><br />";
	print "<input type=\"button\" value=\"新規登録\" onclick=\"SndWindow(0);\">";
}
?>
</td>
<td width=10% valign=top><input type="button" value="ログアウト" onclick="location.href='./logout.php'">
</td>
</tr></table>
</form>
</div>
<div id=boxC >
</div>
</div>
</body>
</html>