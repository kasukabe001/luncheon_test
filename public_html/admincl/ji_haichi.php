<?php
//*****************************************************
// ji_haichi.php
// param   なし
// 呼出元 mypage.php _mod=jinin 
// 用  途 人員配置 - 役割選択ウィンドウ表示
//*****************************************************

require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'TehaiDAO.php';

$thdbh =& new TehaiDAO();

$thdbh->table="sy_jinin";
$haichi=$thdbh->getJininAry();
$itemno=count($haichi);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta http-equiv="Content-Language" content="ja">
<title><? echo $room; ?> - 役割選択</title>
</head>
<script language="JavaScript" type="text/JavaScript">

function closeBack()
{
  if (document.pickform.R1.selectedIndex == 0) {
  	returnValue="<? echo $haichi[0]; ?>";
  } else if (document.pickform.R1.selectedIndex == 1) {
  	returnValue="<? echo $haichi[1]; ?>";
  } else if (document.pickform.R1.selectedIndex == 2) {
  	returnValue="<? echo $haichi[2]; ?>";
  } else if (document.pickform.R1.selectedIndex == 3) {
  	returnValue="<? echo $haichi[3]; ?>";
  } else if (document.pickform.R1.selectedIndex == 4) {
  	returnValue="<? echo $haichi[4]; ?>";
  } else if (document.pickform.R1.selectedIndex == 5) {
  	returnValue="<? echo $haichi[5]; ?>";
  } else if (document.pickform.R1.selectedIndex == 6) {
  	returnValue="<? echo $haichi[6]; ?>";
  } else if (document.pickform.R1.selectedIndex == 7) {
  	returnValue="<? echo $haichi[7]; ?>";
  } else if (document.pickform.R1.selectedIndex == 8) {
  	returnValue="<? echo $haichi[8]; ?>";
  } else if (document.pickform.R1.selectedIndex == 9) {
  	returnValue="<? echo $haichi[9]; ?>";
  } else if (document.pickform.R1.selectedIndex == 10) {
  	returnValue="<? echo $haichi[10]; ?>";
  } else if (document.pickform.R1.selectedIndex == 11) {
  	returnValue="<? echo $haichi[11]; ?>";
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
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="200" id="AutoNumber1">
  <tr>
    <td width="10"></td>
    <td width="180">
      <p align="center"><font color="#000080">役割選択</font></p>
    </td>
    <td width="20"><font color=#FFDE9B><DIV id=d1> </div></font></td>
  </tr>
  <tr>
    <td width="10"> </td>
    <td width="180" align="center">
      <br>
      &nbsp;<select size="<? echo $itemno; ?>" name="R1" ondblclick="closeBack();">
<?
  for ($i=0;$i<$itemno;$i++) {
    print "<option value=\"" . $haichi[$i] . "\">" .$haichi[$i] . "</option>";
  }
?>
	</select>
    </td>
    <td width="20">　</td>
  </tr>
  <tr>
    <td width="10"></td>
    <td width="180">
    <p align="center">
      <input name="btn1" type="button" value="選択" onclick="closeBack();">&nbsp;&nbsp; <input name="btn" type="button" value="閉じる" onclick="returnValue='';window.close();"></td>                                       
    <td width="20">　</td>
  </tr>
</table>
</form>
</body>
</html>