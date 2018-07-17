{include file="public/include/HtmlHeadSet_ja.tpl" htmlTitle="InfoInput"}
<br />

<form name="form1" method="post" action="?_mod=Info">
{$form.hidden}
<input type="hidden" name="semi_id" value="{$semi_id}">

<TABLE cellSpacing=0 cellPadding=6 width=780>
  <TR>
    <TD align=left width=780 colSpan=4 >アップロードファイル : {$fnum}</TD>
  </TR>
  <TR>
    <TD colSpan=3 width=70%><font size="2"><b>太字</b>はトップページ掲載項目です。</font></TD>
    <TD align="right" colspan=2 >最終更新日 {$form.last_date.value|date_format:"%Y/%m/%d"}</TD>
  </TR>
  <TR>
    <TD class=titleblock3 colspan=4>基本情報 (ID:{$smarty.session.semi_id} {$smarty.session.zachoNum}-{$smarty.session.enshaNum})</TD>
  </TR>
  <tr>
    <td class="titleblock2b" width="20%">学会名</td>
    <td width="80%" class="titleblock" colspan="3">{$form.gakkai.value}<div class="error">{$form.gakkai.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">品目</td>
    <td width="30%" class="titleblock">{$form.hinmoku.value}</td>
    <td width="20%" class="titleblock2">年度</td>
    <td width="30%" class="titleblock">{$form.nendo.value}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">セミナー名</td>
    <td width="30%" class="titleblock">{$form.seminar.value}<div class="error">{$form.seminar.error}</div></td>
    <td width="20%" class="titleblock2">領域</td>
    <td width="30%" class="titleblock">{$form.ryoiki.value}
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">セミナー開催日</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaisaibi.value}<font size="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">開催時間</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaisaiji.value}<font size="2"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">会期</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaiki.value}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">会場</td>
    <td width="80%" class="titleblock" colspan="3">{$form.place.value}</td>
  </tr>
  <!-- tr>
    <td class="titleblock2" width="20%">会場（部屋名）</td>
    <td width="80%" class="titleblock" colspan="3">{$form.room.value}</td>
  </tr -->
  <tr>
    <td class="titleblock2" width="20%">URL</td>
    <td width="80%" class="titleblock" colspan="3"><a href="{$form.yobi2.value}" target=_blank>{$form.yobi2.value}</a></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">テーマ</td>
    <td width="80%" class="titleblock" colspan="3">{$form.thema.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%"><a name="special">特記事項</td>
    <td width="80%" class="titleblock" colspan="3">{$form.tokki.html}</td>
  </tr>
  <tr>
    <td class="titleblock3" colspan=4 ></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">座長1</td>
    <td width="30%" class="titleblock_t">{$form.chair1.value}</td>
    <td width="50%" class="titleblock_t" colspan="2"><span class="letter10">{$form.cyaku1.value}</span></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">座長2</td>
    <td width="30%" class="titleblock_t">{$form.chair2.value}</td>
    <td width="50%" class="titleblock_t" colspan="2"><span class="letter10">{$form.cyaku2.value}</span></td>
  </tr>
{if $smarty.session.zachoNum > 2}
  <tr>
    <td width="20%" class="titleblock2">座長3</td>
    <td width="30%" class="titleblock_t">{$form.chair3.value}</td>
    <td width="50%" class="titleblock_t" colspan="2"><span class="letter10">{$form.cyaku3.value}</span></td>
  </tr>
{/if}
  <tr>
    <td width="20%" class="titleblock2" >演者1</td>
    <td width="30%" class="titleblock_t">氏名{$form.enshaname1.value}</td>
    <td width="50%" class="titleblock_t" colspan="2"><span class="letter10">{$form.enshayaku1.value}</span></td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">演題</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai1.value}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">演者2</td>
    <td width="30%" class="titleblock_t">{$form.enshaname2.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku2.value}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">演題2 </td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai2.value}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">演者3</td>
    <td width="30%" class="titleblock_t">{$form.enshaname3.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku3.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題3</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai3.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演者4</td>
    <td width="30%" class="titleblock_t">{$form.enshaname4.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku4.value}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">演題4</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai4.value}</td>
  </tr>
{if $smarty.session.enshaNum > 4}
  <tr>
    <td class="titleblock2" align="right" width="20%">演者5</td>
    <td width="30%" class="titleblock_t">{$form.enshaname5.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku5.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="20%">演題5</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai5.value}</td>
  </tr>
{/if}
{if $smarty.session.enshaNum > 5}
  <tr>
    <td class="titleblock2" width="20%">演者6</td>
    <td width="30%" class="titleblock_t">{$form.enshaname6.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku6.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題6</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai6.value}</td>
  </tr>
{/if}
{if $smarty.session.enshaNum > 6}
  <tr>
    <td class="titleblock2" width="20%">演者7</td>
    <td width="30%" class="titleblock_t">{$form.enshaname7.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku7.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題7</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai7.value}</td>
  </tr>
{/if}
{if $smarty.session.enshaNum > 7}
  <tr>
    <td class="titleblock2" width="20%">演者8</td>
    <td width="30%" class="titleblock_t">{$form.enshaname8.value}</td>
    <td width="50%" class="titleblock_t" colspan="2">{$form.enshayaku8.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題8</td>
    <td width="80%" class="titleblock" colspan="3">{$form.endai8.value}</td>
  </tr>
{/if}

  <tr>
    <td class="titleblock3" colspan=4 ></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">共催(コプロ社名)</td>
    <td class="titleblock" width="80%" colspan=3>
	{$form.syukan.value}&nbsp;&nbsp;{$form.syukan2.value}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" rowspan=2>製品担当</td>
    <td width="30%" class="titleblock" >{$form.sekinin.value}</td>
    <td class="titleblock2b" width="20%">組織化担当</td>
    <td width="30%" class="titleblock">{$form.sosiki.value}</td>
  </tr>
  <tr>
    <td width="30%" class="titleblock"></td>
    <td class="titleblock2b" width="20%">CL担当</td>
    <td width="30%" class="titleblock">{$form.cltantou.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">学会参加見込人数</td>
    <td width="30%" class="titleblock" >{$form.hotel.value}</td>
    <td class="titleblock2" width="20%" >学会会員数</td>
    <td width="30%" class="titleblock">{$form.yobi1.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">総セミナー数</td>
    <td width="30%" class="titleblock">{$form.yobi4.value}</td>
    <td class="titleblock2" width="20%">座席数</td>
    <td width="30%" class="titleblock">{$form.zaseki.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%" >録画録音</td>
    <td width="30%" class="titleblock" >{$form.syuroku.value}</td>
    <td class="titleblock2b" width="20%" >海外演者の有無</td>
    <td width="30%" class="titleblock" >{$form.kaigai.value}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" >アンケート</td>
    <td width="30%" class="titleblock" >{$form.anquete.value}</td>
    <td width="20%" class="titleblock"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
</table>
<div id="abstract">
<table cellSpacing="0" cellPadding="6" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">抄録情報</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">抄録有無</td>
    <td width="30%" class="titleblock">{$form.syoroku.html}</td>
    <td class="titleblock2" width="20%" class="titleblock">文字制限</td>
    <td width="30%" class="titleblock">{$form.moji_limit.html} 文字以内</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2b">進捗状況</td>
    <td width="30%" class="titleblock">{$form.sintyoku.value}</td>
    <td class="titleblock2" width="20%" class="titleblock"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題登録ページURL</td>
    <td width="80%" class="titleblock" colspan="3"><a href="{$form.endai_url.value}" target=_blank>{$form.endai_url.value}</a></td>
  </tr>
</table>
</div><!-- id="abstract" -->
<TABLE cellSpacing=0 cellPadding=6 width=780>
  <tr>
    <td class="titleblock3" colSpan="4" height="21">進捗情報</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">趣意書入手</td>
    <td width="30%" class="titleblock">{$form.yoko.html}</td>
    <td class="titleblock2b" width="20%" >セミナー申込日</td>
    <td width="30%" class="titleblock">{$form.mousi_add.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">役割者決定</td>
    <td width="30%" class="titleblock">{$form.yakubun1.html}</td>
    <td class="titleblock2" width="20%" >LS事前申込</td>
    <td width="30%" class="titleblock">{$form.ls_mousi.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">1stメール(API)</td>
    <td width="30%" class="titleblock">{$form.amail.html}</td>
    <td class="titleblock2b" width="20%" class="titleblock">MR宛てMail</td>
    <td width="30%" class="titleblock">{$form.annai2.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">チラシ作成依頼</td>
    <td width="30%" class="titleblock">{$form.tirasi1.html}</td>
    <td width="20%" class="titleblock2">チラシ経過・完成</td>
    <td width="30%" class="titleblock">{$form.tirasi2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">チラシ納品日</td>
    <td width="30%" class="titleblock">{$form.tirasi3.html}</td>
    <td class="titleblock2" width="20%" >アンケート作成</td>
    <td width="30%" class="titleblock" >{$form.make_enq.value}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">追加申込締切</td>
    <td width="30%" class="titleblock">{$form.mousi_c.value}</td>
    <td width="20%" class="titleblock2"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">控室名</td>
    <td width="30%" class="titleblock">{$form.hikae_k.value}</td>
    <td width="20%" class="titleblock2">控室案内</td>
    <td width="30%" class="titleblock">{$form.hikae_a.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">控室使用時間</td>
    <td width="80%" class="titleblock" colspan=3>{$form.hikae_t.value}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">資材発注</td>
    <td width="30%" class="titleblock">{$form.tojitu.value}</td>
    <td width="20%" class="titleblock2b">分担表送付</td>
    <td width="30%" class="titleblock">{$form.yakubun2.value}</td>
  </tr>
  <tr>
    <td colspan=4 class="titleblock3"></td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">進行状況</td>
    <td width="30%" class="titleblock">{$form.status.value}</td>
    <td class="titleblock2" width="20%">弁当数</td>
    <td width="30%" class="titleblock">{$form.bento.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">資材数</td>
    <td width="30%" class="titleblock">{$form.sizaisu.value}</td>
    <td class="titleblock2" width="20%">資材No</td>
    <td width="30%" class="titleblock">{$form.sizaino.value}</td>
  </tr>
</table>
<br>
<TABLE cellSpacing=0 cellPadding=6 width=780>
  <tr>
    <td class="titleblock3" colSpan="4" height="21">開催結果</td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">入場者数</td>
    <td width="30%" class="titleblock">{$form.nyujosha.value}</td>
    <td width="20%" class="titleblock2">アンケート回収者数</td>
    <td width="30%" class="titleblock">{$form.an_kaisyu.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">事後報告書</td>
    <td width="30%" class="titleblock">{$form.report.value}</td>
    <td class="titleblock2" width="20%"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
</table>

{if $smarty.session.auth_flg == "2"}
<br />
<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［次ページ］ボタンをクリックしてください。</FONT>
</div>

  <!--### BUTTON ###-->
<div class="form_button">
    <!-- input type="hidden" name="members_id" value="{$smarty.request.members_id|escape}" / -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="Edit" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}
</FORM><br>

{foreach name=outer from=$fileData item="item"}
   {assign var=jo value=`$smarty.foreach.outer.iteration`}
   <a ID="filelist{$jo}"></a>
   <TABLE cellSpacing=0 cellPadding=6 width=780 >
	{if $jo == 1}
	<TR><TD class=titleblock3 colSpan=3 height=21>ファイル</TD></TR>
	{/if}
	<tr>
		<td class=titleblock2 width="20%">ファイル名</td>
		<td width="60%" class=titleblock>
<a href="./bin/adm_down2012.php?fname={$item.sys_filename}" target=_blank>{$item.org_filename}</a></td>
		<td width="20%" class=titleblock >
	{if $smarty.session.auth_flg == $smarty.const._ADMIN2_AUTH_FLG_ && $item.remark == "伝票" }
			<form method="post" action="./admincl/cancel2012den.php" >
			<br><input type="hidden" name="reg_id" value={$item.reg_id}>
			<input type="hidden" name="semi_id" value={$item.semi_id}>
			<input type="submit" value="削除" style="font-size:12" >
			</form>
	{/if}
		</td>
	</tr>
	<tr>
		<td class=titleblock2 width="20%">コメント</td>
		<td width="80%" colspan=2 class=titleblock>{$item.remark}</td>
	</tr>
	<tr>
		<td class=titleblock2 width="20%">日時・サイズ</td>
		<td width="80%" class=titleblock colspan=2>{$item.reg_date} {$item.reg_time} ({$item.filesize|number_format}バイト)
		</td>
	</tr>
</table>
{foreachelse}
   <TABLE cellSpacing=1 cellPadding=2 width=780 >
	<tr>
		<td colspan="3" class="value"></td>
	</tr>
   </table>
{/foreach}
<p align="right"><a href="#top">Page Top</a></p>

{include file="public/include/HtmlFootSet_ja.tpl"}
