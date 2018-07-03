<?php
//*****************************************************
// deltehai.php
// parameter integer sb  1:控室,2:セミナー会場
//           integer semi_id
// 用途:手配品を削除(status=1)します。
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
$th_code = $_GET['sb']; // 1:控室 2:セミナー会場
$val = $_GET['val'];
$valary = explode(":", $val);
// print $val;

if (count($valary) > 1) {
    $ret = $thdbh->delete_tehai($th_code,$semi_id,$valary);
    if ($thdbh->getError() !== null) { //DB削除失敗(errorがnull以外)
	$Ret=ErrorLog('addtehai',$semi_id,$val); 
    }
}

//------------------------------------------------------------
// mypage.phpの再実行
//------------------------------------------------------------

header("location: ../mypage.php?_mod=Tehai&_type=Edit&_act=Display");

?>
