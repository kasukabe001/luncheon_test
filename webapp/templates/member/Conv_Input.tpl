{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="UploadTop" }
<br />


<table width="680" cellpadding=8 cellspacing=4 style="background-color: #FFFFFF">
	<tr>
		<td align="center" style="background-color: #ffcc66">
        <font size="4" color="#ffffff"><b>�ǡ��������Ѵ�</b></font></td>
	</tr>
</table>
<br>
<form name="form1" method="POST" action="?_mod=Conv" >
    <table width="680" cellpadding=6 cellspacing=0 style="padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
	<tr>
	    <td width="23%" class="titleblock2">�ز�̾</td>
	    <td width="77%" class="titleblock"><font size="3"><b>{$gakkai}</b></font>({$smarty.session.semi_id}) </td> 
	</tr>
	<tr>
	    <td class="titleblock2" >���ߥʡ�̾</td>
	    <td class="titleblock">&nbsp;<font size="3" >{$seminar}</font></td>
	</tr>
    </table>
<br>
<table cellSpacing=1 cellPadding=2 width=680>
  <tr>
    <td class="titleblock2" width="21%">��Ĺ1</td>
    <td width="25%" class="titleblock_t">��̾{$form.chair1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">��{$form.cyaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">��Ĺ2</td>
    <td width="25%" class="titleblock_t">��̾{$form.chair2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">��{$form.cyaku2.html}</td>
  </tr>
</table>

<table cellSpacing=1 cellPadding=2 width=680 >
  <tr>
    <td class="titleblock2" width="25%" >���1</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">��{$form.enshayaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����1</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���2</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">��{$form.enshayaku2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����2</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���3</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname3.html}</td>
    <td width="75%" class="titleblock_t" colspan="2">��{$form.enshayaku3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����3</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���4</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname4.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">��{$form.enshayaku4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����4</td>
    <td width="75%" class="titleblock" colspan="3">{$form.endai4.html}</td>
  </tr>
</table>
{$ninzu1}-{$ninzu2}<br>
<table width="680" cellpadding=3 >
{foreach from=$chair key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
    {if $jo == 1}
      <td width="23%" class="titleblock2" rowspan={$ninzu} valign="middle">����</td>
    {/if}
      <td width="13%" class="titleblock" >��Ĺ{$jo} - {$item.cs_id}</td>
      <td width="64%" class="titleblock" >{$item.cs_name} ({$item.cs_yaku})</td>
    </tr>
{foreachelse}
<tr>
    <td colspan="2" class="value">��Ĺ����Ͽ�Ϥ���ޤ���</td>
</tr>
{/foreach}
{foreach from=$ensha key="key" item="item" name=outer }
  {assign var=jo value=`$smarty.foreach.outer.iteration`}
    <tr>
      <td class="titleblock" >���{$jo} - {$item.cs_id}</td>
      <td class="titleblock" >{$item.cs_name} ({$item.cs_yaku})<br> {$item.cs_endai}</td>
    </tr>
{foreachelse}
    <tr>
    <td colspan="2" class="value">��Ԥ���Ͽ�Ϥ���ޤ���</td>
    </tr>
{/foreach}
  </table>
   <br>
{if $locktoken != "unlock"}
   <div align="center">
   <input type="submit" value=" �¹� " name="B1" ><br />
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

