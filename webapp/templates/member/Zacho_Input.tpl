{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="ZachoInput"}
<br />
<form name="form1" method="post" action="?_mod=Zacho">
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

<input type="hidden" name="semi_id" value="{$semi_id}">

        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>座長1</span></a></li>
                <li><a href="#fragment-2"><span>座長2</span></a></li>
{if $smarty.session.zachoNum > 2}
                <li><a href="#fragment-3"><span>座長3</span></a></li>
{/if}
            </ul>

            <div id="fragment-1">
<table width="680" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;座長1{* ($cs_id1) *}
	{if $smarty.session.zachoNum < 1}<span class="red">
現在、このタブにはデータを登録できません。基本情報画面で座長氏名・役職を登録してください。
	</span>
	{/if}
    </TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>座長1</td>
    <td width="25%" class="titleblock_t">氏名&nbsp;{$form.cs_name1.value}<input type=hidden name=cs_name1 value="{$form.cs_name1.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職&nbsp;{$form.cs_yaku1.value}<input type=hidden name=cs_yaku1 value="{$form.cs_yaku1.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="50%" class="titleblock_t" colspan="2">営業所{$form.mr_eigyo1.html}</td>
    <td width="25%" class="titleblock_t">氏名{$form.mr_name1.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;
{$form.mr_setsugu1.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel1.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai1.html}<br />{$form.iki1.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri1.html}<br />{$form.kaeri1.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="50%" class="titleblock_t" colspan="2">ホテル
{$form.inn_hotel1.html}</td>
    <td width="25%" class="titleblock_t">手配先{$form.tehaisaki1.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in1.html} → Out&nbsp;{$form.inn_out1.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3" valign=top>手配
	{$form.inn_tehai1.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku1.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t" >
	お振込み予定日{$form.cs_shakinhi1.html}
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
<table width="680" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;座長2 {* ($cs_id2) *}
	{if $smarty.session.zachoNum < 2}<span class="red">
現在、このタブにはデータを登録できません。基本情報画面で座長氏名・役職を登録してください。
	</span>
	{/if}

    </TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>座長2</td>
    <td width="25%" class="titleblock_t">氏名&nbsp;{$form.cs_name2.value}<input type=hidden name=cs_name2 value="{$form.cs_name2.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職&nbsp;{$form.cs_yaku2.value}<input type=hidden name=cs_yaku2 value="{$form.cs_yaku2.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="50%" class="titleblock_t" colspan="2">営業所{$form.mr_eigyo2.html}</td>
    <td width="25%" class="titleblock_t">氏名{$form.mr_name2.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;
{$form.mr_setsugu2.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel2.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai2.html}<br />{$form.iki2.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri2.html}<br />{$form.kaeri2.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="50%" class="titleblock_t" colspan="2">ホテル
{$form.inn_hotel2.html}</td>
    <td width="25%" class="titleblock_t">手配先{$form.tehaisaki2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in2.html} → Out&nbsp;{$form.inn_out2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3" valign=top>手配
	{$form.inn_tehai2.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku2.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	お振込み予定日{$form.cs_shakinhi2.html}
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
            </div><!-- "fragment-2" -->

{if $smarty.session.zachoNum > 2}
            <div id="fragment-3">
<table width="680" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape}</TD>
  </TR>
  <TR>
    <TD colspan=4>&nbsp;座長3 {* ($cs_id3) *}</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>座長3</td>
    <td width="25%" class="titleblock_t">氏名&nbsp;{$form.cs_name3.value}<input type=hidden name=cs_name3 value="{$form.cs_name3.value}"></td>
    <td width="50%" class="titleblock_t" colspan="2">役職&nbsp;{$form.cs_yaku3.value}<input type=hidden name=cs_yaku3 value="{$form.cs_yaku3.value}"></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">かな{$form.cs_kana3.html}</td>
    <td width="50%" class="titleblock_t" colspan="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%" rowspan=3>ＭＲ</td>
    <td width="50%" class="titleblock_t" colspan="2">営業所{$form.mr_eigyo3.html}</td>
    <td width="25%" class="titleblock_t">氏名{$form.mr_name3.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">携　帯{$form.mr_keitai3.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">現場接遇&nbsp;&nbsp;
{$form.mr_setsugu3.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock_t">TEL{$form.mr_tel3.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">FAX{$form.mr_fax3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=2>交通手配</td>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.ourai3.html}<br />{$form.iki3.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
{$form.fukuri3.html}<br />{$form.kaeri3.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=3>宿泊</td>
    <td width="50%" class="titleblock_t" colspan="2">ホテル
{$form.inn_hotel3.html}</td>
    <td width="25%" class="titleblock_t">手配先{$form.tehaisaki3.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3">
	&nbsp;In&nbsp;{$form.inn_in3.html} → Out&nbsp;{$form.inn_out3.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock_t" colspan="3" valign=top>手配
	{$form.inn_tehai3.html}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >応諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_shodaku3.html}</td>
    <td class="titleblock2" width="25%" >開示承諾書受領日</td>
    <td width="25%" class="titleblock_t">{$form.cs_cv3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >謝金</td>
    <td width="25%" class="titleblock_t">
	お振込み予定日{$form.cs_shakinhi3.html}
    </td>
    <td width="50%" class="titleblock_t" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >備考</td>
    <td width="75%" class="titleblock_t" colspan="3">
	{$form.cs_biko3.html}
    </td>
  </tr>
  </table>
            </div><!-- "fragment-3" -->
{/if}{* if $smarty.session.zachoNum > 2 *}

        </div>

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
<br /><br />
{include file="member/include/HtmlFootSet_ja.tpl"}
