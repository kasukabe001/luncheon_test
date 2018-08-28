<?php
/**
 * SITE CONFIG
 */
//ドメイン設定
define('_DOMAIN_',    'linkage-staff.jp/kyousai');
//define('_DOMAIN_',    '61.206.45.171/kyousai');

define('_HTTP_URI_',  'http://' . _DOMAIN_ . '/');
define('_HTTPS_URI_', 'https://' . _DOMAIN_ . '/');

//プロジェクト名
define('_PROJECT_NAME_JA_', '共催セミナー');
define('_PROJECT_NAME_EN_', '共催セミナー');

//文字コード
define('_CHARSET_', 'utf-8');
define('_INTERNAL_CODE_', 'utf-8');


//管理者IDとパスワードと管理者名とメアド
define('_ADMIN_UID1_',   '1');
define('_ADMIN_PWD1_',   '1');//
define('_ADMIN_NAME1_',  'プロマネ');

define('_ADMIN_UID2_',   '2'); //toukatsu
define('_ADMIN_PWD2_',   '2'); //seminar
define('_ADMIN_NAME2_',  '学術情報部');

define('_ADMIN_UID3_',   '9');
define('_ADMIN_PWD3_',   '9'); //

define('_ADMIN_NAME3_',  'CL管理者');
define('_ADMIN_EMAIL3_', 'fujita@secretariat.ne.jp');

//サイト内で表示するメアド
define('_ADMIN_EMAIL_',   _ADMIN_EMAIL3_);

//メールヘッダ
// mb_internal_encoding("EUC") ;
define('_MAIL_HEADER_JA_', "From: ".mb_encode_mimeheader(_PROJECT_NAME_JA_)."<"._ADMIN_EMAIL_.">\nReturn-Path: "._ADMIN_EMAIL_."\nReply-To: "._ADMIN_EMAIL_."\nMIME-Version: 1.0\n");


//ログイン認証フラグ
//define('_USER_AUTH_FLG_',   'apipm');
//define('_ADMIN2_AUTH_FLG_', 'toukatsu');
//define('_ADMIN3_AUTH_FLG_', 'clinkage');
define('_USER_AUTH_FLG_',   '1'); // apipm
define('_ADMIN2_AUTH_FLG_', '2'); // toukatsu
define('_ADMIN3_AUTH_FLG_', '9');  // clinkage


//Request Parameter Name
define('_REQ_MODULE_', '_mod');
define('_REQ_ACTION_', '_act');
define('_REQ_TYPE_',   '_type');


//データベース
//TODO:DB変更してます。

define('_DB_DSN_', 'pgsql://foo:hogehoge@:5432/yonsoken');


/**
 * 座長/演者最大数、初期件数
 */
define('_ZA_MAX_',  '3');
define('_ZA_INIT_',  '2');
define('_EN_MAX_',  '8');
define('_EN_INIT_',  '4');

/**
 * 担当者の最大数
 */
define('_TANTOU_MAX_',  '10');

/**
 * 手配品目の最大個数、初期件数
 */
//控室
define('_HIKAE_MAX_',  '12'); // 10
define('_HIKAE_INIT_',  '9'); // 10
//セミナー会場
define('_KAIJO_MAX_', '17');
define('_KAIJO_INIT_', '14');
//人員配置
define('_JININ_MAX_',  '9'); 
define('_JININ_INIT_',  '7');

/**
 * 役職選択メニューの最大個数
 */
define('_YAKU_MAX_',  '3'); 


/**
 * Set of mbstring
 */
mb_language('Japanese');
ini_set('mbstring.encoding_translation', 'On');
ini_set('mbstring.internal_encoding',    'UTF-8');
ini_set('mbstring.http_input',           'UTF-8, eucJP-win, SJIS, ASCII, JIS, EUC-JP');
ini_set('mbstring.http_output',          'UTF-8');
ini_set('mbstring.detect_order',         'UTF-8, eucJP-win, SJIS, ASCII, JIS, EUC-JP');
ini_set('mbstring.substitute_character', 'none');
ini_set('mbstring.func_overload',        '0');



/**
 * DIRECTORY PATH
 */
//webapp directory path
define('_WEBAPP_DIR_', dirname(__FILE__) . '/');

//module directory path
define('_MODULE_DIR_', _WEBAPP_DIR_ . 'modules/');

//libraries directory path
// define('_LIB_DIRORG_', _WEBAPP_DIR_ . 'libs/'); // 本番ではこちらを_LIB_DIR_にする
define('_LIB_DIR_', _WEBAPP_DIR_ . 'libs/'); // 本番ではこちらを_LIB_DIR_にする

//ファイルアップロード先
define('_UPLOAD_DIR_', _WEBAPP_DIR_ . '../upload/');
define('_UPLOAD_350_', _WEBAPP_DIR_ . '../upload_350/');
define('_UPLOAD_787_', _WEBAPP_DIR_ . '../upload_787/');

//log directory path
define('_LOG_DIR_', _WEBAPP_DIR_ . 'logs/');

//mail directory path
// define('_MAIL_DIR_', _WEBAPP_DIR_ . 'mail/');


//smarty directory path
define('_SMARTY_DIR_',          _LIB_DIR_ . 'Smarty/');
define('_SMARTY_TEMPLATE_DIR_', _WEBAPP_DIR_ . 'templates/');
define('_SMARTY_COMPILE_DIR_',  _WEBAPP_DIR_ . 'templates_c/');

/**
 * load file
 */
require_once 'initialize.php';
require_once (_LIB_DIR_ . 'GlobalVars.php');
// require_once (_LIB_DIRORG_ . 'GlobalVars.php');
?>