<?php
/**
 * Excelファイル(運営報告書)にデータを出力する
 * PHPExcel.phpを使用
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
$objPHPExcel = $objReader->load("../../template/uneihoukoku.xls");///これが実際のファイル名
$objPHPExcel->setActiveSheetIndex(0);////シートの1番目に移動

$sheet=$objPHPExcel->getActiveSheet();


//============================================================
// seminar,座長,演者データの読込み
//============================================================
$yakuwari="";
$fetch_array =array();
	$str_user="select * from " . $TBL_NAME . " where semi_id =" . $_GET['semi_id'];
	$result = @pg_exec($conn, $str_user);
        $fetch_array = pg_fetch_array($result,$i,PGSQL_ASSOC);

$zacho_array =array();
$enja_array =array();
$j=0;
$ensha = "演者"; // mb_convert_encoding("演者",'UTF-8','EUC-JP');

	$str_zaen="select * from chairspeaker where semi_id =" . $_GET['semi_id'] . " and cs_status=0 and cs_name != '' order by cs_yakuwari desc,detail";
	$result = @pg_exec($conn, $str_zaen);
        $num_rows = pg_num_rows($result);
        for( $i=0; $i < $num_rows; ++$i ) {
          $row = pg_fetch_array($result,$i,PGSQL_ASSOC);
          foreach ($row as $key => $val) {
	    $row[$key] = stripslashes($row[$key]);
//	    $row[$key] = mb_convert_encoding(($row[$key]),'UTF-8','EUC-JP');
          }
	  if ($row['cs_yakuwari'] == $ensha) {
            $enja_array[$j] = $row;
	    $j ++;
	  } else {
            $zacho_array[$i] = $row;
	  }
        }

	// データ取得
        foreach ($fetch_array as $key => $val) {
	  $fetch_array[$key] = stripslashes($fetch_array[$key]);
//	  $fetch_array[$key] = mb_convert_encoding(($fetch_array[$key]),'UTF-8','EUC-JP');
        }

// フォント色セット   
$sheet->getStyle( "A1:R35" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
$sheet->getStyle( "A1" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);

// セルに値をセットする
$sheet->setCellValue("C5", $fetch_array['gakkai']); 

// 会期
if (!empty($fetch_array['kaiki'])) {
    $vpos = strpos($fetch_array['kaiki'],"-");
    $begin = substr($fetch_array['kaiki'],0,$vpos);
    $end = substr($fetch_array['kaiki'],$vpos + 1);
    if ($vpos==0) {  // 2012.12.05追加
	$begin = $fetch_array['kaiki'];
    }

    // 初め
    $begin_array = explode("/", $begin); // /で分割
    $beginj = date("Y年n月j日" , mktime(0,0,0,$begin_array[1],$begin_array[2],$begin_array[0]));
//    $beginj = mb_convert_encoding($beginj,'UTF-8','EUC-JP');
    $sheet->setCellValue("C6", $beginj);
    // 終わり
    if (strlen($end) < 3)  { // 2桁以下なら日だけ
	$endj = $end . "日";
    } else { // 3桁以上なら月と日 年をまたがって開催されることはないはず
	$end_array = explode("/", $end); // /で分割
	$endj = date("n月j日" , mktime(0,0,0,$end_array[0],$end_array[1],$begin_array[0]));
    }
    if ($vpos==0) {  // 2012.12.05追加
	$endj = "";
	$sheet->setCellValue("J6", $endj);
    }
//    $endj = mb_convert_encoding($endj,'UTF-8','EUC-JP');
    $sheet->setCellValue("K6", $endj,$vpos + 1);
}


$sheet->setCellValue("C7", $fetch_array['place']); 
$sheet->setCellValue("C9", $fetch_array['seminar']); 
$sheet->setCellValue("L9", $fetch_array['hinmoku']); //品目

$dayAry = divideDate($fetch_array['kaisaibi']); // 日付分断
$kaisaibi=$dayAry['y'] ."/" .$dayAry['m'] . "/" . $dayAry['d'];

$sheet->setCellValue("C10", $kaisaibi . " " . $fetch_array['kaisaiji']); 
$sheet->setCellValue("C11", $fetch_array['bento']); //参加者数

// 氏名の 先生 欠落対策
$teacher = "先生"; //mb_convert_encoding("先生",'UTF-8','EUC-JP');
/*
*/

// 座長
$rpos = 13;$no= 1;
if ( (empty($zacho_array[0]['cs_name'])==false) || (empty($zacho_array[0]['cs_yaku'])==false) ) {
  $sheet->setCellValue("A" . $rpos, $no); 
  $sheet->setCellValue("C" . $rpos, $zacho_array[0]['cs_name']); 
  $sheet->setCellValue("L" . $rpos, $zacho_array[0]['cs_yaku']); // 座長所属
  $no += 1;$rposTo = $rpos+2;
} else {
  $sheet->getRowDimension($rpos)->setVisible(false);
}
$rpos += 1;
if ( (empty($zacho_array[1]['cs_name'])==false) || (empty($zacho_array[1]['cs_yaku'])==false) ) {
    $sheet->setCellValue("A" . $rpos, $no); 
    $sheet->setCellValue("C" . $rpos, $zacho_array[1]['cs_name']); 
    $sheet->setCellValue("L" . $rpos, $zacho_array[1]['cs_yaku']); 
    $no += 1;$rposTo = $rpos+1;
} else {
    $sheet->getRowDimension($rpos)->setVisible(false);
}
$rpos += 1;
if ( (empty($zacho_array[2]['cs_name'])==false) || (empty($zacho_array[2]['cs_yaku'])==false) ) {
    $sheet->setCellValue("A" . $rpos, $no); 
    $sheet->setCellValue("C" . $rpos, $zacho_array[2]['cs_name']); 
    $sheet->setCellValue("L" . $rpos, $zacho_array[2]['cs_yaku']); 
    $no += 1;$rposTo =0;
} else {
    $sheet->getRowDimension($rpos)->setVisible(false);
}
$rpos += 1;

// 演者
$enjamax = 8; //演者最大数
for ($i=0;$i<$enjamax;$i++) {
    if ((empty($enja_array[$i]['cs_name']) == false) || (empty($enja_array[$i]['cs_endai']) == false) || (empty($enja_array[$i]['cs_yaku']) == false)) {
      $sheet->setCellValue("A" . $rpos, $no); 
      $sheet->setCellValue("C" . $rpos, $enja_array[$i]['cs_name']); 
      $sheet->setCellValue("L" . $rpos, $enja_array[$i]['cs_endai']); // 演者1演題
      $rpos += 1;$enjaend = $rpos;
      $sheet->setCellValue("C" . $rpos, $enja_array[$i]['cs_yaku']); 
      $rpos += 1;$no += 1;
    } else {
      $sheet->getRowDimension($rpos)->setVisible(false);
      $sheet->getRowDimension($rpos+1)->setVisible(false);
      $rpos += 2;
    }
}
for ($i=0;$i<18;$i++) {
   $sheet->getStyleByColumnAndRow($i, $enjaend)->
     getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
}

/*
*/

//------------------------------------------------------------
// エクセルファイルをブラウザに書き出し
//------------------------------------------------------------
//ヘッダーの設定
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="image_test.xlsx"');
header('Content-Disposition: attachment;filename="houkoku.xls"');
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
