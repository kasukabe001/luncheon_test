<?php
/**
 * 操作履歴TBLを操作するDataAccessObjectd?
 *
 *
 */

require_once _LIB_DIR_ . 'DAO.php';

class HistoryDAO extends DAO
{

    /**
     * Set of Variables
     */
    var $table = 'rireki'; //Table name


    /**
     * Constructor
     */
    function HistoryDAO()
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
     * 全件取得
     *
     * @return
     */
    function selectAll($year = null, $month = null, $day = null, $person = null)
    {
        if ($this->getError() !== null) {return;}

        if ($year !== null && $month != 0 && $day != 0 && $person == null) {
            $sql =& $this->con->prepare('SELECT history.*, family_name, first_name, lang_mode FROM history LEFT JOIN syutten2 ON history.members_id = syutten2.members_id WHERE history_date LIKE ? ORDER BY history_id DESC');
            $date = '%' . sprintf("%04d-%02d-%02d", $year, $month, $day) . '%';
            $res =& $this->con->execute($sql, $date);
        } else if ($year !== null && $month == 0 && $day == 0 && $person !== "") {
            $sql =& $this->con->prepare('SELECT history.*, family_name, first_name, lang_mode FROM history LEFT JOIN syutten2 ON history.members_id = syutten2.members_id WHERE syutten2.members_id LIKE ? ORDER BY history_id DESC');
            $person = '%' . $person . '%';
            $res =& $this->con->execute($sql, $person);
        } else if ($year !== null && $month != 0 && $day != 0 && $person !== null) {
            $sql =& $this->con->prepare('SELECT history.*, family_name, first_name, lang_mode FROM history LEFT JOIN syutten2 ON history.members_id = syutten2.members_id WHERE history_date LIKE ? and syutten2.members_id LIKE ? ORDER BY history_id DESC');
            $date = '%' . sprintf("%04d-%02d-%02d", $year, $month, $day) . '%';
            $person = '%' . $person . '%';
            $res =& $this->con->execute($sql, array($date,$person));
        } else {
            $sql =& $this->con->prepare('SELECT history.*, family_name, first_name, lang_mode, uid FROM history LEFT JOIN syutten2 ON history.members_id = syutten2.members_id ORDER BY history_id DESC');
            $res =& $this->con->execute($sql);
        }
        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
        }
    return $ary;
    }



    /**
     *一人分の履歴取得
     *
     * @return
     */
    function selectOne($members_id = null)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT history.*, family_name, first_name, lang_mode FROM history LEFT JOIN syutten2 ON history.members_id = syutten2.members_id WHERE history.members_id = ? ORDER BY history_id DESC');
	$res =& $this->con->execute($sql, $members_id);

        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
        }
    return $ary;
    }



    /**
     * インサート処理
     *
     * @param  int $members_id
     * @param  array $change_data 変更内容
     * @return
     */
    function newinsert($members_id='', $change_data='')
    {
        if ($this->getError() !== null) {return;}

	foreach( $change_data as $key1 => $val1 ){

          $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->table . '(
                update_day,
                update_time,
                semi_id,
                fieldname,
		oldvalue,
		newvalue
            ) VALUES (
                ?, ?, ?, ?, ?, ?
            )'
          );

          $ary = array(
            'update_day' => date("Y-m-d"),
            'update_time'  => date("H:i:s"),
            'semi_id'   => $members_id,
            'fieldname'  => $val1[label],
            'oldvalue'     => $val1[before],
            'newvalue'     => $val1[after]
          );

          $res =& $this->con->execute($sql, $ary);
	  if (DB::isError( $res )) {
	    print "更新履歴登録エラー：" . $res->getMessage() . "<br>";
//  	    print $res->getDebugInfo();
//	    die($res->getMessage());
	  }
	}

        $this->endProc($res, __LINE__);

    return;
    }



}

?>
