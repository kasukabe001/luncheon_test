{include file="public/include/HtmlHead.tpl" htmlTitle=$htmlTitle}

  <!--/// HEADER BAR ///-->
<TABLE cellSpacing=4 cellPadding=8 width=780 border=0 background="./images/banner-bg.gif">
  <TR>
    <TD width="53%" >
    <font color="#FFFFFF" size=5><b>セミナー詳細情報 </b></font>
    </TD>
    <TD width="47%" align="right">
<input type="hidden" name="semi_id" value="#semi_id#">
    </TD>
</TR></TABLE>
  <!--/// HEADER BAR ///-->


  <!--### MENU ###-->

<div id="menu">
<table width="780" bgcolor="#f6f6f6" cellpadding="0" cellspacing="0">
<tr>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Info'}_v{/if}"><a href="?_mod=Info&amp;_type=Edit&amp;_act=Display">基本情報</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Chair'}_v{/if}"><a href="?_mod=Chair&amp;_type=Edit&amp;_act=Display">座長</a></td>
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Speaker'}_v{/if}"><a href="?_mod=Speaker&amp;_type=Edit&amp;_act=Display">演者</a></td>
    <td width="113" class="menu_btn_kara"></td>
    <td width="113" class="menu_btn_kara"></td>
  {if $smarty.session.auth_flg == $smarty.const._ADMIN2_AUTH_FLG_}
    <td width="113" class="menu_btn{if $smarty.request._mod == 'Denpyo'}_v{/if}"><a href="?_mod=Denpyo&amp;_type=Edit&amp;_act=Display">伝票ファイル</a></td>
  {else}
    <td width="113">&nbsp;</td>
  {/if}
    <td width="113" class="menu_btn{if $smarty.request._mod == ''}_v{/if}"><a href="#" onclick="window.close();">Close</a></td>
</tr>
</table>
</div>
  <!--/// MENU ///-->

<!--/// HEADER ///-->


<!--### MAIN BODY ###-->
<div id="main_body">

