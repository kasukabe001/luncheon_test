<table width=680 cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;演者{$num}</TD>
  </TR>
  <tr bgcolor="#ffcc66" align="center"> 
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>演者{$num}</td>
    <td width="25%" class="titleblock_t">{$form.cs_name7.value}<input type="hidden" name="cs_name7" value="{$form.cs_name7.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職:{$form.cs_yaku7.value}<input type="hidden" name="cs_yaku7" value="{$form.cs_yaku7.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cs_endai7.value}<input type="hidden" name="cs_endai7" value="{$form.cs_endai7.value}"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>ＰＣ</td>
    <td width="25%" class="titleblock_t" >OS{$form.os7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t" >Soft{$form.soft7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">Version{$form.version7.html}</td>
  </tr>
  <tr>
    <td width="50%" class="titleblock_t" colspan="2">持込み形態{$form.mochikomi7.html}</td>
    <td width="25%" class="titleblock_t" >動画&nbsp;{$form.douga7.html}<br />音声&nbsp;{$form.onsei7.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="25%" class="titleblock_t">営業所{$form.mr_eigyo7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">氏名{$form.mr_name7.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;{$form.mr_setsugu7.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel7.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai7.html}<br />{$form.iki7.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri7.html}<br />{$form.kaeri7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="50%" class="titleblock_t" colspan="2">ホテル{$form.inn_hotel7.html}</td>
    <td width="25%" class="titleblock_t" >手配先{$form.tehaisaki7.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in7.html} → Out&nbsp;{$form.inn_out7.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">手配{$form.inn_tehai7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku7.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >ご略歴入手</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.ryakureki7.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	支払い予定日{$form.cs_shakinhi7.html}
    </td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >備考</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.cs_biko7.html}
    </td>
  </tr>
  </table>
