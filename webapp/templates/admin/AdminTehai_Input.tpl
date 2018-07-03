{include file="admin/include/HtmlHeadSet.tpl" htmlTitle="AdminTehaiInput"}
<br />

<form name="form1" method="post" action="?_mod=AdminTehai">
{$form.hidden}
<table width="880" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=7 height=21>&nbsp;初期値の設定</TD>
  </TR>
	<tr><td>&nbsp;控室</td></tr>
</table>
<div id="box">
<ul>
<li>*1 参照項目:将来の機能追加用の項目です。現在は使用していません。</li>
</ul>
</div>

<table width="880" cellspacing="1" cellpadding="2">
	<tr bgcolor="#ffcc66" align="center"> 
        	<td ><b><font color="#660033">手配物</font></b></td>
                <td ><b><font color="#660033">数</font></b></td>
                <td ><b><font color="#660033">手配</font></b></td>
                <td ><b><font color="#660033">確認</font></b></td>
                <td ><b><font color="#660033">備考</font></b></td>
                <td ><b><font color="#660033">参照項目 <sup>*1</sup></font></b></td>
                <td ><b><font color="#660033">状況</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$form.th_hinmei1.html}</td>
                <td class="value_c">{$form.th_su1.html}</td>
                <td class="value_c">{$form.tehaisha1.html}</td>
                <td class="value_c">{$form.kakunin1.html}</td>
                <td class="value">{$form.th_bikou1.html}</td>
                <td class="value">{$form.th_lookup1.html}</td>
                <td class="value">{$form.th_status1.html}</td>
        </tr>
        <tr> 
              	<td class="item">{$form.th_hinmei2.html}</td>
                <td class="value_c">{$form.th_su2.html}</td>
                <td class="value_c">{$form.tehaisha2.html}</td>
                <td class="value_c">{$form.kakunin2.html}</td>
                <td class="value">{$form.th_bikou2.html}</td>
                <td class="value">{$form.th_lookup2.html}</td>
                <td class="value">{$form.th_status2.html}</td>
        </tr>
        <tr> 
		<td class="item">{$form.th_hinmei3.html}</td>
                <td class="value_c">{$form.th_su3.html}</td>
                <td class="value_c">{$form.tehaisha3.html}</td>
                <td class="value_c">{$form.kakunin3.html}</td>
                <td class="value">{$form.th_bikou3.html}</td>
                <td class="value">{$form.th_lookup3.html}</td>
                <td class="value_c">{$form.th_status3.html}</td>
        </tr>
        <tr>
               	<td class="item">{$form.th_hinmei4.html}</td>
                <td class="value_c">{$form.th_su4.html}</td>
                <td class="value_c">{$form.tehaisha4.html}</td>
                <td class="value_c">{$form.kakunin4.html}</td>
                <td class="value">{$form.th_bikou4.html}</td>
                <td class="value">{$form.th_lookup4.html}</td>
                <td class="value">{$form.th_status4.html}</td>
        </tr>
        <tr>
          	<td class="item">{$form.th_hinmei5.html}</td>
                <td class="value_c">{$form.th_su5.html}</td>
                <td class="value_c">{$form.tehaisha5.html}</td>
                <td class="value_c">{$form.kakunin5.html}</td>
                <td class="value">{$form.th_bikou5.html}</td>
                <td class="value">{$form.th_lookup5.html}</td>
                <td class="value">{$form.th_status5.html}</td>
        </tr>
        <tr>
          	<td class="item">{$form.th_hinmei6.html}</td>
                <td class="value_c">{$form.th_su6.html}</td>
                <td class="value_c">{$form.tehaisha6.html}</td>
                <td class="value_c">{$form.kakunin6.html}</td>
                <td class="value">{$form.th_bikou6.html}</td>
                <td class="value">{$form.th_lookup6.html}</td>
                <td class="value">{$form.th_status6.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei7.html}</td>
                <td class="value_c">{$form.th_su7.html}</td>
                <td class="value_c">{$form.tehaisha7.html}</td>
                <td class="value_c">{$form.kakunin7.html}</td>
                <td class="value">{$form.th_bikou7.html}</td>
                <td class="value">{$form.th_lookup7.html}</td>
                <td class="value">{$form.th_status7.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei8.html}</td>
                <td class="value_c">{$form.th_su8.html}</td>
                <td class="value_c">{$form.tehaisha8.html}</td>
                <td class="value_c">{$form.kakunin8.html}</td>
                <td class="value">{$form.th_bikou8.html}</td>
                <td class="value">{$form.th_lookup8.html}</td>
                <td class="value">{$form.th_status8.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei9.html}</td>
                <td class="value_c">{$form.th_su9.html}</td>
                <td class="value_c">{$form.tehaisha9.html}</td>
                <td class="value_c">{$form.kakunin9.html}</td>
                <td class="value">{$form.th_bikou9.html}</td>
                <td class="value">{$form.th_lookup9.html}</td>
                <td class="value">{$form.th_status9.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei10.html}</td>
                <td class="value_c">{$form.th_su10.html}</td>
                <td class="value_c">{$form.tehaisha10.html}</td>
                <td class="value_c">{$form.kakunin10.html}</td>
                <td class="value">{$form.th_bikou10.html}</td>
                <td class="value">{$form.th_lookup10.html}</td>
                <td class="value">{$form.th_status10.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei11.html}</td>
                <td class="value_c">{$form.th_su11.html}</td>
                <td class="value_c">{$form.tehaisha11.html}</td>
                <td class="value_c">{$form.kakunin11.html}</td>
                <td class="value">{$form.th_bikou11.html}</td>
                <td class="value">{$form.th_lookup11.html}</td>
                <td class="value">{$form.th_status11.html}</td>
        </tr>
        <tr> 
          	<td class="item">{$form.th_hinmei12.html}</td>
                <td class="value_c">{$form.th_su12.html}</td>
                <td class="value_c">{$form.tehaisha12.html}</td>
                <td class="value_c">{$form.kakunin12.html}</td>
                <td class="value">{$form.th_bikou12.html}</td>
                <td class="value">{$form.th_lookup12.html}</td>
                <td class="value">{$form.th_status12.html}</td>
        </tr>
</table>
<br />

<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［次ページ］ボタンをクリックしてください。</FONT>
</div>

  <!--### BUTTON ###-->
{if $locktoken != "unlock"}
<div class="form_button">
    <!-- input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" / -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
{/if}
  <!--/// BUTTON ///-->

</FORM><br>


{include file="admin/include/HtmlFootSet.tpl"}
