{include file="member/include/HtmlHead.tpl" htmlTitle=$htmlTitle}

  <!--/// HEADER BAR ///-->
<TABLE cellSpacing=4 cellPadding=8 width=780 border=0 background="./images/banner-bg.gif">
  <TR>
    <TD width="53%" >
    <font color="#FFFFFF" size=5><b>セミナー詳細情報 </b>（Linkage専用）</font>
    </TD>
    <TD width="47%" align="right">
  {if $locktoken != "unlock" && $htmlTitle != "ListTop"}
<input type="button" style="font-weight: bold; font-size: 12pt" value="コレポン" onclick="coreponWindow({$smarty.session.semi_id});">
  {/if}
    </TD>
</TR></TABLE>
  <!--/// HEADER BAR ///-->


  <!--### MENU ###-->

<div id="menu">
<table width="780" bgcolor="#f6f6f6" cellpadding="0" cellspacing="0">
<tr>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Basic'}_v{/if}"><a href="?_mod=Basic&amp;_type=Edit&amp;_act=Display">基本情報</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Zacho'}_v{/if}"><a href="?_mod=Zacho&amp;_type=Edit&amp;_act=Display">座長</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Enja'}_v{/if}"><a href="?_mod=Enja&amp;_type=Edit&amp;_act=Display">演者</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Tehai'}_v{/if}"><a href="?_mod=Tehai&amp;_type=Edit&amp;_act=Display">手配</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Jinin'}_v{/if}"><a href="?_mod=Jinin&amp;_type=Edit&amp;_act=Display">人員配置</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Schedule'}_v{/if}"><a href="?_mod=Schedule&amp;_type=Edit&amp;_act=Display">スケジュール他</a></td>
</tr>
<tr>
    <td width="113" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"><a href="./admincl/unlock.php">Close</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"><a href="?_mod=Basic&amp;_act=Display"></a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"><a href="?_mod=Basic&amp;_type=Edit&amp;_act=Display"></a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Tantou'}_v{/if}"><a href="?_mod=Tantou&amp;_type=Edit&amp;_act=Display">担当者</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Upload'}_v{/if}"><a href="?_mod=Upload&amp;_type=Edit&amp;_act=Display">アップロード</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'List'}_v{/if}"><a href="?_mod=List&amp;_type=Edit&amp;_act=Display">帳票</a></td>
</tr>
</table>
</div>
  <!--/// MENU ///-->

<!--/// HEADER ///-->


<!--### MAIN BODY ###-->
<div id="main_body">

