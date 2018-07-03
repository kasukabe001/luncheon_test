<?php
/**
 * InfoExcel.php
 * Parameter semi_id
 * Parameter zaen 
 * Excelファイル(インフォメーションシート)にデータを出力する
 */

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


session_cache_limiter('public');
session_name('AstellasID'); // 2012.3.24追加
session_start();
/**
 * DIRECTORY PATH
 */
//webapp directory path


//libraries directory path
define('_LIB_DIR_', '/home/kyousai/webapp/libs/');

ini_set('include_path', _LIB_DIR_ . 'pear:' . ini_get('include_path'));


require_once "PHPExcel.php";
require_once "PHPExcel/IOFactory.php";


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

//------------------------------------------------------------
// PHPExcelオブジェクトを生成
//------------------------------------------------------------
$objPHPExcel = new PHPExcel();

// テンプレートをオープン
// $objReader = PHPExcel_IOFactory::createReader('Excel2007');///.xlsの場合は（）ないにExcel5を
$objReader = PHPExcel_IOFactory::createReader('Excel5');///.xlsの場合は（）ないにExcel5を
if ($_GET['zaen'] == "za") {
    $objPHPExcel = $objReader->load("../../template/infozacho.xls");///これが実際のファイル名
} else {
    $objPHPExcel = $objReader->load("../../template/infoensha.xls");///これが実際のファイル名
}
$objPHPExcel->setActiveSheetIndex(0);////シートの1番目に移動
$sheet=$objPHPExcel->getActiveSheet();


//============================================================
// seminar,座長,演者データの読込み
//============================================================
$str_user="select * from " . $TBL_NAME . " where semi_id =" . $_GET['semi_id'];
$result = @pg_exec($conn, $str_user);
$fetch_array = pg_fetch_array($result,$i,PGSQL_ASSOC);

// データ変換
foreach ($fetch_array as $key => $val) {
    $fetch_array[$key] = stripslashes($fetch_array[$key]);
//    $fetch_array[$key] = mb_convert_encoding(($fetch_array[$key]),'UTF-8','EUC-JP');
}

$str_zaen="select * from chairspeaker where semi_id =" . $_GET['semi_id'] . " and cs_status=0 and cs_id = " . $_GET['cs_id'];
$result = @pg_exec($conn, $str_zaen);
$row = pg_fetch_array($result,$i,PGSQL_ASSOC);
foreach ($row as $key => $val) {
    $row[$key] = stripslashes($row[$key]);
//    $row[$key] = mb_convert_encoding(($row[$key]),'UTF-8','EUC-JP');
}

//============================================================
// セルに値をセットする
//============================================================
// $ensha = mb_convert_encoding("演者",'UTF-8','EUC-JP');
$tantou = "担当"; // mb_convert_encoding("担当",'UTF-8','EUC-JP');
// セミナー情報
$sheet->setCellValue("G5", $tantou . ":" . $fetch_array['cltantou']); 
$sheet->setCellValue("B11", $fetch_array['gakkai']); 
$sheet->setCellValue("G11", $fetch_array['seminar']); 

$dayAry = divideDate($fetch_array['kaisaibi']); // 日付分断
$kaisaibi=$dayAry['y'] ."/" .$dayAry['m'] . "/" . $dayAry['d'];

$sheet->setCellValue("G12", $kaisaibi . " " . $fetch_array['kaisaiji']); 
$sheet->setCellValue("C12", $fetch_array['place']); 


// 座長 or 演者
// 氏名の 先生 欠落対策
$teacher = "先生"; // mb_convert_encoding("先生",'UTF-8','EUC-JP');
$row['cs_name'] = str_replace($teacher, "", $row['cs_name']); // 一旦先生除去

$sheet->setCellValue("C16", $row['cs_yaku']); 
$sheet->setCellValue("G16", $row['mr_eigyo']); 
$sheet->setCellValue("C18", $row['cs_name']); 
$sheet->setCellValue("C19", $row['cs_kana']); 


//------------------------------------------------------------
// エクセルファイルをブラウザに書き出し
//------------------------------------------------------------
//ヘッダーの設定
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="information.xlsx"');
header('Content-Disposition: attachment;filename="information.xls"');
header('Cache-Control: max-age=0');

//出力
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output'); 


//------------------------------------------------------------
// データベース・クローズ
//------------------------------------------------------------
pg_close($conn);

?>
