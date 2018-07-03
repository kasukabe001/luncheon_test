{include file='member/include/HtmlHeadSet_ja.tpl' htmlTitle="$bpshj-`$typeNameLabel.ja`"}

<div class="complete_title">{$bpshj}-{$typeNameLabel.ja}</div>
<br />
<div class="complete">
{if $error != ''}
  {if $error == 'NoData'}
変更データはありませんでした。
  {else}
<font color=red>{$error}</font><br />
ログアウトして、再度ご操作ください。
  {/if}
{else}
{$bpshj}情報を{$typeNameLabel.ja}しました。
{/if}
</div>


{include file='member/include/HtmlFootSet.tpl'}