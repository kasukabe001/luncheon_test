{include file="admin/include/HtmlHeadSet.tpl" htmlTitle="担当者完了" js_flg="完了"}
<br />
<div align="center">担当者情報-登録</div>
<br />

<div class="indent">
{if $error != ''}
    <span class="red">{$error}</span><br />
{else}
    担当者情報を登録しました。<br />
    <br /><br /><br />
    <div class="complete">
    <br />
    <a href="?_mod=AdminDetail">担当者リスト</a>
    </div><!-- class="complete" -->
{/if}
</div>
<br />
{include file='admin/include/HtmlFootSet.tpl'}
