<?php

//############################################################
// config_pup.php
// webapp上に置くUtilityプログラム用共通関数
//【作成者】Fujita Kazuhiko
//【作成日】2010/05/02
//【修正日】2012/04/14 不要なコメントを削除
//############################################################

//*****************************************************
// function fuseiSeni(  )
// 不正遷移をチェックします。
// 引数：なし
// 戻値：0:不正なし 1:不正あり
//*****************************************************

function fuseiSeni($j=null)
{
  $mystring1 = "linkage-staff.jp/kyousai/";
//  $mystring1 = "61.206.45.171/kyousai/";
  $mystring2 = "part_div.php?";
  $mystring3 = "ttps";         // adm_downからのCall

//  if ($j>0) $mystring3="AdminPr"; // picture_togoからのCall
//  if ($j<0) $mystring3="AdminSe"; // updateDBからのCall

  $pos1 = strpos($_SERVER["HTTP_REFERER"],$mystring1 );
  $pos2 = strpos($_SERVER["HTTP_REFERER"],$mystring2 );
  $pos3 = strpos($_SERVER["HTTP_REFERER"],$mystring3 );

  if (($pos1 == false) || ($pos2 == false) || ($pos3 == false)) {
    return (1);
  } else {
    return (0);
  }
}



//*****************************************************
// function IPcheck($j)
// アクセス元のIPアドレスをチェックします。
// 引数：1 - BPとCL　2:BL,CL,CESA
// 戻値：0:OK 1:NG
//*****************************************************

function IPcheck($j)
{
 if (
        $_SERVER['REMOTE_ADDR'] == '219.121.56.52' ||
        $_SERVER['REMOTE_ADDR'] == '122.249.12.246' ||
        $_SERVER['REMOTE_ADDR'] == '60.45.61.118' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.79' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.81' ||
        $_SERVER['REMOTE_ADDR'] == '164.162.0.1' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.82' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.83' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.84' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.85' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.86' 
    ) {
	$ret = 0;
    } else {
	$ret = 1;
    }
    return $ret;
}

$UPLOAD_FILE_PATH = "/home/kyousai/upload/";
$UPLOAD_350_PATH = "/home/kyousai/upload_350/";
$UPLOAD_787_PATH = "/home/kyousai/upload_787/";

ini_set('include_path', "/home/kyousai/webapp/libs/" . 'pear:' . ini_get('include_path'));
//ini_set('include_path', "/home/reg-clinkage.jp/webapp/libs/" . 'pear:' . ini_get('include_path'));

?>

