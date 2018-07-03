{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="JininInput"}
<br />

<form name="form1" method="post" action="?_mod=Jinin">
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

<table width="780" cellspacing="1" cellpadding="2">
  <TR>
    <TD class=titleblock3 colspan=6 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
</table>
<div id="box">
<ul>
<li>{if $copro1 != "" }共催社(コプロ)責任者、{/if}学会責任者はこのページでご登録ください。</li>
<li>アステラス、リンケージの責任者は基本情報ページより参照されます。</li>
<li>データの並べ替えはご遠慮ください。</li>
</ul>
</div>

  {* if $locktoken != "unlock" *}
<!--### BUTTON ###-->
<!-- div align="center">
    <input type="button" name="btn1" value="参照" onclick="Lookup(3)" style="font-size:12pt;" />
</div -->
<!--/// BUTTON ///-->
  {* /if *}

<table width="780" cellspacing="1" cellpadding="2">

	<tr><td colspan=5>&nbsp:人員配置({$smarty.session.j_num} 件)</td></tr>
        <tr bgcolor="#ffcc66" align="center"> 
        	<td ><b><font color="#660033">&nbsp;</font></b></td>
                <td ><b><font color="#660033">Astellas</font></b></td>
		{if $copro1 != "" }
                <td><b><font color="#660033">{$copro1|mb_truncate:8:""|default:"コプロ"|escape}</font></b></td>
		{/if}
		{if $copro2 != "" }
                <td><b><font color="#660033">{$copro2|mb_truncate:8:""|default:"コプロ"|escape}</font></b></td>
		{/if}
                <td ><b><font color="#660033">CL</font></b></td>
                <td ><b><font color="#660033">学会</font></b></td>
                <td ><b><font color="#660033">備考</font></b></td>
                <td >&nbsp:</td>
	</tr>
        <tr> 
        	<td class="item">{$form.ji_yakuwari1.html}</td>
                <td class="value_c">{$form.ji_as1.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co11.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co21.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl1.html}</td>
                <td class="value_c">{$form.ji_gakkai1.html}</td>
                <td class="value_c">{$form.ji_bikou1.html}</td>
                <td class="value_c">{$form.ji_del1.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.ji_yakuwari2.html}</td>
                <td class="value_c">{$form.ji_as2.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co12.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co22.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl2.html}</td>
                <td class="value_c">{$form.ji_gakkai2.html}</td>
                <td class="value_c">{$form.ji_bikou2.html}</td>
                <td class="value_c">{$form.ji_del2.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.ji_yakuwari3.html}</td>
                <td class="value_c">{$form.ji_as3.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co13.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co23.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl3.html}</td>
                <td class="value_c">{$form.ji_gakkai3.html}</td>
                <td class="value_c">{$form.ji_bikou3.html}</td>
                <td class="value_c">{$form.ji_del3.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.ji_yakuwari4.html}</td>
                <td class="value_c">{$form.ji_as4.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co14.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co24.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl4.html}</td>
                <td class="value_c">{$form.ji_gakkai4.html}</td>
                <td class="value_c">{$form.ji_bikou4.html}</td>
                <td class="value_c">{$form.ji_del4.html}</td>
        </tr>
        <tr> 
        	<td class="item">{$form.ji_yakuwari5.html}</td>
                <td class="value_c">{$form.ji_as5.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co15.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co25.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl5.html}</td>
                <td class="value_c">{$form.ji_gakkai5.html}</td>
                <td class="value_c">{$form.ji_bikou5.html}</td>
                <td class="value_c">{$form.ji_del5.html}</td>
        </tr>
	{if $smarty.session.j_num > 5}
        <tr> 
        	<td class="item">{$form.ji_yakuwari6.html}</td>
                <td class="value_c">{$form.ji_as6.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co16.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co26.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl6.html}</td>
                <td class="value_c">{$form.ji_gakkai6.html}</td>
                <td class="value_c">{$form.ji_bikou6.html}</td>
                <td class="value_c">{$form.ji_del6.html}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 6}
        <tr> 
        	<td class="item">{$form.ji_yakuwari7.html}</td>
                <td class="value_c">{$form.ji_as7.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co17.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co27.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl7.html}</td>
                <td class="value_c">{$form.ji_gakkai7.html}</td>
                <td class="value_c">{$form.ji_bikou7.html}</td>
                <td class="value_c">{$form.ji_del7.html}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 7}
        <tr> 
        	<td class="item">{$form.ji_yakuwari8.html}</td>
                <td class="value_c">{$form.ji_as8.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co18.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co28.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl8.html}</td>
                <td class="value_c">{$form.ji_gakkai8.html}</td>
                <td class="value_c">{$form.ji_bikou8.html}</td>
                <td class="value_c">{$form.ji_del8.html}</td>
        </tr>
	{/if}
	{if $smarty.session.j_num > 8}
        <tr> 
        	<td class="item">{$form.ji_yakuwari9.html}</td>
                <td class="value_c">{$form.ji_as9.html}</td>
		{if $copro1 != "" }
                <td class="value_c">{$form.ji_co19.html}</td>
		{/if}
		{if $copro2 != "" }
                <td class="value_c">{$form.ji_co29.html}</td>
		{/if}
                <td class="value_c">{$form.ji_cl9.html}</td>
                <td class="value_c">{$form.ji_gakkai9.html}</td>
                <td class="value_c">{$form.ji_bikou9.html}</td>
                <td class="value_c">{$form.ji_del9.html}</td>
        </tr>
	{/if}
        <tr> 
        	<td class="item">
	{if $smarty.session.j_num < 9 && $locktoken != "unlock"}
<input type="button" value="追加" onclick="AddLine(3,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000">
	{/if}
		</td>
                <td class="value_c"></td>
	    {if $copro1 != "" }
                <td class="value_c"></td>
	    {/if}
	    {if $copro2 != "" }
                <td class="value_c"></td>
	    {/if}
                <td class="value"></td>
                <td class="value"></td>
                <td class="value"></td>
                <td class="item">
	{if $locktoken != "unlock"}
	<input type="button" value="削除" onclick="DelLine(3,{$smarty.session.semi_id});" style="font-size:10pt;color:#ff0000">
	{/if}
		</td>
        </tr>
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
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}

</FORM><br />

{include file="member/include/HtmlFootSet_ja.tpl"}

