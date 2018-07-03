<?php

/**
 * 管理者用のコントローラ
 */
// incAdminAuthCheck();
require_once _MODULE_DIR_.'TehaiDAO.php';
require_once _MODULE_DIR_ . 'AdminTehaiForm.php';

$act  = $this->request->getParameter(_REQ_ACTION_);
$th_code = $this->request->getParameter('th_code');

//QuickForm の設定
$qform =& new AdminTehaiForm('AdminTehaiForm');
$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($this->renderer);

$qform->buildFormValues($th_code);
// $qform->buildFormFilters();
// $qform->buildFormRules();

//DB
$thdbh =& new TehaiDAO();

//操作履歴DB
//$history =& new HistoryDAO();


switch ($act) {
case 'List':

    $this->tpl_name = 'admin/AdminTehai_List.tpl';
    break;

case 'Display':    //トークンのセット
    createToken($this->renderer, $this->session);

    //DBから控室手配品情報を取得し、QFにセット
    $thdbh->table = "sy_tehai";
    $ary = $thdbh->getTehaiDefault($th_code);
    $qform->setDefaults($ary);
    $qform->setDefaults(array('th_code'=>$pronum));

    //フォームデータをQFからレンダラへセット
    $qform->accept($renderer);
    $this->renderer->assign('form', $renderer->toArray());

    $this->tpl_name = ($th_code == 1) ? 'admin/AdminTehai_Input.tpl': 'admin/AdminTehaiK_Input.tpl';

    break;

case 'Input':
case 'Confirm':

    if ($act != 'Confirm') {
        //トークンのセット
        createToken($this->renderer, $this->session);
        $this->tpl_name = ($th_code == 1) ? 'admin/AdminTehai_Input.tpl' : 'admin/AdminTehaiK_Input.tpl';

    } else {
        //入力エラーチェック　エラーが無い時
        if ($qform->validate()) {
            $qform->freeze();

	    $this->tpl_name = ($th_code == 1) ? 'admin/AdminTehai_Confirm.tpl' : 'admin/AdminTehaiK_Confirm.tpl';

        //入力エラーチェック　エラーがあった時
        } else {
	    $this->tpl_name = ($th_code == 1) ? 'admin/AdminTehai_Input.tpl' : 'admin/AdminTehaiK_Input.tpl';
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
        $thdbh->table = "sy_tehai";
        $beforeData = $thdbh->getTehaiDefault($th_code);

	// 変更項目の抽出 
	$diff = array();
	$diff = diff_Column( $beforeData,$postData);

	// 赤色表示
	$amax = count($diff);
	for ($i = 0; $i < $amax; $i++) {
           $this->renderer->assign($diff[$i], "<font color=red>"); 
           $this->renderer->assign("e" . $diff[$i], "</font>"); 
	}
    }

    break;

case 'Update':
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

    // アクセス競合対策 - 初期データと更新直前データの比較
//    $lock_error = array();
//    $lock_error = DuplicateAccess($beforeData,&$this->session);

//    if (count($lock_error) > 0 ) { //競合発生
//      $this->renderer->assign('error', $GLOBALS['ERROR_LOCK_DB']['ja']);
//      $this->tpl_name = 'member/All_Complete_ja.tpl';
//      break;
//    }

    //変更前のデータをDBから取得
    $beforeData=array();
    $thdbh->table = "sy_tehai";
    $beforeData = $thdbh->getTehaiDefault($th_code);
$beforeData['th_code'] = $th_code;

    //DBへUpdate準備  変更項目の抽出
    $diffA = array();
    $diffA = diff_Column( $beforeData,$postData);

    //変更内容の抽出
    $diff = fetchDiff($beforeData, $postData);
    $diff = remakeDiff($diff, $qform);

    //変更がなければ
    if (count($diff) == 0) {
        $this->tpl_name = 'admin/AdminTehai_List.tpl';
        $this->renderer->assign('message', "手配物の変更データはありませんでした。");
        foreach ($postData as $key) { 
	  unset($_SESSION[$key]);
        }
        break;
    }

    //DBへUpdate
    $thdbh->TehaiOrgUpdate($th_code,$postData);
    //DBへ変更が成功すれば(errorがnullなら)
    if ($thdbh->getError() === null) {

        //操作履歴TBLへ追加
/*
        $history->newinsert($this->session->getParameter('members_id'),
                        $this->session->getParameter('auth_flg'),
                        'p', //モード
                        'e', //タイプ
                        $diff // $str 変更内容
			);
*/
        $this->renderer->assign('message', "手配物の初期値を変更しました。");
        $this->tpl_name = 'admin/AdminTehai_List.tpl';
    //DBへ変更失敗した場合
    } else {
        $Ret=UpdateErrorLog('p','e',$this->session->getParameter('members_id'),$diff); 
        $this->renderer->assign('error', $GLOBALS['ERROR_EDIT_DB']['ja']);
        $this->tpl_name = 'admin/All_Complete_ja.tpl';
    }

    foreach ($postData as $key) { 
	unset($_SESSION[$key]);
    }
    break;

}

$this->renderer->assign('bpshj', "手配物初期値");
$this->renderer->assign('bpshe', "AdminTehai");

?>
