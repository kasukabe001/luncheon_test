<?php
//*****************************************************
// itemsave.php
// 引  数 post
// 呼出元 corepon.php
// 用  途 項目毎にデータ保存
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';

// 不正遷移チェック
$ret = fuseiSeni(3);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}

// IPアドレスチェック
incAdminAuthCheck();

//DB
$dbh =& new MembersDAO();

//パラメータ取得
$semi_id = $_POST['semi_id'];
$val = $_POST['corepon'];

    $endsw=0;


if (empty($semi_id) == true) {
    $semi_id = $_GET['semi_id'];
    $gk = urldecode($_GET['corepon']);
    $val = mb_convert_encoding($gk,"eucJP-win","UTF-8"); 
    $endsw=1;
}

//サニタイズ
$val = trim($val);
$val = pg_escape_string($val);

// $lock_token = $_GET['token'];

//------------------------------------------------------------
// データの変更
//------------------------------------------------------------
$table='luncheon';
$column='corepon';

$ret = $dbh->itemUpdate($semi_id,$table,$column,$val);
if ($dbh->getError() !== null) { //ロック解除失敗(errorがnull以外)
    $Ret=ErrorLog('coreponupdate',$semi_id,$val); 
}

if ($endsw == 0) header("location: ./corepon.php?p=" . $semi_id);

?>
