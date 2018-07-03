<?php
require_once _LIB_DIR_ . 'DAO.php';

class TehaiDAO extends DAO
{

    /**
     * Set of Variables
     */
    var $table = 'tehai'; //DB Tabel name



    /**
     * Constructor
     */
    function TehaiDAO()
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
     * Transaction Start
     */
    function begin_trans()
    {
      $this->con->autoCommit( false );
    }



    /**
     * セミナー毎の手配品 控室 key名をform用にして返す
     * @param  integer $semi_id
     * @param  string $sort
     * @param  integer $sw 1:人数分の行で返す 無:form用配列で返す
     * @return array $ary
     */
    function selectAll($semi_id,$sort='semi_id',$sw=null)
    {
        if ($this->getError() !== null) {return;}

	if ($this->table == "tehai") {
	$sql =& $this->con->prepare('SELECT * FROM '.$this->table.
	      '	where th_status = 0 and semi_id = ?  ORDER BY th_code, ' . $sort); 
	} else if ($this->table == "jinin")  {
	$sql =& $this->con->prepare('SELECT * FROM '.$this->table.
	      '	where ji_status = 0 and semi_id = ?  ORDER BY ' . $sort); 
	}
        $res =& $this->con->execute($sql,$semi_id);

	$num = $res->numRows();
        if ($num == 0) {
	    return;
        }

	$i = 1;
	$j = 61;
        $ary = array();
	if ($sw==1) {
          while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[]=$row;
          }
	} else {
          while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    if ($row['th_code']==1 or $this->table == "jinin") {
	      foreach( $row as $key => $val ){
		$rows[$key . $i] = $val;
	      }
	      $i++;
	    } else {
	      foreach( $row as $key => $val ){
		$rows[$key . $j] = $val;
	      }
	      $j++;
	    }
            $ary +=$rows;
          }
	}
    return $ary;
    }



    /**
     * 控室 セミナー会場の手配品の数を返す 
     * @param  integer $semi_id
     * @return array $ary (hikae,kaijou)
     */
    function selectTehaiNum($semi_id)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT th_code,count(*) as kensu FROM '.$this->table.
	      '	where th_status = 0 and semi_id = ? group by th_code'); 
        $res =& $this->con->execute($sql,$semi_id);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
        $tempAry = array();
	$i = 0;
	while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $tempAry[$i] = $row['kensu'];
	    $i ++;
	}

	$ary['hikae'] = $tempAry[0];
	$ary['kaijo'] = $tempAry[1];

    return $ary;
    }



    /**
     * 人員配置の数を返す
     * @param  integer $semi_id
     * @return integer 
     */
    function selectJininNum($semi_id)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT * FROM jinin 
	       where ji_status = 0 and semi_id = ?'); 

        $res =& $this->con->execute($sql,$semi_id);
	$jinin = $res->numRows();

    return $jinin;
    }



    /**
     * 手配品を追加登録します
     *
     * @param  integer $val // 1:控室 2:セミナー会場
     * @param  integer $semi_id 
     * @return 
     */
    function insert_tehai($val,$semi_id)
    {
        if ($this->getError() !== null) {return;}

	// 現在の明細数を取得
	$hinsu = $this->selectTehaiNum($semi_id);
        if ($val == 1 ) {
	    $detail = $hinsu['hikae'] + 1;
        } else {
	    $detail = $hinsu['kaijo'] + 1 + 60; //会場は61からスタート
	}

        $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->table . '(
                semi_id,
	        th_reg_date,
                th_code,
                detail,
		th_status
            ) VALUES (
                ?, ?, ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'semi_id'  => $semi_id,
	    'th_reg_date' => date("Y-m-d H:i:s"),
            'th_code'    => $val,
            'detail'   => $detail,
            'th_status'  => 0
        );

        $res =& $this->con->execute($sql, $ary);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        return;
    }



    /**
     * 手配品を削除(status=1)します
     *
     * @param  integer $val // 1:控室 2:セミナー会場
     * @param  integer $semi_id 
     * @param  array   $detailary 削除する明細番号 
     * @return 
     */
    function delete_tehai($val,$semi_id,$detailary)
    {
        if ($this->getError() !== null) {return;}

	// 削除件数をカウント
        $delnum = count($detailary) - 1;
	// 新明細数を計算

	//まず削除処理
        //DB変更に必要な情報を作成
	$ary['th_reg_date'] = date('Y-m-d H:i:s');
	$ary['semi_id'] = $semi_id;
	for ($i=0;$i<$delnum;$i++) {
           $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET th_reg_date = ? ,th_status = 1 
		  WHERE semi_id = ? and detail = ?');

	   $ary['detail'] = $detailary[$i];
           $res =& $this->con->execute($sql, $ary);

	}
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

	// 明細番号の再付番
	$ary2['th_reg_date'] = date('Y-m-d H:i:s');
	$ary2['semi_id'] = $semi_id;
	$ary2['th_code'] = $val;
	for ($i=0;$i<$delnum;$i++) {
           $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET th_reg_date = ? ,detail = (detail - 1) 
		  WHERE semi_id = ? and th_status = 0 and th_code = ? and detail > ' . $detailary[$i]);

           $res =& $this->con->execute($sql, $ary2);
	}

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        return;
    }



    /**
     * 人員配置を削除(status=1)します
     *
     * @param  integer $semi_id 
     * @param  array   $detailary 削除する明細番号 
     * @return 
     */
    function delete_jinin($semi_id,$detailary)
    {
        if ($this->getError() !== null) {return;}

	// 削除件数をカウント
        $delnum = count($detailary) - 1;

	//まず削除処理
        //DB変更に必要な情報を作成
	$ary['ji_reg_date'] = date('Y-m-d H:i:s');
	$ary['semi_id'] = $semi_id;
	for ($i=0;$i<$delnum;$i++) {
           $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ji_reg_date = ? ,ji_status = 1 
		  WHERE semi_id = ? and detail = ?');

	   $ary['detail'] = $detailary[$i];
           $res =& $this->con->execute($sql, $ary);

	}
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

	// 明細番号の再付番
	$ary2['ji_reg_date'] = $ary['ji_reg_date'];
	$ary2['semi_id'] = $semi_id;
	for ($i=0;$i<$delnum;$i++) {
           $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ji_reg_date = ? ,detail = (detail - 1) 
		  WHERE semi_id = ? and ji_status = 0 and detail > ' . $detailary[$i]);

           $res =& $this->con->execute($sql, $ary2);
	}

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        return;
    }



    /**
     * tehai テーブルを更新します
     * @param  integer semi_id
     * @param  array 1セミナーの手配物
     * @return boolean
     */
    function detailUpdate($semi_id,$ArrTehai)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
        $i = 1;
	$loopmax = _KAIJO_MAX_ + 60;
	for ($i=1;$i <= $loopmax;$i++) {
	    if ($i > _HIKAE_MAX_ && $i <= 60 ) continue;
            $upd_sql = "th_reg_date = ? ";
	    $ary['th_reg_date'] = date('Y-m-d H:i:s');
            $upd_sql .= ", th_hinmei = ? ";
	    $ary['th_hinmei'] = $ArrTehai['th_hinmei' .$i];
            $upd_sql .= ", th_su = ? ";
	    $ary['th_su'] = $ArrTehai['th_su' .$i];
            $upd_sql .= ", tehaisha = ? ";
	    $ary['tehaisha'] = $ArrTehai['tehaisha' .$i];
            $upd_sql .= ", kakunin = ? ";
	    $ary['kakunin'] = $ArrTehai['kakunin' .$i];
            $upd_sql .= ", th_bikou = ? ";
	    $ary['th_bikou'] = $ArrTehai['th_bikou' .$i];

            $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ' . $upd_sql . 
		' WHERE semi_id = ? and detail = ?');
	    $ary['semi_id']           = $semi_id;
	    $ary['detail'] = $i;
            $res =& $this->con->execute($sql, $ary);

	    if (DB::isError( $res )) {
		print "Update Error:". $i ."<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
            }

	}

      $this->endProc($res, __LINE__);

      return;
    }



    /**
     * sy_tehai テーブルを更新します
     * @param  integer 1控室 2会場
     * @param  array 手配物
     * @return boolean
     */
    function TehaiOrgUpdate($th_code,$ArrTehai)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
	if ($th_code == 1) {
	    $loop = _HIKAE_MAX_;
	    $j = 1;
	} else if ($th_code == 2) {
	    $loop = _KAIJO_MAX_ ;
	    $j = 61;
	}
	for ($i=1;$i <= $loop ;$i++) {
            $upd_sql = " th_hinmei = ? ";
	    $ary['th_hinmei'] = $ArrTehai['th_hinmei' .$j];
            $upd_sql .= ", th_su = ? ";
	    $ary['th_su'] = $ArrTehai['th_su' .$j];
            $upd_sql .= ", tehaisha = ? ";
	    $ary['tehaisha'] = $ArrTehai['tehaisha' .$j];
            $upd_sql .= ", kakunin = ? ";
	    $ary['kakunin'] = $ArrTehai['kakunin' .$j];
            $upd_sql .= ", th_bikou = ? ";
	    $ary['th_bikou'] = $ArrTehai['th_bikou' .$j];
            $upd_sql .= ", th_lookup = ? ";
	    $ary['th_lookup'] = $ArrTehai['th_lookup' .$j];
            $upd_sql .= ", th_status = ? ";
	    $ary['th_status'] = $ArrTehai['th_status' .$j];

            $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ' . $upd_sql . 
		' WHERE th_code = ? and detail = ?');
	    $ary['th_code'] = $th_code;
	    $ary['detail'] = $j;

            $res =& $this->con->execute($sql, $ary);

	    if (DB::isError( $res )) {
		print "Update Error:". $j ."<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
            }
	    $j ++;
	}

//    $this->endProc($res, __LINE__);

      return;
    }



    /**
     * 人員配置を追加登録します
     *
     * @param  integer $semi_id 
     * @return 
     */
    function insert_jinin($semi_id)
    {
        if ($this->getError() !== null) {return;}

	// 現在の明細数を取得
	$ninzu = $this->selectJininNum($semi_id);
	$detail = $ninzu + 1;

        $sql =& $this->con->prepare(
            'INSERT INTO jinin (
                semi_id,
	        ji_reg_date,
                detail
            ) VALUES (
                ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'semi_id'  => $semi_id,
	    'th_reg_date' => date("Y-m-d H:i:s"),
            'detail'   => $detail
        );

        $res =& $this->con->execute($sql, $ary);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        return;
    }



    /**
     * jinin テーブルを更新します
     * @param  integer semi_id
     * @param  array 1セミナーの人員配置
     * @return boolean
     */
    function JininUpdate($semi_id,$ArrJinin)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
        $i = 1;
	$loopmax = _JININ_MAX_;
	for ($i=1;$i <= $loopmax;$i++) {
            $upd_sql = "ji_reg_date = ? ";
	    $ary['ji_reg_date'] = date('Y-m-d H:i:s');
            $upd_sql .= ", ji_yakuwari = ? ";
	    $ary['ji_yakuwari'] = $ArrJinin['ji_yakuwari' .$i];
            $upd_sql .= ", ji_as = ? ";
	    $ary['ji_as'] = $ArrJinin['ji_as' .$i];
            $upd_sql .= ", ji_co1 = ? ";
	    $ary['ji_co1'] = $ArrJinin['ji_co1' .$i];
            $upd_sql .= ", ji_co2 = ? ";
	    $ary['ji_co2'] = $ArrJinin['ji_co2' .$i];
            $upd_sql .= ", ji_cl = ? ";
	    $ary['ji_cl'] = $ArrJinin['ji_cl' .$i];
            $upd_sql .= ", ji_gakkai = ? ";
	    $ary['ji_gakkai'] = $ArrJinin['ji_gakkai' .$i];
            $upd_sql .= ", ji_bikou = ? ";
	    $ary['ji_bikou'] = $ArrJinin['ji_bikou' .$i];

            $sql =& $this->con->prepare(
        	'UPDATE jinin SET ' . $upd_sql . 
		' WHERE semi_id = ? and detail = ?');
	    $ary['semi_id']           = $semi_id;
	    $ary['detail'] = $i;
            $res =& $this->con->execute($sql, $ary);

	    if (DB::isError( $res )) {
		print "Update Error:". $i ."<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
            }

	}

      $this->endProc($res, __LINE__);

      return;
    }



    /**
     * sy_jinin テーブルを更新します
     * @param  array 人員配置
     * @return boolean
     */
    function JininOrgUpdate($ArrJinin)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
	$loop = _JININ_MAX_;
	for ($i=1;$i <= $loop ;$i++) {
            $upd_sql = " ji_yakuwari = ? ";
	    $ary['ji_yakuwari'] = $ArrJinin['ji_yakuwari' .$i];
            $upd_sql .= ", ji_as = ? ";
	    $ary['ji_as'] = $ArrJinin['ji_as' .$i];
            $upd_sql .= ", ji_co = ? ";
	    $ary['ji_co'] = $ArrJinin['ji_co' .$i];
            $upd_sql .= ", ji_cl = ? ";
	    $ary['ji_cl'] = $ArrJinin['ji_cl' .$i];
            $upd_sql .= ", ji_gakkai = ? ";
	    $ary['ji_gakkai'] = $ArrJinin['ji_gakkai' .$i];
            $upd_sql .= ", ji_bikou = ? ";
	    $ary['ji_bikou'] = $ArrJinin['ji_bikou' .$i];
            $upd_sql .= ", ji_lookup = ? ";
	    $ary['ji_lookup'] = $ArrJinin['ji_lookup' .$i];
            $upd_sql .= ", ji_status = ? ";
	    $ary['ji_status'] = $ArrJinin['ji_status' .$i];

            $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ' . $upd_sql . 
		' WHERE detail = ?');
	    $ary['detail'] = $i;

            $res =& $this->con->execute($sql, $ary);

	    if (DB::isError( $res )) {
		print "Update Error:". $j ."<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
            }
	}

//    $this->endProc($res, __LINE__);

      return;
    }



    /**
     * セミナー毎の手配品 控室 key名を表形式用に加工して返す（管理者用）
     * @param  integer 1控室 2会場 3人員
     * @return array $ary
     */
    function getTehaiDefault($th_code=null)
    {
        if ($this->getError() !== null) {return;}

	if ($this->table == "sy_tehai") {
	$sql =& $this->con->prepare('SELECT * FROM '.$this->table.
	      '	where th_code = ? ORDER BY detail'); 
        	$res =& $this->con->execute($sql,$th_code);
	} else if ($this->table == "sy_jinin")  {
	$sql =& $this->con->prepare('SELECT * FROM '.$this->table.
	      '	ORDER BY detail'); 
        	$res =& $this->con->execute($sql);
	}

	if ($th_code==1 ||$th_code==3) $i = 1;
	else if ($th_code==2 ) $i = 61;
        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    foreach( $row as $key => $val ){
		$rows[$key . $i] = $val;
	    }
	    $i++;
            $ary +=$rows;
        }

    return $ary;
    }



    /**
     * 手配品 選択メニュー用配列を返す
     * @param  integer $th_code 1控え室 2会場
     * @return array $ary
     */
    function getTehaiAry($th_code)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT th_hinmei FROM '.$this->table.
	      '	where th_status = 0 and th_code = ?  ORDER BY detail'); 
        $res =& $this->con->execute($sql,$th_code);

        $ary = array();
	$i=0;
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[$i] = $row['th_hinmei'];
            $i ++;
        }

    return $ary;
    }



    /**
     * 手配品 選択メニュー用配列を返す
     * @param  
     * @return array $ary
     */
    function getJininAry()
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT ji_yakuwari FROM '.$this->table.
	      '	where ji_status = 0 ORDER BY detail'); 
        $res =& $this->con->execute($sql);

        $ary = array();
	$i=0;
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[$i] = $row['ji_yakuwari'];
            $i ++;
        }

    return $ary;
    }



    /**
     * 責任者を返す
     * @param  integer $semi_id
     * @return array $ary
     */
    function getSekinin($semi_id)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare("SELECT * FROM jinin 
	      where ji_status = 0 and semi_id = ? and ji_lookup='責任者'"); 
        $res =& $this->con->execute($sql,$semi_id);

	if (DB::isError( $res )) {
	    print "Error:Sekinin";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
        }

        $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);

    return $row;
    }



    /**
     * 削除処理
     *
     * @param  int $session_id
     */
/*
    function delete($session_id)
    {
        if ($this->getError !== null) {return;}

        $sql =& $this->con->prepare('DELETE FROM ' . $this->table . ' WHERE session_id = ?');
        $res =& $this->con->execute($sql, array($session_id));

        $this->endProc($res, __LINE__);

    return;
    }
*/


    /**
     * 排他ロック
     *
     * @param  string $id
     * @param  string $field_name session_id 固定
     * @return array
     */
    function LockSById($id, $field_name='session_id')
    {
        if ($this->getError() !== null) {return "NG";}

        $sql =& $this->con->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field_name . ' = ? for update nowait');
        $res =& $this->con->execute($sql, $id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return "NG";
        }

    return;
    }



}
?>
