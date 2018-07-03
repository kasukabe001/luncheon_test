<?php
//*****************************************************
// togo_down2016.php
// ファイルを圧縮してダウンロード
// パラメータ fnameの先頭1文字目で圧縮対象を判定
// K:開示承諾書  D:応諾書 P:伝票
//*****************************************************
session_cache_limiter('public'); // SSL対策
set_time_limit(20); // SSL対策

require_once("../../webapp/config_pub.php");
error_reporting(E_ALL & ~E_NOTICE);

// 不正遷移チェック
$ret = fuseiSeni();
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}
// IPアドレスチェック
$ret = IPcheck(2);
if ($ret == 1) {
  echo "不正遷移 Error";
  exit;
}

// ブラウザ判別 2012.4.20追加
$agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($agent,'MSIE') !== false || strpos($agent,'Trident') !== false ) {
    $browser = "ie";
}

//パラメータ処理
$fileDir = substr($_GET['fname'],4,4);
$type = substr($_GET['fname'],0,1);
$fileNo = intval($fileDir);

if ($fileNo <= '350') {
    $target_path = $UPLOAD_350_PATH . $fileDir;
} else if ($fileNo < '1000') {
    $target_path = $UPLOAD_787_PATH . $fileDir;
} else {
    $target_path = $UPLOAD_FILE_PATH . $fileDir;
}

$zip_name = '/home/kyousai/webapp/logs/some.zip'; //圧縮ファイル テンポラリー

//if (getZipCompression('/home/kyousai/upload/1847', $zip_name = '/home/jisin/lcfile/foo.zip')) {
//if (getZipCompression('/home/kyousai/upload/1847', '/home/jisin/lcfile/foo.zip')) {
//if (getZipCompression($target_path)) { 
$ret = getZipCompression($target_path,$zip_name);
if ($ret == false) {
    echo "失敗" . $target_path;
    exit;
}


//圧縮ファイル名
if ($type=="K") {
   $dl_filename = "開示承諾書" . $fileNo . ".zip"; 
} else if ($type=="D") {
   $dl_filename = "応諾書" . $fileNo . ".zip"; 
} else if ($type=="P") {
   $dl_filename = "伝票" . $fileNo . ".zip"; 
}
// 日本語文字化け対策 2012.4.20
if ($browser == "ie") {
    $dl_filename = mb_convert_encoding($dl_filename, "SJIS", "AUTO");
} else {
    $dl_filename = mb_convert_encoding($dl_filename, "UTF-8", "AUTO");
}

// ダウンロード開始
if(ini_get('zlib.output_compression')) {
    ini_set('zlib.output_compression', 'Off');
}
mb_http_output($zip_name);

header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=$dl_filename");
header('Content-Transfer-Encoding: binary');
header("Content-Length: ".filesize($zip_name));

$fp = fopen($zip_name, "rb");
echo fread($fp, filesize($zip_name));
fclose($fp);


/*
$handle = fopen($zip_name, "rb");

while(!feof($handle))
{
    print fread($handle, 4096);
    ob_flush();
    flush();
}
fclose();
*/
//header("Content-Disposition: inline; filename=\"$dl_filename\"");
//readfile($zip_name);



// テンポラリファイルを削除
unlink ($zip_name);


/**
 * PHPでZipファイルに圧縮
 * 
 * @param string $target_path
 * @param string $zip_name
 * @return boolean
 */
function getZipCompression($target_path, $zip_name = '')
{
    // 存在チェック
    if (! file_exists($target_path)) {
        return FALSE;
    }

    // ZIPファイル名が未定義の場合は圧縮対象ディレクトリの同階層/日付.zip
    if (empty($zip_name)) {
//        $zip_name = '/home/kyousai/webapp/logs/some.zip';
//        $zip_name = $target_path . '/' . date('ymd') . '.zip';
    }

    $zip = new ZipArchive();
    try {
        // アーカイブをオープン
        $zip->open($zip_name, ZIPARCHIVE::CREATE);


        // 圧縮対象ディレクトリ
        $targetFiles = scandir($target_path);
        if (! empty($targetFiles)) {
            foreach ($targetFiles as $targetFilesKey => $targetFilesVal) {
                // ファイルのみを抽出
                if (is_file($target_path . '/' . $targetFilesVal)) {
                    // アーカイブに追加
                    $zip->addFile($target_path . '/' . $targetFilesVal, $targetFilesVal);
                }
            }
        }
        // アーカイブをクローズ
        $zip->close();
    } catch (Exception $e) {
        return FALSE;
    }

    return TRUE;
}


?>
