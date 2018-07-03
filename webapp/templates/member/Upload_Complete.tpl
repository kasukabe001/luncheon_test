{include file='member/include/HtmlHeadSet_ja.tpl' htmlTitle="$bpshj-`$typeNameLabel.ja`"}
<br />
<div class="complete_title">{$bpshj}-{$typeNameLabel.ja}</div>
<br />
<div class="complete">
{if $error != ''}
  {if $error == 'NoData'}
変更データはありませんでした。
  {else}
<font color=red>{$error}</font><br />
再度、ご操作ください。
  {/if}
{else}
{$bpshj}を終了しました。
{/if}
</div>


{include file='member/include/HtmlFootSet.tpl'}