<?php
//*****************************************************
// newdata.php
// 用途:新規データを登録します。
//*****************************************************
require_once("../../webapp/config.php");
require_once _MODULE_DIR_ . 'MembersDAO.php';

// 不正遷移チェック
$ret = fuseiSeni(1);
//if ($ret == 1) { // 2012.12.5 comment ka
//  echo "不正遷移 Error";
//  exit;
//}

incAdminAuthCheck();

//DB
$dbh =& new MembersDAO();

//------------------------------------------------------------
// データの挿入準備
//------------------------------------------------------------
//INSERTコマンド作成準備
$val["gakkai"] = "未定(2018年度)";
$val["seminar"] = "未定";
$val["kaisaibi"] = "0";
// $val["last_date"] = date("Y-n-j");
$val["last_date"] = date("Y-m-d H:i:s");
$val["sys_stat"] = 0;
$val["status"] = "進行中";
$val["narabi"] = 30000;
$val["nendo"] = 2018;

$dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始) 
$ret = $dbh->insert($val);
if ($dbh->getError() !== null) { //DB追加失敗(errorがnull以外)
    $dbh->con->rollback(); // ロールバック 
    $Ret=ErrorLog('newdata','insert',$val); 
//    header("location: ../bin/part.php");
    exit;
} else {
    $semi_id = $ret;
}

//print $semi_id;

//------------------------------------------------------------
// 関連データ作成
//------------------------------------------------------------
$ret = $dbh->insertAddition($semi_id);
if ($dbh->getError() !== null) { //DB追加失敗(errorがnull以外)
    $dbh->con->rollback(); // ロールバック  
    $Ret=ErrorLog('newdata','insertAddition',$val); 
    header("location: ../bin/part.php");
    exit;
}


// 座長 3件 _ZA_INIT_
// 演者 8件 _EN_INIT_
// 控室手配物 9件 _HIKAE_INIT_
// 会場控物 12件 _SEMINAR_INIT_
// 人員配置 7件 _JININ_INIT_
// 担当者 7件
//        AS CL 件はtantouから抽出
//        MR - 参照するので不要
//        コプロは２件、運営・アンケート・会場は1件～データを登録
//  
//------------------------------------------------------------
// ディレクトリ作成
//------------------------------------------------------------
$dir=_UPLOAD_DIR_ . "/" . sprintf("%04d", $semi_id);

// ディレクトリの存在チェック
if(!is_dir($dir)) { // ディレクトリがないのでOK
    // ディレクトリ作成
    $mk_dir = "mkdir \"" . $dir . "\"";
    system($mk_dir,$rt);
    if ($rt != 0) { 
        $dbh->con->rollback(); // ロールバック 
        $Ret=ErrorLog('newdata','mkdir',$val); 
        header("location: ../bin/part.php");
        exit;
    }
    // メール送信
    CompleteMail('newdata',$val);

} else {
    $Ret=ErrorLog('newdata','dupli',$val); 
}


$dbh->con->commit();  // コミット 
$dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了) 

//------------------------------------------------------------
// part.phpの再実行
//------------------------------------------------------------
header("location: ../bin/part.php");

?>
