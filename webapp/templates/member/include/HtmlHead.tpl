<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smarty.const._CHARSET_}" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
{if $meta != ''}{$meta}{/if}
<title>{$smarty.const._PROJECT_NAME_JA_}::{$htmlTitle|default:''}</title>
<link rel="stylesheet" href="css/ui.tabs.css" type="text/css" media="print, projection, screen">
<link rel="stylesheet" href="css/basic2011.css" type="text/css" media="print, projection, screen">
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/basic2011.js"></script>
{if $htmlTitle=="BasicInput" || $htmlTitle == "基本-確認"}
  <script type="text/javascript" src="js/smoothScroll.js"></script>
  <script type="text/javascript" src="js/calendar.js"></script>

  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/qaTab.js" type="text/javascript"></script>
  <script type="text/javascript">
{literal}
$(document).ready(function(){  
    $('.accordion_head').click(function() {  
        $(this).next().slideToggle();  
//        $('.accordion_head2').next().slideToggle();  
    }).next().hide();
    $('.accordion_head2').click(function() {  
        $(this).next().slideToggle();  
//        $('.accordion_head').next().slideToggle();  
    }).next().hide();  

    var za3 = document.form1.chair3.value;
    if (za3 != "") {
        $('.accordion_head').next().slideToggle();
    }
    var en5 = document.form1.enshaname5.value;
    var en6 = document.form1.enshaname6.value;
    var en7 = document.form1.enshaname7.value;
    var en8 = document.form1.enshaname8.value;
    var en_kohan = en5 + en6 +en7 +en8;
    if (en_kohan != "") {
        $('.accordion_head2').next().slideToggle();
    }

});
{/literal}
  </script> 


{elseif $htmlTitle=="ZachoInput" || $htmlTitle=="EnjaInput" }
        <script src="./js/jquery-1.2.6.js" type="text/javascript"></script>
        <script src="./js/ui.core.js" type="text/javascript"></script>
        <script src="./js/ui.tabs.js" type="text/javascript"></script>
        <script type="text/javascript">
{literal}
            $(function() {
                $('#container-1 > ul').tabs();
                /*$('#container-2 > ul').tabs({ selected: 1 });
                $('#container-3 > ul').tabs({ fx: { height: 'toggle' } });
                $('#container-4 > ul').tabs({ fx: { opacity: 'toggle' } });
                $('#container-5 > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
                $('#container-6 > ul').tabs({
                    fx: { opacity: 'toggle', duration: 'fast' },
                    select: function(ui) {
                        alert('select');
                    },
                    show: function(ui) {
                        alert('show');
                    }
                });
                $('#container-7 > ul').tabs({ fx: [null, { height: 'show', opacity: 'show' }] });
                $('#container-8 > ul').tabs();
                $('#container-9 > ul').tabs({ disabled: [2] });
                $('<p><a href="#">Remove 4th tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('remove', 3);
                    return false;
                });
                $('<p><a href="#">Insert new tab at 2nd position<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('add', '#inserted-tab', 'New Tab', 1);
                    return false;
                });
                $('<p><a href="#">Append new tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('add', '#appended-tab', 'New Tab');
                    return false;
                });
                $('<p><a href="#">Disable 3rd tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('disable', 2);
                    return false;
                });
                $('<p><a href="#">Enable 3rd tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('enable', 2);
                    return false;
                });
                $('<p><a href="#">Select 3rd tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    $('#container-9 > ul').tabs('select', 2);
                    return false;
                });
                $('<p><a href="#">Get selected tab<\/a><\/p>').prependTo('#fragment-22').find('a').click(function() {
                    alert( $('#container-9 > ul').data('selected.tabs') );
                    return false;
                });
                $('#container-10 > ul').tabs({ selected: null, unselect: true });
                $('#container-11 > ul').tabs({ event: 'mouseover' });*/
            });



 {/literal}
        </script>

{/if}


</head>

<body onload=moveto({$smarty.request.move}) onunload="popup.close();">
<a ID="top"></a>

