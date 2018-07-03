{include file='admin/include/HtmlHeadSet.tpl' htmlTitle="$bpshj-確認"}

<div class="confirm_title">- 確認 -</div>

<form name="form1" method="post" action="?_mod={$bpshe}">
{include file="admin/`$bpshe`_Confirm.tpl" htmlMode="EDIT"}

  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" />
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token|escape}" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="hidden" name="_act" value="" />

    {if $smarty.request._type == 'Add' || $smarty.request._type == ''}
	<input type="button" name="btn1" value="&laquo;&nbsp;戻る" onclick="reqAction('Input')" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="btn2" value="登録&nbsp;&raquo;" onclick="reqAction('Insert')" />
    {elseif $smarty.request._type == 'Edit'}
	{if $smarty.request._act == 'Display'}
	    <input type="button" name="btn1" value="&laquo;&nbsp;戻る" onclick="history.back()" />&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="button" name="btn2" value="修正&nbsp;&raquo;" onclick="reqAction('Input')" />
	{else}
	    <input type="button" name="btn2" value=" 変更 " onclick="reqAction('Update')" />&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="button" name="btn1" value=" 戻る " onclick="reqAction('Input')" />
	{/if}
    {/if}

</div>
  <!--/// BUTTON ///-->
</form>
<!-- p align="right"><a href="#top">Page Top</a></p -->

{include file='admin/include/HtmlFootSet.tpl'}