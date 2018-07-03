{include file="admin/include/HtmlHeadSet.tpl" htmlTitle='管理者トップ'}

<!-- div class="title">申込み状況</div -->
<br />

<div class="thanks">
管理ページで行えること
<ul>
<li>手配物、人員配置の初期値を設定できます。</li>
<li>アステラス製薬、コンベンションリンケージの住所情報を変更できます。</li>
<li>共催（コプロ）各社、アンケート・収録関係者情報の変更、新規登録が行えます。</li>
<li>ロックエラーのため、書込み禁止状態となったデータを復旧します。</li>
</ul>
</div>

<br />

  <!--### Lock Status###-->
<div class="subtitle-2">ロック状況</div>
<div class="indent">
<table width="600" cellpadding="2" cellspacing="1" align="center">
<tr align=center>
    <td class="item" width="35"></td>
    <td class="item" width="375">セミナー</td>
    <td class="item" width="140">ロック日時</td>
    <td class="item" width="50"></td>
</tr>

{foreach from=$lockrow key="key" item="item" name=outer }
  {* assign var=jo value=`$smarty.foreach.outer.iteration` *}
<tr>{* if $jo % 2 == 0 }1{/if *}
    <td class="value" align=center>{$item.sy_work_id|escape}</td>
    <td class="value">{$item.jp_seminar|escape} ({$item.semi_id|escape})</td>
    <td class="value">{$item.lock_time|escape}</td>
    <td class="value" align="center">
    <form name="form1" method="post" action="?">
    <input type="submit" name="btn1{$item.semi_id}" value="復旧" />
    <input type="hidden" name="_mod" value="Admin">
    <input type="hidden" name="_act" value="Unlock">
    <input type="hidden" name="semi_id" value={$item.semi_id|escape}>
    <input type="hidden" name="table_name" value={$item.table_name|escape}>
    </form>
    </td>
</tr>
{foreachelse}
<tr>
    <td colspan="4" class="value">ロック中のデータはありません。</td>
</tr>
{/foreach}
</tr>
</table>


</div{* class="indent" *}>
  <!--###  Lock Status ###-->


<br />
  <!--### UnLock ###-->
<!-- div class="subtitle-2">ロック解除</div>
<div class="indent">

    <form name="form1" method="post" action="?_mod=Admin&amp;_act=Unlock">
<table width="600" cellpadding="2" cellspacing="1" align="center">
<tr align=center>
    <td class="item" colspan=2>&nbsp;</td>
</tr>
<tr align=center>
    <td class="value_c" width="80%">
	<input type=radio name=kaijo value="1">基本情報&nbsp;&nbsp;
	<input type=radio name=kaijo value="2">座長 / 演者&nbsp;&nbsp;
	<input type=radio name=kaijo value="3">手配物&nbsp;
	<input type=radio name=kaijo value="4">人員配置
	<input type=radio name=kaijo value="5">担当者
	<input type=radio name=kaijo value="6">スケジュール他
&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td class="value_c" width="20%" align=center>
        <input type="submit" name="lockkaijo" value="解除" style="width:60px;height:26px;" />
        <input type="hidden" name="_act" value="Unlock" />
    </td>
</tr>
<tr align=center>
    <td>{$msg} </td>
</tr>
</table>
    </form>


</div{* class="indent" *} -->
  <!--### UnLock ###-->

<br />
  <!--### 登録状況 ###-->
<div class="subtitle-2">登録状況</div>
<div class="indent">
<table width="600" cellpadding="2" cellspacing="1" align="center">
<tr align=center>
<td class="item" width="150" >総合計</td>
<td class="item" width="150">前年度</td>
<td class="item" width="150">本年度終了済</td>
<td class="item" width="150">本年度進行中</td>
</tr>
<tr align=center>
<td class="value_c" >{$kensu.0|escape} 件</td>
<td class="value_c" >{$kensu.1|escape} 件</td>
<td class="value_c" >{$kensu.2|escape} 件</td>
<td class="value_c" >{$kensu.3|escape} 件</td>
<td class="value_c" > </td>
</tr>
</table>
  <!--### 登録状況 ###-->
</div{* class="indent" *}>

<br />
<div align="center">
<span class="red">管理ページの使用は特定の方に限定することをお勧めします。</span>
</div>
<br />

{include file="admin/include/HtmlFootSet.tpl"}