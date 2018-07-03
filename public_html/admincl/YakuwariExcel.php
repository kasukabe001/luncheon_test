<?php
/**
 * Excelファイルにデータを出力する
 * PHPExcel.phpを使用
 */
session_cache_limiter('public');
session_name('AstellasID');
session_start();

/**
 * DIRECTORY PATH
 */
//webapp directory path

require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';
require_once _MODULE_DIR_.'TehaiDAO.php';
require_once _MODULE_DIR_ . 'AllData.php';

// Excel libraries directory path
define('_LIB2_DIR_', '/home/kyousai/webapp/libs/');
ini_set('include_path', _LIB2_DIR_ . 'pear:' . ini_get('include_path'));

require_once "PHPExcel.php";
require_once "PHPExcel/IOFactory.php";

//DB
$dbh =& new MembersDAO();
$thdbh =& new TehaiDAO();
//データ保管class
$dbcl =& new AllData();

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
// PHPExcelオブジェクトを生成
//------------------------------------------------------------
$objPHPExcel = new PHPExcel();

// テンプレートをオープン
// $objReader = PHPExcel_IOFactory::createReader('Excel2007');///.xlsの場合は（）ないにExcel5を
$objReader = PHPExcel_IOFactory::createReader('Excel5');///.xlsの場合は（）ないにExcel5を
$objPHPExcel = $objReader->load("../../template/yakuwaribuntan.xls");///これが実際のファイル名

//============================================================
// ユーザデータの読込み
//
//============================================================
$semi_id=trim($_GET['semi_id']);
$row = $dbh->selectById($semi_id,'semi_id');
$dbcl->luncheonSet($row);
$zachorow = $dbh->selectZacho($semi_id,'座長',2);
$dbcl->zachoSet($zachorow);

$ensharow = $dbh->selectZacho($semi_id,'演者',2);
if (count($ensharow) == 0) {
    include_once ("../../com212/php/error_header.php");
    print "演者データがありません!";
    include_once ("../../com212/php/close_footer2012.php");
    exit;
}
$dbcl->enshaSet($ensharow);
$tehairow = $thdbh->selectAll($semi_id,'detail',1);
if (count($tehairow) == 0) {
    print "手配物データがありません!";
    include_once ("../../com212/php/close_footer2012.php");
    exit;
}

$sinakazu = $thdbh->selectTehaiNum($semi_id);
$dbcl->tehaiSet($tehairow);

$thdbh->table="jinin";
$jininrow = $thdbh->selectAll($semi_id,'detail',1);
$dbcl->jininSet($jininrow);

$dbh->table = 'lch_tantou';
$lch_tantourow = $dbh->selectTantouInit('each',0,$semi_id);
$dbcl->lch_tantouSet($lch_tantourow);

//============================================================
// 最大値設定
//============================================================
$jininMax=9;
$tehai_hMax=12;
$tehai_kMax=17;

//============================================================
//シートの1番目に移動
//============================================================
$objPHPExcel->setActiveSheetIndex(0);
$sheet=$objPHPExcel->getActiveSheet();


//============================================================
// セルに値をセットする
//============================================================
//見出し部
//$head1a="(会員数:";
//$head1b="名、参加予定数:";
//$head1c="名)";
$head1a = "(会員数:"; // mb_convert_encoding("(会員数:",'UTF-8','eucJP-win');
$head1b = "名、参加予定数:"; // mb_convert_encoding("名、参加予定数:",'UTF-8','eucJP-win');
$head1c = "名)"; // mb_convert_encoding("名)",'UTF-8','eucJP-win');
$head1=$head1a . $dbcl->luncheon['yobi1'] . $head1b . $dbcl->luncheon['hotel'] . $head1c;

$sheet->setCellValue("A1", $dbcl->luncheon['gakkai'] . $head1); 
$sheet->setCellValue("A2", $dbcl->luncheon['seminar']); 
$head3a = "アステラス製薬株式会社"; // mb_convert_encoding("アステラス製薬株式会社",'UTF-8','EUC-JP');
$head3 = $head3a;
if (empty($dbcl->luncheon['syukan']) == false) {
   $head3=$head3a . "/" . $dbcl->luncheon['syukan'] ;
} 
if (empty($dbcl->luncheon['syukan2']) == false) {
   $head3=$head3a . "/" .$dbcl->luncheon['syukan'] . "/" . $dbcl->luncheon['syukan2'];
}
$sheet->setCellValue("A3", $head3); 

//セミナー情報
$dayAry = $dbcl->divideDate($dbcl->luncheon['kaisaibi']); // 日付分断
$nen = " 年 "; // mb_convert_encoding(" 年 ",'UTF-8','EUC-JP');
$tuki = " 月 "; // mb_convert_encoding(" 月 ",'UTF-8','EUC-JP');
$hi = " 日 "; // mb_convert_encoding(" 日 ",'UTF-8','EUC-JP');
//$dayAry['w'] = mb_convert_encoding($dayAry['w'],'UTF-8','EUC-JP');
$kaisaibi=$dayAry['y'] .$nen .$dayAry['m'] . $tuki . $dayAry['d'] . $hi . "(" .$dayAry['w'] . ")";
$kaiki = $dbcl->kaikiJpn($dbcl->luncheon['kaiki'],$dbcl->luncheon['kaisaibi']);
$sheet->setCellValue("C6", $kaisaibi . " " .$dbcl->luncheon['kaisaiji']. " " . $kaiki);

$sheet->setCellValue("C7", $dbcl->luncheon['place']); 
$zaseki = "(座席："; //mb_convert_encoding("(座席：",'UTF-8','EUC-JP');
$heya = $dbcl->getRoomName($dbcl->luncheon['place']);
if (!empty($heya)) { $zaseki = $heya . $zaseki; }
$sheet->setCellValue("G7", $zaseki. $dbcl->luncheon['zaseki'] .")" ); //部屋名
$sheet->setCellValue("C8", $dbcl->luncheon['hikae_k']); //控室
$sheet->setCellValue("G8", $dbcl->luncheon['hikae_t']); //控室利用時間

$starttime = $dbcl->startSeminar($dbcl->luncheon['kaisaiji']);
$utiawase = $dbcl->beforeTime($starttime,45,1);
$sheet->setCellValue("C9", $utiawase);

//集合時刻
$syugo1 = "に"; // mb_convert_encoding("に",'UTF-8','EUC-JP');
$syugo2 = "に集合"; // mb_convert_encoding("に集合",'UTF-8','EUC-JP');
$zaentime = $dbcl->beforeTime($starttime,45);
$stafftime = $dbcl->beforeTime($starttime,90);
$zaenmes = $dbcl->luncheon['hikae_k'] . $syugo1 . $zaentime . $syugo2;
$sheet->setCellValue("D11", $zaenmes); //座長演者集合時刻
$staffmes = $dbcl->luncheon['hikae_k'] . $syugo1 . $stafftime .  $syugo2;
$sheet->setCellValue("D12", $staffmes); //スタッフ集合時刻

// 座長
$chair = "座長"; // mb_convert_encoding("座長",'UTF-8','EUC-JP');
$thema = "テーマ"; // mb_convert_encoding("テーマ",'UTF-8','EUC-JP');
// $maru = mb_convert_encoding("●",'UTF-8','EUC-JP');
$arrow = "→"; //mb_convert_encoding("→",'UTF-8','EUC-JP');
$rpos = 17;
$zachoNum = count($dbcl->zacho);
for ($i=0;$i <$zachoNum; $i++) {
    $sheet->setCellValue("A" . $rpos, $chair . $dbcl->convZen($i+1)); 
    $sheet->setCellValue("B" . $rpos, $dbcl->zacho[$i]['cs_name']); 
    $sheet->setCellValue("D" . $rpos, $dbcl->zacho[$i]['cs_kana']); 
    $sheet->setCellValue("E" . $rpos, $dbcl->zacho[$i]['cs_yaku']);
    // 斜線
    $style = $sheet->getStyle('F73');
    $sheet->duplicateStyle($style, "F" . $rpos);
    $style = $sheet->getStyle('G73');
    $sheet->duplicateStyle($style, "G" . $rpos);
    $style = $sheet->getStyle('H73');
    $sheet->duplicateStyle($style, "H" . $rpos);
    $style = $sheet->getStyle('I73');
    $sheet->duplicateStyle($style, "I" . $rpos);
    $style = $sheet->getStyle('J73');
    $sheet->duplicateStyle($style, "J" . $rpos);

    $rpos += 1;
    $sheet->setCellValue("B" . $rpos, $thema);
    $sheet->setCellValue("C" . $rpos, $dbcl->luncheon['thema']);
    $sheet->setCellValue("H" . $rpos, $dbcl->zacho[$i]['mr_setsugu']);
    $sheet->setCellValue("I" . $rpos, "(" . $dbcl->zacho[$i]['mr_name']."MR)");
    $rpos += 1;
    $sheet->setCellValue("C" . $rpos, $dbcl->zacho[$i]['ourai'] . ":".$dbcl->zacho[$i]['iki'] );
    $sheet->setCellValue("G" . $rpos, $dbcl->zacho[$i]['inn_hotel']);
    $rpos += 1;
    $sheet->setCellValue("C" . $rpos, $dbcl->ensha[$i]['fukuri'] . ":".$dbcl->zacho[$i]['kaeri'] );
    if ((empty($dbcl->zacho[$i]['inn_in']) == false) || (empty($dbcl->zacho[$i]['inn_out']) == false)) {
      $sheet->setCellValue("G" . $rpos, $dbcl->zacho[$i]['inn_in'] . $arrow .$dbcl->zacho[$i]['inn_out'] );
    }
    $rpos += 2;
}

// 演者
$ensha = "演者"; // mb_convert_encoding("演者",'UTF-8','EUC-JP');
$enshaNum = count($dbcl->ensha);
for ($i=0;$i <$enshaNum; $i++) {
    $sheet->setCellValue("A" . $rpos, $ensha . $dbcl->convZen($i+1)); 
    $sheet->setCellValue("B" . $rpos, $dbcl->ensha[$i]['cs_name']); 
    $sheet->setCellValue("D" . $rpos, $dbcl->ensha[$i]['cs_kana']); 
    $sheet->setCellValue("E" . $rpos, $dbcl->ensha[$i]['cs_yaku']); 
    $sheet->setCellValue("F" . $rpos, $dbcl->ensha[$i]['os']);
    $sheet->setCellValue("G" . $rpos, $dbcl->ensha[$i]['mochikomi']);
    $sheet->setCellValue("H" . $rpos, $dbcl->ensha[$i]['soft'] . "\r" .$dbcl->ensha[$i]['version']);
    $sheet->setCellValue("I" . $rpos, $dbcl->ensha[$i]['douga']);
    $sheet->setCellValue("J" . $rpos, $dbcl->ensha[$i]['onsei']);
    $rpos += 1;
    $sheet->setCellValue("C" . $rpos, $dbcl->ensha[$i]['cs_endai']);
    $sheet->setCellValue("H" . $rpos, $dbcl->ensha[$i]['mr_setsugu']);
    $sheet->setCellValue("I" . $rpos, "(" . $dbcl->ensha[$i]['mr_name']."MR)");
    $rpos += 1;
    $sheet->setCellValue("C" . $rpos, $dbcl->ensha[$i]['ourai'] . ":".$dbcl->ensha[$i]['iki'] );
    $sheet->setCellValue("G" . $rpos, $dbcl->ensha[$i]['inn_hotel']);
    $rpos += 1;
    $sheet->setCellValue("C" . $rpos, $dbcl->ensha[$i]['fukuri'] . ":".$dbcl->ensha[$i]['kaeri'] );
    if ((empty($dbcl->ensha[$i]['inn_in']) == false) || (empty($dbcl->ensha[$i]['inn_out']) == false)) {
      $sheet->setCellValue("G" . $rpos, $dbcl->ensha[$i]['inn_in'] . $arrow . $dbcl->ensha[$i]['inn_out'] );
    }
    $rpos += 2;
}
// 余分な行を削除
$rposTo=$rpos+46;
$objPHPExcel->getActiveSheet()->removeRow($rpos,$rposTo);


// 2枚目
$objPHPExcel->setActiveSheetIndex(1);//2枚目のシートに移動
$sheet=$objPHPExcel->getActiveSheet();
$jininNum = count($dbcl->jinin);
//$sheet->getStyle( "A3:G10" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
//$sheet->getStyle( "A13:G13" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
//$sheet->getStyle( "A16:G16" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$rpos = 3;
for ($i=0;$i < $jininNum; $i++) {
    if (empty($dbcl->jinin[$i]['ji_yakuwari']) == true) continue;
    $sheet->setCellValue("A" .$rpos , $dbcl->jinin[$i]['ji_yakuwari']);
    $sheet->setCellValue("B" .$rpos , $dbcl->jinin[$i]['ji_as']);
    $sheet->setCellValue("C" .$rpos , $dbcl->jinin[$i]['ji_co1']);
    $sheet->setCellValue("D" .$rpos , $dbcl->jinin[$i]['ji_co2']);
    // CLはフォントサイズ調整 
    $coplen3 = strlen($dbcl->jinin[$i]['ji_cl']);
    if ($coplen3 > 19 ) { // 7文字以上
	$sheet->getStyleByColumnAndRow(4, $rpos)->getFont()->setSize(12);
    }
    $sheet->setCellValue("E" .$rpos , $dbcl->jinin[$i]['ji_cl']);
    $sheet->setCellValue("F" .$rpos , $dbcl->jinin[$i]['ji_gakkai']);
    if ($dbcl->jinin[$i]['ji_bikou'] != '-' ) { // -は印字しない
        $sheet->setCellValue("G" .$rpos , $dbcl->jinin[$i]['ji_bikou']);
    }
    $rpos += 1;
}
$sheet->setCellValue("A14", $dbcl->luncheon['schedule']); 
$sheet->setCellValue("A17", $dbcl->luncheon['kouenkai']); 

// 余分な行を削除 2行以上空白があれば、最終行以外は消す
if ($jininNum <= $jininMax - 2) {
    $endrowj = $jininMax - 2 - $jininNum + 1;
    $objPHPExcel->getActiveSheet()->removeRow($rpos,$endrowj);
}
//  $sheet->setCellValue("A" .$rpos , $endrowj); 

// カラムの削除
if (empty($dbcl->luncheon['syukan2']) == true) {
   $objPHPExcel->getActiveSheet()->removeColumn('D', 1);
} else {
   $sheet->setCellValue("D2", $dbcl->luncheon['syukan2']);
}
if (empty($dbcl->luncheon['syukan']) == true) {
   $objPHPExcel->getActiveSheet()->removeColumn('C', 1);
} else {
   $sheet->setCellValue("C2", $dbcl->luncheon['syukan']);
   //コプロ名のフォントサイズ調整
   $coplen3 = strlen($dbcl->luncheon['syukan']);
   if ($coplen3 > 19 && $coplen3 <= 24) { // 7,8文字
       $sheet->getStyleByColumnAndRow(2, 2)->getFont()->setSize(12);
   } else if ($coplen3 > 24) { // 9文字以上
       $sheet->getStyleByColumnAndRow(2, 2)->getFont()->setSize(10);
   }
}

// ３枚目
$objPHPExcel->setActiveSheetIndex(2);////シートの3番目に移動
$sheet=$objPHPExcel->getActiveSheet();
$sharei = "謝礼"; // mb_convert_encoding("謝礼",'UTF-8','eucJP-win');
$sinmeisho = "応諾書･開示承諾書･振込確認書"; // mb_convert_encoding("応諾書･開示承諾書･振込確認書",'UTF-8','eucJP-win');
$tehaiNum_h=$sinakazu['hikae'];  // 控室の品数
$tehaiNum = count($dbcl->tehai);
$tehai_h = 0;
$tehai_k = 0;
$rpos = 4;
for ($i=0;$i <$tehaiNum; $i++) {
    if (empty($dbcl->tehai[$i]['th_hinmei']) == true) continue;

    if ($dbcl->tehai[$i]['th_hinmei'] == $sharei) {
	$dbcl->tehai[$i]['th_hinmei'] = $sinmeisho;
    }

    $vlength3 = strlen($dbcl->tehai[$i]['th_hinmei']);
    if ($vlength3 > 33) { // 12文字以上
	$sheet->getStyleByColumnAndRow(0, $rpos)->getFont()->setSize(10);
    }
    $sheet->setCellValue("A" .$rpos , $dbcl->tehai[$i]['th_hinmei']); 
    $sheet->setCellValue("B" .$rpos , $dbcl->tehai[$i]['th_su']); 
    $sheet->setCellValue("C" .$rpos , $dbcl->tehai[$i]['tehaisha']); 
    $sheet->setCellValue("D" .$rpos , $dbcl->tehai[$i]['kakunin']); 
    $sheet->setCellValue("E" .$rpos , $dbcl->tehai[$i]['th_bikou']); 
    if ($rpos < 19 ) {
      $tehai_h += 1;
    } else {
      $tehai_k += 1;
    }
    if ($i == $tehaiNum_h -1 ) $rpos = 19;
     else $rpos += 1;
}
// 余分な行を削除 2行以上空白があれば、最終行以外は消す
if ($tehai_k <= $tehai_kMax - 2) {
    $endrowk = $tehai_kMax - 2 - $tehai_k + 1;
    $objPHPExcel->getActiveSheet()->removeRow($rpos,$endrowk);
}
//    $sheet->setCellValue("A" .$rpos , $endrow); 

if ($tehai_h <= $tehai_hMax - 2) {
    $endrowh = $tehai_hMax - 2 - $tehai_h + 1;
    $objPHPExcel->getActiveSheet()->removeRow(4 + $tehai_h,$endrowh);
}
//$sheet->setCellValue("A" .$rpos , $endrowh); 
//$sheet->setCellValue("B" .$rpos , $tehai_h); 


// 4枚目
$objPHPExcel->setActiveSheetIndex(3);////シートの4番目に移動
$sheet=$objPHPExcel->getActiveSheet();
$tantouNum = count($dbcl->lch_tantou);
$kyosai = "共催社"; // mb_convert_encoding("共催社",'UTF-8','eucJP-win');
$zip = "〒"; // mb_convert_encoding("〒",'UTF-8','eucJP-win');
//$sheet->getStyle( "A3:E50" )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$rpos = 3;
// for ($i=0;$i <$tantouNum; $i++) {
for ($i=0;$i < 3; $i++) { // Astellasとコプロ2社
//    if (empty($dbcl->lch_tantou[$i]['lch_corp']) == true ) break;
    if ($i==1) {
      if (empty($dbcl->luncheon['syukan']) == true ) {
	break;
      }	else {
	$sheet->setCellValue("B" .$rpos , $dbcl->luncheon['syukan']); 
        $sheet->setCellValue("C" .$rpos , $dbcl->jinin[0]['ji_co1']); 
      }
    } else if ($i==2) {
      if (empty($dbcl->luncheon['syukan2']) == true ) {
	break;
      }	else {
	$sheet->setCellValue("B" .$rpos , $dbcl->luncheon['syukan2']); 
        $sheet->setCellValue("C" .$rpos , $dbcl->jinin[0]['ji_co2']); 
      }
    } else {
        $sheet->setCellValue("B" .$rpos , $dbcl->lch_tantou[$i]['lch_corp']); 
        $sheet->setCellValue("C" .$rpos , $dbcl->jinin[0]['ji_as']); 
    }
    $sheet->setCellValue("A" .$rpos , $kyosai); 
    if (empty($dbcl->lch_tantou[$i]['lch_zip']) == false ) {
	$sheet->setCellValue("D" .$rpos , $zip . $dbcl->lch_tantou[$i]['lch_zip']); 
    }
    $sheet->setCellValue("E" . $rpos, "T) " . $dbcl->lch_tantou[$i]['lch_tel']); 
    $rpos += 1;
    $sheet->setCellValue("D" .$rpos , $dbcl->lch_tantou[$i]['lch_addr']);
    $sheet->setCellValue("E" . $rpos, "F) " . $dbcl->lch_tantou[$i]['lch_fax']); 
    $rpos += 1;
    $sheet->setCellValue("E" . $rpos, "M) " . $dbcl->lch_tantou[$i]['lch_mobile']); 
    $rpos += 1;
}

// MR名の挿入
$gotan = "ご担当"; // mb_convert_encoding("ご担当",'UTF-8','EUC-JP');
for ($i=0;$i < $zachoNum;$i++) { // 座長MR
//    if ((empty($dbcl->zacho[$i]['mr_name']) == true) && (empty($dbcl->zacho[$i]['mr_keitai'])==true)) break;
    $sheet->setCellValue("A" . $rpos, "MR"); 
    $sheet->setCellValue("B" . $rpos, $dbcl->zacho[$i]['mr_eigyo']); 
    $sheet->setCellValue("C" . $rpos, $dbcl->zacho[$i]['mr_name']); 
    $sheet->setCellValue("E" . $rpos, "T) " . $dbcl->zacho[$i]['mr_tel']); 
    $rpos += 1;
    $sheet->setCellValue("B" . $rpos, "(" .$dbcl->zacho[$i]['cs_name'] .$gotan .")"); 
    $sheet->setCellValue("E" . $rpos, "F) " . $dbcl->zacho[$i]['mr_fax']);
    $rpos += 1;
    $sheet->setCellValue("E" . $rpos, "M) " . $dbcl->zacho[$i]['mr_keitai']); 
    $rpos += 1;
}
for ($i=0;$i < $enshaNum;$i++) { // 演者MR
//    if ((empty($dbcl->ensha[$i]['mr_name']) == true) && (empty($dbcl->ensha[$i]['mr_keitai'])==true)) continue;
    $sheet->setCellValue("A" . $rpos, "MR"); 
    $sheet->setCellValue("B" . $rpos, $dbcl->ensha[$i]['mr_eigyo']); 
    $sheet->setCellValue("C" . $rpos, $dbcl->ensha[$i]['mr_name']); 
    $sheet->setCellValue("E" . $rpos, "T) " . $dbcl->ensha[$i]['mr_tel']); 
    $rpos += 1;
    $sheet->setCellValue("B" . $rpos, "(" .$dbcl->ensha[$i]['cs_name'] .$gotan .")"); 
    $sheet->setCellValue("E" . $rpos, "F) " . $dbcl->ensha[$i]['mr_fax']); 
    $rpos += 1;
    $sheet->setCellValue("E" . $rpos, "M) " . $dbcl->ensha[$i]['mr_keitai']); 
    $rpos += 1;
}
// CL,運営,会場,アンケート,収録
$mu = "無"; // mb_convert_encoding("無",'UTF-8','EUC-JP');
$clin = "リンケージ"; //mb_convert_encoding("リンケージ",'UTF-8','EUC-JP');
$tojitsu = "当日運営"; // mb_convert_encoding("当日運営",'UTF-8','EUC-JP');
$unei = "運営会社"; // mb_convert_encoding("運営会社",'UTF-8','EUC-JP');
$jimukyoku = "学会運営事務局"; // mb_convert_encoding("学会運営事務局",'UTF-8','EUC-JP');
    // 収録
    if ((empty($dbcl->luncheon['syuroku']) == true) || ($dbcl->luncheon['syuroku']== $mu)) {
      $tantouNum -= 1;
    }

for ($i=3;$i <$tantouNum; $i++) {
//    if ((empty($dbcl->lch_tantou[$i]['lch_corp']) == true) && (empty($dbcl->lch_tantou[$i]['lch_man'])==true)) continue;
    if ((empty($dbcl->luncheon['anquete']) == true) || ($dbcl->luncheon['anquete']== $mu)) {
      if ($i == 6 ) continue;
    }
    if ($i == 3) {
      $sheet->setCellValue("A" .$rpos , $tojitsu); 
    } else if ($i == 4) {
      $sheet->setCellValue("A" .$rpos , $jimukyoku); 
    } else {
      $sheet->setCellValue("A" .$rpos , $dbcl->lch_tantou[$i]['lch_code']); 
    }

    if ($i == 5 ) { // 会場
      $sheet->setCellValue("B" .$rpos , $dbcl->luncheon['place']); 
    } else {
      $sheet->setCellValue("B" .$rpos , $dbcl->lch_tantou[$i]['lch_corp']);
    }
    if ($i == 3 ) { // CL
      $sheet->getStyleByColumnAndRow(1, $rpos)->getFont()->setSize(10);
      $sheet->setCellValue("C" .$rpos , $dbcl->luncheon['cltantou']); 
    } else if ($i == 4 ) { 
      $sheet->setCellValue("C" .$rpos , $dbcl->jinin[0]['ji_gakkai']); 
    } else {
      $sheet->setCellValue("C" .$rpos , $dbcl->lch_tantou[$i]['lch_man']); 
    }
    if (empty($dbcl->lch_tantou[$i]['lch_zip']) == false ) {
	$sheet->setCellValue("D" .$rpos , $zip . $dbcl->lch_tantou[$i]['lch_zip']);
    }
    $sheet->setCellValue("E" . $rpos, "T) " . $dbcl->lch_tantou[$i]['lch_tel']);
    $rpos += 1;
    $sheet->setCellValue("D" .$rpos , $dbcl->lch_tantou[$i]['lch_addr']); 
    $sheet->setCellValue("E" . $rpos, "F) " . $dbcl->lch_tantou[$i]['lch_fax']); 
    $rpos += 1;
    $sheet->setCellValue("E" . $rpos, "M) " . $dbcl->lch_tantou[$i]['lch_mobile']); 
    $rpos += 1;
}
// 余分な行を削除
$rposTo=$rpos+15;
$objPHPExcel->getActiveSheet()->removeRow($rpos,$rposTo);
//$sheet->setCellValue("C1" ,$rpos); 



/*
//5枚目
$objPHPExcel->setActiveSheetIndex(4);////シートの4番目に移動
$sheet=$objPHPExcel->getActiveSheet();
$sheet->setCellValue("B2", $dbcl->luncheon['gakkai']); 
$sheet->setCellValue("B3", $dbcl->luncheon['hinmoku']); 
$sheet->setCellValue("B4", $dbcl->luncheon['semina']); 
$sheet->setCellValue("B5", $dbcl->luncheon['ryoiki']); 
$sheet->setCellValue("B6", $dbcl->luncheon['kaisaibi']); 
$sheet->setCellValue("B7", $dbcl->luncheon['kaisaiji']); 
$sheet->setCellValue("B8", $dbcl->luncheon['kaiki']); 
$sheet->setCellValue("B9", $dbcl->luncheon['place']); 
$sheet->setCellValue("B10", $dbcl->luncheon['yobi2']); 

$sheet->setCellValue("D2", $dbcl->zacho[0]['cs_name']); 
$sheet->setCellValue("F2", $dbcl->ensha[0]['cs_name']); 


$sheet->setCellValue("L3", $dbcl->jinin[0]['ji_yakuwari']); 
*/


// 最後
$objPHPExcel->setActiveSheetIndex(0); //シートの1番目に移動

//------------------------------------------------------------
// エクセルファイルをブラウザに書き出し
//------------------------------------------------------------
//ヘッダーの設定
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="image_test.xlsx"');
header('Content-Disposition: attachment;filename="yakuwari.xls"');
header('Cache-Control: max-age=0');

//出力
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output'); 


?>
