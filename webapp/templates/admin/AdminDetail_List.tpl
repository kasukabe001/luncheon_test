{include file="admin/include/HtmlHeadSet.tpl" htmlTitle='担当者一覧/変更' js_flg=$omode}
<br />
<div class="sub_title">担当者一覧/変更</div>
<div class="indent">
  <!--### 参加者検索 ###-->
<form name="formMembersSearch" method="get" action="?_mod=Admin&_act=MembersList">
    <select name="searchMode" >
        <option value="" {if $smarty.request.searchMode == ''} selected="selected"{/if}></option>
        <option value="ta_man" {if $smarty.request.searchMode == 'ta_man'} selected="selected"{/if}>担当者名</option>
        <option value="ta_corp" {if $smarty.request.searchMode == 'ta_corp'} selected="selected"{/if}>会社･団体名</option>
        <option value="ta_id"{if $smarty.request.searchMode == 'ta_id'} selected="selected"{/if}>登録ID</option>
    </select>
    <input type="text" name="searchField" value="{$smarty.request.searchField}" size="50" />

    <input type="hidden" name="_mod" value="AdminDetail" />
    <input type="submit" name="membersSearch" value="検索" />&nbsp;&nbsp;&nbsp;
    <input type="button" name="B1" value="クリア" onclick=AdminClear() />&nbsp;
<br />
<b>区分:</b>&nbsp;
<input type="radio" name="SpInfo" value="コプロ" {if $smarty.request.SpInfo=='P'}checked{/if} />共催(コプロ)&nbsp;
<input type="radio" name="SpInfo" value="アンケート" {if $smarty.request.SpInfo=='Q'}checked{/if} />アンケート&nbsp;&nbsp;
<input type="radio" name="SpInfo" value="収録" {if $smarty.request.SpInfo=='R'}checked{/if} />収録&nbsp;
<input type="radio" name="SpInfo" value="運営会社" {if $smarty.request.SpInfo=='S'}checked{/if} />学会運営事務局(運営会社)&nbsp;
<input type="radio" name="SpInfo" value="その他" {if $smarty.request.SpInfo == "T"}checked{/if} />その他
<br />
</form>
  <!--/// 担当者検索 ///-->
</div{*class="indent"*}>

<div align="center">

  <!--### 担当者リスト ###-->
<div class="pager">
{$pager}
</div>

<form name="form1" method="get" action="mypage.php">
<table border="0" width="680" cellpadding="0" cellspacing="1">
<tr align="center">
    <td class="valueH" width="30">ＩＤ</td>
    <td class="valueH" width="120">区分</td>
    <td class="valueH" width="250">会社･団体名</td>
    <td class="valueH" width="200">担当者</td>
    <td class="valueH" width="80">詳細情報</td>
</tr>
{foreach from=$row key="key" item="item" name=outer }
  {* assign var=jo value=`$smarty.foreach.outer.iteration` *}
<tr>{* if $jo % 2 == 0 }1{/if *}
    <td class="value">{$item.ta_id}</td>
    <td class="value" align="left">{$item.ta_code|replace:"アステラス":"共催(ｱｽﾃﾗｽ)"|replace:"コプロ":"共催(ｺﾌﾟﾛ)"|escape|replace:"運営会社":"学会運営事務局"}</td>
    <td class="value" align="left">
{if $item.ta_status == '1'}<STRIKE>{/if}
    {$item.ta_corp|escape}
{if $item.ta_status == '1'}</STRIKE>{/if}
    </td>
    <td class="value" align="left">
{if $item.ta_status == '1'}<STRIKE>{/if}
    {$item.ta_man|escape}
{if $item.ta_status == '1'}</STRIKE>{/if}
    </td>
    <td class="value" align="center">
    <input type="button" name="btn1{$item.ta_id|escape}" value="詳細" onclick="reqTantouList('AdminDetail', 'Display','{$item.ta_id|escape}')" />
    </td>
</tr>
{foreachelse}
<tr>
    <td colspan="5" class="value">現在登録はありません。</td>
</tr>
{/foreach}
</table>

    <input type="hidden" name="_mod" value="" />
    <input type="hidden" name="_type" value="Edit" />
    <input type="hidden" name="_act" value="" />
    <input type="hidden" name="ta_id" value="" />
</form>

<div class="pager">
{$pager}
</div>
  <!--/// 担当者リスト ///-->
</div><!-- align="center" -->

<br />
{include file="admin/include/HtmlFootSet.tpl"}