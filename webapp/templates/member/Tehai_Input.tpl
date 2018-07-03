{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="TehaiInput"}
<br />

<form name="form1" method="post" action="?_mod=Tehai">
{$form.hidden}
  <!--### BUTTON ###-->
{if $locktoken != "unlock"}
  <!-- p align="center">
    <input type="submit" name="DirectBtn" value="基本" />
    <input type="submit" name="DirectBtn" value="座長" />
    <input type="submit" name="DirectBtn" value="演者" />
    <input type="submit" name="DirectBtn" value="手配" />
    <input type="submit" name="DirectBtn" value="人員" />
    <input type="submit" name="DirectBtn" value=" 他 " />
    <input type="submit" name="DirectBtn" value="担当" />
    <input type="submit" name="DirectBtn" value="ｱｯﾌﾟ" />
    <input type="submit" name="DirectBtn" value="帳票" />
  </p -->
{/if}
  <!--/// BUTTON ///-->

<!-- input type="hidden" name="semi_id" value="{$smarty.session.semi_id}"-->
<table width="780" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=5 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
</table>
<div id="box">
<ul>
<!-- li>[座長/演者数]ボタンをクリックすると講師CV、当日配布物、謝金、コーヒー･冷水等の数を座長・演者の人数にあわせて更新します。</li>
<li>[参照]ボタンは機能拡張に備えた項目です。現在は使用していません。</li -->
<li>項目の並べ替えはご遠慮ください。</li>
</ul>
</div>

  {* if $locktoken != "unlock" *}
<!--### BUTTON ###-->
<!-- div align="center">
    <input type="button" name="btn1" value="座長/演者数" onclick="Lookup(1);" style="font-size:12pt;" />&nbsp;&nbsp;&nbsp;
    <input type="button" name="btn2" value="参照" onclick="Lookup(2);" style="font-size:12pt;" />
</div -->
<!--/// BUTTON ///-->
  {* /if *}

<table width="780" cellspacing="1" cellpadding="2">
	<tr><td colspan=6>&nbsp;控室({$smarty.session.h_num})&nbsp;&nbsp;
<!-- span class=red>手配、確認はダブルクリックで上の行を複写</span --></td>
	</tr>
	<tr bgcolor="#ffcc66" align="center"> 
        	<td width="25%"><b><font color="#660033">手配物</font></b></td>
                <td width="7%" ><b><font color="#660033">数</font></b></td>
                <td width="9%" ><b><font color="#660033">手配</font></b></td>
                <td width="9%" ><b><font color="#660033">確認</font></b></td>
                <td width="45%"><b><font color="#660033">備考</font></b></td>
                <td width="5%"><b><font color="#660033">&nbsp;</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$form.th_hinmei1.html}</td>
                <td class="value_c">{$form.th_su1.html}</td>
                <td class="value_c">{$form.tehaisha1.html}</td>
                <td class="value_c">{$form.kakunin1.html}</td>
                <td class="value">{$form.th_bikou1.html}</td>
                <td class="value_c">{$form.th_del1.html}</td>
        </tr>
        <tr> 
              	<td class="item">{$form.th_hinmei2.html}</td>
                <td class="value_c">{$form.th_su2.html}</td>
                <td class="value_c">{$form.tehaisha2.html}</td>
                <td class="value_c">{$form.kakunin2.html}</td>
                <td class="value">{$form.th_bikou2.html}</td>
                <td class="value_c">{$form.th_del2.html}</td>
        </tr>
        <tr> 
		<td class="item">{$form.th_hinmei3.html}</td>
                <td class="value_c">{$form.th_su3.html}</td>
                <td class="value_c">{$form.tehaisha3.html}</td>
                <td class="value_c">{$form.kakunin3.html}</td>
                <td class="value">{$form.th_bikou3.html}</td>
                <td class="value_c">{$form.th_del3.html}</td>
        </tr>
        <tr>
               	<td class="item">{$form.th_hinmei4.html}</td>
                <td class="value_c">{$form.th_su4.html}</td>
                <td class="value_c">{$form.tehaisha4.html}</td>
                <td class="value_c">{$form.kakunin4.html}</td>
                <td class="value">{$form.th_bikou4.html}</td>
                <td class="value_c">{$form.th_del4.html}</td>
        </tr>
        <tr>
          	<td class="item">{$form.th_hinmei5.html}</td>
                <td class="value_c">{$form.th_su5.html}</td>
                <td class="value_c">{$form.tehaisha5.html}</td>
                <td class="value_c">{$form.kakunin5.html}</td>
                <td class="value">{$form.th_bikou5.html}</td>
                <td class="value_c">{$form.th_del5.html}</td>
        </tr>
        <tr>
          	<td class="item">{$form.th_hinmei6.html}</td>
                <td class="value_c">{$form.th_su6.html}</td>
                <td class="value_c">{$form.tehaisha6.html}</td>
                <td class="value_c">{$form.kakunin6.html}</td>
                <td class="value">{$form.th_bikou6.html}</td>
                <td class="value_c">{$form.th_del6.html}</td>
        </tr>
	{if $smarty.session.h_num > 6}
        <tr> 
          	<td class="item">{$form.th_hinmei7.html}</td>
                <td class="value_c">{$form.th_su7.html}</td>
                <td class="value_c">{$form.tehaisha7.html}</td>
                <td class="value_c">{$form.kakunin7.html}</td>
                <td class="value">{$form.th_bikou7.html}</td>
                <td class="value_c">{$form.th_del7.html}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 7}
        <tr> 
          	<td class="item">{$form.th_hinmei8.html}</td>
                <td class="value_c">{$form.th_su8.html}</td>
                <td class="value_c">{$form.tehaisha8.html}</td>
                <td class="value_c">{$form.kakunin8.html}</td>
                <td class="value">{$form.th_bikou8.html}</td>
                <td class="value_c">{$form.th_del8.html}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 8}
        <tr> 
          	<td class="item">{$form.th_hinmei9.html}</td>
                <td class="value_c">{$form.th_su9.html}</td>
                <td class="value_c">{$form.tehaisha9.html}</td>
                <td class="value_c">{$form.kakunin9.html}</td>
                <td class="value">{$form.th_bikou9.html}</td>
                <td class="value_c">{$form.th_del9.html}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 9}
        <tr> 
          	<td class="item">{$form.th_hinmei10.html}</td>
                <td class="value_c">{$form.th_su10.html}</td>
                <td class="value_c">{$form.tehaisha10.html}</td>
                <td class="value_c">{$form.kakunin10.html}</td>
                <td class="value">{$form.th_bikou10.html}</td>
                <td class="value_c">{$form.th_del10.html}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 10}
        <tr> 
          	<td class="item">{$form.th_hinmei11.html}</td>
                <td class="value_c">{$form.th_su11.html}</td>
                <td class="value_c">{$form.tehaisha11.html}</td>
                <td class="value_c">{$form.kakunin11.html}</td>
                <td class="value">{$form.th_bikou11.html}</td>
                <td class="value_c">{$form.th_del11.html}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 11}
        <tr> 
          	<td class="item">{$form.th_hinmei12.html}</td>
                <td class="value_c">{$form.th_su12.html}</td>
                <td class="value_c">{$form.tehaisha12.html}</td>
                <td class="value_c">{$form.kakunin12.html}</td>
                <td class="value">{$form.th_bikou12.html}</td>
                <td class="value_c">{$form.th_del12.html}</td>
        </tr>
	{/if}
        <tr> 
          	<td class="item">
	{if $smarty.session.h_num < 12 && $locktoken != "unlock"}
<input type="button" value="追加" onclick="AddLine(1,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000">
	{/if}
		</td>
        	<td class="value_c"></td>
                <td class="value_c"></td>
                <td class="value_c"></td>
                <td class="value"></td>
          	<td class="item">
	{if $locktoken != "unlock"}
<input type="button" value="削除" onclick="DelLine(1,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000">
	{/if}
		</td>
        </tr>
</table>
<br />
<table width="780" cellspacing="1" cellpadding="2">
	<tr><td colspan=5>&nbsp;セミナー会場({$smarty.session.k_num})</td></tr>
        <tr bgcolor="#ffcc66" align="center"> 
        	<td width="25%"><b><font color="#660033">手配物</font></b></td>
                <td width="7%" ><b><font color="#660033">数</font></b></td>
                <td width="9%" ><b><font color="#660033">手配</font></b></td>
                <td width="9%" ><b><font color="#660033">確認</font></b></td>
                <td width="45%"><b><font color="#660033">備考</font></b></td>
                <td width="5%"><b><font color="#660033">&nbsp;</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$form.th_hinmei61.html}</td>
                <td class="value_c">{$form.th_su61.html}</td>
                <td class="value_c">{$form.tehaisha61.html}</td>
                <td class="value_c">{$form.kakunin61.html}</td>
                <td class="value">{$form.th_bikou61.html}</td>
                <td class="value_c">{$form.th_del61.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei62.html}</td>
                <td class="value_c">{$form.th_su62.html}</td>
                <td class="value_c">{$form.tehaisha62.html}</td>
                <td class="value_c">{$form.kakunin62.html}</td>
                <td class="value">{$form.th_bikou62.html}</td>
                <td class="value_c">{$form.th_del62.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei63.html}</td>
                <td class="value_c">{$form.th_su63.html}</td>
                <td class="value_c">{$form.tehaisha63.html}</td>
                <td class="value_c">{$form.kakunin63.html}</td>
                <td class="value">{$form.th_bikou63.html}</td>
                <td class="value_c">{$form.th_del63.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei64.html}</td>
                <td class="value_c">{$form.th_su64.html}</td>
                <td class="value_c">{$form.tehaisha64.html}</td>
                <td class="value_c">{$form.kakunin64.html}</td>
                <td class="value">{$form.th_bikou64.html}</td>
                <td class="value_c">{$form.th_del64.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei65.html}</td>
                <td class="value_c">{$form.th_su65.html}</td>
                <td class="value_c">{$form.tehaisha65.html}</td>
                <td class="value_c">{$form.kakunin65.html}</td>
                <td class="value">{$form.th_bikou65.html}</td>
                <td class="value_c">{$form.th_del65.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei66.html}</td>
                <td class="value_c">{$form.th_su66.html}</td>
                <td class="value_c">{$form.tehaisha66.html}</td>
                <td class="value_c">{$form.kakunin66.html}</td>
                <td class="value">{$form.th_bikou66.html}</td>
                <td class="value_c">{$form.th_del66.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.th_hinmei67.html}</td>
                <td class="value_c">{$form.th_su67.html}</td>
                <td class="value_c">{$form.tehaisha67.html}</td>
                <td class="value_c">{$form.kakunin67.html}</td>
                <td class="value">{$form.th_bikou67.html}</td>
                <td class="value_c">{$form.th_del67.html}</td>
        </tr>
	{if $smarty.session.k_num > 7}
        <tr>
        	<td class="item">{$form.th_hinmei68.html}</td>
                <td class="value_c">{$form.th_su68.html}</td>
                <td class="value_c">{$form.tehaisha68.html}</td>
                <td class="value_c">{$form.kakunin68.html}</td>
                <td class="value">{$form.th_bikou68.html}</td>
                <td class="value_c">{$form.th_del68.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 8}
        <tr>
        	<td class="item">{$form.th_hinmei69.html}</td>
                <td class="value_c">{$form.th_su69.html}</td>
                <td class="value_c">{$form.tehaisha69.html}</td>
                <td class="value_c">{$form.kakunin69.html}</td>
                <td class="value">{$form.th_bikou69.html}</td>
                <td class="value_c">{$form.th_del69.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 9}
        <tr>
        	<td class="item">{$form.th_hinmei70.html}</td>
                <td class="value_c">{$form.th_su70.html}</td>
                <td class="value_c">{$form.tehaisha70.html}</td>
                <td class="value_c">{$form.kakunin70.html}</td>
                <td class="value">{$form.th_bikou70.html}</td>
                <td class="value_c">{$form.th_del70.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 10}
        <tr>
        	<td class="item">{$form.th_hinmei71.html}</td>
                <td class="value_c">{$form.th_su71.html}</td>
                <td class="value_c">{$form.tehaisha71.html}</td>
                <td class="value_c">{$form.kakunin71.html}</td>
                <td class="value">{$form.th_bikou71.html}</td>
                <td class="value_c">{$form.th_del71.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 11}
        <tr>
        	<td class="item">{$form.th_hinmei72.html}</td>
                <td class="value_c">{$form.th_su72.html}</td>
                <td class="value_c">{$form.tehaisha72.html}</td>
                <td class="value_c">{$form.kakunin72.html}</td>
                <td class="value">{$form.th_bikou72.html}</td>
                <td class="value_c">{$form.th_del72.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 12}
        <tr>
        	<td class="item">{$form.th_hinmei73.html}</td>
                <td class="value_c">{$form.th_su73.html}</td>
                <td class="value_c">{$form.tehaisha73.html}</td>
                <td class="value_c">{$form.kakunin73.html}</td>
                <td class="value">{$form.th_bikou73.html}</td>
                <td class="value_c">{$form.th_del73.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 13}
        <tr>
        	<td class="item">{$form.th_hinmei74.html}</td>
                <td class="value_c">{$form.th_su74.html}</td>
                <td class="value_c">{$form.tehaisha74.html}</td>
                <td class="value_c">{$form.kakunin74.html}</td>
                <td class="value">{$form.th_bikou74.html}</td>
                <td class="value_c">{$form.th_del74.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 14}
        <tr>
        	<td class="item">{$form.th_hinmei75.html}</td>
                <td class="value_c">{$form.th_su75.html}</td>
                <td class="value_c">{$form.tehaisha75.html}</td>
                <td class="value_c">{$form.kakunin75.html}</td>
                <td class="value">{$form.th_bikou75.html}</td>
                <td class="value_c">{$form.th_del75.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 15}
        <tr>
        	<td class="item">{$form.th_hinmei76.html}</td>
                <td class="value_c">{$form.th_su76.html}</td>
                <td class="value_c">{$form.tehaisha76.html}</td>
                <td class="value_c">{$form.kakunin76.html}</td>
                <td class="value">{$form.th_bikou76.html}</td>
                <td class="value_c">{$form.th_del76.html}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 16}
        <tr>
        	<td class="item">{$form.th_hinmei77.html}</td>
                <td class="value_c">{$form.th_su77.html}</td>
                <td class="value_c">{$form.tehaisha77.html}</td>
                <td class="value_c">{$form.kakunin77.html}</td>
                <td class="value">{$form.th_bikou77.html}</td>
                <td class="value_c">{$form.th_del77.html}</td>
        </tr>
	{/if}
        <tr> 
        	<td class="item">
	{if $smarty.session.k_num < 17 && $locktoken != "unlock"}
<input type="button" value="追加" onclick="AddLine(2,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000">
	{/if}
		</td>
                <td class="value_c"> </td>
                <td class="value_c"></td>
                <td class="value_c"></td>
                <td class="value"></td>
                <td class="item">
	{if $locktoken != "unlock"}
<input type="button" value="削除" onclick="DelLine(2,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000"> 
		</td>
	{/if}
        </tr>
</table>

{if $locktoken != "unlock"}
<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［次ページ］ボタンをクリックしてください。</FONT>
</div>

  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" />
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}

</FORM><br />


{include file="member/include/HtmlFootSet_ja.tpl"}
