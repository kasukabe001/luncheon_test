<?php
//*****************************************************
// deljinin.php
// parameter integer sb  3:使用していません
//           integer semi_id
// 用途:人員配置を削除(status=1)します。
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'TehaiDAO.php';

// 不正遷移チェック
$ret = fuseiSeni(5);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}

// IPアドレスチェック
incAdminAuthCheck();

//DB
$thdbh =& new TehaiDAO();

//------------------------------------------------------------
// データの変更準備
//------------------------------------------------------------
$semi_id = $_GET['semi_id'];
// $th_code = $_GET['sb']; // 3:人員配置
$val = $_GET['val'];
$valary = explode(":", $val);
// print $val;

if (count($valary) > 1) {
    $thdbh->table = 'jinin';
    $ret = $thdbh->delete_jinin($semi_id,$valary);
    if ($thdbh->getError() !== null) { //DB削除失敗(errorがnull以外)
	$Ret=ErrorLog('deljinin',$semi_id,$valary); 
    }
}

//------------------------------------------------------------
// mypage.phpの再実行
//------------------------------------------------------------
//exit;
header("location: ../mypage.php?_mod=Jinin&_type=Edit&_act=Display");

?>
