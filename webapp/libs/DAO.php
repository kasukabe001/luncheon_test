<?php
require_once "DB.php";
// require_once "MDB2.php";

/**
 * DataBase ��³�������饹
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
    //Result, Error �Υ��å���
    function getError()  {return $this->error;}
    function getResult() {return $this->result;}


    /**
     * Setter
     */
    //Result, Error �Υ��å���
    function setError($arg)  {$this->error = $arg;}
    function setResult($arg) {$this->result = $arg;}


    /**
     * Constructor
     */
    function DAO() {
    }


    /**
     * getConnect
     * DB��³����
     */
    function getConnect() {
        if ($this->con === null) {

            $this->con = DB::connect(_DB_DSN_);
//	    $this->con =& MDB2::factory(_DB_DSN_); 
//	    print_r(DB::parseDSN(_DB_DSN_)); //2008.4 Debug�Ѥ��ɲ�
            if (DB::isError($this->con)) {
//		die($this->con->getUserInfo()); //2008.4 Debug�Ѥ��ɲ�
                $this->setError($this->con->getMessage()." (".__LINE__.")");
            return;
            }
        }
    }


    /**
     * getDisconnect
     * DB��³����
     */
    function getDisconnect() {
        if ($this->con !== null) {
            $this->con->disconnect();
            $this->con = null;
        }
    }


    /**
     * ���̽�����̳�Ǽ����
     *
     * @param  pbject $res
     * @param  string $line ��Ȥ��Ƥ�����
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
