{include file="public/include/HtmlHeadSet_ja.tpl" htmlTitle="InfoConfirm"}
<br />

<div class="confirm_title">- 確認 -</div>
<form name="form1" method="post" action="?_mod={$bpshe}">

{$form.hidden}

<!--
<TABLE cellSpacing=1 cellPadding=2 width=780 border=0>
  <TR>
    <TD class=titleblock3 height=21 colspan=3>基本情報 (ID:{$smarty.session.semi_id})</TD>
    <TD class=titleblock3 height=21 >最終更新日 {$smarty.session.last_date}</TD>
  </TR>
  <tr>
    <td class="titleblock2b" width="25%">学会名 <font size="2" color="#FF0000">*</font></td>            <td width="75%" class="titleblock" colspan="3">{$gakkai}{$form.gakkai.html}{$egakkai}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">品目</td>                       
    <td width="25%" class="titleblock">{$hinmoku}{$form.hinmoku.html}{$ehinmoku}</td>
    <td width="25%" class="titleblock2">年度</td>
    <td width="25%" class="titleblock">{$nendo}{$form.nendo.html}{$enendo}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">セミナー名 <font size="2" color="#FF0000">*</font></td>                                                               
    <td width="25%" class="titleblock">{$seminar}{$form.seminar.html}{$eseminar}</td>
    <td width="25%" class="titleblock2">領域</td>
    <td width="25%" class="titleblock">{$ryoiki}{$form.ryoiki.html}{$eryoiki}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">セミナー開催日</td>
    <td width="75%" class="titleblock" colspan="3">{$kaisaibi}{$form.kaisaibi.html}{$ekaisaibi}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">開催時間</td>
    <td width="75%" class="titleblock" colspan="3">{$kaisaiji}{$form.kaisaiji.html}{$ekaisaiji}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">会期</td>
    <td width="75%" class="titleblock" colspan="3">{$kaiki}{$form.kaiki.html}{$ekaiki}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">会場</td>
    <td width="75%" class="titleblock" colspan="3">{$place}{$form.place.html}{$eplace}</td>
  </tr>

  <tr>
    <td class="titleblock2" width="25%">URL</td>
    <td width="75%" class="titleblock" colspan="3">{$yobi2}{$form.yobi2.html}{$eyobi2}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">テーマ</td>
    <td width="75%" class="titleblock" colspan="3">{$thema}{$form.thema.html}{$ethema}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">座長1</td>
    <td width="25%" class="titleblock_t">{$chair1}{$form.chair1.html}{$echair1}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$cyaku1}{$form.cyaku1.html}{$ecyaku1}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">座長2</td>
    <td width="25%" class="titleblock_t">{$chair2}{$form.chair2.html}{$echair2}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$cyaku2}{$form.cyaku2.html}{$ecyaku2}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">座長3</td>
    <td width="25%" class="titleblock_t">{$chair3}{$form.chair3.html}{$echair3}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$cyaku3}{$form.cyaku3.html}{$ecyaku3}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >演者1</td>
    <td width="25%" class="titleblock_t">{$enshaname1}{$form.enshaname1.html}{$eenshaname1}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$enshayaku1}{$form.enshayaku1.html}{$eenshayaku1}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題1</td>
    <td width="75%" class="titleblock" colspan="3">{$endai1}{$form.endai1.html}{$eendai1}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演者2</td>
    <td width="25%" class="titleblock_t">{$enshaname2}{$form.enshaname2.html}{$eenshaname2}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$enshayaku2}{$form.enshayaku2.html}{$eenshayaku2}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題2</td>
    <td width="75%" class="titleblock" colspan="3">{$endai2}{$form.endai2.html}{$eendai2}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演者3</td>
    <td width="25%" class="titleblock_t">{$enshaname3}{$form.enshaname3.html}{$eenshaname3}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$enshayaku3}{$form.enshayaku3.html}{$eenshayaku3}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題3</td>
    <td width="75%" class="titleblock" colspan="3">{$endai3}{$form.endai3.html}{$eendai3}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演者4</td>
    <td width="25%" class="titleblock_t">{$enshaname4}{$form.enshaname4.html}{$eenshaname4}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$enshayaku4}{$form.enshayaku4.html}{$eenshayaku4}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題4</td>
    <td width="75%" class="titleblock" colspan="3">{$endai4}{$form.endai4.html}{$eendai4}</td>
  </tr>

{if $smarty.session.enshaNum > 4}
  <tr>
    <td class="titleblock2" align="right" width="25%">演者5</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname5.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.enshayaku5.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題5</td>
    <td width="75%" class="titleblock" colspan="3">{$endai5}{$form.endai5.html}{$eendai5}</td>
  </tr>
{/if}
{if $smarty.session.enshaNum > 5}
  <tr>
    <td class="titleblock2" align="right" width="25%">演者6</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname6.html}</td>
    <td width="50%" class="titleblock_t" colspan="2">役職{$form.enshayaku6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">演題6</td>
    <td width="75%" class="titleblock" colspan="3">{$endai6}{$form.endai6.html}{$eendai6}</td>
  </tr>
{/if}


  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">共催(コプロ社名)</td>
    <td width="25%" class="titleblock" width="75%" colspan=3>
	{$syukan}{$form.syukan.html}{$esyukan}&nbsp;&nbsp;&nbsp;{$syukan2}{$form.syukan2.html}{$esyukan2}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">薬剤責任者</td>
    <td width="25%" class="titleblock" >氏名 {$sekinin}{$form.sekinin.html}{$esekinin}</td>
    <td class="titleblock2" width="25%">CL窓口</td>
    <td width="25%" class="titleblock">氏名 {$cltantou}{$form.cltantou.html}{$ecltantou}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">学会参加見込み人数</td>
    <td width="25%" class="titleblock" >{$hotel}{$form.hotel.html}{$ehotel}</td>
    <td class="titleblock2" width="25%" >学会会員数</td>
    <td width="25%" class="titleblock">{$yobi1}{$form.yobi1.html}{$eyobi1}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">総セミナー数</td>
    <td width="25%" class="titleblock">{$yobi4}{$form.yobi4.html}{$eyobi4}</td>
    <td class="titleblock2" width="25%">座席数</td>
    <td width="25%" class="titleblock">{$zaseki}{$form.zaseki.html}{$ezaseki}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >アンケート</td>
    <td width="25%" class="titleblock" >{$anquete}{$form.anquete.html}{$eanquete}</td>
    <td class="titleblock2" width="25%" >収録</td>
    <td width="25%" class="titleblock" >{$syuroku}{$form.syuroku.html}{$esyuroku}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">メモ1</td>
    <td width="75%" class="titleblock" colspan="3">{$cl1}{$form.cl1.html}{$ecl1}</td>
  </tr>
</table>
-->
<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">進捗情報</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">案内メール(API)</td>
    <td width="25%" class="titleblock">{$amail}{$form.amail.html}{$eamail}</td>
    <td class="titleblock2" width="25%" class="titleblock"><!-- 案内メール(CL) --></td>
    <td width="25%" class="titleblock">{* $annai2}{$form.annai2.html}{$eannai2 *}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">チラシ作成依頼</td>
    <td width="25%" class="titleblock">{$tirasi1}{$form.tirasi1.html}{$etirasi1}</td>
    <td width="25%" class="titleblock2b">チラシ経過・完成</td>
    <td width="25%" class="titleblock">{$tirasi2}{$form.tirasi2.html}{$etirasi2}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">チラシ納品日</td>
    <td width="25%" class="titleblock">{$tirasi3}{$form.tirasi3.html}{$etirasi}</td>
    <td width="25%" class="titleblock"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
<!--
  <tr>
    <td width="25%" class="titleblock2">追加申込締切</td>
    <td width="25%" class="titleblock">{$mousi_c}{$form.mousi_c.html}{$emousi_c}</td>
    <td width="25%" class="titleblock2b">抄録締切</td>
    <td width="25%" class="titleblock">{$syoroku}{$form.syoroku.html}{$esyoroku}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">控室名</td>
    <td width="25%" class="titleblock">{$hikae_k}{$form.hikae_k.html}{$ehikae_k}</td>
    <td width="25%" class="titleblock2b">控室案内</td>
    <td width="25%" class="titleblock">{$hikae_a}{$form.hikae_a.html}{$ehikae_a}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">控室使用時間</td>
    <td width="75%" class="titleblock" colspan=3>{$hikae_t}{$form.hikae_t.html}{$ehikae_t}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">当日配布物手配</td>
    <td width="25%" class="titleblock">{$tojitu}{$form.tojitu.html}{$etojitu}</td>
    <td width="25%" class="titleblock2b">分担表最終版送付</td>
    <td width="25%" class="titleblock">{$yakubun2}{$form.yakubun2.html}{$eyakubun2}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock2">進行状況</td>
    <td width="25%" class="titleblock">{$status}{$form.status.html}{$estatus}</td>
    <td class="titleblock2" width="25%">弁当数</td>
    <td width="25%" class="titleblock">{$bento}{$form.bento.html}{$ebento}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">資材数</td>
    <td width="25%" class="titleblock">{$sizaisu}{$form.sizaisu.html}{$esizaisu}</td>
    <td class="titleblock2" width="25%">資材No</td>
    <td width="25%" class="titleblock">{$sizaino}{$form.sizaino.html}{$esizaino}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">&nbsp;メモ2</td>
    <td width="75%" class="titleblock" colspan="3">{$cl2}{$form.cl2.html}{$ecl2}</td>
  </tr -->
</table>
<br>
<!-- 
<table cellSpacing="1" cellPadding="2" width="680" border="0">
  <tr>
    <td class="titleblock3" width="680" colSpan="4" height="21">開催結果</td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">入場者数</td>
    <td width="25%" class="titleblock">{$nyujosha}{$form.nyujosha.html}{$enyujosha}</td>
    <td width="25%" class="titleblock2">アンケート回収者数</td>
    <td width="25%" class="titleblock">{$an_kaisyu}{$form.an_kaisyu.html}{$ean_kaisyu}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">事後報告書</td>
    <td width="25%" class="titleblock">{$report}{$form.report.html}{$ereport}</td>
    <td class="titleblock2" width="25%"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">メモ3</td>
    <td width="75%" class="titleblock" colspan="3">{$cl3}{$form.cl3.html}{$ecl3}</td>
  </tr>
</table>
-->
<div align="center">
<FONT color=#ff0000 size=2>入力内容をご確認の上、［変更］ボタンをクリックしてください。</FONT>
</div>
<br />
  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" />
    <input type="hidden" name="token" value="{$smarty.post.token|default:$token|escape}" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="hidden" name="_act" value="" />

    {if $smarty.request._type == 'Add' || $smarty.request._type == ''}
	<input type="button" name="btn1" value="&laquo;&nbsp;戻る" onclick="reqAction('Input')" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="btn2" value="登録&nbsp;&raquo;" onclick="reqAction('Insert')" />
    {elseif $smarty.request._type == 'Edit'}
	<input type="button" name="btn2" value=" 変更 " onclick="reqAction('Update')" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="btn1" value=" 戻る " onclick="reqAction('Input')" />
    {/if}

</div>
  <!--/// BUTTON ///-->
</form>

{include file='public/include/HtmlFootSet.tpl'}