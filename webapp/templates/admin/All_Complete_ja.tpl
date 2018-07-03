{include file='admin/include/HtmlHeadSet.tpl' htmlTitle="$bpshj-`$typeNameLabel.ja`"}
<br />
<div class="complete_title">{$bpshj}-{$typeNameLabel.ja}</div>
<br />
<div class="complete">
{if $error != ''}
  {if $error == 'NoData'}
変更データはありませんでした。
  {else}
<font color=red>{$error}</font><br />
一度ログアウトして、再度ご操作ください。
  {/if}
{else}
{$bpshj}情報を{$typeNameLabel.ja}しました。
{/if}
</div>
<br /><br />

{include file='admin/include/HtmlFootSet.tpl'}