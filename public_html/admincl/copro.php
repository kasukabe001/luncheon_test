<?php
//*****************************************************
// copro.php
// param   なし
// 呼出元 mypage.php _mod=Basic 
// 用  途 コプロ選択ウィンドウ表示
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';

$dbh =& new MembersDAO();

$dbh->table="tantou";
$copro=$dbh->getCoproAry();
$itemno=count($copro);
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ja">
<title><?php echo $room; ?> - コプロ選択</title>
</head>
<script language="JavaScript" type="text/JavaScript">

function closeBack()
{
  if (document.pickform.R1.selectedIndex == 0) {
  	returnValue="<?php echo $copro[0]; ?>";
  } else if (document.pickform.R1.selectedIndex == 1) {
  	returnValue="<?php echo $copro[1]; ?>";
  } else if (document.pickform.R1.selectedIndex == 2) {
  	returnValue="<?php echo $copro[2]; ?>";
  } else if (document.pickform.R1.selectedIndex == 3) {
  	returnValue="<?php echo $copro[3]; ?>";
  } else if (document.pickform.R1.selectedIndex == 4) {
  	returnValue="<?php echo $copro[4]; ?>";
  } else if (document.pickform.R1.selectedIndex == 5) {
  	returnValue="<?php echo $copro[5]; ?>";
  } else if (document.pickform.R1.selectedIndex == 6) {
  	returnValue="<?php echo $copro[6]; ?>";
  } else if (document.pickform.R1.selectedIndex == 7) {
  	returnValue="<?php echo $copro[7]; ?>";
  } else if (document.pickform.R1.selectedIndex == 8) {
  	returnValue="<?php echo $copro[8]; ?>";
  } else if (document.pickform.R1.selectedIndex == 9) {
  	returnValue="<?php echo $copro[9]; ?>";
  } else if (document.pickform.R1.selectedIndex == 10) {
  	returnValue="<?php echo $copro[10]; ?>";
  } else if (document.pickform.R1.selectedIndex == 11) {
  	returnValue="<?php echo $copro[11]; ?>";
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
      <p align="center"><font color="#000080">コプロ選択</font></p>
    </td>
    <td width="20"><font color=#FFDE9B><DIV id=d1> </div></font></td>
  </tr>
  <tr>
    <td width="10"> </td>
    <td width="180" align="center">
      <br>
      &nbsp;<select size="<?php echo $itemno; ?>" name="R1" ondblclick="closeBack();">
<?php
  for ($i=0;$i<$itemno;$i++) {
    print "<option value=\"" . $copro[$i] . "\">" .$copro[$i] . "</option>";
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