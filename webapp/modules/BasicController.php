<?php
/**
 * 一般ユーザがログインした時の主にトップページのコントローラ
 */
incAuthCheck();
require_once _MODULE_DIR_ . 'MembersDAO.php';
require_once _MODULE_DIR_ . 'BasicForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);

//QuickForm Admin管理部分の設定
$qform =& new BasicForm('BasicForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues();
$qform->buildFormFilters();
$qform->buildFormRules();

//DB
$dbh =& new MembersDAO();

//操作履歴DB
$history =& new HistoryDAO();

// 登録して他ページに移動する準備
$btnName=$this->request->getParameter('DirectBtn');
if (empty($btnName)==false) {
    $act ="Direct";
    $toPage=SaveAndGo($btnName);
}

switch ($act) {

case 'Display':
default:

    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBからセミナー情報を取得し、QFにセット
    $row = $dbh->selectBasic($this->session->getParameter('semi_id'),'semi_id');
    $qform->setDefaults($row);
    $this->renderer->assign('last_date',$row['last_date']);

    //座長演者の人数をセッションにセット
    $zaenAry = $dbh->getZaenNinzu($this->session->getParameter('semi_id'),1);
    $this->session->setParameter('zachoNum',$zaenAry['座長']);
    $this->session->setParameter('enshaNum',$zaenAry['演者']);

    // ファイル情報取得
    $ret = $dbh->checkFile($this->session->getParameter('semi_id'));
    $fnum = count($ret);
    if ($fnum > 0 ) {
        for ($i=0;$i<$fnum;$i++) {
	    $ipos = $i + 1;
	    $gazou .= "<a href=\"#filelist" . $ipos ."\"><img src=\"images/text.gif\" title=\"". $ret[$i]['org_filename'] . "\"></a>";
	    $ret[$i]['sys_filename'] = urlencode($ret[$i]['sys_filename']); //2012.4.20 追加
        }
	$this->renderer->assign('fnum',$gazou);
        $this->renderer->assign('fileData',$ret);
    }

    // アクセス競合対策 - 同時更新を防止
    $lockinfo = $dbh->LockCheck($this->session->getParameter('semi_id'), $_SESSION['logintoken']);
    if ($lockinfo['status'] == "otherlock") {
	$qform->freeze();
        $this->renderer->assign('locktoken',"unlock");
    } else if ($lockinfo['status'] == "nonlock") {
        $retLock =$dbh->LockById2($this->session->getParameter('semi_id'), $_SESSION['logintoken']);
        if ($retLock == false ) {
	    $qform->freeze();
            $this->renderer->assign('locktoken',"unlock");
	}
    }

    // 未変更項目の赤色表示対策
    $this->session->setParameter('gakkai', $row['gakkai']);

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = 'member/Basic_Input.tpl';

    break;


case 'Input':
case 'Confirm':
    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);
        $this->tpl_name = 'member/Basic_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

            $this->tpl_name = 'member/All_Confirm_ja.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
            $this->tpl_name = 'member/Basic_Input.tpl';
        }
    }

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());


    //変更項目の赤色表示
    if ($act == 'Confirm') {
        //QFから渡されたPOSTデータを抽出
        $postData = $qform->exportValues();

 	//postData はbuildFormFilters()でescapeされているのでunescape してから比較する
        foreach ($postData as $key => $val) { 
	    $postData[$key] = unhtmlspecialchars($val);
        }

	//変更前のデータをDBから取得
        $beforeData = $dbh->selectBasic($this->session->getParameter('semi_id'),'semi_id');
	// 非変更項目の赤色表示対策
        foreach ($beforeData as $key => $val) {
	    $beforeData[$key] = trim($val);
        }

	// 変更項目の抽出 
	$diff = array();
	$diff = diff_Column( $beforeData,$postData);

        // calendar使用でsessionが書き換えられてしまう対策
	// 開いただけでsessionが変わる
//	if (in_array('kaisaibi',$diff) == true) {
	    $this->session->setParameter('token',$this->request->getParameter('token'));
//	}

	// 赤色表示
	$amax = count($diff);
	for ($i = 0; $i < $amax; $i++) {
           $this->renderer->assign($diff[$i], "<font color=red>"); 
           $this->renderer->assign("e" . $diff[$i], "</font>"); 
	}
    }
    break;


case 'Update':
case 'Direct':
    $checkToken = validateToken2($this->request->getParameter('token'), $this->session->getParameter('token'));
    if ($checkToken === false) {
        $this->tpl_name = '_exception/reloaded_ja.tpl';
        break;
    }

    //QFから渡されたPOSTデータを抽出
    $postData = $qform->exportValues();

    //postData はbuildFormFilters()でescapeされているのでunescape してから比較する
    foreach ($postData as $key => $val) { 
	$postData[$key] = unhtmlspecialchars($val);
    }

    //変更前のデータをDBから取得
    $semi_id = $this->session->getParameter('semi_id');
    $beforeData = $dbh->selectBasic($semi_id,'semi_id');

    // アクセス競合対策 - 初期データと更新直前データの比較
    $lockError = CheckAccessTime($beforeData['last_date'],$postData['last_date']);
    if ($lockError == false ) { //競合発生
	$this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
	$this->tpl_name = 'member/All_Complete_ja.tpl';
	break;
    }

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    if ($beforeData['nendo'] <= 2011) {
     unset($postData['zacs_id3']);
     unset($postData['encs_id5'],$postData['encs_id6'],$postData['encs_id7'],$postData['encs_id8']);
    }
    $diffA = diff_Column( $beforeData,$postData);
    //予定日の自動設定

    if (in_array("kaisaibi",$diffA)) {
	array_push($diffA,"amail_yotei","annai2_yotei","yakuketsu_yotei","hikae_a_yotei","anquete_yotei");
//	$diffA[]='annai2_yotei';
	$dayAry = AutoCalcDate($postData['kaisaibi']); // 日付分断
	$postData['amail_yotei']= $dayAry['before100'];
	$postData['annai2_yotei']= $dayAry['before97'];
	$postData['yakuketsu_yotei']= $dayAry['before103'];
	$postData['hikae_a_yotei']= $dayAry['before1month'];
	$postData['anquete_yotei']= $dayAry['before1month'];
    }

    //変更がなければ
    if (count($diffA) == 0) {
        $this->renderer->assign('error', "NoData");
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        break;
    }

    //DBへ変更
    $this->tpl_name = 'member/All_Complete_ja.tpl';
    $dbh->con->autoCommit( false ); // 自動コミット解除(トランザクション開始)
    $dbh->newupdate($diffA,$postData, $semi_id);

    if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('basic',$postData['semi_id'],$diffA); 
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }

    $dbh->updateZaenBasic($postData, $semi_id);
    if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('basic_zaen',$postData['semi_id'],$postData); 
	$this->tpl_name = 'member/All_Complete_ja.tpl';
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        break;
    }

    // 座長演者数の更新 常時実行
    $realzacho = 0;
    if (!empty($postData['chair1']) ) $realzacho += 1;
    if (!empty($postData['chair2']) ) $realzacho += 1;
    if (!empty($postData['chair3']) ) $realzacho += 1;

    $realensha = 0;
    if (!empty($postData['enshaname1']) ) $realensha += 1;
    if (!empty($postData['enshaname2']) ) $realensha += 1;
    if (!empty($postData['enshaname3']) ) $realensha += 1;
    if (!empty($postData['enshaname4']) ) $realensha += 1;
    if (!empty($postData['enshaname5']) ) $realensha += 1;
    if (!empty($postData['enshaname6']) ) $realensha += 1;
    if (!empty($postData['enshaname7']) ) $realensha += 1;
    if (!empty($postData['enshaname8']) ) $realensha += 1;
    $dbh->updateTehaiBasic1($semi_id,$realzacho,$realensha);
    if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
        $dbh->con->rollback(); // ロールバック
        $Ret=ErrorLog('basic_zaensu',$postData['semi_id'],$postData); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
	break;
    }

    // 資材数
    if (in_array('sizaisu',$diffA) == true) {
	$dbh->updateTehaiBasic2($postData['sizaisu'], 1, $semi_id);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_sizaisu',$postData['semi_id'],$postData); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
    }
    // 資材no
    if (in_array('sizaino',$diffA) == true) {
	$dbh->updateTehaiBasic2($postData['sizaino'], 2, $semi_id);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_sizaino',$postData['semi_id'],$postData); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
    }

    // 弁当数更新
    if (in_array('bento',$diffA) == true) {
	$dbh->updateTehaiBasic2($postData['bento'], 3, $semi_id);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_bento',$postData['semi_id'],$postData); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
    }

    // コプロ情報の更新
    if (in_array('syukan',$diffA) == true) {
      if (empty($postData['syukan']) == false) {
	$dbh->table = 'tantou';
	$lch_row1 = $dbh->selectById($postData['syukan'],'ta_corp');
	// マスターに存在しない社名はupdateTantouBasicがerrorを返さない
	$dbh->updateTantouBasic($lch_row1, 'コプロ', $semi_id,1);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_copro1',$postData['semi_id'],$lch_row1); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
      }
    }
    if (in_array('syukan2',$diffA) == true) {
      if (empty($postData['syukan2']) == false) {
	$dbh->table = 'tantou';
	$lch_row2 = $dbh->selectById($postData['syukan2'],'ta_corp');
	// マスターに存在しない社名はupdateTantouBasicがerrorを返さない
	$dbh->updateTantouBasic($lch_row2, 'コプロ', $semi_id,2);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_copro2',$postData['semi_id'],$lch_row2); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
      }
    }

    // 担当者の更新 AS
    if (in_array('sekinin',$diffA) == true) {
	$dbh->updateSekinin($semi_id,"ji_as", $postData['sekinin'] );
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_jinas',$postData['semi_id'],$postData); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
    }

    // 担当者の更新 CL
    if (in_array('cltantou',$diffA) == true) {
	$dbh->updateSekinin($semi_id,"ji_cl", $postData['cltantou'] );
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_jincl',$postData['semi_id'],$postData); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
    }

    // 担当者の更新 嵯峨野
    if (in_array('anquete',$diffA) == true) {
      if ($postData['anquete'] == "有") {
	$lch_row6 = $dbh->selectTantouInit('アンケート',9);
	$dbh->updateTantouBasic($lch_row6, 'アンケート', $semi_id);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_anq',$postData['semi_id'],$lch_row6); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
      }
    }

    // 担当者の更新 インパルス
    if (in_array('syuroku',$diffA) == true) {
      if ($postData['syuroku'] == "有") {
	$lch_row7 = $dbh->selectTantouInit('収録',9);
	$dbh->updateTantouBasic($lch_row7, '収録', $semi_id,0);
        if ($dbh->getError() !== null) {   //DBへ変更失敗した場合
          $dbh->con->rollback(); // ロールバック
          $Ret=ErrorLog('basic_syu',$postData['semi_id'],$lch_row7); 
          $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
          break;
        }
      }
    }

    // 操作履歴テーブル用のデータを抽出して、加工
    $diff = fetchDiff($beforeData,$postData); //変更項目の抽出を２度行っている
    $diff = remakeDiff($diff, $qform); //改良の余地あり

    //操作履歴TBLへ追加
    $history->newinsert($semi_id,
                        $diff // 変更内容
			);
    // 操作履歴登録エラーを検出できていない

    $dbh->con->commit();  // コミット
    $dbh->con->autoCommit( true ); // 自動コミット再開(トランザクション終了)
    $this->tpl_name = 'member/All_Complete_ja.tpl';

//    foreach ($postData as $key) { 
//	unset($_SESSION[$key]);
//    }

    break;

}

$this->renderer->assign('bpshj', "基本");
$this->renderer->assign('bpshe', "Basic");

if ($act == 'Direct') {
  header("location: ./mypage.php?_mod=" . $toPage . "&_type=Edit&_act=Display");
}

?>