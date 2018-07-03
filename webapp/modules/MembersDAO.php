<?php
require_once _LIB_DIR_ . 'DAO.php';


class MembersDAO extends DAO
{

    /**
     * Set of Variables
     */
    var $table = 'luncheon'; //Table name
    var $mtable1 = 'chairspeaker'; //Table name

    /**
     * Constructor
     */
    function MembersDAO()
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
     * 一行取得
     *
     * @param  string $id
     * @param  string $field_name
     * @return array
     */
    function selectById($id, $field_name='members_id')
    {

        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field_name . ' = ?');
        $res =& $this->con->execute($sql, $id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

    return $res->fetchRow(DB_FETCHMODE_ASSOC);
    }



    /**
     * 担当者初期情報の取得
     *
     * @param  string 'all'     全データを1行にして返す lch_tantou
     *                'each'    全データを行数分返す lch_tantou
     *                コプロ名  該当行を返す tantou
     *                $ta_code  該当行を返す tantou 
     * @param  integer $num     フィールド名の末尾の番号 9:1行普通返し
     * @param  integer $semi_id 
     * @return array
     */

    function selectTantouInit($ta_code,$num=0,$semi_id=null)
    {

	if ($this->getError() !== null) {return;}

	if ($ta_code == "all" || $ta_code == "each") {
	   $sql =& $this->con->prepare('SELECT lch_code,
         lch_corp, lch_zip, lch_addr, lch_tel, lch_fax, lch_mobile, lch_man ,last_update 
	 FROM ' . $this->table . ' where semi_id = ? and lch_status = 0 order by detail');
            $res =& $this->con->execute($sql,$semi_id);
	} else if ($num==1 || $num==2) { //coproは社名検索
	    $sql =& $this->con->prepare('SELECT 
         ta_corp, ta_zip, ta_addr, ta_tel, ta_fax, ta_mobile, ta_man 
	 FROM ' . $this->table . ' 
	  where ta_corp = ? and ta_status = 0 order by ta_id');
            $res =& $this->con->execute($sql,$ta_code);
	} else { // ta_code検索 
	    $sql =& $this->con->prepare('SELECT 
         ta_corp, ta_zip, ta_addr, ta_tel, ta_fax, ta_mobile, ta_email, ta_man 
	 FROM tantou 
	  where ta_code = ? and ta_status = 0 order by ta_id');
            $res =& $this->con->execute($sql,$ta_code);
	}

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

	$i = ($ta_code == "all") ? 0 : 1 ;
        $ary = array();
	if ($ta_code=="all") {
            while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
		foreach ($row as $key => $val) { 
		    $varname = $key . $i;
        	    $ary[$varname] = $val;
		}
                $i ++;
            }
	} else if ($ta_code=="each" ) {
            while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
                $ary[] = $row;
            }
	} else if ($num ==9 ) {
            $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);
            $ary = $row;
	} else {
            $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);
	    foreach ($row as $key => $val) { 
		$varname = "lch" . substr($key,2) . $num;
        	$ary[$varname] = $val;
            }
	}

	return $ary;
    }



    /**
     * 座長/演者の人数取得
     *
     * @param  integer $semi_id
     * @param  integer $jitsu 1:空白データとNullを無視する
     * @return array
     */
    function getZaenNinzu($semi_id,$jitsu=null)
    {
        if ($this->getError() !== null) {return;}

        $ary = array('座長' => 0,'演者' => 0);
	if ($jitsu == 1) {
/*
          $sql =& $this->con->prepare("
	    select cs_yakuwari,count(cs_id) from " . $this->mtable1 .
	    " WHERE cs_status=0 and semi_id= ? and cs_name is not null and cs_name != '' group by cs_yakuwari");
*/
          $sql =& $this->con->prepare("
	    select cs_yakuwari,count(cs_id) from " . $this->mtable1 .
	    " WHERE cs_status=0 and semi_id= ? and length(cs_name) > 0 group by cs_yakuwari");

	} else {
          $sql =& $this->con->prepare("
	    select cs_yakuwari,count(cs_id) from " . $this->mtable1 .
	    " WHERE cs_status=0 and semi_id= ? group by cs_yakuwari");
	}

        $res =& $this->con->execute($sql,$semi_id);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[$row['cs_yakuwari']] = $row['count'];
        }

    return $ary;
    }


    /**
     * 全座長または演者情報の取得
     *
     * @param  string $id  セミナーID
     * @param  string $yaku  座長 or 演者
     * @param  integer $num  無:form用配列で返す
     *         1:人数分の行で返す 2空白を除外して人数分の行で返す
     * @return array
     */
    function selectZacho($id,$yaku,$num=null)
    {

	if ($this->getError() !== null) {return;}

	if ($num == '2') {
	  $sql =& $this->con->prepare("SELECT *  FROM chairspeaker WHERE 
 	    semi_id=? and cs_yakuwari=? and cs_status = 0 and length(cs_name) > 0 order by detail");
	} else {
          $sql =& $this->con->prepare("SELECT *  FROM chairspeaker WHERE 
 	    semi_id=? and cs_yakuwari=? and cs_status = 0 order by detail");
	}

	$ary = array('semi_id'=>$id,'cs_yakuwari'=>$yaku);
        $res =& $this->con->execute($sql,$ary);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

	$i=1;
        $ary = array();
	if ($num >= 1) {
          while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[]=$row;
          }
	} else {
          while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    foreach ($row as $key => $val) { // 
		$varname = $key . $i;
        	$ary[$varname] = $val;
	    }
	    $i += 1;
          }
	}

    return $ary;
    }



    /**
     * 担当者数を返す - 不要になるかも
     * @param  integer $semi_id
     * @return integer 
     */
    function selectTantouNum($semi_id)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT * FROM lch_tantou 
	       where lcht_status = 0 and semi_id = ?'); 

        $res =& $this->con->execute($sql,$semi_id);
	$lcht = $res->numRows();

    return $lcht;
    }



    /**
     * 担当者を追加登録します - 不要になるかも
     *
     * @param  string $val // 担当コード おそらくその他？
     * @param  integer $semi_id 
     * @return 
     */
    function insert_lch_tantou($val,$semi_id)
    {
        if ($this->getError() !== null) {return;}

	// 現在の行数を取得
	$ninzu = $this->selectTantouNum($semi_id);
	$detail = $ninzu + 1;

        $sql =& $this->con->prepare(
              'INSERT INTO lch_tantou (
                semi_id,
                lch_code,
                detail,
		last_update
              ) VALUES (
                ?, ?, ?, ?
              )'
            );

        //DB追加に必要な情報を作成
            $ary = array(
                'semi_id'  => $semi_id,
                'lch_code' => $val,
                'detail'   => $detail,
	        'last_update' => date("Y-m-d H:i:s")
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



    /**
     * oid->semi_id変換 !消すな!
     *
     * @param  integer $oid
     * @return integer $semi_id
     */
    function Trans_Oid_Semiid($oid)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT semi_id FROM ' . $this->table . ' WHERE oid = ?');
        $res =& $this->con->execute($sql, $oid);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);

    return $row['semi_id'];
    }



    /**
     * 基本情報の取得 座長の名前/役職やchairspeakerから
     *
     * @param  string $id  セミナーID
     * @param  string $field_name
     * @return array
     */
    function selectBasic($id, $field_name='members_id')
    {

       if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field_name . ' = ?');
        $res =& $this->con->execute($sql,$id);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }
	$row =& $res->fetchRow(DB_FETCHMODE_ASSOC);

	//chair
        $ary = array();
	$varname1="chair";
	$varname2="cyaku";
	$varname3="zacs_id";
	$i = 1;
	$ary = $this->selectZacho($id,'座長',1);
        for ($j=0;$j < _ZA_MAX_;$j++) {
            $row[$varname1 . $i] = $ary[$j]['cs_name'];
            $row[$varname2 . $i] = $ary[$j]['cs_yaku'];
            $row[$varname3 . $i] = $ary[$j]['cs_id'];
	    $i++;
        }

	//speaker
        $ary = array();
	$varname1="enshaname";
	$varname2="enshayaku";
	$varname3="endai";
	$varname4="encs_id";
	$i = 1;
	$ary = $this->selectZacho($id,'演者',1);
        for ($j=0;$j < _EN_MAX_;$j++) {
            $row[$varname1 . $i] = $ary[$j]['cs_name'];
            $row[$varname2 . $i] = $ary[$j]['cs_yaku'];
            $row[$varname3 . $i] = $ary[$j]['cs_endai'];
            $row[$varname4 . $i] = $ary[$j]['cs_id'];
	    $i++;
        }

    return $row;
    }



    /**
     * lch_tantou テーブルを更新します
     * @param integer semi_id
     * @param  array 1セミナーの担当者
     * @return boolean
     */
    function TantouUpdate($semi_id,$ArrTantou)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
	$loopmax = _TANTOU_MAX_;
	for ($i=0;$i < $loopmax;$i++) {
            $upd_sql = "last_update = ? ";
	    $ary['last_update'] = date('Y-m-d H:i:s');
            $upd_sql .= ", lch_corp = ? ";
	    $ary['lch_corp'] = $ArrTantou['lch_corp' .$i];
            $upd_sql .= ", lch_zip = ? ";
	    $ary['lch_zip'] = $ArrTantou['lch_zip' .$i];
            $upd_sql .= ", lch_addr = ? ";
	    $ary['lch_addr'] = $ArrTantou['lch_addr' .$i];
            $upd_sql .= ", lch_tel = ? ";
	    $ary['lch_tel'] = $ArrTantou['lch_tel' .$i];
            $upd_sql .= ", lch_fax = ? ";
	    $ary['lch_fax'] = $ArrTantou['lch_fax' .$i];
            $upd_sql .= ", lch_mobile = ? ";
	    $ary['lch_mobile'] = $ArrTantou['lch_mobile' .$i];
            $upd_sql .= ", lch_man = ? ";
	    $ary['lch_man'] = $ArrTantou['lch_man' .$i];

            $sql =& $this->con->prepare(
        	'UPDATE '.$this->table.' SET ' . $upd_sql . 
		' WHERE semi_id = ? and detail = ?');
	    $ary['semi_id']           = $semi_id;
	    $ary['detail'] = $i;
            $res =& $this->con->execute($sql, $ary);

	    if (DB::isError( $res )) {
		print "Update Error:". $i ."<br>";
		print $res->getDebugInfo();
//      	die($res->getMessage());
            }
	}

    $this->endProc($res, __LINE__);

      return;
    }



    /**
     * アップロード済みファイルの情報を返す
     *
     * @param  integer semi_id
     * @return array fileテーブル情報
     */
    function checkFile($semi_id)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT * FROM file WHERE semi_id = ? and status = 0');
        $sql =& $this->con->prepare('SELECT * FROM file WHERE semi_id = ? and status = 0 order by reg_id');
        $res =& $this->con->execute($sql, $semi_id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

	$ary = array();
	$gazou = "";
	while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
	}

    return $ary;
    }



    /**
     * ログイン認証
     *  渡されたパスワードはmd5で暗号化する
     *
     * @param  string $uid
     * @param  string $pwd
     * @return array 行全体の配列
     */
    function loginAuth($uid, $pwd)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT * FROM username WHERE userid = ? AND password = ?');
        $res =& $this->con->execute($sql, array($uid, $pwd)); 

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        if ($row = $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $this->setResult(true);
        } else {
            $this->setResult(false);
        }

    return $row;
    }



    /**
     * 参加者情報の更新
     *
     * @param integer $members_id
     * @param array $diff     変更項目
     * @param array $postData 新データ
     *                                
     * @return boolean
     */
    function newupdate($diff, $postData, $members_id)
    {

        if ($this->getError() !== null) {return;}

	$upd_sql = "kaisu = ?";    // ダミー項目 普通
        $ary['kaisu'] = "1";

	foreach ($diff as $key => $val) { // 
	    $varname = substr($val,0,5);
	    if ($varname == "chair" || $varname == "cyaku" || $varname == "endai" || $varname == "ensha" || $varname == "zacs_" || $varname == "encs_") {
		continue;
	    } // zacs_,encs_はchairspeakerのデータが欠けている対策

	    $upd_sql .= "," . $val . " = ?";
	    $ary[$val] = $postData[$val];
	}

        $upd_sql .= ", last_date = ? ";
	$ary['last_date'] = date('Y-m-d H:i:s');
	$ary['semi_id']           = $members_id;

        $sql =& $this->con->prepare(
            'UPDATE '.$this->table.' SET ' . $upd_sql . ' WHERE semi_id = ?');

        $res =& $this->con->execute($sql, $ary);

	if (DB::isError( $res )) {
		print "Update Error0：<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
	}

//      $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 座長演者情報の更新
     *
     * @param integer $cs_id
     * @param array $diff     変更項目
     * @param array $postData 新データ
     *                                
     * @return boolean
     */
    function updateZaen($diff, $postData)
    {

        if ($this->getError() !== null) {return;}

	$ary=array();
	$upd_sql = "cs_yobi = ?"; 
        $ary['cs_yobi'] = "1";

	foreach ($diff as $key => $val) { // 
//	    $nagasa = strlen($val) - 1;
//	    $colname = substr($val,0,$nagasa);
	    // 更新対象からはずす
//	    if ($colname == "cs_name" || $colname == "cs_yaku" || $colname == "cs_endai") continue; 

	    $upd_sql .= "," . $val . " = ?";
	    $ary[$val] = $postData[$val];
	}

        $upd_sql .= ", cs_reg_date = ? ";
	$ary['cs_reg_date'] = date('Y-m-d H:i:s');

	$ary['cs_id'] = $postData['cs_id'];
//	$ary['cs_id']           = $cs_id;

        $sql =& $this->con->prepare(
            'UPDATE '.$this->table.' SET ' . $upd_sql . ' WHERE cs_id = ? and cs_status=0');

        $res =& $this->con->execute($sql, $ary);

	if (DB::isError( $res )) {
		print "Update Error：<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
	}

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 座長演者情報の強制更新 Basic画面から座長演者を変更
     * @param array $postData 新データ
     * @param integer $semi_id
     *                                
     * @return 
     */
    function updateZaenBasic($postData, $semi_id)
    {

        if ($this->getError() !== null) {return;}

	$ary = array();
	if ($postData['nendo'] >= 2012) {
	    $zachoNum = _ZA_MAX_;
	    $enshaNum = _EN_MAX_;
	} else {
	    $zachoNum = 2;
	    $enshaNum = 4;
	}

//	for ($i=1;$i<= _ZA_MAX_;$i++) { // chair
	for ($i=1;$i<= $zachoNum;$i++) { // chair
            $sql =& $this->con->prepare(
	        'update chairspeaker set cs_name = ?, cs_yaku = ? 
		where semi_id = ? and cs_id = ?');

	    $varname1="chair" . $i;
	    $ary['cs_name'] = $postData[$varname1];
	    $varname2="cyaku" . $i;
	    $ary['cs_yaku'] = $postData[$varname2];
	    $ary['semi_id'] = $semi_id;
	    $varname3="zacs_id" . $i;
	    $ary['cs_id'] = $postData[$varname3];

            $res =& $this->con->execute($sql, $ary);
	}
	if (DB::isError( $res )) {
	    print "Update Error1：<br>";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
	}

	$ary = array(); 
//	for ($j=1;$j<= _EN_MAX_ ;$j++) { // speaker detailは21から
	for ($j=1;$j<= $enshaNum;$j++) { // speaker detailは21から

            $sql =& $this->con->prepare(
		'update chairspeaker set cs_name = ?, cs_yaku = ? , cs_endai = ?
		where semi_id = ? and cs_id = ?');

	    $varname1="enshaname" . $j;
	    $ary['cs_name'] = $postData[$varname1];
	    $varname2="enshayaku" . $j;
	    $ary['cs_yaku'] = $postData[$varname2];
	    $varname3="endai" . $j;
	    $ary['cs_endai'] = $postData[$varname3];
	    $ary['semi_id'] = $semi_id;
	    $varname4="encs_id" . $j;
	    $ary['cs_id'] = $postData[$varname4];

            $res =& $this->con->execute($sql, $ary);
	}
	if (DB::isError( $res )) {
	    print "Update Error2：<br>";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
	}


        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 座長演者数の強制更新 Tehai情報を更新 tehaiデータがなくてもerrorにならない
     * @param integer $semi_id
     * @param integer $realzacho ディスク書込み前の座長数
     * @param integer $realensha ディスク書込み前の演者数
     * @return 
     */
    function updateTehaiBasic1($semi_id,$realzacho,$realensha)
    {
        if ($this->getError() !== null) {return;}

// 	chairspeakerテーブルの座長演者数
	$zaenAry = $this->getZaenNinzu($semi_id,1);
	$zaenNum = $zaenAry['座長'] + $zaenAry['演者'];

	$realzaen = $realzacho + $realensha;
//      if (($zaenNum == $realzaen) && ($zaenAry['演者'] == $realensha)) {
//		return;
//	}

        $sql =& $this->con->prepare(
        //  "select * from tehai WHERE semi_id = ? and th_status = 0 and th_lookup = '演者'");
          "select * from tehai WHERE semi_id = ? and th_status = 0 and (th_hinmei like '%CV%' or th_hinmei like '%ＣＶ%')");
        $res =& $this->con->execute($sql, $semi_id);
	$enshaonly = $res->numRows();
        if ($enshaonly != 0) {
            $sql =& $this->con->prepare(
        	"UPDATE tehai SET th_reg_date = ? ,th_su = ? 
		  WHERE semi_id = ? and th_status = 0 and (th_hinmei like '%CV%' or th_hinmei like '%ＣＶ%')");

	    $ary = array();
	    $ary['th_reg_date'] = date('Y-m-d H:i:s');
	    $ary['th_su'] = $realensha; // $zaenAry['演者'];
	    $ary['semi_id'] = $semi_id;
            $res =& $this->con->execute($sql, $ary);
	    if (DB::isError( $res )) {
		print "Update Error：<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
	    }
	}

        $sql =& $this->con->prepare(
  //        "select * from tehai WHERE semi_id = ? and th_status = 0 and th_lookup = '座長演者'");
          "select * from tehai WHERE semi_id = ? and th_status = 0 and
	  (th_hinmei like '%座長演者%' or th_hinmei like '%座長･講師%' or 
	   th_hinmei like '%コーヒー%' or th_hinmei = '謝礼' or th_hinmei = '当日配布物')");
        $res =& $this->con->execute($sql, $semi_id);
	$zaenplus = $res->numRows();
        if ($zaenplus != 0) {
            $sql =& $this->con->prepare(
        	"UPDATE tehai SET th_reg_date = ? ,th_su = ? 
		  WHERE semi_id = ? and th_status = 0 and 
	  (th_hinmei like '%座長演者%' or th_hinmei like '%座長･講師%' or 
	   th_hinmei like '%コーヒー%' or th_hinmei = '謝礼' or th_hinmei = '当日配布物')");
	    $ary2 = array();
	    $ary2['th_reg_date'] = $ary['th_reg_date'];
	    $ary2['th_su'] = $realzaen; //$zaenNum;
	    $ary2['semi_id'] = $semi_id;
            $res =& $this->con->execute($sql, $ary2);
            if (DB::isError( $res )) {
		print "Update Error：<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
	    }
	}

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 座長演者数の強制更新 Tehai 資材数、弁当情報を更新
     * @param integer $num  資材数 or 弁当数
     * @param integer $flag 1:資材数 2:資材no 3:弁当数
     * @param integer $semi_id
     * @return 
     */
    function updateTehaiBasic2($num, $flag,$semi_id)
    {
        if ($this->getError() !== null) {return;}

	if ($flag == 1) {
          $sql =& $this->con->prepare(
            "select * from tehai WHERE semi_id = ? and th_status= 0 and th_hinmei in ('配布資料','アンケート')");
	} else if ($flag == 2) {
            $sql =& $this->con->prepare(
            "select * from tehai WHERE semi_id = ? and th_status= 0 and th_hinmei = '配布資料'"
	    );
	} else {
            $sql =& $this->con->prepare(
            "select * from tehai WHERE semi_id = ? and th_status= 0 and th_hinmei = 'セミナー用弁当'"
	    );
	}
        $res =& $this->con->execute($sql, $semi_id);
	$kensu = $res->numRows();
        if ($kensu == 0) return;

	$ary = array();
	if ($flag == 1) {
            $sql =& $this->con->prepare(
        	"UPDATE tehai SET th_reg_date = ? ,th_su = ? 
		  WHERE semi_id = ? and th_status = 0 and th_hinmei in ('配布資料','アンケート')");
	} else if ($flag == 2) {
            $sql =& $this->con->prepare(
        	"UPDATE tehai SET th_reg_date = ? ,th_bikou = ? 
		  WHERE semi_id = ? and th_status = 0 and th_hinmei = '配布資料'");
	} else {
            $sql =& $this->con->prepare(
        	"UPDATE tehai SET th_reg_date = ? ,th_su = ? 
		  WHERE semi_id = ? and th_status = 0 and th_hinmei = 'セミナー用弁当'");
	}

	$ary['th_reg_date'] = date('Y-m-d H:i:s');
	if ($flag == 2) {
	    $ary['th_bikou'] = "資材No:" . $num . "(個口)";
//	    $ary['th_bikou'] = "資材no:" . $num;
	} else {
	    $ary['th_su'] = $num; 
	}
	$ary['semi_id'] = $semi_id;
        $res =& $this->con->execute($sql, $ary);
	if (DB::isError( $res )) {
	    print "Update Error：<br>";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
	}

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * lch_tantou情報を更新
     * @param array $row 会社情報
     * @param string $code 担当コード 
     * @param integer $semi_id
     * @param integer $detail コプロ用明細番号
     * @return 
     */
    function updateTantouBasic($row, $lch_code, $semi_id,$detail=null)
    {

        if ($this->getError() !== null) {return;}

	$ary = array();

	if ($detail == 0) { 
          $sql =& $this->con->prepare(
        	'UPDATE lch_tantou SET 
	    lch_corp = ?,
	    lch_zip = ?,
	    lch_addr = ?,
	    lch_tel = ?,
	    lch_fax = ?,
	    lch_mobile = ?,
	    lch_email = ?,
	    lch_man = ?, 
	    last_update = ?
		  WHERE semi_id = ? and lch_status = 0 and lch_code=?');
	} else {
          $sql =& $this->con->prepare(
        	'UPDATE lch_tantou SET 
	    lch_corp = ?,
	    lch_zip = ?,
	    lch_addr = ?,
	    lch_tel = ?,
	    lch_fax = ?,
	    lch_mobile = ?,
	    lch_email = ?,
	    last_update = ?
		  WHERE semi_id = ? and lch_status = 0 and lch_code=? and detail=?');
//	    lch_man = ?,  除外
	}

	$ary['lch_corp'] = $row['ta_corp'];
	$ary['lch_zip'] = $row['ta_zip'];
	$ary['lch_addr'] = $row['ta_addr'];
	$ary['lch_tel'] = $row['ta_tel'];
	$ary['lch_fax'] = $row['ta_fax'];
	$ary['lch_mobile'] = $row['ta_mobile'];
	$ary['lch_email'] = $row['ta_email'];

	if ($detail == 0) $ary['lch_man'] = $row['ta_man']; 
	$ary['last_update'] = date('Y-m-d H:i:s');
	$ary['semi_id'] = $semi_id;
	$ary['lch_code'] = $lch_code;

	if ($detail != 0) $ary['detail'] = $detail;

        $res =& $this->con->execute($sql, $ary);
	if (DB::isError( $res )) {
		print "Update Error 6：<br>";
//		print $res->getDebugInfo();
//      	die($res->getMessage());
	}

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 講師略歴の更新 Tehai 講師CVを更新
     * @param string  $val  略歴
     * @param integer $semi_id
     * @param string $flag =null
     * @return 
     */
    function updateRyakureki($val, $semi_id, $flag=null)
    {
        if ($this->getError() !== null) {return;}

	$ary = array();

        $sql =& $this->con->prepare(
          "select * from tehai WHERE semi_id = ? and th_status = 0 and (th_hinmei like '%CV%' or th_hinmei like '%ＣＶ%')");
        $res =& $this->con->execute($sql, $semi_id);
	$kensu = $res->numRows();
        if ($kensu != 0) {
          $sql =& $this->con->prepare(
           "UPDATE tehai SET th_reg_date = ? ,th_bikou = ? 
	     WHERE semi_id = ? and th_status = 0 and th_code = '1' and (th_hinmei like '%CV%' or th_hinmei like '%ＣＶ%')");

	  $ary['th_reg_date'] = date('Y-m-d H:i:s');
	  $ary['th_bikou'] = $val; 
	  $ary['semi_id'] = $semi_id;
          $res =& $this->con->execute($sql, $ary);
	  if (DB::isError( $res )) {
	    print "Update Error：<br>";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
	  }
        }

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 役職選択メニュー用配列を返す
     * @param  integer $itemno
     * @param  string $name
     * @return array $ary
     */
    function getYakushoku($itemno, $name)
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare('SELECT cs_yaku FROM '.$this->mtable1.
	      ' where cs_name = ? and cs_status=0 ORDER BY cs_id desc limit ' . $itemno);
        $res =& $this->con->execute($sql,$name);
//	$sql =& $this->con->prepare('SELECT cs_yaku FROM '.$this->mtable1.
//	      '	where cs_name = ? ORDER BY cs_id limit ' . $itemno); 
//        $res =& $this->con->execute($sql,$name);

        $ary = array();
	$i=0;
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[$i] = $row['cs_yaku'];
            $i ++;
        }

    return $ary;
    }



    /**
     * コプロ選択メニュー用配列を返す
     * @param  
     * @return array $ary
     */
    function getCoproAry()
    {
        if ($this->getError() !== null) {return;}

	$sql =& $this->con->prepare("SELECT ta_corp FROM ".$this->table.
	      " where ta_status = 0 and ta_code = 'コプロ' ORDER BY ta_id"); 
        $res =& $this->con->execute($sql);

        $ary = array();
	$i=0;
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $ary[$i] = $row['ta_corp'];
            $i ++;
        }

    return $ary;
    }



    /**
     * 項目毎の個別更新
     *
     * @param integer $semi_id
     * @param string $table テーブル名
     * @param string $column 変更項目名
     * @param string $val 新データ
     *                                
     * @return boolean
     */
    function itemUpdate($semi_id,$table,$column, $val)
    {

        if ($this->getError() !== null) {return;}

	$upd_sql = $column . " = ?";
	$ary['val'] = $val;
	$ary['semi_id']           = $semi_id;

        $sql =& $this->con->prepare(
            'UPDATE '.$table.' SET ' . $upd_sql . ' WHERE semi_id = ?');

        $res =& $this->con->execute($sql, $ary);

	if (DB::isError( $res )) {
		print "Update Error：<br>";
		print $res->getDebugInfo();
//      	die($res->getMessage());
	}

    return;
    }



//**********************************************************************
// 申込登録時に使用(Registration)
//***********************************************************************
    /**
     * 新規データの登録1
     *
     * @param  array $postData フォームで入力された配列
     * @return integer セミナーID
     */
    function insert($postData)
    {

        if ($this->getError() !== null) {return;}

	// to get seminar id insert to identifer 
        $token = md5(microtime());

        $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->table . '(
                gakkai,
	        seminar,
                kaisaibi,
                last_date,
		sys_stat,
                status,
                narabi,
                nendo,
		tokensave
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'gakkai'  => $postData['gakkai'],
	    'seminar' => $postData['seminar'], 
            'kaisaibi'    => $postData['kaisaibi'],
            'last_date'   => $postData['last_date'],
            'sys_stat'    => $postData['sys_stat'],
            'status'      => $postData['status'],
            'narabi'      => $postData['narabi'],
            'nendo'       => $postData['nendo'],
            'tokensave'   => $token
        );

        $res =& $this->con->execute($sql, $ary);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        } else {
            $sql2 =& $this->con->prepare('SELECT semi_id FROM ' . $this->table . ' WHERE tokensave = ?');
            $res2 =& $this->con->execute($sql2, $token);
            $row2 = $res2->fetchRow(DB_FETCHMODE_ASSOC);
	}
        $this->endProc($res, __LINE__);

    return $row2['semi_id'];
    }



    /**
     * 新規データの登録2
     *
     * @param integer $semi_id セミナーID
     * @param integer $keisiki 2011年度以前形式のデータ作成
     * @return boolean
     */
    function insertAddition($semi_id,$keisiki=null)
    {

        if ($this->getError() !== null) {return;}

	// 座長
	$this->insert_zaen(4,$semi_id);
	$this->insert_zaen(4,$semi_id);
	if (empty($keisiki) == true) {
	    $this->insert_zaen(4,$semi_id);
	}

	// 演者
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);
	if (empty($keisiki) == false) {
	    return;
	}
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);
	$this->insert_zaen(5,$semi_id);

	// 手配物 1:控室,2:会場
    for ($th_code=1;$th_code<3;$th_code ++) {
	$sql =& $this->con->prepare('SELECT * FROM sy_tehai 
	  where th_code = ? and th_status=0 ORDER BY detail'); 
          $res =& $this->con->execute($sql,strval($th_code));

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

        $aryTeahi = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $aryTeahi[]=$row;
        }

	$num = count($aryTeahi);
	for ($i=0;$i<$num;$i++) {
	    $sql =& $this->con->prepare(
              'INSERT INTO tehai (
                semi_id,
		th_reg_date,
                th_hinmei,
	        th_su,
	        tehaisha,
	        kakunin,
	        th_bikou,
                th_lookup,
                th_code,
                detail
              ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
              )'
            );
            $ary = array(
                'semi_id'  => $semi_id,
	        'th_reg_date' => date("Y-m-d H:i:s"),
                'th_hinmei' =>$aryTeahi[$i]['th_hinmei'],
	        'th_su' =>$aryTeahi[$i]['th_su'],
	        'tehaisha' =>$aryTeahi[$i]['tehaisha'],
	        'kakunin' =>$aryTeahi[$i]['kakunin'],
	        'th_bikou' =>$aryTeahi[$i]['th_bikou'],
	        'th_lookup' =>$aryTeahi[$i]['th_lookup'],
                'th_code'  => $th_code,
                'detail'   => $aryTeahi[$i]['detail']
            );
            $res =& $this->con->execute($sql, $ary);
	}
    }

	// 人員配置 
	$sql =& $this->con->prepare('SELECT * FROM sy_jinin 
	  where ji_status = 0 ORDER BY detail'); 
          $res =& $this->con->execute($sql);

        $aryJinin = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $aryJinin[]=$row;
        }

	$num = count($aryJinin);
	for ($i=0;$i<$num;$i++) {
	    $sql =& $this->con->prepare(
              'INSERT INTO jinin (
                semi_id,
		ji_reg_date,
                ji_yakuwari,
	        ji_as,
	        ji_co1,
	        ji_cl,
	        ji_gakkai,
                ji_bikou,
	        ji_lookup,
                detail
              ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
              )'
            );
            $ary = array(
                'semi_id'  => $semi_id,
	        'ji_reg_date' => date("Y-m-d H:i:s"),
                'ji_yakuwari' =>$aryJinin[$i]['ji_yakuwari'],
	        'ji_as' =>$aryJinin[$i]['ji_as'],
	        'ji_co1' =>$aryJinin[$i]['ji_co'],
	        'ji_cl' =>$aryJinin[$i]['ji_cl'],
                'ji_gakkai'=>$aryJinin[$i]['ji_gakkai'],
	        'ji_bikou' =>$aryJinin[$i]['ji_bikou'],
	        'ji_lookup' =>$aryJinin[$i]['ji_lookup'],
                'detail'   =>$aryJinin[$i]['detail']
            );
            $res =& $this->con->execute($sql, $ary);
	}

	// 担当者 - 担当者名は移さない
        $aryTantou = array();
	$this->table = 'tantou';
	for ($i=0;$i<8;$i++) {
	    if ($i == 0) {
//		$aryTantou[$i] = $this->selectById('アステラス','ta_code');
		$aryTantou[$i] = $this->selectById(1,'ta_id');
// selectTantouInit は項目名に数字を付けて返すので使用できない
	    } else if ($i == 3) {
//		$aryTantou[$i] = $this->selectById('リンケージ','ta_code');
		$aryTantou[$i] = $this->selectById(12,'ta_id');
	    } else {
		$aryTantou[$i]['ta_code'] = $GLOBALS['DetailTantou'][$i];
		$aryTantou[$i]['ta_corp'] = "";
		$aryTantou[$i]['ta_zip'] = "";
		$aryTantou[$i]['ta_addr'] = "";
		$aryTantou[$i]['ta_tel'] = "";
		$aryTantou[$i]['ta_fax'] = "";
		$aryTantou[$i]['ta_mobile'] = "";
		$aryTantou[$i]['ta_email'] = "";
//		$aryTantou[$i]['ta_man'] = "";
	    }
	    $sql =& $this->con->prepare(
              'INSERT INTO lch_tantou (
                semi_id,
		last_update,
                lch_code,
		lch_corp,
		lch_zip,
		lch_addr,
		lch_tel,
		lch_fax,
		lch_mobile,
		lch_email,
                detail
              ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
              )'
            );
            $ary = array(
                'semi_id'  => $semi_id,
	        'last_update' => date("Y-m-d H:i:s"),
                'lch_code' => $aryTantou[$i]['ta_code'],
		'lch_corp' => $aryTantou[$i]['ta_corp'],
		'lch_zip' => $aryTantou[$i]['ta_zip'],
		'lch_addr' => $aryTantou[$i]['ta_addr'],
		'lch_tel' => $aryTantou[$i]['ta_tel'],
		'lch_fax' => $aryTantou[$i]['ta_fax'],
		'lch_mobile' => $aryTantou[$i]['ta_mobile'],
		'lch_email' => $aryTantou[$i]['ta_email'],
                'detail'   => $i
            );
            $res =& $this->con->execute($sql, $ary);
	}

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

    return;
    }



    /**
     * 座長/演者を追加登録します
     *
     * @param  integer $val // 4:chairman 5:speaker
     * @param  integer $semi_id 
     * @return 
     */
    function insert_zaen($val,$semi_id)
    {
        if ($this->getError() !== null) {return;}

	// 現在の人数を取得
	$ninzu = $this->getZaenNinzu($semi_id,2);
        if ($val == 4 ) {
	    $detail = $ninzu['座長'] + 1;
	    $zaen = "座長";
        } else if ($val == 5 ) {
	    $detail = $ninzu['演者'] + 1 + 20; //speakerは21からスタート
	    $zaen = "演者";
	}

        $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->mtable1 . '(
                semi_id,
	        cs_reg_date,
                cs_yakuwari,
                detail
            ) VALUES (
                ?, ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'semi_id'  => $semi_id,
	    'cs_reg_date' => date("Y-m-d H:i:s"),
            'cs_yakuwari'    => $zaen,
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
     * 責任者を更新する
     * @param  integer $semi_id
     * @param  string  $colname 変更項目名
     * @param  string $val 値
     * @return 
     */
    function updateSekinin($semi_id, $colname, $val)
    {
        if ($this->getError() !== null) {return;}

	// jininテーブルの責任者レコードの確認
//	$sql =& $this->con->prepare("SELECT * FROM jinin 
//	      where ji_status = 0 and semi_id = ? and ji_lookup ='責任者'"); 
	$sql =& $this->con->prepare("SELECT * FROM jinin 
	      where semi_id = ? and ji_status = 0 and  ji_yakuwari ='責任者'"); 
        $res =& $this->con->execute($sql,$semi_id);

	$num = $res->numRows();
	if ($num == 0 ) return;

        $sql =& $this->con->prepare(
            "UPDATE jinin SET ji_reg_date = ? ," .$colname . " = ? 
		  WHERE semi_id = ? and ji_yakuwari ='責任者' and ji_status = 0");

	$ary['ji_reg_date'] = date('Y-m-d H:i:s');
	$ary[$colname] = $val;
	$ary['semi_id'] = $semi_id;
        $res =& $this->con->execute($sql, $ary);

	if (DB::isError( $res )) {
	    print "Update Error 7:";
//	    print $res->getDebugInfo();
//          die($res->getMessage());
        }

    return $ary;
    }



    /**
     * メンバーID(PRIMARY KEY)の取得
     *
     * @param  string $uid
     * @param  string $wpd
     * @return string $row['members_id']
     */
/*
    function getMembersId($uid, $pwd)
    {
        $row = $this->loginAuth($uid, $pwd);
    return $row['members_id'];
    }
*/



    /**
     * 排他ロック
     *
     * @param  string $id
     * @param  string $field_name members_id 固定
     * @return array
     */
/* 動作しない
    function LockById($id, $field_name='members_id')
    {
        if ($this->getError() !== null) {return "NG";}

        $sql =& $this->con->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field_name . ' = ? for update nowait');
        $res =& $this->con->execute($sql, $id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
	    print $res->getDebugInfo();
    	    die($res->getMessage());
            return "NG";
        }

    return;
    }
*/


    /**
     * 人工排他ロック
     *
     * @param  string $semi_id
     * @param  string $logintoken
     * @return boolean;
     */
    function LockById2($semi_id,$logintoken)
    {
        if ($this->getError() !== null) {return ;}

        $sql =& $this->con->prepare(
            'INSERT INTO sy_work (
	        semi_id ,
	        lock_token, 
	        lock_time 
            ) VALUES (
                ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'semi_id'   => $semi_id,
            'lock_token'  => $logintoken,
            'lock_time'  => date('Y-m-d H:i:s')
        );

        $res =& $this->con->execute($sql, $ary);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return flase;
        }

    return true;
    }



    /**
     * ロック状態のチェック 
     *  lock後2時間経過していれば、ロック解除
     * @param  string $semi_id
     * @param  string $logintoken
     * @return array; $lockinfo  status,lock中のtoken
     */
    function LockCheck($semi_id,$logintoken)
    {
        if ($this->getError() !== null) {return ;}

	$lockinfo = array();
        $sql =& $this->con->prepare(
            'select * from sy_work where semi_id = ? '
        );

        $res =& $this->con->execute($sql, $semi_id);
        if (DB::isError($res)) {
//          $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
	    $lockinfo = array('status'=>'nonlock');
            return $lockinfo;
        }

        $row =& $res->fetchRow(DB_FETCHMODE_ASSOC);
	if ($row['lock_token'] == $logintoken ) {
	    $lockman = "mylock";
	} else {
	    $lockman = "otherlock";
	}

	$keikaSec = time() - strtotime($row['lock_time']);
	if ($keikaSec > 7200) {
          $sql =& $this->con->prepare(
            'delete from sy_work where semi_id = ? '
            );
            $res =& $this->con->execute($sql, $semi_id);
	    $lockinfo = array('status'=>'nonlock');
            return $lockinfo;
	}
	$lockinfo = array('status'=> $lockman,
		'token'=> $row['lock_token']
		);

    return $lockinfo;
    }



    /**
     * ロック解除
     *
     * @param  string $semi_id
     * @param  string $logintoken 
     * @return boolean
     */
//    function LockKaijo($semi_id, $logintoken)
    function LockKaijo($logintoken)
    {
        if ($this->getError() !== null) {return ;}

        $sql =& $this->con->prepare(
            'delete from sy_work 
		where lock_token = ?' );
        //ロック解除に必要な情報を作成
//	$ary = array('semi_id'  => $semi_id,
//		'lock_token' => $logintoken
//	);

        $res =& $this->con->execute($sql, $logintoken);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

    return ;
    }




}
?>
