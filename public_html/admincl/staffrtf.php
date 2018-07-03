<?php
//############################################################
// staffrtf.php スタッフ発注書の印字
//############################################################
// 1.
// [Authote] 藤田和彦
// [Date]  2012/4/7
// ファイルダウンロード
// 受取り 
// 引渡し 
//############################################################
    function get_rtf_text($str) {
        $str = get_unicode_ascii($str);
        $str = str_replace("\n", "{\n\\par}", $str);
        return $str;
    }

    function get_unicode_ascii($str) {
        $ret = '';
        $code = 'UCS-2';
        $str = mb_convert_encoding($str, $code, 'EUC-JP');
        for ($i = 0; $i < mb_strlen($str, $code); $i++) {
            $char = mb_substr($str, $i, 1, $code);
            $char2 = mb_ord($char);
            if ($char2 == 10) {
                $ret .= "\n";
            } else {
                $ret .= '\u' . $char2 . "\\'83\\'69";
            }
        }
        return $ret;
    }

    function mb_ord($char){
      return (strlen($char) < 2) ?
        ord($char) : 256 * mb_ord(substr($char, 0, -1)) + ord(substr($char, -1));
    }

    function sjis2rtf($s){
	return "\'".implode("\'",str_split(bin2hex($s),2));
    }

    // 苗字抽出
    function getMyouji($simei){
	$simei = preg_replace("/　/"," ",$simei);
	$banban = explode(" ", $simei);
	return $banban[0];
    }

    // 日付解体
    function divideDate($kaisaibi){
	$weekjp_array = array('日', '月', '火', '水', '木', '金', '土');
	$banban = explode("/", $kaisaibi);
	if (strlen($banban[0]) == 4 ) {
		$dAry['y']=substr($banban[0],2,2); // 年が4桁のとき
	} else {
		$dAry['y']=$banban[0];
	}
	if (substr($banban[1],0,1) == "0" ) {
		$dAry['m']=substr($banban[1],1,1);
	} else {
		$dAry['m']=$banban[1];
	}
	if (substr($banban[2],0,1) == "0" ) {
		$dAry['d']=substr($banban[2],1,1);
	} else {
		$dAry['d']=substr($banban[2],0,2);
	}

	$pyear = "20" . $dAry['y'];
	$ptimestamp = mktime(0, 0, 0, $dAry['m'], $dAry['d'], $pyear);
	$weekno = date('w', $ptimestamp);
	$dAry['w']= $weekjp_array[$weekno];

	return $dAry;
    }

    // 時刻整理
    function divideTime($jikan){
	$jikan = str_replace("：",":",$jikan);
	$banban = explode(":", $jikan);
	$tAry['h1']=$banban[0];
	$tAry['m1']=substr($banban[1],0,2);

	$phour = substr($banban[1],-2,1);
	if ($phour != "1" && $phour != "2") {
		$tAry['h2']=substr($banban[1],-1);
	} else {
		$tAry['h2']=substr($banban[1],-2);
	}
	$tAry['m2']=substr($banban[2],0,2);
	$p1 = intval($tAry['h1']) -1;
	$tAry['h0']= strval($p1);
// staff発注書専用仕様
	$p3 = intval($tAry['h1']) -3; //開催3時間前
	$tAry['h3']= strval($p3);
	$pe = intval($tAry['h2']) +1; //終了1時間後
	$tAry['he']= strval($pe);

	return $tAry;
    }

session_name('AstellasID');
session_start();
header("Cache-Control: public");
header("Pragma: public");
header('Content-Type: text/rtf');

//============================================================
// パラメータの引継ぎと帳票・宛名の判別
//============================================================
$semi_id=$_GET['semi_id'];

	  header("Content-Disposition: attachment; filename=staffirai.rtf");
	  $tmpl = file("../../template/staff.rtf");


//============================================================
// 外部ファイル読込
//============================================================
include_once("../../com212/inc/const.inc");
include_once("../../com212/php/errorcheck.php");

//------------------------------------------------------------
// 不正遷移チェック
//------------------------------------------------------------
$err_msg ="パラメータエラー";

if( !$_SESSION['oid'] ) {
  err_out(9);
  include_once ("../../com212/php/close_footer2012.php");
  exit;
}


//------------------------------------------------------------
// データベース・オープン
//------------------------------------------------------------
$conn = @pg_connect($OPEN);
if($conn == false) {
  err_out(1);
  include ("../../com212/php/close_footer2012.php");
  exit;
}


//============================================================
// セミナーデータ&担当者情報の読込み
//============================================================
$fetch_array =array();
	$str_seminar="select * from " . $TBL_NAME . " where semi_id =" . $_GET['semi_id'];
	$result = @pg_exec($conn, $str_seminar);
        $fetch_array = pg_fetch_array($result,$i,PGSQL_ASSOC);

$cl_array =array();
	$str_tantou="select * from lch_tantou where semi_id =" . $_GET['semi_id'] . " and lch_status=0 and lch_code = 'リンケージ'";
	$result = @pg_exec($conn, $str_tantou);
        $cl_array = pg_fetch_array($result,$i,PGSQL_ASSOC);

//============================================================
// データ変換
//============================================================
	$dayAry = divideDate($fetch_array['kaisaibi']); // 日付分断
	if (empty($fetch_array['kaisaiji']) == false) { // 時刻分断
	  $timeAry = divideTime($fetch_array['kaisaiji']);
	}
        foreach ($fetch_array as $key => $val) {
	  $fetch_array[$key] = stripslashes($fetch_array[$key]);
	  $fetch_array[$key] = mb_convert_encoding(($fetch_array[$key]),'SJIS','UTF-8');
	  $fetch_array[$key] = sjis2rtf($fetch_array[$key]);
        }

        foreach ($cl_array as $key => $val) {
	  $cl_array[$key] = stripslashes($cl_array[$key]);
	  $cl_array[$key] = mb_convert_encoding(($cl_array[$key]),'SJIS','UTF-8');
	  $cl_array[$key] = sjis2rtf($cl_array[$key]);
        }


        $y = $dayAry['y']; // 年
        $m = $dayAry['m']; // 月
        $d = $dayAry['d']; // 日
        $w = $dayAry['w']; // 曜日
	$w = mb_convert_encoding($w,'SJIS','UTF-8');
	$w = sjis2rtf($w);
        $h1 = $timeAry['h1']; // 開始時
        $m1 = $timeAry['m1']; // 開始分
        $h2 = $timeAry['h2']; // 終了時
        $m2 = $timeAry['m2']; // 終了分
        $h3 = $timeAry['h3']; // 開始3時間前
        $he = $timeAry['he']; // 終了1時間後

//------------------------------------------------------------
// データベース・クローズ
//------------------------------------------------------------
pg_close($conn);

//============================================================
// 申込みフォームの読込み
//============================================================
$content="";
reset($tmpl);

while(list(,$value) = each($tmpl)) {
	$i = 0;

	while($FIELD[$i]) {
		$fieldname = $FIELD[$i];
		$value = ereg_replace("#$FIELD[$i]#", $fetch_array[$fieldname], $value);
		$i++;
	}

	$value = ereg_replace("#lch_mobile#", $cl_array['lch_mobile'], $value);
	$value = ereg_replace("#lch_man#", $cl_array['lch_man'], $value);
	$mi = intval($m);
	$yi = intval($y) - 1;
	if ($mi < 4) { $nendo = strval($yi); }
	 else {$nendo = $y;}
	$value = ereg_replace("#n#", $nendo, $value);
	$value = ereg_replace("#y#", $y, $value);
	$value = ereg_replace("#m#", $m, $value);
	$value = ereg_replace("#d#", $d, $value);
	$value = ereg_replace("#w#", $w, $value);
	$value = ereg_replace("#h3#", $h3, $value);
	$value = ereg_replace("#h1#", $h1, $value);
	$value = ereg_replace("#m1#", $m1, $value);
	$value = ereg_replace("#h2#", $h2, $value);
	$value = ereg_replace("#m2#", $m2, $value);
	$value = ereg_replace("#he#", $he, $value);
	$content .= $value;
}

// $content = get_rtf_text($content);

mb_http_output('SJIS');


ob_start('mb_output_handler');
print $content;

?>
