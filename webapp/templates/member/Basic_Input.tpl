{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="BasicInput"}
<br />

<form name="form1" method="post" action="?_mod=Basic">
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

<TABLE cellSpacing=0 cellPadding=6 width=780 >
  <TR>
    <TD align=right colspan=4 >アップロードファイル : {$fnum}</TD>
  </TR>
  <TR>
    <TD colSpan=3 width=70%><font size="2"><span class="red">注意）* 印の項目は必ず入力してください。 </span> <b>太字</b>はトップページ掲載項目です。<br>
 メモ1,メモ2,メモ3はリンケージ社内でしか閲覧できません。 </font></TD>
    <TD width=30% align="right">最終更新日 {$last_date|truncate:12:" "}{$smarty.request.last_date|truncate:12:" "}</TD>
  </TR>
  <TR>
    <TD class=titleblock3 colspan=4>基本情報 (ID:{$smarty.session.semi_id} {$smarty.session.zachoNum}-{$smarty.session.enshaNum})</TD>
  </TR>
  <tr>
    <td class="titleblock2b" width="20%">学会名 <font size="2" color="#FF0000">*</font></td>
    <td width="80%" class="titleblock" colspan="3">{$form.gakkai.html}<div class="error">{$form.gakkai.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">品目</td>
    <td width="30%" class="titleblock">{$form.hinmoku.html}</td>
    <td width="20%" class="titleblock2">年度</td>
    <td width="30%" class="titleblock">{$form.nendo.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" nowrap>セミナー名 <font size="2" color="#FF0000">*</font></td>
    <td width="30%" class="titleblock">{$form.seminar.html}<div class="error">{$form.seminar.error}</div></td>
    <td width="20%" class="titleblock2">領域</td>
    <td width="30%" class="titleblock">{$form.ryoiki.html}
	{if $locktoken != "unlock"}
      <input type="button" onclick="doDialog();" value="一覧" style="background:#5C4C77;color:#FF9600;" >
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" nowrap>セミナー開催日</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaisaibi.html}<font size="2"> 例）08/03/14(金)</font>
	{if $locktoken != "unlock"}
    <input type=button value="C" name="B0" onclick="wrtCalendar(event,this.form.kaisaibi,'yy/mm/dd(a)');">
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">開催時間</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaisaiji.html}<font size="2"> 例）16:00-18:00</font></td>                                                               
  </tr>
  <tr>
    <td class="titleblock2" width="20%">会期</td>
    <td width="80%" class="titleblock" colspan="3">{$form.kaiki.html}<font size="2"> 例）2012/3/14-15</font></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">会場</td>
    <td width="80%" class="titleblock" colspan="3">{$form.place.html}</td>
  </tr>
  <!-- tr>
    <td class="titleblock2" width="20%">会場（部屋）</td>
    <td width="80%" class="titleblock" colspan="3">{$form.room.html}</td>
  </tr -->
  <tr>
    <td class="titleblock2" width="20%">URL</td>
    <td width="80%" class="titleblock" colspan="3">{$form.yobi2.html}
      <font size="2">例）http://www.gakkai.jp</font></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">テーマ</td>
    <td width="80%" class="titleblock" colspan="3">{$form.thema.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">特記事項</td>
    <td width="80%" class="titleblock" colspan="3">{$form.tokkijiko.html}</td>
  </tr>
</table>

<table cellSpacing=0 cellPadding=6 width=780 >
  <TR>
    <TD class="titleblock3" colspan=4 ></TD>
  </TR>
  <tr>
    <td class="titleblock2" width="15%">座長1</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.chair1.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.cyaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">座長2</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.chair2.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.cyaku2.html}</td>
  </tr>
</table>

<span class="accordion_head">&emsp;<input type="button" name="e1" value="追加"></span>
<div> 
<table cellSpacing=0 cellPadding=6 width=780>
  <tr>
    <td class="titleblock2" width="15%">座長3</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair3.html}
    <div class="error">{$form.chair3.error}</div></td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.cyaku3.html}
    <div class="error">{$form.cyaku3.error}</div></td>
  </tr>
</table>
</div> 

<table cellSpacing=0 cellPadding=6 width=780 >
  <TR>
    <TD class="titleblock3" colspan=4 ></TD>
  </TR>
  <tr>
    <td class="titleblock2" width="15%" >演者1</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname1.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題1</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者2</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname2.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題2</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者3</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname3.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題3</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者4</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname4.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題4</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai4.html}</td>
  </tr>
</table>
<span class="accordion_head2">&emsp;<input type="button" name="e2" value="追加"></span>
<div> 
<table cellSpacing=0 cellPadding=6 width=780>
  <tr>
    <td class="titleblock2" width="15%">演者5</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname5.html}
    <div class="error">{$form.enshaname5.error}</div></td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku5.html}
    <div class="error">{$form.enshayaku5.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題5</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai5.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者6</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname6.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題6</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者7</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname7.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題7</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演者8</td>
    <td width="25%" class="titleblock_t"><div class="letter9">氏名</div> {$form.enshaname8.html}</td>
    <td width="60%" class="titleblock_t" colspan="2"><span class="letter9">役職</span> {$form.enshayaku8.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="15%">演題8</td>
    <td width="85%" class="titleblock" colspan="3">{$form.endai8.html}</td>
  </tr>
</table>
</div> 

<table cellSpacing=0 cellPadding=6 width=780>
  <tr>
    <td class="titleblock3" colspan=4 ></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">共催(コプロ社名)</td>
    <td class="titleblock" width="80%" colspan=3>
	{$form.syukan.html}&nbsp;&nbsp;{$form.syukan2.html}
<div class="error">{$form.syukan.error}</div>
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">製品担当</td>
    <td width="30%" class="titleblock" ><span class="letter9">氏名</span> {$form.sekinin.html}</td>
    <td width="50%" class="titleblock" colspan=2>{$form.sekinin_menu.html} <span class="letter9">（メニューから選択できます。）</span></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">組織化担当</td>
    <td width="30%" class="titleblock"><span class="letter9">氏名</span> {$form.soshiki.html}</td>
    <td width="50%" class="titleblock" colspan=2>{$form.soshiki_menu.html}<span class="letter9">（メニューから選択できます。）</span></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">CL担当</td>
    <td width="30%" class="titleblock"><span class="letter9">氏名</span> {$form.cltantou.html}</td>
    <td width="50%" class="titleblock" colspan=2>{$form.cltantou_menu.html}<span class="letter9">（メニューから選択できます。）</span></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">学会参加見込み人数</td>
    <td width="30%" class="titleblock" >{$form.hotel.html}</td>
    <td class="titleblock2" width="20%" >学会会員数</td>
    <td width="30%" class="titleblock">{$form.yobi1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">総セミナー数</td>
    <td width="30%" class="titleblock">{$form.yobi4.html}</td>
    <td class="titleblock2" width="20%">座席数</td>
    <td width="30%" class="titleblock">{$form.zaseki.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%" >録画録音</td>
    <td width="30%" class="titleblock" >{$form.syuroku.html}</td>
    <td class="titleblock2b" width="20%" >海外演者</td>
    <td width="30%" class="titleblock" >{$form.kaigai.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" >アンケート</td>
    <td width="30%" class="titleblock" >{$form.anquete.html}</td>
    <td class="titleblock2b" width="20%" ></td>
    <td width="30%" class="titleblock" ></td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="20%">メモ1</td>
    <td width="80%" class="titleblock" colspan="3">{$form.cl1.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="0" cellPadding="6" width="780">
  <tr>
    <td class="titleblock3" colspan="4" >抄録情報</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">抄録有無</td>
    <td width="30%" class="titleblock">{$form.syoroku_umu.html}</td>
    <td class="titleblock2" width="20%" class="titleblock">文字制限</td>
    <td width="30%" class="titleblock">{$form.syoroku_seigen.html} <span class="letter9">文字以内</span></td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2b">抄録進捗</td>
    <td width="30%" class="titleblock">{$form.syoroku.html}</td>
    <td width="50%" class="titleblock" colspan=2>{$form.syoroku_status.html}<span class="letter9">（メニューから選択できます。）</span></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">演題登録ページURL</td>
    <td width="80%" class="titleblock" colspan="3">{$form.syoroku_url.html} <font size="2">例）http://www.endai.jp</font></td>
  </tr>
</table>

<br>
<table cellSpacing="0" cellPadding="6" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" >進捗情報</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">趣意書入手</td>
    <td width="30%" class="titleblock">{$form.yoko.html}</td>
    <td class="titleblock2b" width="20%" >セミナー申込日</td>
    <td width="30%" class="titleblock">{$form.seminar_mousi.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%" >LS事前申込</td>
    <td width="30%" class="titleblock">{$form.mousi_k.html}</td>
    <td width="20%" class="titleblock"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">役割者決定予定日</td>
    <td width="30%" class="titleblock">{$form.yakuketsu_yotei.html}</td>
    <td class="titleblock2b" width="20%">役割者決定</td>
    <td width="30%" class="titleblock">{$form.yakuketsu.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">1stメール(API)予定日</td>
    <td width="30%" class="titleblock">{$form.amail_yotei.html}</td>
    <td class="titleblock2" width="20%" class="titleblock">1stメール(API)</td>
    <td width="30%" class="titleblock">{$form.amail.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="20%">MR宛メール予定日</td>
    <td width="30%" class="titleblock">{$form.annai2_yotei.html}</td>
    <td class="titleblock2b" width="20%" class="titleblock">MR宛メール</td>
    <td width="30%" class="titleblock">{$form.annai2.html}</td>
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
    <td width="20%" class="titleblock2">追加申込締切</td>
    <td width="30%" class="titleblock">{$form.mousi_c.html}</td>
  </tr>
  <tr>
    <!-- td class="titleblock2" width="25%">追加申込</td>
    <td width="25%" class="titleblock"><input type="text" name="mousi_add" size="20" style="IME-MODE: inactive" maxlength=36></td -->
    <td class="titleblock2b" width="20%">アンケート作成予定日</td>
    <td width="30%" class="titleblock">{$form.anquete_yotei.html}</td>
    <td width="20%" class="titleblock2b">アンケート作成依頼</td>
    <td width="30%" class="titleblock">{$form.anquete_make.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">控室名</td>
    <td width="30%" class="titleblock">{$form.hikae_k.html}</td>
    <td class="titleblock2" width="20%">控室使用時間</td>
    <td width="30%" class="titleblock">{$form.hikae_t.html}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2b">控室案内予定日</td>
    <td width="30%" class="titleblock">{$form.hikae_a_yotei.html}</td>
    <td width="20%" class="titleblock2b">控室案内</td>
    <td width="30%" class="titleblock">{$form.hikae_a.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">当日配布物手配</td>
    <td width="30%" class="titleblock">{$tojitu}{$form.tojitu.html}{$etojitu}</td>
    <td class="titleblock2b" width="20%">資材発注</td>
    <td width="30%" class="titleblock">{$form.sizai_order.html}</td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2b">分担表送付</td>
    <td width="30%" class="titleblock">{$form.yakubun2.html}</td>
    <td width="20%" class="titleblock"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock3" colspan=4 ></td>
  </tr>
  <tr>
    <td width="20%" class="titleblock2">進行状況</td>
    <td width="30%" class="titleblock">{$form.status.html}</td>
    <td class="titleblock2" width="20%">弁当数</td>
    <td width="30%" class="titleblock">{$form.bento.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">資材数</td>
    <td width="30%" class="titleblock">{$form.sizaisu.html}</td>
    <td class="titleblock2" width="20%">資材No</td>
    <td width="30%" class="titleblock">{$form.sizaino.html}</td>
  </tr>
  <!--tr>
    <td class="titleblock2" width="25%">ステータス</td>
    <td width="25%" class="titleblock"><input type="radio" value="0" name="sys_stat">有効 
      <input type="radio" name="sys_stat" value="1"> 削除 
    </td>
    <td width="50%" class="titleblock" colspan="2">削除後はこのデータは表示されません。</td>
  </tr-->
  <tr>
    <td class="titleblock2" width="20%" align="right">&nbsp;メモ2</td>
    <td width="80%" class="titleblock" colspan="3">{$form.cl2.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="0" cellPadding="6" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">開催結果</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">入場者数</td>
    <td width="30%" class="titleblock">{$form.nyujosha.html}</td>
    <td width="20%" class="titleblock2">アンケート回収者数</td>
    <td width="30%" class="titleblock">{$form.an_kaisyu.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%">事後報告書</td>
    <td width="30%" class="titleblock">{$form.report.html}</td>
    <td class="titleblock2" width="20%"></td>
    <td width="30%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="20%" align="right">メモ3</td>
    <td width="80%" class="titleblock" colspan="3">{$form.cl3.html}</td>
  </tr>
  <!-- tr>
    <td class="titleblock3" width="680" colSpan="4" height="21">設定</td></tr>
  <tr>
    <td class="titleblock2" width="25%">表示/非表示</td>
    <td width="75%" class="titleblock" colspan="3"><input type="radio" name="sys_stat" value="0">表示 
      <input type="radio" name="sys_stat" value="1">非表示</td>
  </tr-->
</table>

{if $locktoken != "unlock"}
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
<!-- a ID="filelist0"></a -->
{foreach name=outer from=$fileData item="item"}
   {assign var=jo value=`$smarty.foreach.outer.iteration`}
   <a ID="filelist{$jo}"></a>
   <TABLE cellSpacing=0 cellPadding=6 width=780>
	{if $jo == 1}
	<TR><TD class=titleblock3 colSpan=3 height=21>ファイル</TD></TR>
	{/if}
	<tr>
		<td class=titleblock2 width="25%">ファイル名</td>
		<td width="55%" class=titleblock>
<a href="./bin/adm_down2012.php?fname={$item.sys_filename}" target=_blank>{$item.org_filename}</a></td>
		<td width="20%" class=titleblock align=center>
		{if $locktoken != "unlock"}
			<form method="post" action="./admincl/cancel2012.php" >
			<br><input type="hidden" name="reg_id" value={$item.reg_id}>
			<input type="hidden" name="semi_id" value={$item.semi_id}>
			<input type="submit" value="削除" style="font-size:12" >
			</form>
		{/if}
		</td>
	</tr>
	<tr>
		<td class=titleblock2 width="25%">コメント</td>
		<td width="75%" colspan=2 class=titleblock>{$item.remark}</td>
	</tr>
	<tr>
		<td class=titleblock2 width="25%">日時・サイズ</td>
		<td width="75%" class=titleblock colspan=2>{$item.reg_date} {$item.reg_time} ({$item.filesize|number_format}バイト)
		</td>
	</tr>
   </table>
{foreachelse}
   <TABLE cellSpacing=1 cellPadding=2 width=780 border=0>
	<tr>
		<td colspan="3" class="value"></td>
	</tr>
   </table>
{/foreach}
<p align="right"><a href="#top">Page Top</a></p>

{include file="member/include/HtmlFootSet_ja.tpl"}
