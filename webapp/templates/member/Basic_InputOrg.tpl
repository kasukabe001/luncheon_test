{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="BasicInput"}
<br />

<form name="form1" method="post" action="?_mod=Basic">
{$form.hidden}
  <!--### BUTTON ###-->
{if $locktoken != "unlock"}
  <!-- p align="center">
    <input type="submit" name="DirectBtn" value="����" />
    <input type="submit" name="DirectBtn" value="��Ĺ" />
    <input type="submit" name="DirectBtn" value="���" />
    <input type="submit" name="DirectBtn" value="����" />
    <input type="submit" name="DirectBtn" value="�Ͱ�" />
    <input type="submit" name="DirectBtn" value=" ¾ " />
    <input type="submit" name="DirectBtn" value="ô��" />
    <input type="submit" name="DirectBtn" value="�����̎�" />
    <input type="submit" name="DirectBtn" value="Ģɼ" />
  </p -->
{/if}
  <!--/// BUTTON ///-->

<TABLE cellSpacing=1 cellPadding=2 width=780 >
  <TR>
    <TD align=right colspan=4 height=21>���åץ��ɥե����� : {$fnum}</TD>
  </TR>
  <TR>
    <TD colSpan=4><font size="2" color="#FF0000">��ա�* ���ι��ܤ�ɬ�����Ϥ��Ƥ��������� </font> <u><font size="2">����</font></u><font size="2" color="#FF0000">�ϥȥåץڡ����Ǻܹ��ܤǤ���<br>                                                               
 ���1,���2,���3�ϥ�󥱡�������Ǥ��������Ǥ��ޤ��� </font></TD>
  </TR>
  <TR>
    <TD class=titleblock3 width=75% height=21 colspan=3>���ܾ��� (ID:{$smarty.session.semi_id} {$smarty.session.zachoNum}-{$smarty.session.enshaNum})</TD>
    <TD class=titleblock3 height=21 >�ǽ������� {$last_date|truncate:12:" "}{$smarty.request.last_date|truncate:12:" "}</TD>
  </TR>
  <tr>
    <td class="titleblock2b" width="25%">�ز�̾ <font size="2" color="#FF0000">*</font></td>
    <td width="75%" class="titleblock" colspan="3">{$form.gakkai.html}<div class="error">{$form.gakkai.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">����</td>
    <td width="25%" class="titleblock">{$form.hinmoku.html}</td>
    <td width="25%" class="titleblock2">ǯ��</td>
    <td width="25%" class="titleblock">{$form.nendo.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%" nowrap>���ߥʡ�̾ <font size="2" color="#FF0000">*</font></td>
    <td width="25%" class="titleblock">{$form.seminar.html}<div class="error">{$form.seminar.error}</div></td>
    <td width="25%" class="titleblock2">�ΰ�</td>
    <td width="25%" class="titleblock">{$form.ryoiki.html}
	{if $locktoken != "unlock"}
      <input type="button" onclick="doDialog();" value="����" style="background:#5C4C77;color:#FF9600;" >
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%" nowrap>���ߥʡ�������</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaisaibi.html}<font size="2">
      ���08/03/14(��)</font>
	{if $locktoken != "unlock"}
    <input type=button value="C" name="B0" onclick="wrtCalendar(event,this.form.kaisaibi,'yy/mm/dd(a)');">
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���Ż���</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaisaiji.html}<font size="2">
      ���16:00-18:00</font></td>                                                               
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaiki.html}<font size="2">���2012/3/14-15</font></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">���</td>
    <td width="75%" class="titleblock" colspan="3">{$form.place.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">URL</td>
    <td width="75%" class="titleblock" colspan="3">{$form.yobi2.html}
      <font size="2">���http://www.gakkai.jp</font></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">�ơ���</td>
    <td width="75%" class="titleblock" colspan="3">{$form.thema.html}</td>
  </tr>
</table>

<table cellSpacing=1 cellPadding=2 width=780 border=0>
  <tr>
    <td class="titleblock2" width="21%">��Ĺ1</td>
    <td width="25%" class="titleblock_t">��̾{$form.chair1.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.cyaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">��Ĺ2</td>
    <td width="25%" class="titleblock_t">��̾{$form.chair2.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.cyaku2.html}</td>
  </tr>
</table>

<span class="accordion_head"><input type="button" name="e1" value="�ɲ�"></span>
<div> 
<table cellSpacing=1 cellPadding=2 width=780 border=0>
  <tr>
    <td class="titleblock2" width="21%">��Ĺ3</td>
    <td width="25%" class="titleblock_t">��̾{$form.chair3.html}
    <div class="error">{$form.chair3.error}</div></td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.cyaku3.html}
    <div class="error">{$form.cyaku3.error}</div></td>
  </tr>
</table>
</div> 

<table cellSpacing=1 cellPadding=2 width=780 >
  <tr>
    <td class="titleblock2" width="21%" >���1</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname1.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����1</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���2</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname2.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����2</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���3</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname3.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����3</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���4</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname4.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����4</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai4.html}</td>
  </tr>
</table>
<span class="accordion_head2"><input type="button" name="e2" value="�ɲ�"></span>
<div> 
<table cellSpacing=1 cellPadding=2 width=780>
  <tr>
    <td class="titleblock2" width="21%">���5</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname5.html}
    <div class="error">{$form.enshaname5.error}</div></td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku5.html}
    <div class="error">{$form.enshayaku5.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����5</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai5.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���6</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname6.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����6</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���7</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname7.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����7</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">���8</td>
    <td width="25%" class="titleblock_t">��̾{$form.enshaname8.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">��{$form.enshayaku8.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">����8</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai8.html}</td>
  </tr>
</table>
</div> 

<table cellSpacing=1 cellPadding=2 width=780>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����(���ץ��̾)</td>
    <td width="25%" class="titleblock" width="75%" colspan=3>
	{$form.syukan.html}&nbsp;&nbsp;&nbsp;{$form.syukan2.html}
<div class="error">{$form.syukan.error}</div>
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">������Ǥ��</td>
    <td width="25%" class="titleblock" >��̾ {$form.sekinin.html}</td>
    <td class="titleblock2" width="25%">CL���</td>
    <td width="25%" class="titleblock">��̾ {$form.cltantou.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">�ز񻲲�<br/ >�����߿Ϳ�</td>
    <td width="25%" class="titleblock" >{$form.hotel.html}</td>
    <td class="titleblock2" width="25%" >�ز�����</td>
    <td width="25%" class="titleblock">{$form.yobi1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">���ߥʡ���</td>
    <td width="25%" class="titleblock">{$form.yobi4.html}</td>
    <td class="titleblock2" width="25%">���ʿ�</td>
    <td width="25%" class="titleblock">{$form.zaseki.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >���󥱡���</td>
    <td width="25%" class="titleblock" >{$form.anquete.html}</td>
    <td class="titleblock2" width="25%" >��Ͽ</td>
    <td width="25%" class="titleblock" >{$form.syuroku.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">���1</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl1.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">��Ľ����</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">����᡼��(API)</td>
    <td width="25%" class="titleblock">{$form.amail.html}</td>
    <td class="titleblock2" width="25%" class="titleblock">����᡼��(CL)</td>
    <td width="25%" class="titleblock">{$form.annai2.html}</td>
  </tr>
  <!-- tr>
    <td width="25%" class="titleblock2">�׹�����</td>
    <td width="25%" class="titleblock"><input type="text" name="yoko" size="20" style="IME-MODE: inactive" maxlength=36></td>
    <td class="titleblock2" align="middle" width="25%">���������</td>
    <td width="25%" class="titleblock"><input type="text" name="annai1" size="20" style="IME-MODE: inactive" maxlength=36></td> 
  </tr -->
  <!-- tr>
    <td class="titleblock2b" width="25%">����������</td>
    <td width="25%" class="titleblock">
    <input type="text" name="iraijo" size="20" maxlength=24 style="IME-MODE: inactive">
    </td>
    <td width="25%" class="titleblock2b">������</td>
    <td width="25%" class="titleblock">
    <input type="text" name="oudaku" size="20" maxlength=24 style="IME-MODE: inactive"></td>
  </tr -->
  <tr>
    <td class="titleblock2b" width="25%">���饷��������</td>
    <td width="25%" class="titleblock">{$form.tirasi1.html}</td>
    <td width="25%" class="titleblock2b">���饷�вᡦ����</td>
    <td width="25%" class="titleblock">{$form.tirasi2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">���饷Ǽ����</td>
    <td width="25%" class="titleblock">{$form.tirasi3.html}</td>
    <td width="25%" class="titleblock"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <!-- td class="titleblock2" width="25%">�ɲÿ���</td>
    <td width="25%" class="titleblock"><input type="text" name="mousi_add" size="20" style="IME-MODE: inactive" maxlength=36></td -->
    <td width="25%" class="titleblock2">�ɲÿ�������</td>
    <td width="25%" class="titleblock">{$form.mousi_c.html}</td>
    <td width="25%" class="titleblock2b">��Ͽ����</td>
    <td width="25%" class="titleblock">{$form.syoroku.html}</td>
  </tr>
  <!-- tr>
    <td class="titleblock2" width="25%">����ǧ</td>
    <td width="25%" class="titleblock"><input type="text" name="kaijo_k" size="20" style="IME-MODE: inactive" maxlength=36></td>
    <td width="25%" class="titleblock2b">�����ǧ</td>
    <td width="25%" class="titleblock"><input type="text" name="syuku_k" size="20" style="IME-MODE: inactive" maxlength=36></td>
  </tr -->
  <tr>
    <td class="titleblock2" width="25%">����̾</td>
    <td width="25%" class="titleblock">{$form.hikae_k.html}</td>
    <td width="25%" class="titleblock2b">��������</td>
    <td width="25%" class="titleblock">{$form.hikae_a.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">�������ѻ���</td>
    <td width="75%" class="titleblock" colspan=3>{$form.hikae_t.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">��������ʪ����</td>
    <td width="25%" class="titleblock">{$form.tojitu.html}</td>
    <td width="25%" class="titleblock2b">ʬôɽ�ǽ�������</td>
    <td width="25%" class="titleblock">{$form.yakubun2.html}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock2">�ʹԾ���</td>
    <td width="25%" class="titleblock">{$form.status.html}</td>
    <td class="titleblock2" width="25%">������</td>
    <td width="25%" class="titleblock">{$form.bento.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����</td>
    <td width="25%" class="titleblock">{$form.sizaisu.html}</td>
    <td class="titleblock2" width="25%">���No</td>
    <td width="25%" class="titleblock">{$form.sizaino.html}</td>
  </tr>
  <!--tr>
    <td class="titleblock2" width="25%">���ơ�����</td>
    <td width="25%" class="titleblock"><input type="radio" value="0" name="sys_stat">ͭ�� 
      <input type="radio" name="sys_stat" value="1"> ��� 
    </td>
    <td width="50%" class="titleblock" colspan="2">�����Ϥ��Υǡ�����ɽ������ޤ���</td>
  </tr-->
  <tr>
    <td class="titleblock2" width="25%">&nbsp;���2</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl2.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">���ŷ��</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">����Կ�</td>
    <td width="25%" class="titleblock">{$form.nyujosha.html}</td>
    <td width="25%" class="titleblock2">���󥱡��Ȳ���Կ�</td>
    <td width="25%" class="titleblock">{$form.an_kaisyu.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">��������</td>
    <td width="25%" class="titleblock">{$form.report.html}</td>
    <td class="titleblock2" width="25%"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">���3</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl3.html}</td>
  </tr>
  <!-- tr>
    <td class="titleblock3" width="680" colSpan="4" height="21">����</td></tr>
  <tr>
    <td class="titleblock2" width="25%">ɽ��/��ɽ��</td>
    <td width="75%" class="titleblock" colspan="3"><input type="radio" name="sys_stat" value="0">ɽ�� 
      <input type="radio" name="sys_stat" value="1">��ɽ��</td>
  </tr-->
</table>

{if $locktoken != "unlock"}
<div align="center">
<FONT color=#ff0000 size=2>�������Ƥ�����å��ξ塢�μ��ڡ����ϥܥ���򥯥�å����Ƥ���������</FONT>
</div>

  <!--### BUTTON ###-->
<div class="form_button">
    <!-- input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" / -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="Edit" />
    <input type="submit" name="submit" value=" ���ڡ��� " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  �ꥻ�å� " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}
</FORM><br>
<!-- a ID="filelist0"></a -->
{foreach name=outer from=$fileData item="item"}
   {assign var=jo value=`$smarty.foreach.outer.iteration`}
   <a ID="filelist{$jo}"></a>
   <TABLE cellSpacing=1 cellPadding=2 width=780>
	{if $jo == 1}
	<TR><TD class=titleblock3 colSpan=3 height=21>�ե�����</TD></TR>
	{/if}
	<tr>
		<td class=titleblock2 width="25%">�ե�����̾</td>
		<td width="55%" class=titleblock>
<a href="./bin/adm_down2012.php?fname={$item.sys_filename}" target=_blank>{$item.org_filename}</a></td>
		<td width="20%" class=titleblock align=center>
		{if $locktoken != "unlock"}
			<form method="post" action="./admincl/cancel2012.php" >
			<br><input type="hidden" name="reg_id" value={$item.reg_id}>
			<input type="hidden" name="semi_id" value={$item.semi_id}>
			<input type="submit" value="���" style="font-size:12" >
			</form>
		{/if}
		</td>
	</tr>
	<tr>
		<td class=titleblock2 width="25%">������</td>
		<td width="75%" colspan=2 class=titleblock>{$item.remark}</td>
	</tr>
	<tr>
		<td class=titleblock2 width="25%">������������</td>
		<td width="75%" class=titleblock colspan=2>{$item.reg_date} {$item.reg_time} ({$item.filesize|number_format}�Х���)
		</td>
	</tr>
   </table>
{foreachelse}
   <TABLE cellSpacing=1 cellPadding=2 width=780 border=0>
	<tr>
		<td colspan="3" class="value"></td>
	</tr>
   </table>
{/foreach}
<p align="right"><a href="#top">Page Top</a></p>

{include file="member/include/HtmlFootSet_ja.tpl"}
