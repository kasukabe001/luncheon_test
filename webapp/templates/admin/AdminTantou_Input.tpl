{include file="admin/include/HtmlHeadSet.tpl" htmlTitle="担当者登録" js_flg="変更"}
<br />
<div id="box">
<table width="630" cellpadding=8 cellspacing=4>
	<tr>
		<td class="titleblock2">担当者・登録フォーム</td>
	</tr>
</table>

<form name="form1" method="post" action="?_mod=AdminMaster&amp;_act=Confirm">
{include file="_incTantou/incTantou_Input.tpl"}


  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="_act" value="" />
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token}" />
    <input type="button" name="btn1" value=" 次ページ " onclick="reqAction('Confirm')" style="font-size: 14pt" />
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


