<?php
//ini_set
ini_set('include_path', _LIB_DIR_ . 'pear:' . ini_get('include_path'));
ini_set('error_log',    _LOG_DIR_ . 'php_error.log');
ini_set('session.cookie_secure',1);
ini_set("session.gc_maxlifetime", "3000");

//session
if ((isset($_REQUEST[_REQ_MODULE_])) && (isset($_REQUEST[_REQ_ACTION_]))) { //2009.6.22 PHP Notice対策
  if ($_REQUEST[_REQ_MODULE_] == 'Admin' && $_REQUEST[_REQ_ACTION_] == 'CSV') {
       session_cache_limiter('public');
  }
}

session_name('AstellasID');
session_start();

//echo '<!--' . get_cfg_var("session.gc_maxlifetime") . '-->';
require_once _LIB_DIR_ . 'Request.php';
require_once _LIB_DIR_ . 'Session.php';
require_once _LIB_DIR_ . 'MySmarty.php';

require_once _LIB_DIR_ . 'function.php';
// require_once _LIB_DIRORG_ . 'function.php';
require_once _MODULE_DIR_ . 'HistoryDAO.php';

//error_reporting(E_ERROR);

?>
