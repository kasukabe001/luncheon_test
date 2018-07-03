{$form.hidden}
<table width="780" cellspacing="1" cellpadding="2">
	<tr><td colspan=5>&nbsp;控室</td></tr>
	<tr bgcolor="#ffcc66" align="center"> 
        	<td width="25%"><b><font color="#660033">手配物</font></b></td>
                <td width="7%" ><b><font color="#660033">数</font></b></td>
                <td width="9%" ><b><font color="#660033">手配</font></b></td>
                <td width="9%" ><b><font color="#660033">確認</font></b></td>
                <td width="50%"><b><font color="#660033">備考</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$th_hinmei1}{$form.th_hinmei1.html}{$eth_hinmei1}</td>
                <td class="value_c">{$th_su1}{$form.th_su1.html}{$eth_su1}</td>
                <td class="value_c">{$tehaisha1}{$form.tehaisha1.html}{$etehaisha1}</td>
                <td class="value_c">{$kakunin1}{$form.kakunin1.html}{$ekakunin1}</td>
                <td class="value">{$th_bikou1}{$form.th_bikou1.html}{$eth_bikou1}</td>
        </tr>
        <tr> 
              	<td class="item">{$th_hinmei2}{$form.th_hinmei2.html}{$eth_hinmei2}</td>
                <td class="value_c">{$th_su2}{$form.th_su2.html}{$eth_su2}</td>
                <td class="value_c">{$tehaisha2}{$form.tehaisha2.html}{$etehaisha2}</td>
                <td class="value_c">{$kakunin2}{$form.kakunin2.html}{$ekakunin2}</td>
                <td class="value">{$th_bikou2}{$form.th_bikou2.html}{$eth_bikou2}</td>
        </tr>
        <tr> 
		<td class="item">{$th_hinmei3}{$form.th_hinmei3.html}{$eth_hinmei3}</td>
                <td class="value_c">{$th_su3}{$form.th_su3.html}{$eth_su3}</td>
                <td class="value_c">{$tehaisha3}{$form.tehaisha3.html}{$etehaisha3}</td>
                <td class="value_c">{$kakunin3}{$form.kakunin3.html}{$ekakunin3}</td>
                <td class="value">{$th_bikou3}{$form.th_bikou3.html}{$eth_bikou3}</td>
        </tr>
        <tr> 
               	<td class="item">{$th_hinmei4}{$form.th_hinmei4.html}{$eth_hinmei4}</td>
                <td class="value_c">{$th_su4}{$form.th_su4.html}{$eth_su4}</td>
                <td class="value_c">{$tehaisha4}{$form.tehaisha4.html}{$etehaisha4}</td>
                <td class="value_c">{$kakunin4}{$form.kakunin4.html}{$ekakunin4}</td>
                <td class="value">{$th_bikou4}{$form.th_bikou4.html}{$eth_bikou4}</td>
        </tr>
        <tr> 
          	<td class="item">{$th_hinmei5}{$form.th_hinmei5.html}{$eth_hinmei5}</td>
                <td class="value_c">{$th_su5}{$form.th_su5.html}{$eth_su5}</td>
                <td class="value_c">{$tehaisha5}{$form.tehaisha5.html}{$etehaisha5}</td>
                <td class="value_c">{$kakunin5}{$form.kakunin5.html}{$ekakunin5}</td>
                <td class="value">{$th_bikou5}{$form.th_bikou5.html}{$eth_bikou5}</td>
        </tr>
        <tr>
          	<td class="item">{$th_hinmei6}{$form.th_hinmei6.html}{$eth_hinmei6}</td>
                <td class="value_c">{$th_su6}{$form.th_su6.html}{$eth_su6}</td>
                <td class="value_c">{$tehaisha6}{$form.tehaisha6.html}{$etehaisha6}</td>
                <td class="value_c">{$kakunin6}{$form.kakunin6.html}{$ekakunin6}</td>
                <td class="value">{$th_bikou6}{$form.th_bikou6.html}{$eth_bikou6}</td>
        </tr>
	{if $smarty.session.h_num > 6}
        <tr> 
          	<td class="item">{$th_hinmei7}{$form.th_hinmei7.html}{$eth_hinmei7}</td>
                <td class="value_c">{$th_su7}{$form.th_su7.html}{$eth_su7}</td>
                <td class="value_c">{$tehaisha7}{$form.tehaisha7.html}{$etehaisha7}</td>
                <td class="value_c">{$kakunin7}{$form.kakunin7.html}{$ekakunin7}</td>
                <td class="value">{$th_bikou7}{$form.th_bikou7.html}{$eth_bikou7}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 7}
        <tr> 
          	<td class="item">{$th_hinmei8}{$form.th_hinmei8.html}{$eth_hinmei8}</td>
                <td class="value_c">{$th_su8}{$form.th_su8.html}{$eth_su8}</td>
                <td class="value_c">{$tehaisha8}{$form.tehaisha8.html}{$etehaisha8}</td>
                <td class="value_c">{$kakunin8}{$form.kakunin8.html}{$ekakunin8}</td>
                <td class="value">{$th_bikou8}{$form.th_bikou8.html}{$eth_bikou8}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 8}
        <tr> 
          	<td class="item">{$th_hinmei9}{$form.th_hinmei9.html}{$eth_hinmei9}</td>
                <td class="value_c">{$th_su9}{$form.th_su9.html}{$eth_su9}</td>
                <td class="value_c">{$tehaisha9}{$form.tehaisha9.html}{$etehaisha9}</td>
                <td class="value_c">{$kakunin9}{$form.kakunin9.html}{$ekakunin9}</td>
                <td class="value">{$th_bikou9}{$form.th_bikou9.html}{$eth_bikou9}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 9}
        <tr> 
          	<td class="item">{$th_hinmei10}{$form.th_hinmei10.html}{$eth_hinmei10}</td>
                <td class="value_c">{$th_su10}{$form.th_su10.html}{$eth_su10}</td>
                <td class="value_c">{$tehaisha10}{$form.tehaisha10.html}{$etehaisha10}</td>
                <td class="value_c">{$kakunin10}{$form.kakunin10.html}{$ekakunin10}</td>
                <td class="value">{$th_bikou10}{$form.th_bikou10.html}{$eth_bikou10}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 10}
        <tr> 
          	<td class="item">{$th_hinmei11}{$form.th_hinmei11.html}{$eth_hinmei11}</td>
                <td class="value_c">{$th_su11}{$form.th_su11.html}{$eth_su11}</td>
                <td class="value_c">{$tehaisha11}{$form.tehaisha11.html}{$etehaisha11}</td>
                <td class="value_c">{$kakunin11}{$form.kakunin11.html}{$ekakunin11}</td>
                <td class="value">{$th_bikou11}{$form.th_bikou11.html}{$eth_bikou11}</td>
        </tr>
	{/if}
	{if $smarty.session.h_num > 11}
        <tr> 
          	<td class="item">{$th_hinmei12}{$form.th_hinmei12.html}{$eth_hinmei12}</td>
                <td class="value_c">{$th_su12}{$form.th_su12.html}{$eth_su12}</td>
                <td class="value_c">{$tehaisha12}{$form.tehaisha12.html}{$etehaisha12}</td>
                <td class="value_c">{$kakunin12}{$form.kakunin12.html}{$ekakunin12}</td>
                <td class="value">{$th_bikou12}{$form.th_bikou12.html}{$eth_bikou12}</td>
        </tr>
	{/if}
</table>
<br />
<table width="780" cellspacing="1" cellpadding="2">
	<tr><td colspan=5>&nbsp;セミナー会場</td></tr>
        <tr bgcolor="#ffcc66" align="center"> 
        	<td width="25%"><b><font color="#660033">手配物</font></b></td>
                <td width="7%" ><b><font color="#660033">数</font></b></td>
                <td width="9%" ><b><font color="#660033">手配</font></b></td>
                <td width="9%" ><b><font color="#660033">確認</font></b></td>
                <td width="50%"><b><font color="#660033">備考</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$th_hinmei61}{$form.th_hinmei61.html}{$eth_hinmei61}</td>
                <td class="value_c">{$th_su61}{$form.th_su61.html}{$eth_su61}</td>
                <td class="value_c">{$tehaisha61}{$form.tehaisha61.html}{$etehaisha61}</td>
                <td class="value_c">{$kakunin61}{$form.kakunin61.html}{$ekakunin61}</td>
                <td class="value">{$th_bikou61}{$form.th_bikou61.html}{$eth_bikou61}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei62}{$form.th_hinmei62.html}{$eth_hinmei62}</td>
                <td class="value_c">{$th_su62}{$form.th_su62.html}{$eth_su62}</td>
                <td class="value_c">{$tehaisha62}{$form.tehaisha62.html}{$etehaisha62}</td>
                <td class="value_c">{$kakunin62}{$form.kakunin62.html}{$ekakunin62}</td>
                <td class="value">{$th_bikou62}{$form.th_bikou62.html}{$eth_bikou62}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei63}{$form.th_hinmei63.html}{$eth_hinmei63}</td>
                <td class="value_c">{$th_su63}{$form.th_su63.html}{$eth_su63}</td>
                <td class="value_c">{$tehaisha63}{$form.tehaisha63.html}{$etehaisha63}</td>
                <td class="value_c">{$kakunin63}{$form.kakunin63.html}{$ekakunin63}</td>
                <td class="value">{$th_bikou63}{$form.th_bikou63.html}{$eth_bikou63}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei64}{$form.th_hinmei64.html}{$eth_hinmei64}</td>
                <td class="value_c">{$th_su64}{$form.th_su64.html}{$eth_su64}</td>
                <td class="value_c">{$tehaisha64}{$form.tehaisha64.html}{$etehaisha64}</td>
                <td class="value_c">{$kakunin64}{$form.kakunin64.html}{$ekakunin64}</td>
                <td class="value">{$th_bikou64}{$form.th_bikou64.html}{$eth_bikou64}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei65}{$form.th_hinmei65.html}{$eth_hinmei65}</td>
                <td class="value_c">{$th_su65}{$form.th_su65.html}{$eth_su65}</td>
                <td class="value_c">{$tehaisha65}{$form.tehaisha65.html}{$etehaisha65}</td>
                <td class="value_c">{$kakunin65}{$form.kakunin65.html}{$ekakunin65}</td>
                <td class="value">{$th_bikou65}{$form.th_bikou65.html}{$eth_bikou65}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei66}{$form.th_hinmei66.html}{$eth_hinmei66}</td>
                <td class="value_c">{$th_su66}{$form.th_su66.html}{$eth_su66}</td>
                <td class="value_c">{$tehaisha66}{$form.tehaisha66.html}{$etehaisha66}</td>
                <td class="value_c">{$kakunin66}{$form.kakunin66.html}{$ekakunin66}</td>
                <td class="value">{$th_bikou66}{$form.th_bikou66.html}{$eth_bikou66}</td>
        </tr>
        <tr> 
        	<td class="item">{$th_hinmei67}{$form.th_hinmei67.html}{$eth_hinmei67}</td>
                <td class="value_c">{$th_su67}{$form.th_su67.html}{$eth_su67}</td>
                <td class="value_c">{$tehaisha67}{$form.tehaisha67.html}{$etehaisha67}</td>
                <td class="value_c">{$kakunin67}{$form.kakunin67.html}{$ekakunin67}</td>
                <td class="value">{$th_bikou67}{$form.th_bikou67.html}{$eth_bikou67}</td>
        </tr>
	{if $smarty.session.k_num > 7}
        <tr>
        	<td class="item">{$th_hinmei68}{$form.th_hinmei68.html}{$eth_hinmei68}</td>
                <td class="value_c">{$th_su68}{$form.th_su68.html}{$eth_su68}</td>
                <td class="value_c">{$tehaisha68}{$form.tehaisha68.html}{$etehaisha68}</td>
                <td class="value_c">{$kakunin68}{$form.kakunin68.html}{$ekakunin68}</td>
                <td class="value">{$th_bikou68}{$form.th_bikou68.html}{$eth_bikou68}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 8}
        <tr>
        	<td class="item">{$th_hinmei69}{$form.th_hinmei69.html}{$eth_hinmei69}</td>
                <td class="value_c">{$th_su69}{$form.th_su69.html}{$eth_su69}</td>
                <td class="value_c">{$tehaisha69}{$form.tehaisha69.html}{$etehaisha69}</td>
                <td class="value_c">{$kakunin69}{$form.kakunin69.html}{$ekakunin69}</td>
                <td class="value">{$th_bikou69}{$form.th_bikou69.html}{$eth_bikou69}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 9}
        <tr>
        	<td class="item">{$th_hinmei70}{$form.th_hinmei70.html}{$eth_hinmei70}</td>
                <td class="value_c">{$th_su70}{$form.th_su70.html}{$eth_su70}</td>
                <td class="value_c">{$tehaisha70}{$form.tehaisha70.html}{$etehaisha70}</td>
                <td class="value_c">{$kakunin70}{$form.kakunin70.html}{$ekakunin70}</td>
                <td class="value">{$th_bikou70}{$form.th_bikou70.html}{$eth_bikou70}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 10}
        <tr>
        	<td class="item">{$th_hinmei71}{$form.th_hinmei71.html}{$eth_hinmei71}</td>
                <td class="value_c">{$th_su71}{$form.th_su71.html}{$eth_su71}</td>
                <td class="value_c">{$tehaisha71}{$form.tehaisha71.html}{$etehaisha71}</td>
                <td class="value_c">{$kakunin71}{$form.kakunin71.html}{$ekakunin71}</td>
                <td class="value">{$th_bikou71}{$form.th_bikou71.html}{$eth_bikou71}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 11}
        <tr>
        	<td class="item">{$th_hinmei72}{$form.th_hinmei72.html}{$eth_hinmei72}</td>
                <td class="value_c">{$th_su72}{$form.th_su72.html}{$eth_su72}</td>
                <td class="value_c">{$tehaisha72}{$form.tehaisha72.html}{$etehaisha72}</td>
                <td class="value_c">{$kakunin72}{$form.kakunin72.html}{$ekakunin72}</td>
                <td class="value">{$th_bikou72}{$form.th_bikou72.html}{$eth_bikou72}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 12}
        <tr>
        	<td class="item">{$th_hinmei73}{$form.th_hinmei73.html}{$eth_hinmei73}</td>
                <td class="value_c">{$th_su73}{$form.th_su73.html}{$eth_su73}</td>
                <td class="value_c">{$tehaisha73}{$form.tehaisha73.html}{$etehaisha73}</td>
                <td class="value_c">{$kakunin73}{$form.kakunin73.html}{$ekakunin73}</td>
                <td class="value">{$th_bikou73}{$form.th_bikou73.html}{$eth_bikou73}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 13}
        <tr>
        	<td class="item">{$th_hinmei74}{$form.th_hinmei74.html}{$eth_hinmei74}</td>
                <td class="value_c">{$th_su74}{$form.th_su74.html}{$eth_su74}</td>
                <td class="value_c">{$tehaisha74}{$form.tehaisha74.html}{$etehaisha74}</td>
                <td class="value_c">{$kakunin74}{$form.kakunin74.html}{$ekakunin74}</td>
                <td class="value">{$th_bikou74}{$form.th_bikou74.html}{$eth_bikou74}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 14}
        <tr>
        	<td class="item">{$th_hinmei75}{$form.th_hinmei75.html}{$eth_hinmei75}</td>
                <td class="value_c">{$th_su75}{$form.th_su75.html}{$eth_su75}</td>
                <td class="value_c">{$tehaisha75}{$form.tehaisha75.html}{$etehaisha75}</td>
                <td class="value_c">{$kakunin75}{$form.kakunin75.html}{$ekakunin75}</td>
                <td class="value">{$th_bikou75}{$form.th_bikou75.html}{$eth_bikou75}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 15}
        <tr>
        	<td class="item">{$th_hinmei76}{$form.th_hinmei76.html}{$eth_hinmei76}</td>
                <td class="value_c">{$th_su76}{$form.th_su76.html}{$eth_su76}</td>
                <td class="value_c">{$tehaisha76}{$form.tehaisha76.html}{$etehaisha76}</td>
                <td class="value_c">{$kakunin76}{$form.kakunin76.html}{$ekakunin76}</td>
                <td class="value">{$th_bikou76}{$form.th_bikou76.html}{$eth_bikou76}</td>
        </tr>
	{/if}
	{if $smarty.session.k_num > 16}
        <tr>
        	<td class="item">{$th_hinmei77}{$form.th_hinmei77.html}{$eth_hinmei77}</td>
                <td class="value_c">{$th_su77}{$form.th_su77.html}{$eth_su77}</td>
                <td class="value_c">{$tehaisha77}{$form.tehaisha77.html}{$etehaisha77}</td>
                <td class="value_c">{$kakunin77}{$form.kakunin77.html}{$ekakunin77}</td>
                <td class="value">{$th_bikou77}{$form.th_bikou77.html}{$eth_bikou77}</td>
        </tr>
	{/if}
</table>

