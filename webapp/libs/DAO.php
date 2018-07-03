<?php
require_once "DB.php";
// require_once "MDB2.php";

/**
 * DataBase 接続処理クラス
 *
 * @author Hiromichi HARUNA
 */
class DAO
{
    /**
     * Set of Variables
     */
    var $con    = null;
    var $error  = null;
    var $result = null;


    /**
     * Getter
     */
    //Result, Error のゲッター
    function getError()  {return $this->error;}
    function getResult() {return $this->result;}


    /**
     * Setter
     */
    //Result, Error のセッター
    function setError($arg)  {$this->error = $arg;}
    function setResult($arg) {$this->result = $arg;}


    /**
     * Constructor
     */
    function DAO() {
    }


    /**
     * getConnect
     * DB接続処理
     */
    function getConnect() {
        if ($this->con === null) {

            $this->con = DB::connect(_DB_DSN_);
//	    $this->con =& MDB2::factory(_DB_DSN_); 
//	    print_r(DB::parseDSN(_DB_DSN_)); //2008.4 Debug用に追加
            if (DB::isError($this->con)) {
//		die($this->con->getUserInfo()); //2008.4 Debug用に追加
                $this->setError($this->con->getMessage()." (".__LINE__.")");
            return;
            }
        }
    }


    /**
     * getDisconnect
     * DB接続開放
     */
    function getDisconnect() {
        if ($this->con !== null) {
            $this->con->disconnect();
            $this->con = null;
        }
    }


    /**
     * 共通処理結果格納処理
     *
     * @param  pbject $res
     * @param  string $line 作業していた行
     */
    function endProc(&$res, $line) {
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".$line.")");
            $this->setResult(false);

        } else {
            $this->setResult(true);
        }
    }
}
?>
