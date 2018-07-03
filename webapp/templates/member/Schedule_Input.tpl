{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="ScheduleInput"}
<br />

<form name="form1" method="post" action="?_mod=Schedule">
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
<table width="680" cellspacing="1" cellpadding="3">
  <!--/// BUTTON ///-->
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" >スケジュール</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.schedule.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >同会場講演情報</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.kouenkai.html}</td>
  </tr>
{if $locktoken == "unlock"}
  <tr>
    <td class="titleblock2" width="25%" >コレポン</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.corepon.html}
</td>
  </tr>
{/if}
</table>
<br />

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

</FORM>

{include file="member/include/HtmlFootSet_ja.tpl"}
