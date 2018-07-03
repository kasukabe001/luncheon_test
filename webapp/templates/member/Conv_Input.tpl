{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="UploadTop" }
<br />


<table width="680" cellpadding=8 cellspacing=4 style="background-color: #FFFFFF">
	<tr>
		<td align="center" style="background-color: #ffcc66">
        <font size="4" color="#ffffff"><b>データ形式変換</b></font></td>
	</tr>
</table>
<br>
<form name="form1" method="POST" action="?_mod=Conv" >
    <table width="680" cellpadding=6 cellspacing=0 style="padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
	<tr>
	    <td width="23%" class="titleblock2">学会名</td>
	    <td width="77%" class="titleblock"><font size="3"><b>{$gakkai}</b></font>({$smarty.session.semi_id}) </td> 
	</tr>
	<tr>
	    <td class="titleblock2" >セミナー名</td>
	    <td class="titleblock">&nbsp;<font size="3" >{$seminar}</font></td>
	</tr>
    </table>
<br>
<table cellSpacing=1 cellPadding=2 width=680>
  <tr>
    <td class="titleblock2" width="21%">座長1</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.cyaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">座長2</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.cyaku2.html}</td>
  </tr>
</table>

<table cellSpacing=1 cellPadding=2 width=680 >
  <tr>
    <td class="titleblock2" width="25%" >演者1</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.enshayaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演題1</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演者2</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.enshayaku2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演題2</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演者3</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname3.html}</td>
    <td width="75%" class="titleblock_t" colspan="2">役職{$form.enshayaku3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演題3</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演者4</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname4.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.enshayaku4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演題4</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai4.html}</td>
  </tr>
</table>
{$ninzu1}-{$ninzu2}<br>
<table width="680" cellpadding=3 >
{foreach from=$chair key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
    {if $jo == 1}
      <td width="23%" class="titleblock2" rowspan={$ninzu} valign="middle">宛先</td>
    {/if}
      <td width="13%" class="titleblock" >座長{$jo} - {$item.cs_id}</td>
      <td width="64%" class="titleblock" >{$item.cs_name} ({$item.cs_yaku})</td>
    </tr>
{foreachelse}
<tr>
    <td colspan="2" class="value">座長の登録はありません。</td>
</tr>
{/foreach}
{foreach from=$ensha key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
      <td class="titleblock" >演者{$jo} - {$item.cs_id}</td>
      <td class="titleblock" >{$item.cs_name} ({$item.cs_yaku})<br> {$item.cs_endai}</td>
    </tr>
{foreachelse}
    <tr>
    <td colspan="2" class="value">演者の登録はありません。</td>
    </tr>
{/foreach}
  </table>
   <br>
{if $locktoken != "unlock"}
   <div align="center">
   <input type="submit" value=" 実行 " name="B1" ><br />
   <span class="red">{$message}</span>
   </div>
{/if}
	<!-- hidden -->
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token}" />
    <input type="hidden" name="_act" value="Update" />
    <input type="hidden" name="_type" value="Edit" />
</form>
    <br>
{include file="member/include/HtmlFootSet_ja.tpl"}

