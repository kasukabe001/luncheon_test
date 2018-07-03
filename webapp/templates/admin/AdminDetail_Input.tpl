{include file='admin/include/HtmlHeadSet.tpl' htmlTitle="担当者情報"}

<!-- br / -->
<div id="box">
<br />

<table width="630" cellpadding=8 cellspacing=4>
	<tr>
		<td class="titleblock2">担当者・変更フォーム</td>
	</tr>
</table>
<form name="form1" method="post" action="?_mod=AdminDetail&amp;_act=Confirm">


{include file="_incTantou/incTantou_Input.tpl"}


<div class="subtitle-2">■管理情報</div>
        <table width=630 cellpadding=0 cellspacing=0 class="table-list">
          <tr>
          <td class="form-left-01">最終更新日</td>
          <td class="form-right-01">{$last_update}&nbsp;</td>
          </tr>
          <tr>
          <td class="form-left-02">状況</td>
          <td class="form-right-02">{$ta_status}{replaceFromQF from=$form.ta_status}</font></td>
          </tr>
        </table>

	<br />

  <!--### BUTTON ###-->
<div class="form_button">
    <!-- input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" / -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
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