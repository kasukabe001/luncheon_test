{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="UploadTop" }
<br />


<table width="680" cellpadding=8 cellspacing=4 style="background-color: #FFFFFF">
	<tr>
		<td align="center" style="background-color: #ffcc66">
        <font size="4" color="#ffffff"><b>ファイルアップロード</b></font></td>
	</tr>
</table>
<br>
<form name="form1" method="post" action="?_mod=Upload&amp;_act=Confirm" enctype="multipart/form-data" >
	<table width="680" cellSpacing=1 cellPadding=2 >
		<tr height="27">
		<td width="126" class="titleblock2" >学会名</td>
		<td width="460" class="titleblock"><font size="3" ><b>&nbsp;{$gakkai}</b></font></td> 
		</tr>
		<tr height="27">
		<td width="126" class="titleblock2" >セミナー名</td>
		<td class="titleblock">&nbsp;<font size="3" >{$seminar}</font></td>
		</tr>
    </table>
    <br>
    <table width="680" cellpadding=2 cellspacing=1>
      <tr>
        <td width="126" class=titleblock2 align=right rowspan=2>
        アップロードする</ br>ファイル</td>
        <td width="460">・１ファイル当たりの最大サイズ数は3MBです。</td>
      </tr>
      <tr>
        <td width="460" height="27">{$form.org_filename.html}
		<div class="error">{$form.org_filename.error}</div>
	</td>
      </tr>
    </table>
    <br>
    <table width="680" cellpadding=2 cellspacing=1>
	<tr height="27">
	<td width="126" class="titleblock2" >種類</td>
	<td width="460" class="titleblock" >{$form.remark.html}<div class="error">{$form.remark.error}</div></td>
	</tr>
   </table>

{if $locktoken != "unlock"}
   <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse; background-color: #FFFFFF" bordercolor="#111111" width="630" id="AutoNumber1">
      <tr>
        <td width="100%" align="center">
    <font size="2" color="#FF0000">ファイルを選択した後、［アップロード］ボタンを押してください。</font></td>
      </tr>
      <tr>
        <td align=center><input type="submit" value="アップロード" name="B1" ></td>
      </tr>
   </table>
{/if}
   <br /><br />
   <table width="680" cellpadding=3 style="border:1px solid #000080; border-collapse:collapse; padding-left:4; padding-right:4; padding-top:1; padding-bottom:1" >
        <tr>
	<td></td>
	</tr>
   </table>
	<!-- hidden -->
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token}" />
</form>

<br />
{include file="member/include/HtmlFootSet_ja.tpl"}

