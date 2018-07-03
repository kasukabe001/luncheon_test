<?php
//*****************************************************
// togo_down.php
// ファイルを圧縮してダウンロード
// パラメータ fnameの先頭1文字目で圧縮対象を判定
// K:開示承諾書  D:応諾書 P:伝票
//*****************************************************
require_once("../../webapp/config_pub.php");

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


chdir('../../upload/'.$fileDir);

//圧縮対象を取得
$files = getdirtree('./',$type); // 解凍後にサブフォルダを作らないため


require_once "Archive/Zip.php";
$obj = new Archive_Zip('../../webapp/logs/some.zip');
$obj->create($files);

$filename = "../../webapp/logs/some.zip"; // テンポラリーファイル
// $dl_filename = "file" . $fileNo . ".zip"; // 圧縮ファイル名
if ($type=="K") {
   $dl_filename = "開示承諾書" . $fileNo . ".zip"; // 圧縮ファイル名
} else if ($type=="D") {
   $dl_filename = "応諾書" . $fileNo . ".zip"; // 圧縮ファイル名
} else if ($type=="P") {
   $dl_filename = "伝票" . $fileNo . ".zip"; // 圧縮ファイル名
}
// 日本語文字化け対策 2012.4.20
if ($browser == "ie") {
    $dl_filename = mb_convert_encoding($dl_filename, "SJIS", "AUTO");
} else {
    $dl_filename = mb_convert_encoding($dl_filename, "UTF-8", "AUTO");
}

// ダウンロード開始
header("Content-disposition: attachment; filename=$dl_filename");
header("Content-type: application/octet-stream; name=$dl_filename");
$fp = fopen($filename, "r");
echo fread($fp, filesize($filename));
fclose($fp);

// テンポラリファイルを削除
unlink ($filename);



//*****************************************************
// function getdirtree( $dir )
// 指定したディレクトリ以下のファイル一覧を獲得します。
//-----------------------------------------------------
// 引数：ディレクトリを示す文字列
// 引数：ファイル番号  K:開示承諾書 O:応諾書
// 戻値：ファイル一覧を格納した配列
// 注意：$dir は、スクリプトから見た相対パスを指定します。
//*****************************************************
function getdirtree( $dir,$type )
{
    if( !is_dir( $dir ) )    // ディレクトリでなければ false を返す
        return false;

    $tree = array();    // 戻り値用の配列

    if( $handle = opendir( $dir ) )
    {
	$j=0;
        while ( false !== $file = readdir( $handle ) )
        {
            // 自分自身と上位階層のディレクトリを除外
            if( $file != "." && $file != ".." )
            {
                if( is_dir( $dir."/".$file ) )
                    // ディレクトリならば再帰呼出
//                  $tree[ $file ] = getdirtree( $dir."/".$file );
                    $tree[ $j] = getdirtree( $file );
                else
                    // ファイルならばパスを格納
		    $topName = substr($file,0,3) ; 
//		    if ( $topName == "SYS" ) { // SYS以外で始まるものを除外
		    if ( $topName == "SY" . $type ) {
//                	$tree[] = $dir."/".$file;
                	$tree[] = $file;   // 解凍後にサブフォルダを作らないため
		    }
	        }
	    $j++;
        }
        closedir( $handle );
        uasort( $tree, "strcmp" ); // uasort() でないと添え字が失われます
    }

    return $tree;
}

?>
