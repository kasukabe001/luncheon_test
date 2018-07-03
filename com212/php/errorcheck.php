<?php
/***********************
 * Error Check Library
 ***********************/

/**
 * not empty and digit
 */
function _is_num ($val) {

  if ( empty($val) ) {
       return (0);
  }

  if ( preg_match("/[^0-9]/",$val) ) {
    return (0);
  }

  return (1);

}

/**
 * not empty and alpha or digit
 */
function _is_alnum ($val) {

  if ( empty($val) ) {
       return (0);
  }

  if ( preg_match("/[^a-zA-Z0-9]/",$val) ) {
    return (0);
  }

  return (1);

}

/**
 * Mail 
 */
function _is_mail ($str) {

  if ( empty($str) ) {
       return (0);
  }

  if ( !preg_match("/^[\w\-+\.]+\@[\w\-+\.]+$/i", $str) ) {
    return (0);
  }

  return (1);

}

/**
 * tel
 */
function _is_tel ($val) {

  if ( empty($val) ) {
       return (0);
  }

  if ( preg_match("/[^0-9\-]/",$val) ) {
    return (0);
  }

  return (1);

}

/**
 * zip(Japan)
 */
function _is_zip ($val) {

  if ( empty($val) ) {
       return (0);
  }

  if ( !preg_match("/\d\d\d\-\d\d\d\d/",$val) ) {
    return (0);
  }

  return (1);

}

/**
 * zip(World)
 */
function _is_zip_w ($val) {

  if ( empty($val) ) {
       return (0);
  }

  if ( preg_match("/[^a-zA-Z0-9\-\ ]/",$val) ) {
    return (0);
  }

  return (1);

}

/**
 * ascii characters
 */
function _is_ascii ($NONASCII, $val) {
  if ( preg_match("/[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\~\=\|\-\^\\\[\]\@\`\+\*\;\:\{\}\,\.\/\_\?\<\> ]/",$val) ) {
      return (0);
  } else if( preg_match("/&amp;#[0-9]{5};/",$val) ){
      return (0);
  }
  return (1);
}

/**
 * Zenkaku Kana check
 */
function KanaCheck( $AttriName ) {
	if( ereg( "^(\xA5[\xA1-\xF6]|\xA1\xBC|\xA1\xA6|\xA1\xA1|\x20)+$",
		$AttriName ) == False ) {
		return False;
	}
	return True;
}

/**
 * 必須チェック ここは毎回修正
 */

function Check_Rule( $post,$field,$val ) {
	$n=0;
	if ($val[gakkai] ==null) {
	  $Errors[gakkai] = "<LI>学会名を入力してください\n";
	  $n ++;
	}
	if ($val[seminar] ==null) {
	  $Errors[seminar] = "<LI>セミナー名を入力してください\n";
	  $n ++;
	}
	if ($val[cl1] != "") { // 長さチェック
	  $chk_str = strip_tags($val[cl1]);
	  $chk_str = preg_replace("/(<br>|\n|\r\n)/i"," ",$chk_str);
	  $chk_str = preg_replace("/\s/","",$chk_str);
	  $chk_len  = mb_strlen($chk_str);
	  if( $chk_len > 200 ) {
	    $Errors[cl1] = "<LI>メモ1が200文字を超えています\n";
	  }
	  $n ++;
	}
	if ($val[cl2] != "") { // 長さチェック
	  $chk_str = strip_tags($val[cl2]);
	  $chk_str = preg_replace("/(<br>|\n|\r\n)/i"," ",$chk_str);
	  $chk_str = preg_replace("/\s/","",$chk_str);
	  $chk_len  = mb_strlen($chk_str);
	  if( $chk_len > 200 ) {
	    $Errors[cl2] = "<LI>メモ2が200文字を超えています\n";
	  }
	  $n ++;
	}
	if ($val[cl3] != "") { // 長さチェック
	  $chk_str = strip_tags($val[cl3]);
	  $chk_str = preg_replace("/(<br>|\n|\r\n)/i"," ",$chk_str);
	  $chk_str = preg_replace("/\s/","",$chk_str);
	  $chk_len  = mb_strlen($chk_str);
	  if( $chk_len > 200 ) {
	    $Errors[cl3] = "<LI>メモ3が200文字を超えています\n";
	  }
	  $n ++;
	}

/*
	if ($val[affil_name] ==null) {
	  $Errors[affil_name] = "<LI>学校名を入力してください\n";
	  $n ++;
	}

	if ($val[zip1] == "") {
	  $Errors[zip1] = "<LI>郵便番号を入力してください\n";
	  $n ++;
	} else if ( !_is_num($val[zip1])) {
	  $Errors[zip1] = "<LI>郵便番号は半角数字で入力してください\n";
	  $n ++;
	} else if ( strlen($val[zip1]) !=3) {
	  $Errors[zip1] = "<LI>3桁で入力してください\n";
	  $n ++;
	}
	if ($val[zip2] == "") {
	  $Errors[zip2] = "<LI>郵便番号を入力してください\n";
	  $n ++;
	} else if ( !_is_num($val[zip2])) {
	  $Errors[zip2] = "<LI>郵便番号は半角数字で入力してください\n";
	  $n ++;
	} else if ( strlen($val[zip2]) !=4) {
	  $Errors[zip2] = "<LI>4桁で入力してください\n";
	  $n ++;
	}

*/
	return ($Errors);
}

function err_out($num) {
  $err_msg = "<font color=red>";
  require ("error_header.php");
  switch ($num) { 
	case 0:  // 起動引数チェック
	  $err_msg .= "パラメータエラー(Object)";
	  break;
	case 1:  // 起動引数チェック
	  $err_msg .= "データベースをオープンできません";
	  break;
	case 2:
	  $err_msg .= "パラメータエラー(ID)";
	  break;
	case 3:
	  $err_msg .= "データ取得エラー";
	  break;
	case 4:
	  $err_msg .= "データ更新エラー";
	  break;
	case 5:
	  $err_msg .= "データ再取得エラー";
	  break;
	case 6:
	  $err_msg .= "データ整合性エラー";
	  break;
	case 7:
	  $err_msg .= "更新履歴作成エラー";
	  break;
	case 8:
	  $err_msg .= "テンプレートファイル取得エラー";
	  break;
	case 9:
	  $err_msg .= "不正遷移エラー";
	  break;
	case 10:   // file upload
	  $err_msg .= "ファイル数が制限に達しています";
	  break;
	case 11:
	  $err_msg .= "登録エラー";
	  break;
	case 12:   // file upload
	  $err_msg .= "ファイルがありません";
  }
  $err_msg .= "<br><br>";
  print $err_msg;
//  print "<input type=\"button\" class=\"g-12-thin\" value=\"戻る\" onclick=\"history.back()\">";
  return;
}

?>
