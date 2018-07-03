{include file="admin/include/HtmlHeadSet.tpl" htmlTitle="ListTop" }
<br />


<table width="680" cellpadding=8 cellspacing=4 style="background-color: #FFFFFF">
	<tr>
		<td align="center" style="background-color: #ffcc66">
        <font size="4" color="#ffffff"><b>空データ作成</b></font></td>
	</tr>
</table>
<br>
<br>
<form name="form1" method="POST" action="?_mod=Empty" >
  <table width="680" cellpadding=3 >
    <tr>
      <td width="23%" class="titleblock2">年度</td>
      <td width="77%"  class="titleblock">
      <input type="radio" name="R2" value="2012" checked>2012&nbsp; 
      <input type="radio" name="R2" value="2011">2011&nbsp; 
      <input type="radio" name="R2" value="2010">2010&nbsp;
      <input type="radio" name="R2" value="2009">2009&nbsp;
      <input type="radio" name="R2" value="2008">2008&nbsp;
      <input type="radio" name="R2" value="2007">2007&nbsp;
      </td>
    </tr>
    </table>
   <br>

   <div align="center">
{if $message==''}
   <input type="submit" value=" 実行 " name="B1" ><br />
{else}
   <span class="red">{$message}</span>
{/if}
   </div>

	<!-- hidden -->
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token}" />
    <input type="hidden" name="_act" value="Update" />
    <input type="hidden" name="_type" value="Edit" />
</form>
<br />
   <br /><br />
   <table width="680" cellpadding=3 style="border:1px solid #000080; border-collapse:collapse; padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
        <tr>
	<td></td>
	</tr>
   </table>
<br />
{include file="admin/include/HtmlFootSet.tpl"}

