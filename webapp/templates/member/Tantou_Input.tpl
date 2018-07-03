{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="LchTantouInput"}
<br />

<form name="form1" method="post" action="?_mod=Tantou">
{$form.hidden}
  <!--### BUTTON ###-->
{if $locktoken != "unlock"}
  <!-- p align="center">
    <input type="submit" name="DirectBtn" value="基本" />
    <input type="submit" name="DirectBtn" value="座長" />
    <input type="submit" name="DirectBtn" value="演者" />
    <input type="submit" name="DirectBtn" value="手配" />
    <input type="submit" name="DirectBtn" value="人員" />
    <input type="submit" name="DirectBtn" value="担当" />
    <input type="submit" name="DirectBtn" value=" 他 " />
    <input type="submit" name="DirectBtn" value="ｱｯﾌﾟ" />
    <input type="submit" name="DirectBtn" value="帳票" />
  </p -->
{/if}
  <!--/// BUTTON ///-->

<TABLE cellSpacing=1 cellPadding=2 width=680 border=0>
  <TR>
    <TD class=titleblock3 colspan=4 height=21>&nbsp;{$gakkai|escape} ({$smarty.session.semi_id})</TD>
  </TR>
</table>
<div id="box">
<ul>
<!-- li>[参照]ボタンをクリックすると、【コプロ】のデータを参照します。</li>
<li>参照したデータは変更できます。[参照]ボタンを再度クリックするとデータが初期化されますので、ご注意ください。</li -->
<li>学会（運営）事務局、会場情報はこのページでご登録ください。</li>
<li>アンケート、収録は基本情報ページで "有" を選択している場合に表示されます。</li>
<li>アステラス、リンケージの責任者は基本情報ページより参照されます。</li>
</ul>
</div>

  {* if $locktoken != "unlock" *}
<!--### BUTTON ###-->
<!-- div align="center">
    <input type="button" name="btn1" value="参照" onclick="reqReload()" style="font-size:12pt;" />
</div -->
<!--/// BUTTON ///-->
  {* /if *}


<TABLE cellSpacing=1 cellPadding=2 width=680 border=0>
  <TR>
    <TD colspan=4>&nbsp;担当者</TD>
  </TR>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp0.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip0.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr0.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel0.html}
FAX{$form.lch_fax0.html}
携帯{$form.lch_mobile0.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man0.value}</td>
  </tr>
{if $smarty.session.copronum > 0}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp1.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip1.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr1.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel1.html}
FAX{$form.lch_fax1.html}
携帯{$form.lch_mobile1.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man1.value}</td>
  </tr>
{/if}
{if $smarty.session.copronum > 1}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>共催</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp2.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr2.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel2.html}
FAX{$form.lch_fax2.html}
携帯{$form.lch_mobile2.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man2.value}</td>
  <tr>
{/if}

<!-- MR -->
{foreach from=$zacho key="key" item="item" }
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="50%" class="titleblock" colspan="2">
	{$item.mr_eigyo}<br />{$item.mr_name}</td>
    <td class="titleblock" width="25%" >
    T) {$item.mr_tel}<br />F) {$item.mr_fax}<br />M) {$item.mr_keitai}<br /></td>
</tr>
{foreachelse}
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">座長が登録されていません。</td>
</tr>
{/foreach}
{foreach from=$ensha key="key" item="item" }
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="50%" class="titleblock" colspan="2">
	{$item.mr_eigyo}<br />{$item.mr_name}</td>
    <td class="titleblock" width="25%" >
    T) {$item.mr_tel}<br />F) {$item.mr_fax}<br />M) {$item.mr_keitai}<br /></td>
</tr>
{foreachelse}
<tr>
    <td class="titleblock2" width="25%" >MR</td>
    <td width="75%" class="titleblock" colspan="3">演者が登録されていません。</td>
</tr>
{/foreach}
<!-- MR -->

  <tr>
    <td class="titleblock2" width="25%" rowspan=5>CL当日運営</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp3.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip3.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr3.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel3.html}
FAX{$form.lch_fax3.html}
携帯{$form.lch_mobile3.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man3.value}</td>
  </tr>
  <tr>
    <td colspan=4 height=5></td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>学会事務局</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp4.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip4.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr4.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel4.html}
FAX{$form.lch_fax4.html}
携帯{$form.lch_mobile4.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man4.value}</td>
  </tr>
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>会場</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp5.value}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip5.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr5.html}</td>
  </tr>
  <tr>
    <td width="25%" class="titleblock" colspan="3">
TEL{$form.lch_tel5.html}
FAX{$form.lch_fax5.html}
携帯{$form.lch_mobile5.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者 {$form.lch_man5.html}</td>
  </tr>
{if $anquete == "有"}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>アンケート</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp6.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip6.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr6.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel6.html}
FAX{$form.lch_fax6.html}
携帯{$form.lch_mobile6.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$form.lch_man6.html}</td>
  </tr>
{else}
  <tr>
    <td class="titleblock2" width="25%" >アンケート</td>
    <td width="75%" class="titleblock" colspan="3">無</td>
  </tr>
{/if}

{if $syuroku == "有"}
  <tr>
    <td class="titleblock2" width="25%" rowspan=5>収録</td>
    <td width="75%" class="titleblock" colspan="3">{$form.lch_corp7.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">〒{$form.lch_zip7.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">住所{$form.lch_addr7.html}</td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">
TEL{$form.lch_tel7.html}
FAX{$form.lch_fax7.html}
携帯{$form.lch_mobile7.html}
    </td>
  </tr>
  <tr>
    <td width="75%" class="titleblock" colspan="3">担当者{$form.lch_man7.html}</td>
  </tr>
{else}
  <tr>
    <td class="titleblock2" width="25%" >収録</td>
    <td width="75%" class="titleblock" colspan="3">無</td>
  </tr>
{/if}
</table>
<br />

{if $locktoken != "unlock"}
<div align="center">
<FONT color=#ff0000 size=2>入力内容をチェックの上、［次ページ］ボタンをクリックしてください。</FONT>
</div>

  <!--### BUTTON ###-->
<div class="form_button">
    <input type="hidden" name="semi_id" value="{$smarty.request.semi_id|escape}" />
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Confirm" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
    <input type="submit" name="submit" value=" 次ページ " />&nbsp;&nbsp;&nbsp;&nbsp;
    <INPUT type=reset value="  リセット " name=Reset>
</div>
  <!--/// BUTTON ///-->
{/if}

</FORM><br>


<p align="right"><a href="#top">Page Top</a></p>

{include file="member/include/HtmlFootSet_ja.tpl"}
