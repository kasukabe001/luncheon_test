<?php
require_once _LIB_DIR_ . 'DAO.php';

class AdminDAO extends DAO
{

    /**
     * Set of Variables
     */
    var $table = 'tantou'; //DB Tabel name
    var $subtable = 'luncheon'; //DB Tabel name


    /**
     * Constructor
     */
    function AdminDAO()
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
     * 全行取得取得
     *
     * @param  string $searchMode
     * @param  string $searchField
     * @param  string $condition // 検索条件
     * @return array
     */
    function selectAll($searchMode = null, $searchField = null,$condition)
    {
        if ($this->getError() !== null) {return;}

	// $conditionから検索条件を抽出
//	if ($condition['forumType'] !="") $val=" and " . $condition['forumType'] . " > 0";
	if ($condition['SpInfo'] !="") $val .=" and ta_code = '" .$condition['SpInfo'] . "'";
//	if ($condition['EqInfo'] !="") $val .=" and visa = '" . $condition['EqInfo'] ."'";
print $val;
        // 検索欄に入力があった時
        if ($searchMode !== null && (empty($searchField) == false)) {
            // 問合せ番号検索の場合
            if ($searchMode == 'ta_id') {
                $sql =& $this->con->prepare("SELECT * FROM ".$this->table." WHERE ta_id = ? AND last_update is not null " .$val. " ORDER BY ta_status ,ta_id ");
                $res =& $this->con->execute($sql, $searchField);
            } else {
                $searchMode = quotemeta($searchMode);
                $sql =& $this->con->prepare("SELECT * FROM ".$this->table." WHERE " . $searchMode . " LIKE ? AND last_update is not null " .$val. " ORDER BY ta_status,ta_id ");
                $searchField = '%' . $searchField . '%';
                $res =& $this->con->execute($sql, $searchField);

            }

        // 検索フィールドに入力がない時(デフォルト)
        } else {
            $sql =& $this->con->prepare("SELECT * FROM ".$this->table." WHERE ta_status is not null " .$val. " ORDER BY ta_status ,ta_id ");
            $res =& $this->con->execute($sql);
        }

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
        }

    return $ary;
    }



    /**
     * 全行取得
     *
     * @param  string $table_name
     * @param  string $field_name ソート項目
     * @return array
     */

    function SelectAllLock($tablename, $fieldname)
    {
        if ($this->getError() !== null) {return;}


        $sql =& $this->con->prepare("SELECT * FROM ".$tablename . " ORDER BY " . $fieldname);
        $res =& $this->con->execute($sql);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $row['jp_seminar'] = $this->GetSeminarName($row['semi_id']);
            $ary[] = $row;
        }

    return $ary;
    }



    /**
     * ユニークIDより一行取得
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
        $res =& $this->con->execute($sql, array($id));

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

    return $res->fetchRow(DB_FETCHMODE_ASSOC);
    }



    /**
     * 情報の更新
     *
     * @param array $diff     変更項目
     * @param array $postData 新データ
     * @param integer $ta_id
     * @return boolean
     */
    function newupdate($diff, $postData, $ta_id)
    {
        if ($this->getError() !== null) {return;}

	if ($this->table == "tantou") $type = 1;
	else $type = 2;

	if ($type == 1) {
	    $id ='ta_id';
	    $tblname = $this->table;
	    $upd_sql = "yobi = ?"; // ダミー項目
            $ary['yobi'] = 1;
	} else {
	    $id ='members_id';
	    $tblname = $this->subtable;
	    $upd_sql = "yobi8 = ?"; // ダミー項目
            $ary['yobi8'] = 1;
	}
	foreach ($diff as $key => $val) { // 
	    $upd_sql .= "," . $val . " = ?";
	    $ary[$val] = $postData[$val];
	}
// print $upd_sql;

	if ($type == 1) {
	    $upd_sql .= ", last_update  = ?";
            $ary['last_update'] = date('Y-m-d H:i:s');
	    $ary['ta_id']       = $ta_id;
	} else {
	    $upd_sql .= ", last_update  = ?";
            $ary['last_update'] = date('Y-m-d H:i:s');
	    $ary['members_id']           = $reg_id;
	}

        $sql =& $this->con->prepare(
            'UPDATE '.$tblname.' SET ' . $upd_sql . ' WHERE ' . $id . ' = ?');

        $res =& $this->con->execute($sql, $ary);

	if (DB::isError( $res )) {
		print "Update Error：<br>";
		print $res->getDebugInfo();
//      	die($res->getMessage());
	}

        $this->endProc($res, __LINE__);

    return;
    }



    /**
     * 強制ロック解除
     *
     * @param  integer $semi_id
     * @return boolean
     */
    function LockKaijo($semi_id)
    {
        if ($this->getError() !== null) {return ;}

        $sql =& $this->con->prepare(
            'delete from sy_work where semi_id =?' );
        $res =& $this->con->execute($sql, $semi_id);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

    return;
    }



    /**
     * Timeoutしたsession idを取得
     *
     * @return array
     */

    function SelectTimeout()
    {
        if ($this->getError() !== null) {return;}

	$before3 = date('Y-m-d H:i:s',time()-10800);

        $sql =& $this->con->prepare("SELECT * FROM sy_work where lock_time < ? ORDER BY sy_work_id");
        $res =& $this->con->execute($sql,$before3);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
        }

    return $ary;
    }



    /**
     * Delete Time Outデータ削除
     *
     * @param  integer $semi_id
     * @return 
     */
    function deleteById($semi_id)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('delete FROM sy_work WHERE semi_id = ?');
        $res =& $this->con->execute($sql, $semi_id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

    return;
    }



    /**
     * semi_id->学会名!
     *
     * @param  integer $semi_id
     * @return string  学会名
     */
    function GetSeminarName($semi_id)
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare('SELECT gakkai FROM luncheon WHERE semi_id = ?');
        $res =& $this->con->execute($sql, $semi_id);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);

    return $row['gakkai'];
    }



//**********************************************************************
// 担当者登録時に使用(Registration)
//***********************************************************************
    /**
     * 申込登録からのDB処理
     *
     * @param  array $postData フォームで入力された配列
     * @return integer 
     */
    function insert($postData)
    {

        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare(
            'INSERT INTO ' . $this->table . '(
                ta_code,
	        ta_corp,
                ta_zip,
                ta_addr,
		ta_tel,
                ta_fax,
                ta_mobile,
	        last_update,
                ta_email,
		ta_man
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )'
        );

        //DB追加に必要な情報を作成
        $ary = array(
            'ta_code'  => $postData['ta_code'],
	    'ta_corp' => $postData['ta_corp'], 
            'ta_zip'    => $postData['ta_zip'],
            'ta_addr'   => $postData['ta_addr'],
            'ta_tel'      => $postData['ta_tel'],
            'ta_fax'      => $postData['ta_fax'],
            'ta_mobile'   => $postData['ta_mobile'],
	    'last_update' => date("Y-m-d H:i:s"),
            'ta_email'    => $postData['ta_email'],
            'ta_man'   => $postData['ta_man']
        );

        //prepare で設定したreg_dateを + で繋いでSQL実行
        $res =& $this->con->execute($sql, $ary);
        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
//	    print $res->getDebugInfo();
//    	    die($res->getMessage());
            return;
        }

//      $this->endProc($res, __LINE__);

    return ;
    }



//**********************************************************************
// 集計部分で使用
//***********************************************************************



    /**
     * 有効/キャンセル
     *
     * @param  なし
     * @return array 
     */
    function CountVarid()
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare("SELECT count(*) as kensu FROM ".$this->subtable." group by status order by kensu desc");
        $res =& $this->con->execute($sql);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
	$i = 0;
	while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[$i] = $row['kensu'];
	    $i ++;
	}

    return $ary;
    }



    /**
     * セミナー数を返す
     *
     * @param  なし
     * @return array (全セミナー数、今年度の件数、進捗中の件数)
     */
    function CountSeminar()
    {
        if ($this->getError() !== null) {return;}

	$ary = array();
	$year = date('Y');
	$month = date('m');
	$beforeYear = $year - 1;
	if ($month <= '03') {
		$year -= 1;
		$beforeYear -= 1;
	}

        $sql =& $this->con->prepare('SELECT semi_id FROM '.$this->subtable.' where sys_stat = 0');
        $res =& $this->con->execute($sql);
	$ary[0] = $res->numRows();

        $sql =& $this->con->prepare('SELECT semi_id FROM '.$this->subtable.' where sys_stat = 0 and nendo = ?');
        $res =& $this->con->execute($sql,$beforeYear);
	$ary[1] = $res->numRows();

        $sql =& $this->con->prepare("SELECT semi_id FROM ".$this->subtable." where sys_stat = 0 and nendo = ? and status='終了'");
        $res =& $this->con->execute($sql,$year);
	$ary[2] = $res->numRows();

        $sql =& $this->con->prepare("SELECT semi_id FROM ".$this->subtable." where sys_stat = 0 and nendo = ? and status='進行中'");
        $res =& $this->con->execute($sql,$year);
	$ary[3] = $res->numRows();

    return $ary;
    }



    /**
     * セミナー数を返す
     *
     * @param  Integer $nendo
     * @return array (全セミナー数、今年度の件数、進捗中の件数)
     */
    function getNendoData($nendo)
    {

        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare(
	    "SELECT semi_id,kaisaibi FROM luncheon where sys_stat=0 and 
	    nendo = ? ORDER BY semi_id");
        $res =& $this->con->execute($sql,$nendo);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $ary = array();
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {
            $ary[] = $row;
        }

    return $ary;
    }

//**********************************************************************
// CSVダウンロード
//***********************************************************************



    /**
     * 参加者CSV
     *
     * @return array
     */
    function MembersCSV()
    {
        if ($this->getError() !== null) {return;}

        $sql =& $this->con->prepare("SELECT * 
FROM members_t 
WHERE  members_t.status = 't'
ORDER BY members_t.members_id");
        $res =& $this->con->execute($sql);

        if (DB::isError($res)) {
            $this->setError($res->getMessage()." (".__LINE__.")");
            return;
        }

        $item  = "\"" . mb_convert_encoding("Regi_ID",       'Shift_JIS', _CHARSET_) . "\","; //members_id
        $item .= "\"" . mb_convert_encoding("Regi_Date",           'Shift_JIS', _CHARSET_) . "\","; //reg_date
        $item .= "\"" . mb_convert_encoding("Regi_Time",           'Shift_JIS', _CHARSET_) . "\","; //reg_time
        $item .= "\"" . mb_convert_encoding("Title", 'Shift_JIS', _CHARSET_) . "\","; //title
        $item .= "\"" . mb_convert_encoding("Family name",    'Shift_JIS', _CHARSET_) . "\","; //familyname
        $item .= "\"" . mb_convert_encoding("Given name",    'Shift_JIS', _CHARSET_) . "\","; //givenname
        $item .= "\"" . mb_convert_encoding("MI", 'Shift_JIS', _CHARSET_) . "\","; //mi

        $item .= "\"" . mb_convert_encoding("Dept",      'Shift_JIS', _CHARSET_) . "\","; //dept
        $item .= "\"" . mb_convert_encoding("Organization",  'Shift_JIS', _CHARSET_) . "\","; //organization
        $item .= "\"" . mb_convert_encoding("Country1",      'Shift_JIS', _CHARSET_) . "\","; //country1
        $item .= "\"" . mb_convert_encoding("Contact",'Shift_JIS', _CHARSET_) . "\","; //contact

        $item .= "\"" . mb_convert_encoding("Street",  'Shift_JIS', _CHARSET_) . "\","; //street
        $item .= "\"" . mb_convert_encoding("State",   'Shift_JIS', _CHARSET_) . "\","; //state
        $item .= "\"" . mb_convert_encoding("Zip code",  'Shift_JIS', _CHARSET_) . "\","; //zip
        $item .= "\"" . mb_convert_encoding("Country2",    'Shift_JIS', _CHARSET_) . "\","; //country2
        $item .= "\"" . mb_convert_encoding("TEL",        'Shift_JIS', _CHARSET_) . "\","; //tel
        $item .= "\"" . mb_convert_encoding("FAX",        'Shift_JIS', _CHARSET_) . "\","; //fax
        $item .= "\"" . mb_convert_encoding("Email",      'Shift_JIS', _CHARSET_) . "\","; //email

        $item .= "\"" . mb_convert_encoding("同伴者1fmaily",  'Shift_JIS', _CHARSET_) . "\","; //acc1_familyname
        $item .= "\"" . mb_convert_encoding("同伴者1given",  'Shift_JIS', _CHARSET_) . "\","; //acc1_givenname
        $item .= "\"" . mb_convert_encoding("同伴者1mi",  'Shift_JIS', _CHARSET_) . "\","; //acc1_mi
        $item .= "\"" . mb_convert_encoding("同伴者1title",  'Shift_JIS', _CHARSET_) . "\","; //acc1_title
        $item .= "\"" . mb_convert_encoding("同伴者2fmaily",  'Shift_JIS', _CHARSET_) . "\","; //acc2_familyname
        $item .= "\"" . mb_convert_encoding("同伴者2given",  'Shift_JIS', _CHARSET_) . "\","; //acc2_givenname
        $item .= "\"" . mb_convert_encoding("同伴者2mi",  'Shift_JIS', _CHARSET_) . "\","; //acc2_mi
        $item .= "\"" . mb_convert_encoding("同伴者2title",  'Shift_JIS', _CHARSET_) . "\","; //acc2_title
        $item .= "\"" . mb_convert_encoding("区分",  'Shift_JIS', _CHARSET_) . "\","; //kubun
        $item .= "\"" . mb_convert_encoding("同伴者",  'Shift_JIS', _CHARSET_) . "\","; //acc_p_num

        $item .= "\"" . mb_convert_encoding("Optional tour",  'Shift_JIS', _CHARSET_) . "\","; //acc_pro_num

        $item .= "\"" . mb_convert_encoding("Banquet",      'Shift_JIS', _CHARSET_) . "\","; //banquet
        $item .= "\"" . mb_convert_encoding("Hotel",    'Shift_JIS', _CHARSET_) . "\","; //hotel

        $item .= "\"" . mb_convert_encoding("Visa",  'Shift_JIS', _CHARSET_) . "\","; //visa
        $item .= "\"" . mb_convert_encoding("workshop1",      'Shift_JIS', _CHARSET_) . "\","; //workshop1
        $item .= "\"" . mb_convert_encoding("workshop2",      'Shift_JIS', _CHARSET_) . "\","; //workshop2
        $item .= "\"" . mb_convert_encoding("Invoice",      'Shift_JIS', _CHARSET_) . "\","; //invoice
        $item .= "\"" . mb_convert_encoding("Invoice宛名", 'Shift_JIS', _CHARSET_) . "\","; //inv_name
        $item .= "\"" . mb_convert_encoding("Invoice No.", 'Shift_JIS', _CHARSET_) . "\","; //inv_no
        $item .= "\"" . mb_convert_encoding("参加費",    'Shift_JIS', _CHARSET_) . "\","; //amount_regfee

        $item .= "\"" . mb_convert_encoding("同伴者参加費",'Shift_JIS', _CHARSET_) . "\","; //amount_accom
        $item .= "\"" . mb_convert_encoding("Optional tour",     'Shift_JIS', _CHARSET_) . "\","; //amount_acpro
        $item .= "\"" . mb_convert_encoding("Banquet費", 'Shift_JIS', _CHARSET_) . "\","; //amount_banq

        $item .= "\"" . mb_convert_encoding("総額",    'Shift_JIS', _CHARSET_) . "\","; //amount_total
        $item .= "\"" . mb_convert_encoding("支払方法", 'Shift_JIS', _CHARSET_) . "\","; //method_payment
        $item .= "\"" . mb_convert_encoding("決済ID",  'Shift_JIS', _CHARSET_) . "\","; //order_id
        $item .= "\"" . mb_convert_encoding("決済日",  'Shift_JIS', _CHARSET_) . "\","; //order_date
        $item .= "\"" . mb_convert_encoding("備考",    'Shift_JIS', _CHARSET_) . "\","; //yobi1

        $item .= "\"" . mb_convert_encoding("最終更新日", 'Shift_JIS', _CHARSET_) . "\","; //last_update
        $item .= "\"" . mb_convert_encoding("管理ステータス", 'Shift_JIS', _CHARSET_) . "\"\n"; //status

        /**
         * array_mapで使用するcallbask関数
         * ダブルクォートを[""]2重にする処理
         */
        function csvConvertDQ($row)
        {
	    $row = unhtmlspecialchars($row);
            $res = ereg_replace('"', '""', $row);
	    $res = preg_replace("/\<script\>/","<_s_c_r_i_p_t_>",$res);
            $res = preg_replace("/(\n|\r\n|\t)/i","",$res);
            return $res;
        }

        $ary = array();
        $ary[0] = $item;
        while ($row =& $res->fetchRow(DB_FETCHMODE_ASSOC)) {

            $row = array_map('csvConvertDQ', $row);

            $value  = "\"" . mb_convert_encoding("R" . $row["members_id"],       'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["reg_date"],         'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["reg_time"], 'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["title"],'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["familyname"],'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["givenname"],'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["mi"],'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["dept"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["organization"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["country1"], 'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["contact"],  'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["street"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["state"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["zip"],  'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["country2"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["tel"],     'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["fax"],     'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["email"],    'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["acc1_familyname"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc1_givenname"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc1_mi"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc1_title"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc2_familyname"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc2_givenname"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc2_mi"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc2_title"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["kubun"], 'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["acc_p_num"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["acc_pro_num"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["banquet"],   'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["hotel"], 'Shift_JIS', _CHARSET_) . "\",";
	    if ($row["visa"] == 1) $row["visa"] = "Yes";
            $value .= "\"" . mb_convert_encoding($row["visa"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["workshop1"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["workshop2"],    'Shift_JIS', _CHARSET_) . "\",";
	    if ($row["invoice"] == 1) {
		$row["invoice"] = "Yes";
	        $row["inv_no"]="A" . sprintf("%03d",$row["inv_no"]);
	    }
            $value .= "\"" . mb_convert_encoding($row["invoice"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["inv_name"],'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["inv_no"],'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["amount_regfee"],    'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["amount_accom"],  'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["amount_acpro"],  'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["amount_banq"],  'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["amount_total"], 'Shift_JIS', _CHARSET_) . "\",";
	    if ($row["method_payment"] === "0") $row["invoice"] = "Card";
		else  $row["invoice"] = "Other";
            $value .= "\"" . mb_convert_encoding($row["method_payment"],'Shift_JIS', _CHARSET_) . "\",";

            $value .= "\"" . mb_convert_encoding($row["order_id"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["order_date"],'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["yobi1"],     'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($row["last_update"], 'Shift_JIS', _CHARSET_) . "\",";
            $value .= "\"" . mb_convert_encoding($GLOBALS['COMMON_STATUS'][$row["status"]], 'Shift_JIS', _CHARSET_) . "\"\n";
            $ary[] = $value;
        }

    return $ary;
    }

}

?>
