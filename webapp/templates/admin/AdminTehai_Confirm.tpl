{include file='admin/include/HtmlHeadSet.tpl' htmlTitle="$bpshj-確認"}

<div class="confirm_title">- 確認 -</div>

<form name="form1" method="post" action="?_mod={$bpshe}">
{$form.hidden}
<table width="880" cellspacing="1" cellpadding="2">
	<tr><td colspan=7>&nbsp;控室</td></tr>
	<tr bgcolor="#ffcc66" align="center"> 
        	<td><b><font color="#660033">手配物</font></b></td>
                <td><b><font color="#660033">数</font></b></td>
                <td><b><font color="#660033">手配</font></b></td>
                <td><b><font color="#660033">確認</font></b></td>
                <td><b><font color="#660033">備考</font></b></td>
                <td><b><font color="#660033">参照項目</font></b></td>
                <td><b><font color="#660033">状況</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$th_hinmei1}{$form.th_hinmei1.html}{$eth_hinmei}</td>
                <td class="value_c">{$th_su1}{$form.th_su1.html}{$eth_su1}</td>
                <td class="value_c">{$tehaisha1}{$form.tehaisha1.html}{$etehaisha1}</td>
                <td class="value_c">{$kakunin1}{$form.kakunin1.html}{$ekakunin1}</td>
                <td class="value">{$th_bikou1}{$form.th_bikou1.html}{$eth_bikou1}</td>
                <td class="value">{$th_lookup1}{$form.th_lookup1.html}{$eth_lookup1}</td>
                <td class="value">{$th_status1}{$form.th_status1.html}{$eth_status1}</td>
        </tr>
        <tr> 
              	<td class="item">{$th_hinmei2}{$form.th_hinmei2.html}{$eth_hinmei2}</td>
                <td class="value_c">{$th_su2}{$form.th_su2.html}{$eth_su2}</td>
                <td class="value_c">{$tehaisha2}{$form.tehaisha2.html}{$etehaisha2}</td>
                <td class="value_c">{$kakunin2}{$form.kakunin2.html}{$ekakunin2}</td>
                <td class="value">{$th_bikou2}{$form.th_bikou2.html}{$eth_bikou2}</td>
                <td class="value">{$th_lookup2}{$form.th_lookup2.html}{$eth_lookup2}</td>
                <td class="value">{$th_status2}{$form.th_status2.html}{$eth_status2}</td>
        </tr>
        <tr> 
		<td class="item">{$th_hinmei3}{$form.th_hinmei3.html}{$eth_hinmei3}</td>
                <td class="value_c">{$th_su3}{$form.th_su3.html}{$eth_su3}</td>
                <td class="value_c">{$tehaisha3}{$form.tehaisha3.html}{$etehaisha3}</td>
                <td class="value_c">{$kakunin3}{$form.kakunin3.html}{$ekakunin3}</td>
                <td class="value">{$th_bikou3}{$form.th_bikou3.html}{$eth_bikou3}</td>
                <td class="value">{$th_lookup3}{$form.th_lookup3html}{$eth_lookup3}</td>
                <td class="value">{$th_status3}{$form.th_status3.html}{$eth_status3}</td>
        </tr>
        <tr> 
               	<td class="item">{$th_hinmei4}{$form.th_hinmei4.html}{$eth_hinmei4}</td>
                <td class="value_c">{$th_su4}{$form.th_su4.html}{$eth_su4}</td>
                <td class="value_c">{$tehaisha4}{$form.tehaisha4.html}{$etehaisha4}</td>
                <td class="value_c">{$kakunin4}{$form.kakunin4.html}{$ekakunin4}</td>
                <td class="value">{$th_bikou4}{$form.th_bikou4.html}{$eth_bikou4}</td>
                <td class="value">{$th_lookup4}{$form.th_lookup4.html}{$eth_lookup4}</td>
                <td class="value">{$th_status4}{$form.th_status4.html}{$eth_status4}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei5}{$form.th_hinmei5.html}{$eth_hinmei5}</td>
                <td class="value_c">{$th_su5}{$form.th_su5.html}{$eth_su5}</td>
                <td class="value_c">{$tehaisha5}{$form.tehaisha5.html}{$etehaisha5}</td>
                <td class="value_c">{$kakunin5}{$form.kakunin5.html}{$ekakunin5}</td>
                <td class="value">{$th_bikou5}{$form.th_bikou5.html}{$eth_bikou5}</td>
                <td class="value">{$th_lookup5}{$form.th_lookup5.html}{$eth_lookup5}</td>
                <td class="value">{$th_status5}{$form.th_status5.html}{$eth_status5}</td>
        </tr>
        <tr>
          	<td class="item">{$th_hinmei6}{$form.th_hinmei6.html}{$eth_hinmei6}</td>
                <td class="value_c">{$th_su6}{$form.th_su6.html}{$eth_su6}</td>
                <td class="value_c">{$tehaisha6}{$form.tehaisha6.html}{$etehaisha6}</td>
                <td class="value_c">{$kakunin6}{$form.kakunin6.html}{$ekakunin6}</td>
                <td class="value">{$th_bikou6}{$form.th_bikou6.html}{$eth_bikou6}</td>
                <td class="value">{$th_lookup6}{$form.th_lookup6.html}{$eth_lookup6}</td>
                <td class="value">{$th_status6}{$form.th_status6.html}{$eth_status6}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei7}{$form.th_hinmei7.html}{$eth_hinmei7}</td>
                <td class="value_c">{$th_su7}{$form.th_su7.html}{$eth_su7}</td>
                <td class="value_c">{$tehaisha7}{$form.tehaisha7.html}{$etehaisha7}</td>
                <td class="value_c">{$kakunin7}{$form.kakunin7.html}{$ekakunin7}</td>
                <td class="value">{$th_bikou7}{$form.th_bikou7.html}{$eth_bikou7}</td>
                <td class="value">{$th_lookup7}{$form.th_lookup7.html}{$eth_lookup7}</td>
                <td class="value">{$th_status7}{$form.th_status7.html}{$eth_status7}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei8}{$form.th_hinmei8.html}{$eth_hinmei8}</td>
                <td class="value_c">{$th_su8}{$form.th_su8.html}{$eth_su8}</td>
                <td class="value_c">{$tehaisha8}{$form.tehaisha8.html}{$etehaisha8}</td>
                <td class="value_c">{$kakunin8}{$form.kakunin8.html}{$ekakunin8}</td>
                <td class="value">{$th_bikou8}{$form.th_bikou8.html}{$eth_bikou8}</td>
                <td class="value">{$th_lookup8}{$form.th_lookup8.html}{$eth_lookup8}</td>
                <td class="value">{$th_status8}{$form.th_status8.html}{$eth_status8}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei9}{$form.th_hinmei9.html}{$eth_hinmei9}</td>
                <td class="value_c">{$th_su9}{$form.th_su9.html}{$eth_su9}</td>
                <td class="value_c">{$tehaisha9}{$form.tehaisha9.html}{$etehaisha9}</td>
                <td class="value_c">{$kakunin9}{$form.kakunin9.html}{$ekakunin9}</td>
                <td class="value">{$th_bikou9}{$form.th_bikou9.html}{$eth_bikou9}</td>
                <td class="value">{$th_lookup9}{$form.th_lookup9.html}{$eth_lookup9}</td>
                <td class="value">{$th_status9}{$form.th_status9.html}{$eth_status9}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei10}{$form.th_hinmei10.html}{$eth_hinmei10}</td>
                <td class="value_c">{$th_su10}{$form.th_su10.html}{$eth_su10}</td>
                <td class="value_c">{$tehaisha10}{$form.tehaisha10.html}{$etehaisha10}</td>
                <td class="value_c">{$kakunin10}{$form.kakunin10.html}{$ekakunin10}</td>
                <td class="value">{$th_bikou10}{$form.th_bikou10.html}{$eth_bikou10}</td>
                <td class="value">{$th_lookup10}{$form.th_lookup10.html}{$eth_lookup10}</td>
                <td class="value">{$th_status10}{$form.th_status10.html}{$eth_status10}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei11}{$form.th_hinmei11.html}{$eth_hinmei11}</td>
                <td class="value_c">{$th_su11}{$form.th_su11.html}{$eth_su11}</td>
                <td class="value_c">{$tehaisha11}{$form.tehaisha11.html}{$etehaisha11}</td>
                <td class="value_c">{$kakunin11}{$form.kakunin11.html}{$ekakunin11}</td>
                <td class="value">{$th_bikou11}{$form.th_bikou11.html}{$eth_bikou11}</td>
                <td class="value">{$th_lookup11}{$form.th_lookup11.html}{$eth_lookup11}</td>
                <td class="value">{$th_status11}{$form.th_status11.html}{$eth_status11}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei12}{$form.th_hinmei12.html}{$eth_hinmei12}</td>
                <td class="value_c">{$th_su12}{$form.th_su12.html}{$eth_su12}</td>
                <td class="value_c">{$tehaisha12}{$form.tehaisha12.html}{$etehaisha12}</td>
                <td class="value_c">{$kakunin12}{$form.kakunin12.html}{$ekakunin12}</td>
                <td class="value">{$th_bikou12}{$form.th_bikou12.html}{$eth_bikou12}</td>
                <td class="value">{$th_lookup12}{$form.th_lookup12.html}{$eth_lookup12}</td>
                <td class="value">{$th_status12}{$form.th_status12.html}{$eth_status12}</td>
        </tr>
</table>
<br />
<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［変更］ボタンをクリックしてください。</FONT>
</div>
<br />
  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token|escape}" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="hidden" name="_act" value="" />

    <input type="button" name="btn2" value=" 変更 " onclick="reqAction('Update')" />&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="btn1" value=" 戻る " onclick="reqAction('Input')" />
</div>
  <!--/// BUTTON ///-->
</form>

{include file='admin/include/HtmlFootSet.tpl'}
