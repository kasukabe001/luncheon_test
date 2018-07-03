{include file="member/include/HtmlHeadSet_ja.tpl" htmlTitle="TehaiAssign"}
<br />
<div class="title">会場 - 手配品</div>

<form name="form1" method="post" action="?_mod=Tehai" id="formid">
{$form.hidden}

<!-- script>
    if ( ! cal1.getFormValue() ) cal1.setFormValue();
</script -->
<!-- script src="./js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="./js/ui.core.js" type="text/javascript"></script>
<script src="./js/ui.sortable.js" type="text/javascript"></script -->
{literal}
<script type="text/javascript">
  $(function() {   
    $("#sortable1, #sortable2").sortable({   
        connectWith: ['.connectedSortable'],   
        stop: function(event, ui) {
	     $('#sortable1').mouseover(function(){
//	        ui.item.css("background-color", "#555555");
//	        ui.item.css("color", "#eeeeee");
//	        ui.item.css("font-weight", "bold");
	     });
	     $('#sortable2').mouseover(function(){
//	        ui.item.css("background-color", "#eeeeee");
//	        ui.item.css("color", "#2e7db2");
	     });
	     var order = $("#sortable1").sortable("serialize") + '&action=updateRecordsListings'; 
	     $.post("updateDB.php", order, function(theResponse){
		$("#contentRight").html(theResponse);
	     }); 
	}
    }).disableSelection();   
  });   

</script>
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	margin-top: 10px;
}

ul {
	margin: 0;
	/* 上 右 下 左*/
}

#contentWrap {
/*	width: 760px; */
	width: 730px;
	margin: 0 auto;
	height: auto;
	overflow: hidden;
}

#contentTop {
	width: 700px;
	padding: 10px;
	margin-left: 30px;
}

#contentLeft { 
	float: left;
/*	width: 240px; */
	width: 230px;
	background-color:#FFF68F;
}

#contentMiddle { 
	float: right; 
/*	width: 240px; */
	width: 230px;
	background-color:#EEEED1;
}
#pageLink { 
	position absolute;
	top 300px;
	left 200px;
	width: 240px;
	text-align:center;
	background-color:#EEEED1;
}

#contentLeft p,
#contentMiddle p {
	text-align: center;
	font-weight: bold;
}


#contentRight {
	float: right;
/*	width: 260px; */
	width: 250px;
	padding:10px;
	background-color:#336600;
	color:#FFFFFF;
}

#sortable1, #sortable2 { list-style-type: none; margin: 0; padding: 0; float: left; margin-right: 10px; }  
#sortable1 li, #sortable2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 180px; }   
.ui-default {border: 1px solid #cccccc; background: #eeeeee ; color: #2e7db2; }
.ui-highlight {border: 1px solid #cccccc; background: #eeeeee ; color: #2e7db2;}
</style>   


{/literal}

<div class="indent">
  <!--### セッションリスト ###-->
<table border="0" width="680" cellpadding="2" cellspacing="1">
<tr>
    <td class=titleblock3 height=21 >{$gakkai}(ID:{$smarty.session.semi_id})</td>
</tr>
</table>
</div{* class="indent" *}>

<div align="right">
<a href="?_mod=Tehai&_type=Edit&_act=Display">戻る</a>
</div>

<!--/// セッション講師側情報 ///-->
<div id="contentWrap">
	<div id="contentTop">
	<img src="./images/arrow-down.png" alt="Arrow Down" align="middle" width="32" height="32" />　手配品一覧から手配品をドラッグ＆ドロップしてください.
	</div>

<div id="contentLeft">
<p>現在の手配品</p>
  <ul id="sortable1" class="connectedSortable">
{foreach from=$now key="key" item="item"}
	<li id="recordsArray_{$item.tehai_id}" class="ui-default">{$item.tehai_id} {$item.th_hinmei}({$item.semi_id|escape})</li>
{foreachelse}
　ここにドロップしてください.<br /><br />
{/foreach}
  </ul>
</div>   
	<div id="contentRight">
		手配品の右横部分がドラッグしやすいです.<br/><br/>
		手配品を重ねるように移動させるとドロップエリアが広がります.<br/>
		<br/>
	</div>
<div id="contentMiddle">
<p>手配品</p>
  <ul id="sortable2" class="connectedSortable">
{foreach from=$all key="key" item="item"}
	<!-- li id="recordsArray_{$item.member_id|escape}" class="ui-highlight">{$item.member_id|escape} {$item.th_hinmei|escape}({$item.uid|escape})</li -->
	<li id="recordsArray_{$key}" class="ui-highlight">{$item|escape}({$key|escape})</li>
{/foreach}
  </ul>
<br />
<br>
<!-- input type="hidden" name="page" value="1" -->
    <input type="hidden" name="token" value="{$token|default:$smarty.post.token|escape}" />
    <input type="hidden" name="_act" value="Assign" />
    <input type="hidden" name="_type" value="{$smarty.request._type|escape}" />
<!-- table border="0" cellspacing="0" cellpadding="2">
<tr><td align=center><font size=2>講師名:</font>
<input type="text" name="speaker" size=10 value=>&nbsp;
<input type="submit" name="btnSend" value="検索"></td></tr>
</table -->
<br>&nbsp;
{$p}

</div>
</div> <!-- contentWrap -->



</form>

{include file="member/include/HtmlFootSet_ja.tpl"}
