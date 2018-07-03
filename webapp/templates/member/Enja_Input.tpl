{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="EnjaInput"}
<br />

<form name="form1" method="post" action="?_mod=Enja">
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
  <!--/// BUTTON ///-->

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
    <TD colspan=4>&nbsp;演者1
	{if $smarty.session.enshaNum < 1}<span class="red">
現在、このタブにはデータを登録できません。基本情報画面で演者氏名・役職・演題名を登録してください。
	</span>
	{/if}
   </TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>演者1</td>
    <td width="25%" class="titleblock_t">{$form.cs_name1.value}
<input type="hidden" name="cs_name1" value="{$form.cs_name1.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職 {$form.cs_yaku1.value}
<input type="hidden" name="cs_yaku1" value="{$form.cs_yaku1.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana1.html}</td>
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
    <td width="25%" class="titleblock_t" >動画&nbsp;{$form.douga1.html}<br />音声&nbsp;{$form.onsei1.html}
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
    <td width="50%" class="titleblock_t" colspan="2">ホテル{$form.inn_hotel1.html}</td>
    <td width="25%" class="titleblock_t" >手配先{$form.tehaisaki1.html}</td>
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


{* if $smarty.session.enshaNum > 1 *}
            <div id="fragment-2">
	{include file="member/Enja2.tpl" num="2"}
            </div>
{* /if *}
{* if $smarty.session.enshaNum > 2 *}
            <div id="fragment-3">
	{include file="member/Enja3.tpl" num="3"}
            </div>
{* /if *}
{* if $smarty.session.enshaNum > 3 *}
            <div id="fragment-4">
	{include file="member/Enja4.tpl" num="4"}
            </div>
{* /if *}
{if $smarty.session.enshaNum > 4}
            <div id="fragment-5">
	{include file="member/Enja5.tpl" num="5"}
            </div>
{/if}
{if $smarty.session.enshaNum > 5}
            <div id="fragment-6">
	{include file="member/Enja6.tpl" num="6"}
            </div>
{/if}
{if $smarty.session.enshaNum > 6}
            <div id="fragment-7">
	{include file="member/Enja7.tpl" num="7"}
            </div>
{/if}
{if $smarty.session.enshaNum > 7}
            <div id="fragment-8">
	{include file="member/Enja8.tpl" num="8"}
            </div>
{/if}

        </div><!-- div id="container-1" -->


{if $locktoken != "unlock"}
<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［次ページ］ボタンをクリックしてください。</FONT>
</div>

  <!--### BUTTON ###-->
<div class="form_button">
    <!-- input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" / -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}

</FORM><br />

{include file="member/include/HtmlFootSet_ja.tpl"}


