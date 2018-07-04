{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="ListTop" }
<br />


<table width="780" cellpadding=6 cellspacing=0 style="background-color: #FFFFFF">
<!-- table width="780" cellpadding=8 cellspacing=4 style="background-color: #FFFFFF" -->
	<tr>
		<td align="center" style="background-color: #ffcc66">
        <font size="4" color="#ffffff"><b>帳票アウトプット</b></font></td>
	</tr>
</table>
<br>
<form name="regform" method="POST" action="./admincl/newrtf.php" >
    <table width="780" cellpadding=6 cellspacing=0 style="padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
        <TR><TD class="titleblock3" colspan=2 ></TD></TR>
	<tr>
	    <td width="20%" class="titleblock2">学会名</td>
	    <td width="80%" class="titleblock"><font size="3"><b>{$gakkai}</b></font>({$smarty.session.semi_id})</td> 
	</tr>
	<tr>
	    <td class="titleblock2" >セミナー名</td>
	    <td class="titleblock">&nbsp;<font size="3" >{$seminar}</font></td>
	</tr>
    </table>
<br> 
<!-- table width="680" cellpadding=3 -->
<table width="780" cellSpacing=0 cellPadding=6 >
  <TR><TD class="titleblock3" colspan=3 ></TD></TR>
{foreach from=$chair key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
    {if $jo == 1}
      <td width="20%" class="titleblock2" rowspan={$ninzu} valign="middle">宛先</td>
    {/if}
      <td width="13%" class="titleblock" >
      <input type="radio" name="R1" value="za{$item.cs_id}" {if $jo == 1} checked{/if}>座長{$jo}</td>
      <td width="67%" class="titleblock" >{$item.cs_name} ({$item.cs_yaku})</td>
    </tr>
{foreachelse}
<tr>
    <td colspan="2" class="value">座長の登録はありません。</td>
</tr>
{/foreach}
{foreach from=$ensha key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
      <td class="titleblock" ><input type="radio" value="en{$item.cs_id}" name="R1">演者{$jo}</td>
      <td class="titleblock" >{$item.cs_name} ({$item.cs_yaku})</td>
    </tr>
{foreachelse}
    <tr>
    <td colspan="2" class="value">演者の登録はありません。</td>
    </tr>
{/foreach}
  </table>
<br>
  <!-- table width="680" cellpadding=3 -->
  <table width="780" cellSpacing=0 cellPadding=6 >
    <TR><TD class="titleblock3" colspan=2 ></TD></TR>
    <tr>
      <td width="20%" class="titleblock2" rowspan=2>帳票</td>
      <td width="80%"  class="titleblock">
      <input type="radio" name="R2" value="1" checked>事前お打合せ案内状&nbsp; 
      <input type="radio" name="R2" value="2">依頼書&nbsp; 
      <input type="radio" name="R2" value="3">応諾書&nbsp;
      <input type="radio" name="R2" value="4">招聘状&nbsp;
      <input type="radio" name="R2" value="5">インフォメーションシート</td>
    </tr>
    <tr>
      <td width="80%" class="titleblock">
      <input type="radio" name="R2" value="6">契約書</td>
    </tr>

    </table>
   <br>
<div align="center">
<font size="2" color="#FF0000">帳票を選択した後、［出力］ボタンを押してください。</font>
<br />
<input type="submit" value="出　力" name="B1" >
</div>
	<!-- hidden -->
	<input type="hidden" name="semi_id" value="{$smarty.session.semi_id}">
</form>
<br />
  <table width="780" cellSpacing=0 cellPadding=6 >
    <TR><TD class="titleblock3" width="20%" ></TD><td width="80%"></TD></TR>
        <tr>
      <td width="20%" class="titleblock2">その他の帳票</td>
      <td width="80%">
<a href="/kyousai/admincl/AdminExcel.php?semi_id={$smarty.session.semi_id}">運営報告書</a>　
<a href="/kyousai/admincl/YakuwariExcel.php?semi_id={$smarty.session.semi_id}">役割分担表</a>　
<a href="/kyousai/admincl/staffrtf.php?semi_id={$smarty.session.semi_id}">スタッフ発注書</a></td>
	</tr>
   </table>
   <br /><br />
   <table width="780" cellpadding=3 style="border:1px solid #000080; border-collapse:collapse; padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
        <tr>
	<td></td>
	</tr>
   </table>
<br />
{include file="member/include/HtmlFootSet_ja.tpl"}

