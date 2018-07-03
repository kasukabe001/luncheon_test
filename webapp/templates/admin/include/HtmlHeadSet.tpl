{include file="admin/include/HtmlHead.tpl" htmlTitle=$htmlTitle}


  <!--/// HEADER BAR ///-->
<TABLE cellSpacing=4 cellPadding=8 width=880 border=0 background="./images/banner-bg.gif">

  <TR>
    <TD width="53%" >
    <font color="#FFFFFF" size=5><b>管理者ページ</b></font>
    </TD>
    <TD width="47%"><br></TD>
</TR></TABLE>
  <!--/// HEADER BAR ///-->


  <!--### MENU ###-->

<div id="menu_admin">
<table width="880" bgcolor="#f6f6f6" cellpadding="0" cellspacing="0">
<tr>
    <td width="145" class="menu_btn{if $smarty.request._mod == 'Admin'}_v{/if}"><a href="?_mod=Admin">トップ</a></td>
    <td width="145" class="menu_btn{if $smarty.request._mod == 'AdminTehai'}_v{/if}"><a href="?_mod=AdminTehai&amp;_type=Edit&amp;_act=List">初期値設定</a></td>
    <td width="145" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"><!-- a href="?_mod=Empty&amp;_type=Edit&amp;_act=Display" ></a --></td>
    <td width="145" class="menu_btn{if $smarty.request._mod == 'AdminDetail'}_v{/if}"><a href="?_mod=AdminDetail">担当者一覧/変更</a></td>
    <td width="145" class="menu_btn{if $smarty.request._mod == 'AdminMaster'}_v{/if}"><a href="?_mod=AdminMaster">担当者 新規登録</a></td>
    <td width="145" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"></td>
</tr>
</table>
</div>
  <!--/// MENU ///-->

<!--/// HEADER ///-->


<!--### MAIN BODY ###-->
<div id="main_body">

