<?php
//############################################################
// newrtf.php
//############################################################
// 1.
// [Authote] 藤田和彦
// [Date]  2009/12/28
// ファイルダウンロード
// 受取り 
// 引渡し 
// [Date]  2012/4/6　修正 InfoExcel.phpへの遷移
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

	return $tAry;
    }

    // 所属と役割分割
    function divideYakuwari($yaku){
	//初期化
	$yakuwari = '';

	if (empty($yaku)) return $sho_yaku;
//	$yaku = preg_replace("/　/"," ",$yaku);
	$yaku = trim($yaku);
//	$banban = explode(" ", $yaku);
	$banban = mb_split("　", $yaku);

	// 配列要素カウント
	$num = count($banban) - 1;
	if ($num <=0 ) return $yakuwari;

	$yakuwari = $banban[$num];

	return $yakuwari;
    }


session_name('AstellasID');
session_start();
header("Cache-Control: public");
header("Pragma: public");
header('Content-Type: text/rtf');

//============================================================
// パラメータの引継ぎと帳票・宛名の判別
//============================================================
$name = substr($_POST['R1'],0,2); // 宛名
$kind = $_POST['R2']; // 帳票種類
$cs_id = substr($_POST['R1'],2); // 座長演者ID

if ($name == 'za') {
	$zaen ="座長";
} else {
	$zaen = "演者";
}

switch ($kind) {
case (1):
	if ($zaen == "座長" ) {
	  header("Content-Disposition: attachment; filename=annaizacho.rtf");
	  $tmpl = file("../../template/annaizacho.rtf");
	} else if ($zaen == "演者" ) {
	  header("Content-Disposition: attachment; filename=annaienzya.rtf");
	  $tmpl = file("../../template/annaienzya.rtf");
	}
	break;
case (2): // 2011.7.21 座長・演者分離
	if ($zaen == "座長" ) {
	  header("Content-Disposition: attachment; filename=iraishozacho.rtf");
	  $tmpl = file("../../template/iraishozacho.rtf");
	} else if ($zaen == "演者" ) {
	  header("Content-Disposition: attachment; filename=iraishoenzya.rtf");
	  $tmpl = file("../../template/iraishoenzya.rtf");
	}
	break;
case (3): // 2011.7.21 座長・演者分離
	if ($zaen == "座長" ) {
	  header("Content-Disposition: attachment; filename=oudakushozacho.rtf");
	  $tmpl = file("../../template/oudakushozacho.rtf");
	} else if ($zaen == "演者" ) {
	  header("Content-Disposition: attachment; filename=oudakushoenzya.rtf");
	  $tmpl = file("../../template/oudakushoenzya.rtf");
	}
	break;
case (4): // 2012.4.9 追加
	if ($zaen == "座長" ) {
	  header("Content-Disposition: attachment; filename=shoheishozacho.rtf");
	  $tmpl = file("../../template/shoheizacho.rtf");
	} else if ($zaen == "演者" ) {
	  header("Content-Disposition: attachment; filename=shoheishoenzya.rtf");
	  $tmpl = file("../../template/shoheienzya.rtf");
	}
	break;
case (5): // 2012.4.6 追加
	header("location: ./InfoExcel.php?semi_id=". $_POST["semi_id"] . "&zaen=" . $name . "&cs_id=" . $cs_id);
	exit;
case (6): // 2016.8.4 追加
	if ($zaen == "座長" ) {
	  header("Content-Disposition: attachment; filename=keiyakuzacho.rtf");
	  $tmpl = file("../../template/keiyakuzacho.rtf");
	} else if ($zaen == "演者" ) {
	  header("Content-Disposition: attachment; filename=keiyakuenzya.rtf");
	  $tmpl = file("../../template/keiyakuenzya.rtf");
	}
	break;
}

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
// セミナーデータ&座長演者情報の読込み
//============================================================
$yakuwari="";
$fetch_array =array();
	$str_user="select * from " . $TBL_NAME . " where semi_id =" . $_POST['semi_id'];
	$result = @pg_exec($conn, $str_user);
        $fetch_array = pg_fetch_array($result,$i,PGSQL_ASSOC);

$zaen_array =array();
	$str_zaen="select * from chairspeaker where semi_id =" . $_POST['semi_id'] . " and cs_status=0 and cs_id = " . $cs_id;
	$result = @pg_exec($conn, $str_zaen);
        $zaen_array = pg_fetch_array($result,$i,PGSQL_ASSOC);
if ($kind!=1) {
    $cl_array =array();
	$str_tantou="select * from lch_tantou where semi_id =" . $_POST['semi_id'] . " and lch_status=0 and lch_code = '会場'";
	$result = @pg_exec($conn, $str_tantou);
        $cl_array = pg_fetch_array($result,$i,PGSQL_ASSOC);
        foreach ($cl_array as $key => $val) {
	  if (empty($val)) {
	    $cl_array[$key] = "_";
	    continue;
	  }
	  if ($key == "lch_tel") {
	    $cl_array[$key] = str_replace("－", "-", $val); // 先生除去
	  }
	  $cl_array[$key] = stripslashes($cl_array[$key]);
	  $cl_array[$key] = mb_convert_encoding(($cl_array[$key]),'SJIS','UTF-8');
	  $cl_array[$key] = sjis2rtf($cl_array[$key]);
        }
}

	// 対象者の判定
	switch ($name) {
	case ('za'):
	case ('en'):
	  $yakuwari = $zaen_array['cs_yaku'];
	  $simei  = $zaen_array['cs_name'];
	  $abs = $zaen_array['cs_endai'];  
	  break;
	case ('z1'):
	  $yakuwari = $fetch_array['cyaku1'];
	  $simei  = $fetch_array['chair1'];
	  break;
	case ('z2'):
	  $yakuwari = $fetch_array['cyaku2'];
	  $simei = $fetch_array['chair2'];
	  break;
	case ('e1'):
	  $yakuwari = $fetch_array['enshayaku1'];
	  $simei = $fetch_array['enshaname1'];
	  $abs = $fetch_array['endai1'];  // 2011.9.26 追加
	  break;
	case ('e2'):
	  $yakuwari = $fetch_array['enshayaku2'];
	  $simei = $fetch_array['enshaname2'];
	  $abs = $fetch_array['endai2'];  // 2011.9.26 追加
	  break;
	case ('e3'):
	  $yakuwari = $fetch_array['enshayaku3'];
	  $simei = $fetch_array['enshaname3'];
	  $abs = $fetch_array['endai3'];  // 2011.9.26 追加
	  break;
	case ('e4'):
	  $yakuwari = $fetch_array['enshayaku4'];
	  $simei = $fetch_array['enshaname4'];
	  $abs = $fetch_array['endai4'];  // 2011.9.26 追加
	}
	$dayAry = divideDate($fetch_array['kaisaibi']); // 日付分断
	if (empty($fetch_array['kaisaiji']) == false) { // 時刻分断
	  $timeAry = divideTime($fetch_array['kaisaiji']);
	}
	// 2013.2.6 2行追加
	$syukan = $fetch_array['syukan']; 
	$syukan2 = $fetch_array['syukan2'];

	// データ取得
        foreach ($fetch_array as $key => $val) {
	  if (empty($val)) {
	    $fetch_array[$key] = "_";
	    continue;
	  }
	  $fetch_array[$key] = stripslashes($fetch_array[$key]);
	  $fetch_array[$key] = mb_convert_encoding(($fetch_array[$key]),'SJIS','UTF-8');
	  $fetch_array[$key] = sjis2rtf($fetch_array[$key]);

        }

	// 要加工データ
	$kabane= getMyouji($simei);  // 苗字抽出
	$kabane = mb_convert_encoding($kabane,'sjis-win','UTF-8');
	$kabane = sjis2rtf($kabane);

	$simei = str_replace("　先生", "", $simei); // 先生除去
	$simei = str_replace(" 先生", "", $simei); // 先生除去
	$simei = str_replace("先生", "", $simei); // 先生除去
	$oudakusimei = $simei; //2014.1.15追加
	$oudakusimei = str_replace(" ", "　", $oudakusimei); //2014.1.15追加
	$simei = mb_convert_encoding($simei,'sjis-win','UTF-8');
	$simei = sjis2rtf($simei);

	if ($kind == 6) {                           // 2016.8.4 追加
	    $onlyYakuwari=divideYakuwari($yakuwari);
	    if (!empty($onlyYakuwari)) {

	    //役職複数者の役職が同じ場合に、前の役職が消えるのを防ぐため@を付加
	        $shozoku = str_replace( $onlyYakuwari."@", "", $yakuwari."@"); 
	    //役職複数者は／の後で改行する
	        $shozoku = str_replace( "／", "／\n", $shozoku); 
		$shozoku = trim($shozoku);

	        $shozoku = mb_convert_encoding($shozoku,'sjis-win','UTF-8');
	        $shozoku = sjis2rtf($shozoku);

	        $yakuwari = $onlyYakuwari;
	    }
	}

	$yakuwari = mb_convert_encoding($yakuwari,'sjis-win','UTF-8');
	$yakuwari = sjis2rtf($yakuwari);
	$zaen = mb_convert_encoding($zaen,'sjis-win','UTF-8');
	$zaen = sjis2rtf($zaen);
	// 2011.9.26 追加 2013.2.8 修正
	if (empty($abs)) {
	  $abs = "_";
        } else {
	  $abs = mb_convert_encoding($abs,'sjis-win','UTF-8');
	  $abs = sjis2rtf($abs);
	}
	// 2013.2.6 追加 4行
	$ten = mb_convert_encoding("・",'sjis-win','UTF-8');
	$ten = sjis2rtf($ten);
	if (!empty($syukan)) $copro = $ten . $fetch_array['syukan'];
	if (!empty($syukan2)) $copro .= $ten . $fetch_array['syukan2'];
	// 2014.1.15 追加 5行
	while (strlen($oudakusimei) < 16 ) {
//	while (mb_strlen($oudakusimei) < 8 ) {
	  $oudakusimei .= "　";
	}
	$oudakusimei = mb_convert_encoding($oudakusimei,'sjis-win','UTF-8');
	$oudakusimei = sjis2rtf($oudakusimei);

        $y = $dayAry['y']; // 年
        $y4 = "20" . $dayAry['y']; // 年
        $m = $dayAry['m']; // 月
        $d = $dayAry['d']; // 日
        $w = $dayAry['w']; // 曜日
	$w = mb_convert_encoding($w,'SJIS','UTF-8');
	$w = sjis2rtf($w);
        $h1 = $timeAry['h1']; // 開始時
        $m1 = $timeAry['m1']; // 開始分
        $h2 = $timeAry['h2']; // 終了時
        $m2 = $timeAry['m2']; // 終了分
        $h0 = $timeAry['h0']; // 開始１時間時

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

	$value = ereg_replace("#yakuwari#", $yakuwari, $value);
	$value = ereg_replace("#shozoku#", $shozoku, $value); // 2016.8.2 追加
	$value = ereg_replace("#simei#", $simei, $value);
	$value = ereg_replace("#osimei#", $oudakusimei, $value);
	$value = ereg_replace("#kabane#", $kabane, $value);
	$value = ereg_replace("#zaen#", $zaen, $value);
	$value = ereg_replace("#abs#", $abs, $value); // 2011.9.26 追加
	$value = ereg_replace("#y#", $y, $value);
	$value = ereg_replace("#y4#", $y4, $value);
	$value = ereg_replace("#m#", $m, $value);
	$value = ereg_replace("#d#", $d, $value);
	$value = ereg_replace("#w#", $w, $value);
	$value = ereg_replace("#h0#", $h0, $value);
	$value = ereg_replace("#h1#", $h1, $value);
	$value = ereg_replace("#m1#", $m1, $value);
	$value = ereg_replace("#h2#", $h2, $value);
	$value = ereg_replace("#m2#", $m2, $value);
	$value = ereg_replace("#lch_addr#", $cl_array['lch_addr'], $value);
	$value = ereg_replace("#lch_tel#", $cl_array['lch_tel'], $value);
	$value = ereg_replace("#lch_zip#", $cl_array['lch_zip'], $value);
	$value = ereg_replace("#copro#", $copro, $value);
	$content .= $value;
//	print $value;
}

// $content = get_rtf_text($content);

mb_http_output('SJIS');

//	mb_language("Ja") ;
//	mb_internal_encoding("SJIS") ;

ob_start('mb_output_handler');
print $content;

?>
