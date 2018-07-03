<?php
//*****************************************************
// yakushoku.php
// 引  数 name 座長演者氏名post
// 呼出元 mypage.php _mod=Basic
// 用  途 役職選択ウィンドウ表示
// 検  討 検索対象を座長と演者で区別してもよいかも
//*****************************************************

require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';

$dbh =& new MembersDAO();

$itemno=_YAKU_MAX_;
$gk = urldecode($_GET['name']);
$zaenname = $gk; //mb_convert_encoding($gk,"eucJP-win","UTF-8"); 
$yaku=$dbh->getYakushoku($itemno,$zaenname); 

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ja">
<title><?php echo $itemno; ?> - 役職選択</title>
</head>
<script language="JavaScript" type="text/JavaScript">

function closeBack()
{
  if (document.pickform.R1.selectedIndex == 0) {
  	returnValue="<?php echo $yaku[0]; ?>";
  } else if (document.pickform.R1.selectedIndex == 1) {
  	returnValue="<?php echo $yaku[1]; ?>";
  } else if (document.pickform.R1.selectedIndex == 2) {
  	returnValue="<?php echo $yaku[2]; ?>";
  } else if (document.pickform.R1.selectedIndex == 3) {
  	returnValue="<?php echo $yaku[3]; ?>";
  } else if (document.pickform.R1.selectedIndex == 4) {
  	returnValue="<?php echo $yaku[4]; ?>";
  } else if (document.pickform.R1.selectedIndex == 5) {
  	returnValue="<?php echo $yaku[5]; ?>";
  } else if (document.pickform.R1.selectedIndex == 6) {
  	returnValue="<?php echo $yaku[6]; ?>";
  } else if (document.pickform.R1.selectedIndex == 7) {
  	returnValue="<?php echo $yaku[7]; ?>";
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
      <p align="center"><font color="#000080">役職選択</font></p>
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
    print "<option value=\"" . $yaku[$i] . "\">" .$yaku[$i] . "</option>";
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