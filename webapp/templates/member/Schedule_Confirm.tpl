<!-- input type="hidden" name="semi_id" value="{$semi_id}" -->
{$form.hidden}

<table width="680" cellspacing="1" cellpadding="3">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" >スケジュール</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$schedule}{$form.schedule.html}{$eschedule}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >同会場講演情報</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$kouenkai}{$form.kouenkai.html}{$ekouenkai}</td>
  </tr>
  <!-- tr>
    <td class="titleblock2" width="25%" >コレポン</td>
    <td width="75%" class="titleblock_t" colspan="3">
{* $corepon}{$form.corepon.html}{$ecorepon *}</td>
  </tr -->
</table>
<br />
<br />

