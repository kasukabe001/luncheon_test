<?php
//############################################################
// download.php
//############################################################
// Data download For fujisawa,nisitetu,MR
// For Excel work sheet
// [Author] fujita
// [date] 2003/12/1
// 2004.2.18 Drのみの全項目リストを追加
// 2004.4.21 $cancel_flag:1のときキャンセル 
//	$num = 12;$num2=13;$num3=14;
//  $num:支店 $num2:status $nums:キャンセル日
//############################################################


//------------------------------------------------------------
// パラメータの判定 条件作成
//------------------------------------------------------------
function ParamChk($jou){
$nd="";
$stat="";
$rk="";
$kb="";
$gk="";

$n1 = substr($jou,0,2);
$s1 = substr($jou,2,1);
$r1 = substr($jou,3,1);
$k1 = substr($jou,4,2);
$z1 = substr($jou,6,1);
$gk = substr($jou,7);

$gk = urldecode($gk);
//$gk = mb_convert_encoding($gk,"eucJP-win","UTF-8"); 

// 2010.9 追加
$hm = $_GET['hm'];
$hm = urldecode($hm);
//$hm = mb_convert_encoding($hm,"eucJP-win","UTF-8"); 
$pl = $_GET['pl'];
$pl = urldecode($pl);
//$pl = mb_convert_encoding($pl,"eucJP-win","UTF-8"); 
$ze = $_GET['ze'];
$ze = urldecode($ze);
//$ze = mb_convert_encoding($ze,"eucJP-win","UTF-8"); 

switch ($n1) {
  case(1):
  $nd="nendo = 2007";
  break;
  case(2):
  $nd="nendo = 2008";
  break;
  case(3):
  $nd="nendo = 2009";
  break;
  case(4):
  $nd="nendo = 2010";
  break;
  case(5):
  $nd="nendo = 2011";
  break;
  case(6):
  $nd="nendo = 2012";
  break;
  case(7):
  $nd="nendo = 2013";
  break;
  case(8):
  $nd="nendo = 2014";
  break;
  case(9):
  $nd="nendo = 2015";
  break;
  case(10):
  $nd="nendo = 2016";
  break;
  case('11'):
  $nd="nendo = 2017";
}
switch ($s1) {
  case(1):
  $stat="status = '進行中'";
  break;
  case(2):
  $stat="status = '終了'";
}
switch ($r1) {
  case(1):
  $rk="ryoiki like '%循環器%'";
  break;
  case(2):
  $rk="ryoiki like '%免疫%'";
  break;
  case(3):
  $rk="ryoiki like '%感染症%'";
  break;
  case(4):
  $rk="ryoiki like '%中枢%'";
  break;
  case(5):
  $rk="ryoiki like '%泌尿器%'";
  break;
  case(6):
  $rk="ryoiki like '%消化器%'";
  break;
  case(7):
  $rk="ryoiki like '%マーケ%'";
  break;
  case(8):
  $rk="ryoiki like '%その%'";
}


if ($k1 == "00") { // month
  $kb="";
} else {
  $kb="kaisaibi like '%/" . $k1 . "/%'";
}
if (!empty($gk)) {
  $gk="gakkai like '%" . $gk . "%'";
}
if (!empty($hm)) {
  $hm="hinmoku like '%" . $hm . "%'";
}
if (!empty($pl)) {
  $pl = "place like '%" . $pl . "%'"; 
}
if (!empty($ze)) {
  if ($z1 == 0) {
//    $zaen = "Both";
    $ze = "semi_id in (select semi_id from chairspeaker where cs_name like '" . $ze . "%')"; 
  } else if ($z1 == 1) {
//    $zaen = "chair";
    $ze = "semi_id in (select semi_id from chairspeaker where cs_yakuwari = '座長' and cs_name like '" . $ze . "%')"; 
  } else if ($z1 == 2) {
//    $zaen = "ensha";
    $ze = "semi_id in (select semi_id from chairspeaker where cs_yakuwari = '演者' and cs_name like '" . $ze . "%')"; 
  }
}

  $where = " oid > 0";
  if ($nd != "") $where .= " and " . $nd ;
  if (!empty($stat)) $where .= " and " . $stat;
  if (!empty($rk)) $where .= " and " . $rk;
  if (!empty($kb)) $where .= " and " . $kb;
  if (!empty($gk)) $where .= " and " . $gk;
  if (!empty($hm)) $where .= " and " . $hm;
  if (!empty($pl)) $where .= " and " . $pl;
  if (!empty($ze)) $where .= " and " . $ze;

  return ($where);
}

//------------------------------------------------------------
// chairspeakerテーブルより座長演者情報の取得
//------------------------------------------------------------
// parameter Integer セミナーID
// parameter Integer 0:座長 1:演者
// return string
function DataConv($semi_id,$flag){

    if ($flag==1) {
	$zaen ="演者";
	$loop = 6;
    } else {
	$zaen ="座長";
	$loop = 3;
    }

    $sqlstr = "select cs_name,cs_yaku from chairspeaker where semi_id = " . $semi_id;
    $sqlstr .= " and cs_yakuwari = '" . $zaen . "' and cs_status=0 order by detail";

    $longvar="";
    $res = pg_exec($sqlstr);

    for ($i=0;$i<$loop;$i++) {
	$data = pg_fetch_array($res,$i);
	if ($i==$loop - 1) {
            $longvar .= $data['cs_name'] . "</TD><TD>" . $data['cs_yaku'] ;
	} else {
            $longvar .= $data['cs_name'] . "</TD><TD>" . $data['cs_yaku'] . "</TD><TD>";
	}
    }

  return $longvar;
}

session_cache_limiter('public');
set_time_limit(15);
session_name('AstellasID');
session_start( );

// 不正遷移のチェック
$Error ="";
if( !$_SESSION['USERID'] ) {
  $Error .= "<LI>ユーザIDを指定してください";
}

if( !$_SESSION['PWD'] ) {
  $Error .= "<LI>パスワードを指定してください";
}

if( $Error ) {
  include ("../../com212/php/error_header.php");
  print $Error;
  include_once ("../../com212/php/close_footer.php");
  exit;
}
$brow = getenv("HTTP_USER_AGENT");
header("Content-Type: application/vnd.ms-excel");
if (mb_ereg("Chrome", $brow)) {
  header("Content-disposition: attachment; filename=seminar.xls");
  header("Content-type: octet-stream");
} else {
  header("Content-disposition: attachment; filename=seminar.xls");
}
include_once("../../com212/inc/const.inc");

//------------------------------------------------------------
// Parametaの判定
// modea,modeb:アステラス用 modec:リンケージ用
//------------------------------------------------------------
$pp = $_SESSION['param']; 

// 検索条件の取得
$jouken = ParamChk($_GET['pm']);
//print $jouken;
//------------------------------------------------------------
// データベース・オープン
//------------------------------------------------------------
$conn = pg_connect($OPEN);
if($conn == false) {
	print("dbutil: DB open failed\n");
	exit;
}

//------------------------------------------------------------
// SQL文連結作成
//------------------------------------------------------------
$sql_img = "select ";
if (($pp == $modea) || ($pp == $modeb)) { //アステラス用リスト
  $sql_img .= "semi_id as ＩＤ,gakkai as 学会名,hinmoku as 品目,seminar as セミナー名, ryoiki as 領域,";
  $sql_img .= "kaisaibi as セミナー開催日,kaisaiji as 開催時間,kaiki as 会期,place as 会場,";
  $sql_img .= "thema as テーマ,chair1 as 座長1,cyaku1 as 座長1役職,chair2 as 座長2,cyaku2 as 座長2役職,";
  $sql_img .= "syukan as 共催,sekinin as 責任者,cltantou as ＣＬ窓口,";
  $sql_img .= "amail as 案内メール,annai2 as 案内状送付,iraijo as 依頼書・招聘状, oudaku as 応諾書,";
  $sql_img .= "tirasi1 as チラシ作成依頼,tirasi2 as チラシ経過・完成,tirasi3 as チラシ納品日,";
  $sql_img .= "syoroku as 抄録締切,hikae_a as 控室案内,syuku_k as 宿泊確認,";
  $sql_img .= "tojitu as 当日配布物手配, cv as CV入手,sharei as 謝金支払完了,";
  $sql_img .= "yakubun2 as 分担表最終版送付,";
  $sql_img .= "report as 報告書,status as 進行状況,";
  $sql_img .= "zaseki as 座席数,bento as 弁当数,nyujosha as 入場者数,an_kaisyu as アンケート回収者数 ";
  $sql_img .= " from " . $TBL_NAME;
} else if ($pp == $modec) {  //リンケージ用リスト
  $sql_img .= "semi_id as ＩＤ,gakkai as 学会名,hinmoku as 品目,seminar as セミナー名, ryoiki as 領域,";
  $sql_img .= "kaisaibi as セミナー開催日,kaisaiji as 開催時間,kaiki as 会期,place as 会場,";
  $sql_img .= "thema as テーマ, chair1 as 座長1,enshaname1 as 演者1,";
// chair1 as 座長1,cyaku1 as 座長1役職,chair2 as 座長2,cyaku2 as 座長2役職,";
//  $sql_img .= "enshaname1 as 演者1,enshayaku1 as 演者1役職,enshaname2 as 演者2,enshayaku2 as 演者2役職,";
//  $sql_img .= "enshaname3 as 演者3,enshaname4 as 演者4,enshayaku3 as 演者3役職,enshayaku4 as 演者4役職,";
  $sql_img .= "syukan as 共催,sekinin as 責任者,cltantou as ＣＬ窓口,";
  $sql_img .= "amail as 案内メール,annai1 as 案内状作成,annai2 as 案内状送付,yoko as 要綱入手,";
  $sql_img .= "tirasi1 as チラシ作成依頼,tirasi2 as チラシ経過・完成,tirasi3 as チラシ納品日,";
  $sql_img .= "mousi_add as 追加申込,mousi_c as 申込締切,mousi_k as 申込内容確認,";
  $sql_img .= "syoroku as 抄録締切,kaijo_k as 会場確認,hikae_k as 控室確認,";
  $sql_img .= "hikae_a as 控室案内,syuku_k as 宿泊確認,";
  $sql_img .= "tojitu as 当日配布物手配,yakubun2 as 分担表最終版送付,";
/*
 cv as CV入手,sharei as 謝金支払完了,";
  $sql_img .= "shaman1 as 謝金氏名1,shahi1 as 支払日1,shaman2 as 謝金氏名2,shahi2 as 支払日2,";
  $sql_img .= "shaman3 as 謝金氏名3,shahi3 as 支払日3,shaman4 as 謝金氏名4,shahi4 as 支払日4,";
  $sql_img .= "yakubun1 as 分担表Ver1送付,last_m as 最終Ｍ,yakubun2 as 分担表最終版送付,";
*/
  $sql_img .= "report as 報告書,status as 進行状況,";
  $sql_img .= "zaseki as 座席数,bento as 弁当数,nyujosha as 入場者数,an_kaisyu as アンケート回収者数,";
  $sql_img .= "cl1 as メモ1,cl2 as メモ2,cl3 as メモ3 ";
  $sql_img .= " from " . $TBL_NAME;
}
$sql_img .= " where (sys_stat = 0 or sys_stat is null) and " . $jouken;
$sql_img .= " order by semi_id";

	$result = pg_exec($sql_img);
//	$lvl = error_reporting(53);
	$rows = pg_numrows($result);
	if ($rows <= 0) {
	  $errmsg = "<p>該当データがありません</p>";
	} else {
	  $data = pg_fetch_array($result,0);
	  $max = pg_numfields($result);
	}


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ja">
<title>seminar list</title>
</head>
<body>
<!-- table -->
<tr>
<?php
	print $outstr;

	if ($rows <= 0) {
	  print $errmsg;
	} else {
// header output
	  $outstr = "<table border=1>";
	  $outstr .= "<tr>";
	  for($ix=0;$ix<$max;$ix++) {
	    $outstr .= "<th nowrap>";
	    if ($ix ==10) {
		$outstr .= "座長1</th><th>座長1役職</th><th>座長2</th><th>座長2役職</th><th>座長3</th><th>座長3役職";
	    } else if ($ix ==11) {
		$outstr .= "演者1</th><th>演者1役職</th><th>演者2</th><th>演者2役職</th><th>演者3</th><th>演者3役職</th><th>";
		$outstr .= "演者4</th><th>演者4役職</th><th>演者5</th><th>演者5役職</th><th>演者6</th><th>演者6役職";
	    } else {
	        $outstr .= pg_fieldname($result,$ix);
	    }
	    $outstr .= "</th>";
	  }
	  $outstr .= "</tr>";
	//fputs($fp,$outstr);
	  print $outstr;

// data output
	for($j=0;$j<$rows;$j++){
	    $cancel_flag = 0; 
		$outstr = "<tr>";
		$data = pg_fetch_array($result,$j);
		for($fnum=0;$fnum<$max;$fnum++) {
		    if ($fnum ==10) {
			$val = DataConv($data[0],0);
		    } else if ($fnum ==11) {
			$val = DataConv($data[0],1);
		    } else {
			$val = $data["$fnum"];
		    }
		    $val = ereg_replace("\n"," ",$val);
		    if ($val == '') {
			$val .= "<br>";
		    }
		    $outstr .= "<td nowrap>";
		    $outstr .= $val; // mb_convert_encoding($val,'','UTF-8EUC-JP');
		    $outstr .= "</td>";
		}
		$outstr .= "</tr>";
		print $outstr;
	}
	$outstr = "</table>";
	print $outstr;
	}
//------------------------------------------------------------
// データベース・クローズ
//------------------------------------------------------------
pg_close($conn);

?>

</body>
</html>
