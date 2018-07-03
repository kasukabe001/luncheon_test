{$form.hidden}
<table width="780" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan={$retsu} height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
	<tr><td colspan=5>&nbsp:人員配置</td></tr>
        <tr bgcolor="#ffcc66" align="center"> 
        	<td width="16%"><b><font color="#660033">&nbsp;</font></b></td>
                <td width="14%" ><b><font color="#660033">Astellas</font></b></td>
		{if $copro1 != "" }
                <td><b><font color="#660033">{$copro1|mb_truncate:8:""|default:"コプロ"|escape}</font></b></td>
		{/if}
		{if $copro2 != "" }
                <td><b><font color="#660033">{$copro2|mb_truncate:8:""|default:"コプロ"|escape}</font></b></td>
		{/if}
                <td width="14%" ><b><font color="#660033">CL</font></b></td>
                <td width="13%" ><b><font color="#660033">学会</font></b></td>
                <td width="30%"><b><font color="#660033">備考</font></b></td>
	</tr>
        <tr> 
        	<td class="item">{$ji_yakuwari1}{$form.ji_yakuwari1.html}{$eji_yakuwari1}</td>
                <td class="value">{$ji_as1}{$form.ji_as1.html}{$eji_as1}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co11}{$form.ji_co11.html}{$eji_co11}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co21}{$form.ji_co21.html}{$eji_co21}</td>
		{/if}
                <td class="value">{$ji_cl1}{$form.ji_cl1.html}{$eji_cl1}</td>
                <td class="value">{$ji_gakkai1}{$form.ji_gakkai1.html}{$eji_gakkai1}</td>
                <td class="value">{$ji_bikou1}{$form.ji_bikou1.html}{$eji_bikou1}</td>
        </tr>
        <tr> 
        	<td class="item">{$ji_yakuwari2}{$form.ji_yakuwari2.html}{$eji_yakuwari2}</td>
                <td class="value">{$ji_as2}{$form.ji_as2.html}{$eji_as2}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co12}{$form.ji_co12.html}{$eji_co12}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co22}{$form.ji_co22.html}{$eji_co22}</td>
		{/if}
                <td class="value">{$ji_cl2}{$form.ji_cl2.html}{$eji_cl2}</td>
                <td class="value">{$ji_gakkai2}{$form.ji_gakkai2.html}{$eji_gakkai2}</td>
                <td class="value">{$ji_bikou2}{$form.ji_bikou2.html}{$eji_bikou2}</td>
        </tr>
        <tr> 
        	<td class="item">{$ji_yakuwari3}{$form.ji_yakuwari3.html}{$eji_yakuwari3}</td>
                <td class="value">{$ji_as3}{$form.ji_as3.html}{$eji_as3}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co13}{$form.ji_co13.html}{$eji_co13}</td>
		{/if}
 		{if $copro2 != "" }
                <td class="value">{$ji_co23}{$form.ji_co23.html}{$eji_co23}</td>
		{/if}
               <td class="value">{$ji_cl3}{$form.ji_cl3.html}{$eji_cl3}</td>
                <td class="value">{$ji_gakkai3}{$form.ji_gakkai3.html}{$eji_gakkai3}</td>
                <td class="value">{$ji_bikou3}{$form.ji_bikou3.html}{$eji_bikou3}</td>
        </tr>
        <tr> 
        	<td class="item">{$ji_yakuwari4}{$form.ji_yakuwari4.html}{$eji_yakuwari4}</td>
                <td class="value">{$ji_as4}{$form.ji_as4.html}{$eji_as4}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co14}{$form.ji_co14.html}{$eji_co14}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co24}{$form.ji_co24.html}{$eji_co24}</td>
		{/if}
                <td class="value">{$ji_cl4}{$form.ji_cl4.html}{$eji_cl4}</td>
                <td class="value">{$ji_gakkai4}{$form.ji_gakkai4.html}{$eji_gakkai4}</td>
                <td class="value">{$ji_bikou4}{$form.ji_bikou4.html}{$ei_bikou4}</td>
        </tr>
        <tr> 
        	<td class="item">{$ji_yakuwari5}{$form.ji_yakuwari5.html}{$eji_yakuwari5}</td>
                <td class="value">{$ji_as5}{$form.ji_as5.html}{$eji_as5}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co15}{$form.ji_co15.html}{$eji_co15}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co25}{$form.ji_co25.html}{$eji_co25}</td>
		{/if}
                <td class="value">{$ji_cl5}{$form.ji_cl5.html}{$eji_cl5}</td>
                <td class="value">{$ji_gakkai5}{$form.ji_gakkai5.html}{$eji_gakkai5}</td>
                <td class="value">{$ji_bikou5}{$form.ji_bikou5.html}{$ei_bikou5}</td>
        </tr>
	{if $smarty.session.j_num > 5}
        <tr> 
        	<td class="item">{$ji_yakuwari6}{$form.ji_yakuwari6.html}{$eji_yakuwari6}</td>
                <td class="value">{$ji_as6}{$form.ji_as6.html}{$eji_as6}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co16}{$form.ji_co16.html}{$eji_co16}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co26}{$form.ji_co26.html}{$eji_co26}</td>
		{/if}
                <td class="value">{$ji_cl6}{$form.ji_cl6.html}{$eji_cl6}</td>
                <td class="value">{$ji_gakkai6}{$form.ji_gakkai6.html}{$eji_gakkai6}</td>
                <td class="value">{$ji_bikou6}{$form.ji_bikou6.html}{$ei_bikou6}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 6}
        <tr> 
        	<td class="item">{$ji_yakuwari7}{$form.ji_yakuwari7.html}{$eji_yakuwari7}</td>
                <td class="value">{$ji_as7}{$form.ji_as7.html}{$eji_as7}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co17}{$form.ji_co17.html}{$eji_co17}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co27}{$form.ji_co27.html}{$eji_co27}</td>
		{/if}
                <td class="value">{$ji_cl7}{$form.ji_cl7.html}{$eji_cl7}</td>
                <td class="value">{$ji_gakkai7}{$form.ji_gakkai7.html}{$eji_gakkai7}</td>
                <td class="value">{$ji_bikou7}{$form.ji_bikou7.html}{$ei_bikou7}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 7}
        <tr> 
        	<td class="item">{$ji_yakuwari8}{$form.ji_yakuwari8.html}{$eji_yakuwari8}</td>
                <td class="value">{$ji_as8}{$form.ji_as8.html}{$eji_as8}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co18}{$form.ji_co18.html}{$eji_co18}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co28}{$form.ji_co28.html}{$eji_co28}</td>
		{/if}
                <td class="value">{$ji_cl8}{$form.ji_cl8.html}{$eji_cl8}</td>
                <td class="value">{$ji_gakkai8}{$form.ji_gakkai8.html}{$eji_gakkai8}</td>
                <td class="value">{$ji_bikou8}{$form.ji_bikou8.html}{$eji_bikou8}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 8}
        <tr> 
        	<td class="item">{$ji_yakuwari9}{$form.ji_yakuwari9.html}{$eji_yakuwari9}</td>
                <td class="value">{$ji_as9}{$form.ji_as9.html}{$eji_as9}</td>
		{if $copro1 != "" }
                <td class="value">{$ji_co19}{$form.ji_co19.html}{$eji_co19}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value">{$ji_co29}{$form.ji_co29.html}{$eji_co29}</td>
		{/if}
                <td class="value">{$ji_cl9}{$form.ji_cl9.html}{$eji_cl9}</td>
                <td class="value">{$ji_gakkai9}{$form.ji_gakkai9.html}{$eji_gakkai9}</td>
                <td class="value">{$ji_bikou9}{$form.ji_bikou9.html}{$eji_bikou9}</td>
        </tr>
	{/if}
</table>
<br />
