<?
/*
class Chk_Complete {

// include_once("field.php");
include_once("errorcheck.php");


function kousin($FIELD) {
print "a";
*/
//------------------------------------------------------------
// 現データの読み込み
//------------------------------------------------------------
	$str_select = "select * from " . $TBL_NAME . " where semi_id = " . $semi_id . " FOR UPDATE";
	$result = pg_exec($conn, $str_select);
	if (!$result || pg_numrows($result) == 0) {
	  err_out(3);
	  exit;
	}
	// フィールドデータの取得
	$arr = pg_fetch_array($result,0);

//------------------------------------------------------------
// 新旧比較
//------------------------------------------------------------
	$ct =0;
	$amax = count($FIELD);
	for ($i = 0; $i < $amax; $i++) {
	  $str = $FIELD[$i];
	  $str_from = $arr[$str];	//比較用
	  $str_to = $$FIELD[$i];
	  // 比較除外項目
	  if ($str =="semi_id" || $str=="last_date") continue;
	  if ($_POST['lang_type'] == "1" ) { // チラシページでの変更
	    if (($str !="tirasi1") && ($str != "tirasi2")) continue;
	  }
	  //比較
	  if ($str_from == $str_to) continue;
	  // 0から 空白 への対応
//	  if ($str_to == "" && $str_from != "" && $str_from == 0 && strlen(str_from) == 1)	continue;
	  // 空白から 0 への対応
	  if ($str_to == "" && $str_from == '0') continue;
//	  $str_from = htmlspecialchars($str_from); 
//	  $str_to = htmlspecialchars($str_to); // check時に実施済み
	  $str_update .= "," . $FIELD[$i] . "='" . addslashes($str_to) . "'";
	  $update_line[$ct] = $Reg_Att_name[$str]."','".$str_from."','".$str_to."'";
	  $tbl .= "<tr><td>" . $Reg_Att_name[$str] . "</td>\n";
	  $tbl .= "<td>" . htmlspecialchars($str_from) . "&nbsp;</td>\n";
	  $tbl .= "<td>" . htmlspecialchars($str_to) . "&nbsp;</td></tr>\n";
//	  if ($str != "yobi1" && $str != "yobi2") {
//	    $mail_line .= "項目名：".$Reg_Att_name[$str]."\n変更前：".$str_from."\n";
//	    $mail_line .= "変更後：".$str_to."\n*****************************\n";
//	    $mail_line = ereg_replace("&nbsp;","",$mail_line); // &nbsp;
//		$mflag = 0; 		// 0:メール送信する 1:しない
//	  }
	  $ct ++;	//履歴数
	}

//------------------------------------------------------------
// UPDATEコマンドの完成 、変更項目なし対策
//------------------------------------------------------------
	if ($str_update != "") {
	  $update = date("Y-n-j");
	  $str_update .= ",last_date='" . $update ."'";
	  $str_update = "update " . $TBL_NAME . " set " . substr($str_update,1) . " where semi_id = " . $semi_id;
// print $str_update;
	} else {
	  print "<br>\n";
	  print ("データ更新は行われませんでした。\n");
	  print "<br><br>\n";
	  include ("../../common/php/close_footer.php");
	  exit;
	}

//------------------------------------------------------------
// データの更新
//------------------------------------------------------------
pg_exec("begin");
$result = @pg_exec($str_update);
if ($result == false) {
	Errorlog("editcomplete",1,$str_update);
	pg_exec(rollback");
	err_out(4);
	exit;
}

// 再読込
	$result = pg_exec($str_select);
	if (!$result) {
	  pg_exec("rollback");
	  err_out(5);
	  exit;
	}
	$num = pg_numrows($result);				// 行数の取得
	if ($num != 1) {
	  pg_exec("rollback");
	  err_out(6);
	  exit;
	}
	$arr = pg_fetch_array($result,0);

//------------------------------------------------------------
// edit:更新履歴の作成
//------------------------------------------------------------
	$update_r_day = date("Y-n-j");
	$update_r_time = date("H:i:s");
	for ($jj = 0; $jj < $ct; $jj++) {
		$ins_str = "insert into rireki (update_day,update_time,semi_id,";
		$ins_str .= "fieldname,oldvalue,newvalue,update_user) values ('";
		$ins_str .= $update_r_day."','".$update_r_time."',";
		$ins_str .= $arr['semi_id'].",'";
		$ins_str .= $update_line[$jj].",'" . $_POST['lang_type'] . "')";
//print $ins_str . "<br>";
		$result = @pg_exec($conn, $ins_str);
		if (!$result) {
		  Errorlog("editcomplete",2,$ins_str);
		  pg_exec("rollback");
		  err_out(7);
		  exit;
		}
	}

pg_exec("commit");	// 書込実行
pg_exec("end");

/*
return(0);
}
}
*/
?>
