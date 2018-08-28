<?php
//*****************************************************
// itempdf.php
// 引  数 Get
// 呼出元 corepon.php
// 用  途 項目値をPDFファイルに保存
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_.'UploadDAO.php';
require_once _MODULE_DIR_ . 'MembersDAO.php';

include "/home/kyousai/public_html/tcpdf/tcpdf.php"; //ライブラリの読み込み
include "/home/kyousai/public_html/fpdi/fpdi.php"; //ライブラリの読み込み

// 不正遷移チェック
$ret = fuseiSeni(3);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}

// IPアドレスチェック
incAdminAuthCheck();

//DB
$updbh =& new UploadDAO();
$dbh =& new MembersDAO();

//パラメータ取得
$semi_id = $_GET['semi_id'];
// $mail_honbun = $_GET['corepon'];

    $endsw=0;


if (isset($semi_id) && !empty($semi_id)) {
    $mailAry = $updbh->getMail($semi_id,'semi_id');
    $mail_honbun = trim($mailAry['corepon']);
    $endsw=1;
} else {
    include_once ("../../com212/php/error_header.php");
    print "Error! セミナーIDがありません";
    include_once ("../../com212/php/close_footer.php");
    exit;
}


//------------------------------------------------------------
// PDFファイル作成
//------------------------------------------------------------
$pdf = new FPDI();

//フォントの設定
$pdf->SetFont('kozminproregular','',8);
//ヘッダーとフッターを消すよ
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// ページ設定
$pdf->AddPage('P');
//$pdf->SetDisplayMode(’real’,'default');
$pdf->SetAutoPageBreak(true,10);

//本文の位置をX座標とY座標によって指定する
$pdf->SetMargins(10.0, 8.0, 10.0); // 左 上 右

// 日付け
$pdf->SetFont(kozminproregular,'',10);
// $pdf->SetXY(10, 10);
$pdf->Write(6,$mail_honbun);
//Write( $h, $txt,          $link, $fill, $align, $ln, $stretch, $firstline, $firstblock, $maxh $wadj, $margin ) 
	// sys_numの取得
	$uploaded=$updbh->getFileNum($semi_id);
	$max_sys_num=$uploaded['sys_num'];
	$sys_num=intval($max_sys_num) + 1;

	// ディレクトリの存在チェック
	$iso1 = sprintf("%04d", $semi_id);
//	$iso2 = sprintf("%03d", $sys_num);
	if ($semi_id <= '1000') {
		print "Error";
		exit;
	} else {
	    $dir=_UPLOAD_DIR_ . $iso1;
	    $uploaddir=_UPLOAD_DIR_ ;
	}
	if(!is_dir($dir)) {
		include_once ("../../com212/php/error_header.php");
		print "アップロード用ディレクトリがありません";
		include_once ("../../com212/php/close_footer.php");
		exit;
	}

	$updbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
	// file情報のreg_idを取得
	$n=8; // $GLOBALS['FILEKIND'][8]
	$reg_id = $updbh->get_reg_id($semi_id,$n);
	if (isset($reg_id) && $reg_id > 0) { // MR宛てメールアップロード済み;
 		$ret = $updbh->update_file($reg_id,$semi_id);
		if ($updbh->getError() === null) {
			$sys_num=$sys_num - 1;
		} else {
	        	$updbh->con->rollback(); // ロールバック
			include_once ("../../com212/php/error_header.php");
			print "PDFファイルの作成に失敗しました(1)";
			include_once ("../../com212/php/close_footer.php");
			exit;
		}
	}

	// ファイル名の置き換え
	$sys_num2 = sprintf("%02d", $sys_num);
	$sys_filename = $iso1 . $sys_num2 . "-mail.pdf";

	// ファイルアップロード先
	$point = $uploaddir . $iso1 . "/" . $sys_filename;

	// DB登録 
	$fileinfo=array();
	$fileinfo["sys_filename"] = $sys_filename;
	$fileinfo["org_filename"] = $semi_id . "mail.pdf";
	$fileinfo["sys_num"] = $sys_num;
	$fileinfo["sys_folder"] = $iso1;
	$fileinfo["filesize"] = 999;
	$fileinfo["remark"] = $GLOBALS['FILEKIND'][8];

 	$ret = $updbh->insert_file($fileinfo,$semi_id);
	//DBへ追加が成功すれば(errorがnullなら)
	if ($updbh->getError() === null) {
		//ドキュメントを出力する
		$pdf->Output($point,'F');
		$updbh->con->commit();  // コミット
		include_once ("../../com212/php/normal_header.php");
		print "PDFファイルを作成しました<br><div align=center>";
		print "<a href=./corepon.php?p=" . $semi_id .">再編集</a></div>";
	} else {
	        $updbh->con->rollback(); // ロールバック
		include_once ("../../com212/php/error_header.php");
		print "PDFファイルの作成に失敗しました(2)";
        }
	include_once ("../../com212/php/close_footer.php");

        $updbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)

//------------------------------------------------------------
// データの変更
//------------------------------------------------------------
/*

if ($endsw == 0) header("location: ./corepon.php?p=" . $semi_id);
*/
   exit;

?>
