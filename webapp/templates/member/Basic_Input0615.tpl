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

<TABLE cellSpacing=1 cellPadding=2 width=780 >
  <TR>
    <TD align=right colspan=4 height=21>アップロードファイル : {$fnum}</TD>
  </TR>
  <TR>
    <TD colSpan=4><font size="2" color="#FF0000">注意）* 印の項目は必ず入力してください。 </font> <u><font size="2">下線</font></u><font size="2" color="#FF0000">はトップページ掲載項目です。<br>                                                               
 メモ1,メモ2,メモ3はリンケージ社内でしか閲覧できません。 </font></TD>
  </TR>
  <TR>
    <TD class=titleblock3 width=75% height=21 colspan=3>基本情報 (ID:{$smarty.session.semi_id} {$smarty.session.zachoNum}-{$smarty.session.enshaNum})</TD>
    <TD class=titleblock3 height=21 >最終更新日 {$last_date|truncate:12:" "}{$smarty.request.last_date|truncate:12:" "}</TD>
  </TR>
  <tr>
    <td class="titleblock2b" width="25%">学会名 <font size="2" color="#FF0000">*</font></td>
    <td width="75%" class="titleblock" colspan="3">{$form.gakkai.html}<div class="error">{$form.gakkai.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">品目</td>
    <td width="25%" class="titleblock">{$form.hinmoku.html}</td>
    <td width="25%" class="titleblock2">年度</td>
    <td width="25%" class="titleblock">{$form.nendo.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%" nowrap>セミナー名 <font size="2" color="#FF0000">*</font></td>
    <td width="25%" class="titleblock">{$form.seminar.html}<div class="error">{$form.seminar.error}</div></td>
    <td width="25%" class="titleblock2">領域</td>
    <td width="25%" class="titleblock">{$form.ryoiki.html}
	{if $locktoken != "unlock"}
      <input type="button" onclick="doDialog();" value="一覧" style="background:#5C4C77;color:#FF9600;" >
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%" nowrap>セミナー開催日</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaisaibi.html}<font size="2">
      例）08/03/14(金)</font>
	{if $locktoken != "unlock"}
    <input type=button value="C" name="B0" onclick="wrtCalendar(event,this.form.kaisaibi,'yy/mm/dd(a)');">
	{/if}
    </td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">開催時間</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaisaiji.html}<font size="2">
      例）16:00-18:00</font></td>                                                               
  </tr>
  <tr>
    <td class="titleblock2" width="25%">会期</td>
    <td width="75%" class="titleblock" colspan="3">{$form.kaiki.html}<font size="2"> 例）2012/3/14-15</font></td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">会場</td>
    <td width="75%" class="titleblock" colspan="3">{$form.place.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">URL</td>
    <td width="75%" class="titleblock" colspan="3">{$form.yobi2.html}
      <font size="2">例）http://www.gakkai.jp</font></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">テーマ</td>
    <td width="75%" class="titleblock" colspan="3">{$form.thema.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">特記事項</td>
    <td width="75%" class="titleblock" colspan="3">{$form.thema.html}</td>
  </tr>
</table>

<table cellSpacing=1 cellPadding=2 width=780 border=0>
  <tr>
    <td class="titleblock2" width="21%">座長1</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair1.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.cyaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">座長2</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair2.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.cyaku2.html}</td>
  </tr>
</table>

<span class="accordion_head"><input type="button" name="e1" value="追加"></span>
<div> 
<table cellSpacing=1 cellPadding=2 width=780 border=0>
  <tr>
    <td class="titleblock2" width="21%">座長3</td>
    <td width="25%" class="titleblock_t">氏名{$form.chair3.html}
    <div class="error">{$form.chair3.error}</div></td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.cyaku3.html}
    <div class="error">{$form.cyaku3.error}</div></td>
  </tr>
</table>
</div> 

<table cellSpacing=1 cellPadding=2 width=780 >
  <tr>
    <td class="titleblock2" width="21%" >演者1</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname1.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題1</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者2</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname2.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題2</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者3</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname3.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題3</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai3.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者4</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname4.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku4.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題4</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai4.html}</td>
  </tr>
</table>
<span class="accordion_head2"><input type="button" name="e2" value="追加"></span>
<div> 
<table cellSpacing=1 cellPadding=2 width=780>
  <tr>
    <td class="titleblock2" width="21%">演者5</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname5.html}
    <div class="error">{$form.enshaname5.error}</div></td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku5.html}
    <div class="error">{$form.enshayaku5.error}</div></td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題5</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai5.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者6</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname6.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題6</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai6.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者7</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname7.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題7</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai7.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演者8</td>
    <td width="25%" class="titleblock_t">氏名{$form.enshaname8.html}</td>
    <td width="54%" class="titleblock_t" colspan="2">役職{$form.enshayaku8.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="21%">演題8</td>
    <td width="79%" class="titleblock" colspan="3">{$form.endai8.html}</td>
  </tr>
</table>
</div> 

<table cellSpacing=1 cellPadding=2 width=780>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">共催(コプロ社名)</td>
    <td width="25%" class="titleblock" width="75%" colspan=3>
	{$form.syukan.html}&nbsp;&nbsp;&nbsp;{$form.syukan2.html}
<div class="error">{$form.syukan.error}</div>
    </td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%" rowspan=2>薬剤責任者<br>（製品担当?）</td>
    <td width="25%" class="titleblock" >氏名 {$form.sekinin.html}</td>
    <td class="titleblock2b" width="25%">組織化担当</td>
    <td width="25%" class="titleblock">氏名 {$form.cltantou.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock"></td>
    <td class="titleblock2b" width="25%">CL担当</td>
    <td width="25%" class="titleblock">氏名 {$form.cltantou.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">学会参加<br/ >見込み人数</td>
    <td width="25%" class="titleblock" >{$form.hotel.html}</td>
    <td class="titleblock2" width="25%" >学会会員数</td>
    <td width="25%" class="titleblock">{$form.yobi1.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">総セミナー数</td>
    <td width="25%" class="titleblock">{$form.yobi4.html}</td>
    <td class="titleblock2" width="25%">座席数</td>
    <td width="25%" class="titleblock">{$form.zaseki.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" >アンケート</td>
    <td width="25%" class="titleblock" >{$form.anquete.html}</td>
    <td class="titleblock2b" width="25%" >録画録音</td>
    <td width="25%" class="titleblock" >{$form.syuroku.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" align="right" width="25%">メモ1</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl1.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">抄録情報</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">抄録有無</td>
    <td width="25%" class="titleblock">{$form.anquete.html}</td>
    <td class="titleblock2" width="25%" class="titleblock">文字制限</td>
    <td width="25%" class="titleblock">{$form.annai2.html} 文字以内</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock2">進捗状況</td>
    <td width="25%" class="titleblock">
<select size=1 name="cl" STYLE="background-color:#ffffff;" >
    <option value="Fさん" >準備中</option>
    <option value="" selected >募集中</option>
    <option value="Eさん" >締切済</option>
    </select>
    </td>
    <td class="titleblock2" width="25%" class="titleblock"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">演題登録ページURL</td>
    <td width="75%" class="titleblock" colspan="3">{$form.yobi2.html}
      <font size="2">例）http://www.endai.jp</font></td>
  </tr>
</table>

<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">進捗情報</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">趣意書入手</td>
    <td width="25%" class="titleblock">{$form.amail.html}</td>
    <td class="titleblock2b" width="25%" >セミナー申込日</td>
    <td width="25%" class="titleblock">{$form.annai2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">役割者決定</td>
    <td width="25%" class="titleblock">{$form.amail.html}</td>
    <td class="titleblock2b" width="25%" >LS事前申込</td>
    <td width="25%" class="titleblock">{$form.amail.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">1stメール(API)</td>
    <td width="25%" class="titleblock">{$form.amail.html}</td>
    <td class="titleblock2b" width="25%" class="titleblock">2ndメール(CL)</td>
    <td width="25%" class="titleblock">{$form.annai2.html}</td>
  </tr>
  <!-- tr>
    <td width="25%" class="titleblock2">要綱入手</td>
    <td width="25%" class="titleblock"><input type="text" name="yoko" size="20" style="IME-MODE: inactive" maxlength=36></td>
    <td class="titleblock2" align="middle" width="25%">案内状作成</td>
    <td width="25%" class="titleblock"><input type="text" name="annai1" size="20" style="IME-MODE: inactive" maxlength=36></td> 
  </tr -->
  <!-- tr>
    <td class="titleblock2b" width="25%">開示承諾書</td>
    <td width="25%" class="titleblock">
    <input type="text" name="iraijo" size="20" maxlength=24 style="IME-MODE: inactive">
    </td>
    <td width="25%" class="titleblock2b">応諾書</td>
    <td width="25%" class="titleblock">
    <input type="text" name="oudaku" size="20" maxlength=24 style="IME-MODE: inactive"></td>
  </tr -->
  <tr>
    <td class="titleblock2" width="25%">チラシ作成依頼</td>
    <td width="25%" class="titleblock">{$form.tirasi1.html}</td>
    <td width="25%" class="titleblock2">チラシ経過・完成</td>
    <td width="25%" class="titleblock">{$form.tirasi2.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">チラシ納品日</td>
    <td width="25%" class="titleblock">{$form.tirasi3.html}</td>
    <td width="25%" class="titleblock"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <!-- td class="titleblock2" width="25%">追加申込</td>
    <td width="25%" class="titleblock"><input type="text" name="mousi_add" size="20" style="IME-MODE: inactive" maxlength=36></td -->
    <td width="25%" class="titleblock2">追加申込締切</td>
    <td width="25%" class="titleblock">{$form.mousi_c.html}</td>
    <td width="25%" class="titleblock2b">アンケート作成依頼</td>
    <td width="25%" class="titleblock">{$form.mousi_c.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">控室名</td>
    <td width="25%" class="titleblock">{$form.hikae_k.html}</td>
    <td width="25%" class="titleblock2b">当日控室案内</td>
    <td width="25%" class="titleblock">{$form.hikae_a.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">控室使用時間</td>
    <td width="75%" class="titleblock" colspan=3>{$form.hikae_t.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">当日配布資材発注</td>
    <td width="25%" class="titleblock">{$form.tojitu.html}</td>
    <td width="25%" class="titleblock2b">役割分担表送付</td>
    <td width="25%" class="titleblock">{$form.yakubun2.html}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td width="25%" class="titleblock2">進行状況</td>
    <td width="25%" class="titleblock">{$form.status.html}</td>
    <td class="titleblock2" width="25%">弁当数</td>
    <td width="25%" class="titleblock">{$form.bento.html}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">資材数</td>
    <td width="25%" class="titleblock">{$form.sizaisu.html}</td>
    <td class="titleblock2" width="25%">資材No</td>
    <td width="25%" class="titleblock">{$form.sizaino.html}</td>
  </tr>
  <!--tr>
    <td class="titleblock2" width="25%">ステータス</td>
    <td width="25%" class="titleblock"><input type="radio" value="0" name="sys_stat">有効 
      <input type="radio" name="sys_stat" value="1"> 削除 
    </td>
    <td width="50%" class="titleblock" colspan="2">削除後はこのデータは表示されません。</td>
  </tr-->
  <tr>
    <td class="titleblock2" width="25%">&nbsp;メモ2</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl2.html}</td>
  </tr>
</table>
<br>
<table cellSpacing="1" cellPadding="2" width="780">
  <tr>
    <td class="titleblock3" colSpan="4" height="21">開催結果</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">入場者数</td>
    <td width="25%" class="titleblock">{$form.nyujosha.html}</td>
    <td width="25%" class="titleblock2">アンケート回収者数</td>
    <td width="25%" class="titleblock">{$form.an_kaisyu.html}</td>
  </tr>
  <tr>
    <td class="titleblock2b" width="25%">事後報告書</td>
    <td width="25%" class="titleblock">{$form.report.html}</td>
    <td class="titleblock2" width="25%"></td>
    <td width="25%" class="titleblock"></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%">メモ3</td>
    <td width="75%" class="titleblock" colspan="3">{$form.cl3.html}</td>
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
   <TABLE cellSpacing=1 cellPadding=2 width=780>
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
