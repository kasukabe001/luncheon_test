{include file="public/include/HtmlHead.tpl" charset="utf-8"}
<br /><br />
<table width="760" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#ffffff" class="tableBorder">
<tr>
    <td style="padding:8px 0px 0px 10px;"><!-- img src="images/header-img1.gif"/ -->
<B><FONT size=6 face="Arial Black">予備画面<BR><BR></FONT>
<FONT size=6 face="ＭＳ ゴシック, Osaka－等幅">マイページ</FONT></B></td>
</tr>
<tr>
    <td align="center" valign="middle">
            <br />

        <div class="txt_1">
            表示されることはありません。<br />
        </div>

<!--### Registration ###-->
        <!--<div class="txt_1">-->
        <!--div class="txtBar01"--><br />
        <!--/div-->
        <table width="320" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>&nbsp;
{if $logout_msg != ''}
<div id="news_frame">{$logout_msg}</div>
{/if}
	    </td>
        </tr>
        </table>
<!--/// Registration ///-->
    </td>
</tr>
<tr>
    <td height="75" align="center">

<!--### Login ###-->
    <!--div class="txtBar01" -->
        <span class="red">ID（メールアドレス）とパスワードを入力し、ログインしてください。</span>
    <!--/div--><br /><br />
    <form name="form" method="post" action="">
    <table border="0" cellspacing="1" cellpadding="0">
    <tr>
        <td class="txt_2 item" width="100">
            <b>ID:</b>
        </td>
        <td align="left" class="value" width="200">
            <input name="uid" type="text" id="login_id" value="{$smarty.post.uid|escape}" size="29" maxlength="100" class="fm_disabled" />
        </td>
    </tr>
    <tr>
        <td class="txt_2 item">
            <b>Password:</b	>
        </td>
        <td align="left" class="value">
              <input name="pwd" type="password" id="login_pw" value="{$smarty.post.pwd|escape}" size="30" maxlength="100" class="fm_disabled" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="left">
            <input type="submit" name="submit" value="Login" style="margin:4px 0px 0px 15px;" />
            <input type="hidden" name="_act" value="Login" />
        </td>
    </tr>
    </table>
    </form>
<!--/// Login ///-->

    </td>
</tr>
<tr>
    <td align="center">

<!--###  ###-->
<table width="100%" border="0">
<tr>
    <td align="left">
<br />
        <!--a href="{$smarty.const._HTTPS_URI_}">This site is secured by SSL protocol.</a--><br />
    </td>
    <td align="right">
<a href="#" onClick="window.open('privacy.html','','width=468,height=640,status=no,resizable=no,directories=no,scrollbars=yes,screenX=1,left=500,screenY=1,top=200')">
Privacy Policy
</a>
    </td>
</tr>
</table>
<!--///  ///-->

    </td>
</tr>
</table>
<table width="760" border="0" align="center" cellpadding="10" cellspacing="0" class="mainfooter" >
<tr><td>

</td></tr>
</table>
{include file="public/include/HtmlFoot.tpl"}