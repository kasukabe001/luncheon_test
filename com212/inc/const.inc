<?php
//############################################################
// 登録システム・定数設定
//############################################################
//【使用上の注意】
// １．データベース名称を設定する
// ２．プロジェクト名称を設定する
//【作成者】Fujita Kazuhiko
//【作成日】2007/02/08
//############################################################

//============================================================
// 定数設定
//============================================================
$mystring = "linkage-staff.jp/kyousai/admincl";
//$mystring = "61.206.45.171/admincl";
//------------------------------------------------------------
// データベース・テーブル等の設定
//------------------------------------------------------------
$DBNAME = "yonsoken";			// データベース名
$DBUSER = "foo";			// database user
$PASSWD = "hogehoge";
$TBL_NAME = "luncheon";			// 登録テーブル名
$UP_TBL = "file";			// アップロード情報管理テーブル
$OPEN = "dbname=" . $DBNAME . " port=5432 user=" . $DBUSER . " password=" .$PASSWD;
$UP_FILE = 20;				// アップロードできるファイル数
//------------------------------------------------------------
// パスの設定
//------------------------------------------------------------
$HOME_PATH = "/home/kyousai/"; 
//$HOME_PATH = "/domain/reg-clinkage.jp/home/luncheon/";

$HTML_PATH = $HOME_PATH . "template/";
$SYSERROR_HTML = $HTML_PATH . "syserr.html";
$ERROR_LOG = $HOME_PATH . "log/";
$UPLOAD_FILE_PATH= $HOME_PATH . "upload/";
$UPLOAD_350_PATH= $HOME_PATH . "upload_350/";
$UPLOAD_787_PATH= $HOME_PATH . "upload_787/";
$URL="http://linkage-staff.jp/kyousai/";
//  $URL="https://61.206.45.171/kyousai/";
//------------------------------------------------------------
// SESSION変数 モード判定
//------------------------------------------------------------
$modea=205689; // プロマネ
$modeb=554987; // チラシ担当
$modec=601572; // CL

//------------------------------------------------------------
// 返信Ｅメールの設定
//------------------------------------------------------------
// $USER_TITLE = "";
// $BUREAU_EMAIL = "BXG05713@nifty.ne.jp";
$SYS_EMAIL ="fujita@secretariat.ne.jp";
//------------------------------------------------------------
// フィールドの設定
//------------------------------------------------------------
$FIELD = array (
	'semi_id',
	'last_date',
	'kaisu',
	'gakkai',
	'hinmoku',
	'seminar',
	'kaityo',
	'yaku',
	'ryoiki',
	'kaisaibi',
	'kaisaiji',
	'nendo',
	'kaiki',
	'place',
	'syukan',
	'sekinin',
	'thema',
	'chair1',
	'chair2',
	'cyaku1',
	'cyaku2',
	'enshaname1',
	'enshaname2',
	'enshaname3',
	'enshaname4',
	'enshayaku1',
	'enshayaku2',
	'enshayaku3',
	'enshayaku4',
	'endai1',
	'endai2',
	'endai3',
	'endai4',
	'hotel',
	'cltantou',
	'amail',
	'annai1',
	'annai2',
	'yoko',
	'iraijo',
	'oudaku',
	'tirasi1',
	'tirasi2',
	'tirasi3',
	'mousi_add',
	'mousi_c',
	'mousi_k',
	'syoroku',
	'kaijo_k',
	'hikae_k',
	'hikae_a',
	'syuku_k',
	'tojitu',
	'cv',
	'sharei',
	'shaman1',
	'shahi1',
	'shaman2',
	'shahi2',
	'shaman3',
	'shahi3',
	'shaman4',
	'shahi4',
	'yakubun1',
	'yakubun2',
	'last_m',
	'report',
	'zaseki',
	'bento',
	'nyujosha',
	'an_kaisyu',
	'status',
	'yobi1',
	'yobi2',
	'yobi3',
	'yobi4',
	'cl1',
	'cl2',
	'cl3',
	'sys_stat',
	'narabi'
	);

$B_FIELD = array (
	'b_semi_id',
	'b_last_date',
	'b_kaisu',
	'b_gakkai',
	'b_seminar',
	'b_kaityo',
	'b_yaku',
	'b_ryoiki',
	'b_kaisaibi',
	'b_kaisaiji',
	'b_nendo',
	'b_kaiki',
	'b_place',
	'b_syukan',
	'b_sekinin',
	'b_thema',
	'b_chair1',
	'b_chair2',
	'b_cyaku1',
	'b_cyaku2',
	'b_enshaname1',
	'b_enshaname2',
	'b_enshaname3',
	'b_enshaname4',
	'b_enshayaku1',
	'b_enshayaku2',
	'b_enshayaku3',
	'b_enshayaku4',
	'b_endai1',
	'b_endai2',
	'b_endai3',
	'b_endai4',
	'b_hotel',
	'b_hinmoku',
	'b_cltantou',
	'b_amail',
	'b_annai1',
	'b_annai2',
	'b_yoko',
	'b_iraijo',
	'b_oudaku',
	'b_tirasi1',
	'b_tirasi2',
	'b_tirasi3',
	'b_mousi_add',
	'b_mousi_c',
	'b_mousi_k',
	'b_syoroku',
	'b_kaijo_k',
	'b_hikae_k',
	'b_hikae_a',
	'b_syuku_k',
	'b_tojitu',
	'b_cv',
	'b_sharei',
	'b_shaman1',
	'b_shahi1',
	'b_shaman2',
	'b_shahi2',
	'b_shaman3',
	'b_shahi3',
	'b_shaman4',
	'b_shahi4',
	'b_yakubun1',
	'b_yakubun2',
	'b_last_m',
	'b_report',
	'b_zaseki',
	'b_bento',
	'b_nyujosha',
	'b_an_kaisyu',
	'b_status',
	'b_yobi1',
	'b_yobi2',
	'b_yobi3',
	'b_yobi4',
	'b_cl1',
	'b_cl2',
	'b_cl3',
	'b_sys_stat',
	'b_narabi'
	);

$FIELD_File = array (
  "reg_id",
  "reg_date",
  "reg_time",
  "semi_id",
  "org_filename",
  "sys_filename",
  "sys_folder",
  "sys_num",
  "filesize",
  "del_date",
  "remark",
  "status"
);


$non_quote = array (
	"kaisu",
	"nendo",
	"sys_stat",
	"narabi"
);

//------------------------------------------------------------
// 集計項目の設定
//------------------------------------------------------------

?>
