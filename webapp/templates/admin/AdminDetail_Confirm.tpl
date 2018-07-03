{include file='admin/include/HtmlHeadSet.tpl' htmlTitle="担当者情報-確認"}
<br />

<div id="box">
<table width="630" cellpadding=8 cellspacing=4>
	<tr>
		<td class="titleblock2">変更内容をご確認ください</td>
	</tr>
</table>
<!-- /div --><!-- id="box" -->

<!-- div id="box_nl" -->
<form name="form1" method="post" action="?_mod=AdminDetail&amp;_act=Update" >

{include file="_incTantou/incTantou_Confirm.tpl"}
<br />
<div align="center"><span class="red"><font size=2>
入力内容をご確認の上、［変更］ボタンをクリックしてください。</span>
</font></span></div>
<div class="subtitle-2">■管理情報 {* ($ta_id) *}</div>
        <table width=590 cellpadding=0 cellspacing=0 class="table-list">
          <tr>
          <td class="form-left-01">最終更新日</td>
          <td class="form-right-01">{$form.last_update.html}&nbsp;</td>
          </tr>
          <tr>
          <td class="form-left-02">状況</td>
          <td class="form-right-02">{$ta_status}{replaceFromQF from=$form.ta_status}{$eta_status}</td>
          </tr>
        </table>

	<br />

  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" />
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Update" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />

    <input type="button" name="btn2" value=" 変更 " onclick="reqAction('Update')" style="font-size: 14pt" />&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="btn1" value=" 戻る " onclick="reqAction('Input')" style="font-size: 14pt" />
</div>
  <!--/// BUTTON ///-->
</form>
<br />

	<div id="footerLine"></div>
	<img src="../images/spacer.gif" width="630" height="1" alt="">
	<div class="grayLine"></div>


</div><!-- id="box_nl" -->


{include file='admin/include/HtmlFootSet.tpl'}