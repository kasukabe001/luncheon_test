<?
/*
class Chk_Complete {

// include_once("field.php");
include_once("errorcheck.php");


function kousin($FIELD) {
print "a";
*/
//------------------------------------------------------------
// ���f�[�^�̓ǂݍ���
//------------------------------------------------------------
	$str_select = "select * from " . $TBL_NAME . " where semi_id = " . $semi_id . " FOR UPDATE";
	$result = pg_exec($conn, $str_select);
	if (!$result || pg_numrows($result) == 0) {
	  err_out(3);
	  exit;
	}
	// �t�B�[���h�f�[�^�̎擾
	$arr = pg_fetch_array($result,0);

//------------------------------------------------------------
// �V����r
//------------------------------------------------------------
	$ct =0;
	$amax = count($FIELD);
	for ($i = 0; $i < $amax; $i++) {
	  $str = $FIELD[$i];
	  $str_from = $arr[$str];	//��r�p
	  $str_to = $$FIELD[$i];
	  // ��r���O����
	  if ($str =="semi_id" || $str=="last_date") continue;
	  if ($_POST['lang_type'] == "1" ) { // �`���V�y�[�W�ł̕ύX
	    if (($str !="tirasi1") && ($str != "tirasi2")) continue;
	  }
	  //��r
	  if ($str_from == $str_to) continue;
	  // 0���� �� �ւ̑Ή�
//	  if ($str_to == "" && $str_from != "" && $str_from == 0 && strlen(str_from) == 1)	continue;
	  // �󔒂��� 0 �ւ̑Ή�
	  if ($str_to == "" && $str_from == '0') continue;
//	  $str_from = htmlspecialchars($str_from); 
//	  $str_to = htmlspecialchars($str_to); // check���Ɏ��{�ς�
	  $str_update .= "," . $FIELD[$i] . "='" . addslashes($str_to) . "'";
	  $update_line[$ct] = $Reg_Att_name[$str]."','".$str_from."','".$str_to."'";
	  $tbl .= "<tr><td>" . $Reg_Att_name[$str] . "</td>\n";
	  $tbl .= "<td>" . htmlspecialchars($str_from) . "&nbsp;</td>\n";
	  $tbl .= "<td>" . htmlspecialchars($str_to) . "&nbsp;</td></tr>\n";
//	  if ($str != "yobi1" && $str != "yobi2") {
//	    $mail_line .= "���ږ��F".$Reg_Att_name[$str]."\n�ύX�O�F".$str_from."\n";
//	    $mail_line .= "�ύX��F".$str_to."\n*****************************\n";
//	    $mail_line = ereg_replace("&nbsp;","",$mail_line); // &nbsp;
//		$mflag = 0; 		// 0:���[�����M���� 1:���Ȃ�
//	  }
	  $ct ++;	//����
	}

//------------------------------------------------------------
// UPDATE�R�}���h�̊��� �A�ύX���ڂȂ��΍�
//------------------------------------------------------------
	if ($str_update != "") {
	  $update = date("Y-n-j");
	  $str_update .= ",last_date='" . $update ."'";
	  $str_update = "update " . $TBL_NAME . " set " . substr($str_update,1) . " where semi_id = " . $semi_id;
// print $str_update;
	} else {
	  print "<br>\n";
	  print ("�f�[�^�X�V�͍s���܂���ł����B\n");
	  print "<br><br>\n";
	  include ("../../common/php/close_footer.php");
	  exit;
	}

//------------------------------------------------------------
// �f�[�^�̍X�V
//------------------------------------------------------------
pg_exec("begin");
$result = @pg_exec($str_update);
if ($result == false) {
	Errorlog("editcomplete",1,$str_update);
	pg_exec(rollback");
	err_out(4);
	exit;
}

// �ēǍ�
	$result = pg_exec($str_select);
	if (!$result) {
	  pg_exec("rollback");
	  err_out(5);
	  exit;
	}
	$num = pg_numrows($result);				// �s���̎擾
	if ($num != 1) {
	  pg_exec("rollback");
	  err_out(6);
	  exit;
	}
	$arr = pg_fetch_array($result,0);

//------------------------------------------------------------
// edit:�X�V�����̍쐬
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

pg_exec("commit");	// �������s
pg_exec("end");

/*
return(0);
}
}
*/
?>
