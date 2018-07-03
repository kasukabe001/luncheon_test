{include file="public/include/HtmlHeadSet_ja.tpl" htmlTitle="EnjaInput"}
<br />

<form name="form1" method="post" action="?_mod=Enja">
{$form.hidden}

        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>演者1</span></a></li>
                <li><a href="#fragment-2"><span>演者2</span></a></li>
                <li><a href="#fragment-3"><span>演者3</span></a></li>
                <li><a href="#fragment-4"><span>演者4</span></a></li>
	{if $smarty.session.enshaNum > 4}
                <li><a href="#fragment-5"><span>演者5</span></a></li>
	{/if}
	{if $smarty.session.enshaNum > 5}
                <li><a href="#fragment-6"><span>演者6</span></a></li>
	{/if}
	{if $smarty.session.enshaNum > 6}
                <li><a href="#fragment-7"><span>演者7</span></a></li>
	{/if}
	{if $smarty.session.enshaNum > 7}
                <li><a href="#fragment-8"><span>演者8</span></a></li>
	{/if}
            </ul>

            <div id="fragment-1">
<table width=680 cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;演者1</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>演者1</td>
    <td width="25%" class="titleblock_t">{$form.cs_name1.value}
<input type="hidden" name="cs_name1" value="{$form.cs_name1.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職 {$form.cs_yaku1.value}
<input type="hidden" name="cs_yaku1" value="{$form.cs_yaku1.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな {$form.cs_kana1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cs_endai1.value}
<input type="hidden" name="cs_endai1" value="{$form.cs_endai1.value}"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>ＰＣ</td>
    <td width="25%" class="titleblock_t" >OS{$form.os1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t" >Soft{$form.soft1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">Version{$form.version1.html}</td>
  </tr>
  <tr>
    <td width="50%" class="titleblock_t" colspan="2">持込み形態{$form.mochikomi1.html}</td>
    <td width="50%" class="titleblock_t" >動画&nbsp;{$form.douga1.html}<br />音声&nbsp;{$form.onsei1.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="25%" class="titleblock_t">営業所{$form.mr_eigyo1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">氏名{$form.mr_name1.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;{$form.mr_setsugu1.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai1.html}<br />{$form.iki1.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri1.html}<br />{$form.kaeri1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="75%" class="titleblock_t" colspan="2">ホテル{$form.inn_hotel1.html}</td>
    <td width="25%" class="titleblock_t" colspan="2">手配先{$form.tehaisaki1.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in1.html} → Out&nbsp;{$form.inn_out1.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">手配{$form.inn_tehai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku1.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >ご略歴入手</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.ryakureki1.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	支払い予定日{$form.cs_shakinhi1.html}
    </td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >備考</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.cs_biko1.html}
    </td>
  </tr>
  </table>
            </div><!-- id="fragment-1" -->


            <div id="fragment-2">
	{include file="member/Enja2.tpl" num="2" mode="apipm"}
            </div>

            <div id="fragment-3">
	{include file="member/Enja3.tpl" num="3" mode="apipm"}
            </div>

            <div id="fragment-4">
	{include file="member/Enja4.tpl" num="4" mode="apipm"}
            </div>

{if $smarty.session.enshaNum > 4}
            <div id="fragment-5">
	{include file="member/Enja5.tpl" num="5" mode="apipm"}
            </div>
{/if}
{if $smarty.session.enshaNum > 5}
            <div id="fragment-6">
	{include file="member/Enja6.tpl" num="6" mode="apipm"}
            </div>
{/if}
{if $smarty.session.enshaNum > 6}
            <div id="fragment-7">
	{include file="member/Enja7.tpl" num="7" mode="apipm"}
            </div>
{/if}
{if $smarty.session.enshaNum > 7}
            <div id="fragment-8">
	{include file="member/Enja8.tpl" num="8" mode="apipm"}
            </div>
{/if}

        </div><!-- div id="container-1" -->


</FORM><br />

{include file="public/include/HtmlFootSet_ja.tpl"}


