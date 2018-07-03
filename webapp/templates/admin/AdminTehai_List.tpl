{include file="admin/include/HtmlHeadSet.tpl" htmlTitle='管理者トップ'}

<!-- div class="title">申込み状況</div -->
<br />

  <!--### 初期値設定 ###-->
<div class="subtitle-2">初期値設定</div>
<div class="indent">
<ul>
<li>手配物、人員配置の初期値を設定できます。</li>
<li>ここで設定したとおりに新規データが作成されます。</li>
</ul>
<table width="200" cellpadding="2" cellspacing="1" align="center">
<tr align=center>
    <td class="item" width="200">控室手配物</td>
</tr>
<tr align=center>
    <td class="value_c" width="150">
    <form name="form1" method="post" action="?_mod=AdminTehai&amp;_act=Display">
    <input type="submit" name="settei1" value="設定" style="width:60px;height:26px;" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="hidden" name="th_code" value=1 />
    </form>
    </td>
</tr>
<tr align=center>
    <td>&nbsp;</td>
</tr>
<tr align=center>
    <td class="item" width="200">会場手配物</td>
</tr>
<tr align=center>
    <td class="value_c" width="150">
    <form name="form1" method="post" action="?_mod=AdminTehai&amp;_act=Display">
    <input type="submit" name="settei2" value="設定" style="width:60px;height:26px;" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="hidden" name="th_code" value=2 />
    </form>
    </td>
</tr>
<tr align=center>
    <td>&nbsp;</td>
</tr>
<tr align=center>
    <td class="item" width="200">人員配置</td>
</tr>
<tr align=center>
    <td class="value_c" width="150">
    <form name="form1" method="post" action="?_mod=AdminJinin&amp;_act=Display">
    <input type="submit" name="settei3" value="設定" style="width:60px;height:26px;" />
    <input type="hidden" name="th_code" value=3 />
    </form>
    </td>
</tr>
</table>
</div{* class="indent" *}>
  <!--### 初期値設定 ###-->
<div class="red" align="center">{$message}</div>

<br />
<br />
{include file="admin/include/HtmlFootSet.tpl"}