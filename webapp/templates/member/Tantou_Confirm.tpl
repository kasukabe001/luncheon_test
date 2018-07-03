{$form.hidden}

<TABLE cellSpacing=1 cellPadding=2 width=680 border=0>
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
</table>

<TABLE cellSpacing=1 cellPadding=2 width=680 border=0>
  <TR>
    <TD colspan=4>&nbsp;担当者</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$lch_corp0}{$form.lch_corp0.html}{$elch_corp0}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip0}{$form.lch_zip0.html}{$elch_zip0}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr0}{$form.lch_addr0.html}{$elch_addr0}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel0}{$form.lch_tel0.html}{$elch_tel0}
FAX{$lch_fax0}{$form.lch_fax0.html}{$elch_fax0}
携帯{$lch_mobile0}{$form.lch_mobile0.html}{$elch_mobile0}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man0}{$form.lch_man0.html}{$elch_man0}</td>
  </tr>
{if $smarty.session.copronum > 0}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp1.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip1}{$form.lch_zip1.html}{$elch_zip1}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr1}{$form.lch_addr1.html}{$elch_addr1}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel1}{$form.lch_tel1.html}{$elch_tel1}
FAX{$lch_fax1}{$form.lch_fax1.html}{$elch_fax1}
携帯{$lch_mobile1}{$form.lch_mobile1.html}{$elch_mobile1}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$form.lch_man1.html}</td>
  </tr>
{/if}
{if $smarty.session.copronum > 1}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp2.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip2}{$form.lch_zip2.html}{$elch_zip2}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr2}{$form.lch_addr2.html}{$elch_addr2}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel2}{$form.lch_tel2.html}{$elch_tel2}
FAX{$lch_fax2}{$form.lch_fax2.html}{$elch_fax2}
携帯{$lch_mobile2}{$form.lch_mobile2.html}{$elch_mobile2}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man2}{$form.lch_man2.html}{$elch_man2}</td>
  <tr>
{/if}

<!-- MR -->
{foreach from=$zacho key="key" item="item" }
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">
	{$item.mr_eigyo}<br />{$item.mr_name}<br />{$item.mr_keitai}
    </td>
</tr>
{foreachelse}
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">座長担当MRの登録はありません。</td>
</tr>
{/foreach}
{foreach from=$ensha key="key" item="item" }
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">
	{$item.mr_eigyo}<br />{$item.mr_name}<br />{$item.mr_keitai}
    </td>
</tr>
{foreachelse}
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">演者担当MRの登録はありません。</td>
</tr>
{/foreach}
<!-- MR -->

  <tr>
    <td class="titleblock2" width="25%" rowspan=5>【CL当日運営】</td>
    <td width="75%" class="titleblock" colspan="3">{$lch_corp3}{$form.lch_corp3.html}{$elch_corp3}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip3}{$form.lch_zip3.html}{$elch_zip3}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr3}{$form.lch_addr3.html}{$elch_addr3}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel3}{$form.lch_tel3.html}{$elch_tel3}
FAX{$lch_fax3}{$form.lch_fax3.html}{$elch_fax3}
携帯{$lch_mobile3}{$form.lch_mobile3.html}{$wlch_mobile3}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man3}{$form.lch_man3.html}{$elch_man3}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>学会事務局</td>
    <td width="75%" class="titleblock" colspan="3">{$lch_corp4}{$form.lch_corp4.html}{$elch_corp4}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip4}{$form.lch_zip4.html}{$elch_zip4}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr4}{$form.lch_addr4.html}{$elch_addr4}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel4}{$form.lch_tel4.html}{$elch_tel4}
FAX{$lch_fax4}{$form.lch_fax4.html}{$elch_fax4}
携帯{$lch_mobile4}{$form.lch_mobile4.html}{$elch_mobile4}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$form.lch_man4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>会場</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp5.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip5}{$form.lch_zip5.html}{$elch_zip5}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr5}{$form.lch_addr5.html}{$elch_addr5}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock" colspan="3">
TEL{$lch_tel5}{$form.lch_tel5.html}{$elch_tel5}
FAX{$lch_fax5}{$form.lch_fax5.html}{$elch_fax5}
携帯{$lch_mobile5}{$form.lch_mobile5.html}{$elch_mobile5}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man5}{$form.lch_man5.html}{$elch_man5}</td>
  </tr>
{if $anquete == "有"}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>【アンケート】</td>
    <td width="75%" class="titleblock" colspan="3">{$lch_corp6}{$form.lch_corp6.html}{$elch_corp6}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip6}{$form.lch_zip6.html}{$elch_zip6}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr6}{$form.lch_addr6.html}{$elch_addr6}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel6}{$form.lch_tel6.html}{$elch_tel6}
FAX{$lch_fax6}{$form.lch_fax6.html}{$elch_fax6}
携帯{$lch_mobile6}{$form.lch_mobile6.html}{$elch_mobile6}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man6}{$form.lch_man6.html}{$elch_man6}</td>
  </tr>
{else}
  <tr>
    <td class="titleblock2" width="25%" >【アンケート】</td>
    <td width="75%" class="titleblock" colspan="3">無</td>
  </tr>
{/if}

{if $syuroku == "有"}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>【収録】</td>
    <td width="75%" class="titleblock" colspan="3">{$lch_corp7}{$form.lch_corp7.html}{$elch_corp7}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$lch_zip7}{$form.lch_zip7.html}{$elch_zip7}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$lch_addr7}{$form.lch_addr7.html}{$elch_addr7}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$lch_tel7}{$form.lch_tel7.html}{$elch_tel7}
FAX{$lch_fax7}{$form.lch_fax7.html}{$elch_fax7}
携帯{$lch_mobile7}{$form.lch_mobile7.html}{$elch_mobile7}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$lch_man7}{$form.lch_man7.html}{$elch_man7}</td>
  </tr>
{else}
  <tr>
    <td class="titleblock2" width="25%" >【収録】</td>
    <td width="75%" class="titleblock" colspan="3">無</td>
  </tr>
{/if}
</table>
<br>

