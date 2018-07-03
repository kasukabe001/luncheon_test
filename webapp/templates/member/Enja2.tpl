<table width=680 cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;演者{$num}
	{if $smarty.session.enshaNum < 2 && $mode != 'apipm'}<span class="red">
現在、このタブにはデータを登録できません。基本情報画面で演者氏名・役職・演題名を登録してください。
	</span>
	{/if}
    </TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>演者{$num}</td>
    <td width="25%" class="titleblock_t">{$form.cs_name2.value}<input type="hidden" name="cs_name2" value="{$form.cs_name2.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職 {$form.cs_yaku2.value}<input type="hidden" name="cs_yaku2" value="{$form.cs_yaku2.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cs_endai2.value}<input type="hidden" name="cs_endai2" value="{$form.cs_endai2.value}"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>ＰＣ</td>
    <td width="25%" class="titleblock_t" >OS{$form.os2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t" >Soft{$form.soft2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">Version{$form.version2.html}</td>
  </tr>
  <tr>
    <td width="50%" class="titleblock_t" colspan="2">持込み形態{$form.mochikomi2.html}</td>
    <td width="25%" class="titleblock_t" >動画&nbsp;{$form.douga2.html}<br />音声&nbsp;{$form.onsei2.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="25%" class="titleblock_t">営業所{$form.mr_eigyo2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">氏名{$form.mr_name2.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;{$form.mr_setsugu2.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai2.html}<br />{$form.iki2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri2.html}<br />{$form.kaeri2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="50%" class="titleblock_t" colspan="2">ホテル{$form.inn_hotel2.html}</td>
    <td width="25%" class="titleblock_t" >手配先{$form.tehaisaki2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in2.html} → Out&nbsp;{$form.inn_out2.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">手配{$form.inn_tehai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku2.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >ご略歴入手</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.ryakureki2.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	支払い予定日{$form.cs_shakinhi2.html}
    </td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >備考</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.cs_biko2.html}
    </td>
  </tr>
  </table>
