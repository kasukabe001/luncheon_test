<?php
//*****************************************************
// tehai_hikae.php
// param   th_code 1:控え室 2:会場
// 呼出元 mypage.php _mod=Tehai 
// 用  途 手配物選択ウィンドウ表示
//*****************************************************

require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'TehaiDAO.php';

//DB
$thdbh =& new TehaiDAO();

$thdbh->table="sy_tehai";
$h_tehai=$thdbh->getTehaiAry($_GET['th_code']);
$itemno=count($h_tehai);

if ( $_GET['th_code'] == 1) $room ="控室";
 else if ( $_GET['th_code'] == 2) $room ="会場";
print $room;
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta http-equiv="Content-Language" content="ja">
<title><? echo $room; ?> - 手配品選択</title>
</head>
<script language="JavaScript" type="text/JavaScript">

function closeBack()
{
  if (document.pickform.R1.selectedIndex == 0) {
  	returnValue="<? echo $h_tehai[0]; ?>";
  } else if (document.pickform.R1.selectedIndex == 1) {
  	returnValue="<? echo $h_tehai[1]; ?>";
  } else if (document.pickform.R1.selectedIndex == 2) {
  	returnValue="<? echo $h_tehai[2]; ?>";
  } else if (document.pickform.R1.selectedIndex == 3) {
  	returnValue="<? echo $h_tehai[3]; ?>";
  } else if (document.pickform.R1.selectedIndex == 4) {
  	returnValue="<? echo $h_tehai[4]; ?>";
  } else if (document.pickform.R1.selectedIndex == 5) {
  	returnValue="<? echo $h_tehai[5]; ?>";
  } else if (document.pickform.R1.selectedIndex == 6) {
  	returnValue="<? echo $h_tehai[6]; ?>";
  } else if (document.pickform.R1.selectedIndex == 7) {
  	returnValue="<? echo $h_tehai[7]; ?>";
  } else if (document.pickform.R1.selectedIndex == 8) {
  	returnValue="<? echo $h_tehai[8]; ?>";
  } else if (document.pickform.R1.selectedIndex == 9) {
  	returnValue="<? echo $h_tehai[9]; ?>";
  } else if (document.pickform.R1.selectedIndex == 10) {
  	returnValue="<? echo $h_tehai[10]; ?>";
  } else if (document.pickform.R1.selectedIndex == 11) {
  	returnValue="<? echo $h_tehai[11]; ?>";
  } else if (document.pickform.R1.selectedIndex == 12) {
  	returnValue="<? echo $h_tehai[12]; ?>";
  } else if (document.pickform.R1.selectedIndex == 13) {
  	returnValue="<? echo $h_tehai[13]; ?>";
  } else if (document.pickform.R1.selectedIndex == 14) {
  	returnValue="<? echo $h_tehai[14]; ?>";
  } else if (document.pickform.R1.selectedIndex == 15) {
  	returnValue="<? echo $h_tehai[15]; ?>";
  } else if (document.pickform.R1.selectedIndex == 16) {
  	returnValue="<? echo $h_tehai[16]; ?>";
  } else if (document.pickform.R1.selectedIndex == 17) {
  	returnValue="<? echo $h_tehai[17]; ?>";
  } else {
  	returnValue=""; 
  }
  window.close();
 }
</script>
<body onBlur="window.close();" onload="d1.innerHTML=dialogArguments;" bgcolor=#FFDE9B>
<form method="POST" name="pickform" action="--WEBBOT-SELF--">
<!--webbot bot="SaveResults" u-file="fpweb:///_private/form_results.csv"
s-format="TEXT/CSV" s-label-fields="TRUE" --><p>
&nbsp;
<table style="border-collapse: collapse" bordercolor="#111111" width="200" id="AutoNumber1">
  <tr>
    <td width="10">&nbsp;</td>
    <td width="180" align="center""><font color="#000080"><? echo $room; ?> 手配品選択</font></td>
    <td width="10"><font color=#FFDE9B><DIV id=d1> </div></font></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="180" align="center">
      &nbsp;<select size="<? echo $itemno; ?>" name="R1" ondblclick="closeBack();">
<?
  for ($i=0;$i<$itemno;$i++) {
    print "<option value=\"" . $h_tehai[$i] . "\">" .$h_tehai[$i] . "</option>";
  }
?>
	</select>
    </td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="180" align="center">
      <input name="btn1" type="button" value="選択" onclick="closeBack();">&nbsp;&nbsp;
      <input name="btn" type="button" value="閉じる" onclick="returnValue='';window.close();"></td>
    <td width="10">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>