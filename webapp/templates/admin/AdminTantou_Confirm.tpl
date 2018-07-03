{include file="admin/include/HtmlHeadSet.tpl" htmlTitle="担当者確認" js_flg="変更"}
<br />
<div id="box">
<table width="630" cellpadding=8 cellspacing=4>
	<tr>
		<td class="titleblock2">登録内容をご確認ください</td>
	</tr>
</table>

<form name="form1" method="post" action="?_mod=AdminMaster&amp;_act=Confirm">
{include file="_incTantou/incTantou_Confirm.tpl"}
<br />
<div align="center"><span class="red"><font size=2>
入力内容をご確認の上、［登録］ボタンをクリックしてください。</span>
</font></span></div>

  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="_act" value="" />
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token}" />
    <input type="button" name="btn1" value=" 登録 " onclick="reqAction('Insert')" style="font-size: 14pt" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="btn3" value=" 戻る " onclick="reqAction('Input')" style="font-size: 14pt" />

</div>
  <!--/// BUTTON ///-->

	<br />
	<div id="footerLine">
	</div><!-- footerLine -->
	<img src="../images/spacer.gif" width="630" height="1" alt="">
	<div class="grayLine"></div>
</form>
<br />
</div><!-- id="box" -->
{include file='admin/include/HtmlFootSet.tpl'}


