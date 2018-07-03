{include file="admin/include/HtmlHeadSet.tpl" htmlTitle='担当者情報-更新'}
<br />
<div class="center">担当者情報-更新</div>
<br />
<div class="indent">
{if $error != ''}
    <span class="red">{$error}</span><br />
{else}
    担当者情報を変更しました。<br />
    <br /><br /><br />
    <div class="complete">
    <a href="{$oldurl}">同一条件で再検索</a>
    <br /><br />
    <a href="?_mod=AdminDetail">担当者リストへ戻る</a>
    </div><!-- class="complete" -->
{/if}
</div>
<br />
{include file='admin/include/HtmlFootSet.tpl'}