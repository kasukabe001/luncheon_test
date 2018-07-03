<?PHP
// ----------------------------------------------------------
// 関数名    :MakeSQLinsert
// 機能      :INSERT文の作成
// $tbl_name : テーブル名
// $val      : 配列名 
// 04.1.13 $TOTR_TITLE tuika
// ----------------------------------------------------------
function MakeSQLinsert($tbl_name,$val)
{
	global $conn,$non_quote;
	$QUOTE_FLAG = 0;	//0:'で囲む 1:'で囲まない
	$Primary_Col = $tbl_name . "_id";

// カラム数の取得 ------------------------
        $sql = "select * from " . $tbl_name . " offset 1";
        $result = pg_exec($conn, $sql);
	$max=pg_numfields($result);

// ' 'で囲まない項目数の取得 ------------
	$max_non_quote=count($non_quote);

// INSERT文の作成(前半)
        $sqlimg = "INSERT INTO $tbl_name (";
        for($i=0;$i<$max;$i++) {
		if ($i == 0) continue;
		$col_name[$i] = pg_fieldname($result,$i);	//カラム名の取得
		$sqlimg .= $col_name[$i];
                if ($i < ($max - 1))  $sqlimg .= ",";
        }
        $sqlimg .= " ) VALUES ( ";

// INSERT文の作成(後半) ----------------
        for($i=0;$i<$max;$i++) {
		$QUOTE_FLAG = 0;	//初期化
		if ($i == 0) continue;
		$iname = $col_name[$i];
        	for($j=0;$j<$max_non_quote;$j++) {
                	if($iname== $non_quote[$j]) {
                       		$QUOTE_FLAG = 1;
				break;
			}
		}
		if ($QUOTE_FLAG == 0) {
			$sqlimg .= "'";
		} else {
			if ($val["$iname"] == "") $val["$iname"] = "0";
		}
               	$sqlimg .= addslashes($val["$iname"]);
		if ($QUOTE_FLAG == 0) $sqlimg .= "'";
                if ($i < ($max - 1)) $sqlimg .= ","; // 項目間の ,
          }
        $sqlimg .= " )";
        return $sqlimg;		// SQL文を返す
}

//------------------------------------------------------------
// エラー表示関数
//------------------------------------------------------------
function DispError()
{
        global $HTML_PATH,$SYSERROR_HTML;

        $file = $SYSERROR_HTML;
        $tmpl = file("$file");
        reset($tmpl);
        while(list(,$value) = each($tmpl) ) {
                print $value;
        }
}

//------------------------------------------------------------
// Ｅメール送信関数 - 不使用(2016.8.30調査)
//------------------------------------------------------------
function EmailSend($post,$email,$field,$val)
{
        global $ID_Reception,$EMAIL_ABSTRACT,$ABST_TITLE;
        global $USER_TITLE,$BUREAU_EMAIL,$EMAIL_APPLICANT;

        if($post == "a1") { // Seminar 新規追加
	        $tmpl = file("$EMAIL_APPLICANT");
			$title = "緊急 セミナー追加(#semi_id#)Dir無し";
        } else if ($post == "a0"){  //ファイルアップロード
	        $tmpl = file("$EMAIL_APPLICANT");
			$title = "セミナー追加(#semi_id#)Dirあり";
        } else if ($post == "u"){  //ファイルアップロード
	        $tmpl = file("$EMAIL_APPLICANT");
			$title = "ファイルアップロード(#semi_id#)";
        } else if ($post == "e"){  //miho
	        $tmpl = file("$EMAIL_APPLICANT");
//			$title = $USER_TITLE;
			$title = "データ更新記録(#semi_id#)";
        }
        $RECEPTION_DATE = $val["RECEPTION_DATE"];

	$title = ereg_replace("#semi_id#",$val['semi_id'],$title);
        $max = count($field);
        reset($tmpl);
        while(list(,$value) = each($tmpl) ) {
            $value = ereg_replace("#RECEPTION_DATE#","$RECEPTION_DATE",$value);
            for($i=0;$i<$max;$i++) {
            	$str = $val["$field[$i]"];
            	$value = ereg_replace("#$field[$i]#","$str",$value);
            }
            $contents = $contents . $value;
        }
		mb_language("Ja") ;
		mb_internal_encoding("EUC") ;
// 長さ制限
		$contents = substr($contents,0,2200);
// 宛先
		$emailaddr_from="From:" .  "<".$BUREAU_EMAIL.">" . "\n";
// 配信エラー送り先
		$e_delivery="-f" . "fujita@secretariat.ne.jp";
		mb_send_mail($email, $title, $contents,$emailaddr_from,$e_delivery);
}
//------------------------------------------------------------
// SQLエラーログの出力
//------------------------------------------------------------
function Errorlog($fname,$pos,$Errorsql)
{
    global $ERROR_LOG;
    // $fname エラー発生ファイル
    // $pos   エラー発生位置
    $outstr = date("Y-n-j H:i:s") . ":" . $fname . ":" . $pos . ":" . $Errorsql . "\n";
	$filenm = ($ERROR_LOG . "error.log");
	$fp = fopen("$filenm","a+");
	fputs($fp,$outstr);
	fclose($fp);
}

?>
