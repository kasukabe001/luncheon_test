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
    <td width="25%" class="titleblock_t">氏名{$form.cs_name`$num`.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.cs_yaku`$num`.value}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana`$num`.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cs_endai`$num`.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>ＰＣ</td>
    <td width="25%" class="titleblock_t" >OS{$form.os`$num`.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t" >Soft{$form.soft`$num`.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">Version{$form.version`$num`.html}</td>
  </tr>
  <tr>
    <td width="50%" class="titleblock_t" colspan="2">持込み形態{$form.mochikomi`$num`.html}</td>
    <td width="50%" class="titleblock_t" >動画&nbsp;{$form.douga`$num`.html}<br />音声&nbsp;{$form.onsei`$num`.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=2>ＭＲ</td>
    <td width="25%" class="titleblock_t">営業所{$form.mr_eigyo`$num`.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">氏名{$form.mr_name`$num`.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai`$num`.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;{$form.mr_setsugu`$num`.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai`$num`.html}<br />{$form.iki`$num`.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri`$num`.html}<br />{$form.kaeri`$num`.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=4>宿泊</td>
    <td width="75%" class="titleblock_t" colspan="2">ホテル{$form.inn_hotel`$num`.html}</td>
    <td width="25%" class="titleblock_t" colspan="2">手配先{$form.tehaisaki`$num`.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in`$num`.html} → Out&nbsp;{$form.inn_out`$num`.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">手配{$form.inn_tehai`$num`.html}</td>
  </tr>
  <tr>
    <td colspan=4></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku`$num`.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv`$num`.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >ご略歴入手</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.ryakureki`$num`.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	支払い予定日{$form.cs_shakinhi`$num`.html}
    </td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  </table>
