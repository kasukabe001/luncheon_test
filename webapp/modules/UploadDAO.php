<?php
require_once _LIB_DIR_ . 'DAO.php';

class UploadDAO extends DAO
{

    /**
     * Set of Variables
     */
    var $table = 'file'; //DB Tabel name
    var $subtable = 'luncehon'; //DB Tabel name



    /**
     * Constructor
     */
    function UploadDAO()
    {
        $this->initialize();
    }



    /**
     * Initialize
     */
    function initialize()
    {
        $this->getConnect();
    }



    /**
     * セミナー別のファイル数、開示承諾書数、応諾書数、伝票数を返す 
     * @param  integer $semi_id
     * @return array $ary (kaiji,oudaku)
     */
    function getFileNum($semi_id)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('select max(sys_num) as maxno from ' . $this->table . ' where semi_id = ? and status = 0'); 
        $res =& $this->con->execute($sql,$semi_id);
        $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);
	$ary['sys_num'] = $row['maxno'];

	$sql =& $this->con->prepare("select semi_id from " . $this->table . " where semi_id = ? and remark = '開示承諾書' and status = 0"); 
        $res =& $this->con->execute($sql,$semi_id);
	$ary['kaiji'] = $res->numRows();

	$sql =& $this->con->prepare("select semi_id from " . $this->table . " where semi_id = ? and remark = '応諾書' and status = 0"); 
        $res =& $this->con->execute($sql,$semi_id);
	$ary['oudaku'] = $res->numRows();

	$sql =& $this->con->prepare("select semi_id from " . $this->table . " where semi_id = ? and remark = '伝票' and status = 0"); 
        $res =& $this->con->execute($sql,$semi_id);
	$ary['denpyo'] = $res->numRows();
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

    return $ary;
    }



    /**
     * ファイル情報を登録します
     *
     * @param  array $fileinfo  // ファイル情報 
     * @param  integer $semi_id // 
     * @return integer sys_num
     */
    function insert_file($val,$semi_id)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->table . '(
		reg_date,
		reg_time,
		semi_id,
		org_filename,
		sys_filename,
		sys_folder,
		sys_num,
		filesize,
		remark,
		status
            ) VALUES (
                ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
	    'reg_date' => date("Y-m-d"),
	    'reg_time' => date("H:i:s"),
            'semi_id'  => $semi_id,
	    'org_filename'  => $val['org_filename'],
	    'sys_filename'  => $val['sys_filename'],
	    'sys_folder'  => $val['sys_folder'],
	    'sys_num'  => $val['sys_num'],
	    'filesize'  => $val['filesize'],
	    'remark'  => $val['remark'],
            'status'  => 0
        );

        $res =& $this->con->execute($sql, $ary);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        return;
    }



}
?>
