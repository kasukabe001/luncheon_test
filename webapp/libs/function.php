<?php
/**
 * AuthCheck for Administrator
 *
 * ユーザが管理者かチェック
 */
function incAdminAuthCheck() {
    if ($_SESSION['USERID'] != _ADMIN3_AUTH_FLG_  ) {
            header("Location:mypage.php?_mod=Exception");
            exit();
    }
    if (empty($_SESSION['logintoken']) == true ) {
        header("Location:mypage.php?_mod=Exception");
	exit();
    }

    if ($_SERVER['REMOTE_ADDR'] == '219.121.56.52' ||
        $_SERVER['REMOTE_ADDR'] == '122.249.12.246' ||
        $_SERVER['REMOTE_ADDR'] == '60.45.61.118' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.79' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.81' ||
        $_SERVER['REMOTE_ADDR'] == '164.162.0.1' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.82' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.83' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.84' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.85' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.86' 
    ) {
        // OK
    } else {
        header("Location:mypage.php?_mod=Exception");
	exit();
    }

}



/**
 * AuthCheck
 *
 * ユーザが権限を持っているか & リファラーが別のアドレスかチェック
 * 初回の登録時のみリロードがあるのでトークンチェックをしています。
 **/
function incAuthCheck() {
    //ブラウザ履歴から表示対策 2009.7.6追加
    if ($_SESSION['USERID'] != _USER_AUTH_FLG_ && $_SESSION['USERID'] != _ADMIN2_AUTH_FLG_ && $_SESSION['USERID'] != _ADMIN3_AUTH_FLG_  ) {
            header("Location:mypage.php?_mod=Exception");
            exit();
    }

    if (empty($_SESSION['logintoken']) == true ) {
        header("Location:mypage.php?_mod=Exception");
	exit();
    }

    if ($_SERVER['REMOTE_ADDR'] == '219.121.56.52' ||
        $_SERVER['REMOTE_ADDR'] == '122.249.12.246' ||
        $_SERVER['REMOTE_ADDR'] == '60.45.61.118' ||
        $_SERVER['REMOTE_ADDR'] == '164.162.0.1' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.79' ||
        $_SERVER['REMOTE_ADDR'] == '153.142.14.81' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.82' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.83' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.84' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.85' ||
        $_SERVER['REMOTE_ADDR'] == '221.249.182.86' 
    ) {
        // OK
    } else {
        header("Location:mypage.php?_mod=Exception");
	exit();
    }

}



/**
 * トークンの作成
 *  セッションにトークンをセット
 *
 * @param  object $renderer
 * @param  object $session
 * @return string $token
 */
function createToken($renderer, $session)
{
    $token = md5(microtime());

    if (is_object($renderer) && is_object($session)) {
        $renderer->assign('token', $token);
        $session->setParameter('token', $token);
    }

}



/**
 * トークンの検証
 *  リクエストで渡されたトークンとセッションのトークンを比較
 *
 * @param  object $request
 * @param  object $session
 * @return bool
 */
function validateToken(&$request, &$session)
{
    if ($request->getParameter('token') == $session->getParameter('token')) {
        $session->removeParameter('token');
        return true;

    } else {
        return false;

    }
}
function validateToken2($request_token, $session_token)
{
    if ($request_token == $session_token) {
//        $session->removeParameter('token');
        return true;

    } else {
        return false;

    }
}



//*****************************************************
// function fuseiSeni(  )
// 不正遷移をチェックします。
// 引数：プログラム番号 1:newdata 2:corepon 3:itemsave
//        4:空き番号 2:addtehai 6:addjinin 7 unlock
// 戻値：0:不正なし 1:不正あり
//*****************************************************
function fuseiSeni($j=null)
{
  $p = $_SERVER["HTTP_REFERER"];
  if (empty($p) == true)  return (0);

  $mystring1 = _DOMAIN_;
  $mystring2 = "ttps"; 
  if ($j==1) { 
    $mystring3="part.php?";
  } else if ($j==2 || $j==4 || $j==5 || $j==6 || $j==7) {
    $mystring3="mypage.php?"; 
  } else if ($j==8) {
    $mystring3="admincl"; 
  } else if ($j==3) {
    $mystring3="corepon.php?"; 
  }
// print $_SERVER["HTTP_REFERER"];
  $pos1 = strpos($_SERVER["HTTP_REFERER"],$mystring1 );
  $pos2 = strpos($_SERVER["HTTP_REFERER"],$mystring2 );
  $pos3 = strpos($_SERVER["HTTP_REFERER"],$mystring3 );

  if (($pos1 === false) || ($pos2 === false) || ($pos3 === false)) {
    return (1);
  } else {
    return (0);
  }
}



/**
 * Pager
 *
 * @param  mixed $DbResult
 * @return array $ary
 */
function createPager($DbResult, $perPage=25, $delta=10) {
    require_once 'Pager/Pager.php';

    $ary = array();

    $params = array(
        'itemData'     => $DbResult,
        'perPage'      => $perPage,
        'delta'        => $delta,
        'mode'         => 'Jumping', // or Sliding
        'append'       => true,
        //'importQuery'  => false,
        'httpMethod'   => 'GET',
        'separator'    => ' | ',
        'clearIfVoid'  => true,
        'urlVar'       => 'p',
        'useSessions'  => false,
        'closeSession' => false,
        'prevImg'      => '&lt;&lt;Prev',
        'nextImg'      => 'Next&gt;&gt;'
    );


    $pager =& Pager::factory($params);
    $ary['result']     = $pager->getPageData();
    $ary['pagerLinks'] = $pager->getLinks();

    //false だと Smarty の foreach で foreachelse に行かなくなってしまうので null に変更
    if ($ary["result"] === false) {
        $ary["result"] = null;
    }

return $ary;
}



/**
 * ユーザへの追加、変更完了のお知らせメール
 *
 * @param  string $mod          作業項目 ex)p 申込情報
 * @param  string $type         作業タイプ ex)e 変更　削除
 * @param  string $members_id   ID
 * @param  string $auth_flg     認証フラグ
 * @param  string $aryDiff      追加、変更された項目と内容セットの配列
 * @param  string $lang         言語情報
 * @return bool   $res          送信できたかどうか
 */
function sendUpdateMail($mod, $type, $members_id, $auth_flg, $aryDiff, $lang='ja')
{

    mb_language('ja');
    mb_internal_encoding("EUC") ;

    //reg_idよりメンバーのメアドを取得
    require_once _MODULE_DIR_.'MembersDAO.php';
    $dbh =& new MembersDAO();
    $row = $dbh->selectById($members_id,$field_name='members_id');

    // 宛先とbcc設定
    if ($auth_flg == 10) {
	$to = $row['email'];
	$bcc = _ADMIN_EMAIL1_.','._ADMIN_EMAIL3_;
    } else {
	$to = _ADMIN_EMAIL3_;
	$bcc = _ADMIN_EMAIL1_;
    }

    //件名設定
    $subject = '「' . _PROJECT_NAME_JA_ . '」データ変更のお知らせ';
    $message  = '';

    // 文頭の名前の設定 会社名、氏名の表示
    $message .= $row['division']."\n";
    $message .= $row['family_name'].' '.$row['first_name'].' 様 ('.$members_id.')' . "\n\n";

    $hi = substr($row['last_modify_date'],0,4) . "-" . substr($row['last_modify_date'],4,2) . "-" .substr($row['last_modify_date'],6,2) ;

   //メッセージフッタの追加
    $message .= "いつも大変お世話になり、ありがとうございます。\n";
    $message .= "また、KTM2011にご協力賜り、重ねてお礼申し上げます。\n\n";
    $message .= "以下のデータが変更されましたのでご連絡させていただきます。\n";
    $message .= "ご多忙のところ恐縮ですが、ご確認いただきますようお願いいたします。\n\n";

    $message .= "◆登録番号◆ " . $members_id."\n";
    $message .= "◆更 新 日◆ " . $hi ."\n\n";

    //変更内容の整形
    $message .= "■変更内容■\n";
    foreach ($aryDiff as $k => $v) {
        $message .= "------------------------------------------------\n";
        $message .= '項目名: '.$v['label']."\n";
	$tempb = ereg_replace("&nbsp;", "", $v['before']);
        $message .= '変更前: '.strip_tags($tempb)."\n";
	$tempa = ereg_replace("&nbsp;", "", $v['after']);
        $message .= '変更後: '.strip_tags($tempa)."\n";
    }
    $message .= "------------------------------------------------\n";



    define('_MAIL_HEADER_JABC_', _MAIL_HEADER_JA_ ."Bcc: ". $bcc . "\n");

    // 長さ制限
    $message = substr($message,0,2500);

    //配信エラー対応
    $e_delivery="-f" . _ADMIN_EMAIL3_;

   //メール送信
   $res = mb_send_mail($to, $subject, $message, _MAIL_HEADER_JABC_,$e_delivery);

return $res;
}




/**
 * 操作完了の連絡メール - 管理者宛て
 *
 * @param  string $ope
 * @param  array $arr
 * @return $res
 */
function CompleteMail($ope,$arr)
{
    mb_language("Japanese");
    mb_internal_encoding("EUC") ;

    //宛先設定
    $to = _ADMIN_EMAIL_;

    //件名設定
    $subject = $ope . mb_convert_encoding('完了のお知らせ',"EUC-JP","UTF-8");

    // 出展内容の置き換え

    $content = date("Y-n-j H:i:s") . ":" . $ope . "\n";

    foreach ($arr as $key => $value) { 
	$value = mb_convert_encoding($value,"EUC-JP","UTF-8"); 
	$content .= $key . ":" . $value . "\n";
    }
    $content .= "\n";

    //メッセージ設定 - 長さ制限
    $message = substr($content,0,3000);

    mb_internal_encoding("UTF-8") ;   /* 日本語表示させるとき */
    $emailaddr_from = "From: ".mb_encode_mimeheader(_PROJECT_NAME_JA_,'ISO-2022-JP')."<"._ADMIN_EMAIL_.">\nReturn-Path: "._ADMIN_EMAIL_."\nReply-To: "._ADMIN_EMAIL_;
    mb_internal_encoding("EUC") ;


    //メール送信
    $res = mb_send_mail($to, $subject, $message, $emailaddr_from);

    return $res;

}



/**
 * 変更があった項目名を抽出する
 *
 * @param  array $before 
 * @param  array $after
 * @return array $aryDiff
 */
function diff_Column($before = null, $after = null)
{
    $aryDiff = array();


    //変更前と変更後の配列が渡されていれば
    $i = 0;
    foreach ($after as $k => $v) {
          //変更前と後で違う値の物を新しい配列で形成
         if ($before[$k] != $after[$k]) {
                $aryDiff[$i] = $k;
		$i ++;
         }
    }

    return $aryDiff;
}



/**
 * 差分のみを抽出する
 *  変更後の配列が余計なデータを持っていないので変更後の配列を
 *  元に差分のチェックをする
 *
 *  新規登録等の場合は変更前がないので null や 空文字 等を引数に渡す
 *  新規の場合は['after']（変更後）に値を入る
 *
 * @param  array $before
 * @param  array $after
 * @return array $aryDiff
 */
function fetchDiff($before = null, $after = null)
{
    $aryDiff = array();

    //変更前が配列でないなら新規登録とみなす
    if (!is_array($before)) {
        foreach ($after as $k => $v) {
//            $aryDiff[$k]['before'] = '';
            $aryDiff[$k]['after'] = $v;
        }

    //変更前と変更後の配列が渡されていれば
    } else {
        foreach ($after as $k => $v) {
            //変更前と後で違う値の物を新しい配列で形成
          if ($before[$k] != $after[$k]) {
                $aryDiff[$k]['before'] = $before[$k];
                $aryDiff[$k]['after']  = $v;
            }
        }
    }

return $aryDiff;
}



/**
 * 変更前と変更後の差分を抽出した配列(新規登録時は変更後のデータのみ)と
 *  QFから対応する項目名やチェックボックスなどの数値を任意の表示文字列に
 *  変換する
 *
 * @see    fetchDiff
 * @param  array $diff
 * @param  object $qform
 * @return array $aryDiff
 */
function remakeDiff($diff, &$qform)
{
    $aryDiff = array();
    foreach ($diff as $form_name => $before_after) {

        //QF に差分抽出で渡された配列の値が存在するか
        if ($qform->elementExists($form_name)) {

            //リターンする配列の値にフォームの名前をセット
            $aryDi0ff[$form_name] = array();

            $element =& $qform->getElement($form_name);

            //QFのタイプを取得　グループの時
            if ($element->getType() == 'group') {

                //更にグループのタイプを取得　'ラジオ'の時
                if ($element->getGroupType() == 'radio') {

                    //リターンする配列にラベルを挿入
                    $aryDiff[$form_name]['label'] = $element->getLabel();

                    $elements =& $element->getElements();
                    foreach ($elements as $k2 => $v2) {

                        if ($v2->getLabel() == $before_after['before']) {
                            $aryDiff[$form_name]['before'] = $v2->getText();

                        } elseif ($v2->getLabel() == $before_after['after']) {
                            $aryDiff[$form_name]['after'] = $v2->getText();
                        }
                    }

                //グループのタイプが'チェックボックス'の時
                } elseif ($element->getGroupType() == 'checkbox') {

                    //リターンする配列にラベルを挿入
                    $aryDiff[$form_name]['label'] = $element->getLabel();

                    $elements =& $element->getElements();

                    $strBefore = '';
                    foreach ($elements as $k2 => $v2) {
                        foreach ($before_after['before'] as $k3 => $v3) {
                            if ($v2->getLabel() == $k3) {
                                $strBefore .= $v2->getText().', ';
                            }
                        }
                    }
                    //最後の ', ' を切り取ってリターンする配列にセット
                    $strBefore = substr_replace($strBefore, '', strrpos($strBefore, ', '), 2);
                    $aryDiff[$form_name]['before'] = $strBefore;

                    $strAffter = '';
                    foreach ($elements as $k2 => $v2) {
                        foreach ($before_after['after'] as $k3 => $v3) {
                            if ($v2->getLabel() == $k3) {
                                $strAfter .= $v2->getText().', ';
                            }
                        }
                    }
                    //最後の ', ' を切り取ってリターンする配列にセット
                    $strAfter = substr_replace($strAfter, '', strrpos($strAfter, ', '), 2);
                    $aryDiff[$form_name]['after'] = $strAfter;

                }

            //テキストやテキストエリアの場合
            } else {
                $aryDiff[$form_name]['label']  = $element->getLabel();
                $aryDiff[$form_name]['before'] = $before_after['before'];
                $aryDiff[$form_name]['after']  = $before_after['after'];
            }

        //QFに設定していないデータの場合
        } else {
            $aryDiff[$form_name]['label']  = $form_name;
            $aryDiff[$form_name]['before'] = $before_after['before'];
            $aryDiff[$form_name]['after']  = $before_after['after'];
        }
    }
return $aryDiff;
}



/**
 * 変更内容、差分配列を文字列に変換する
 *
 * @param  array $remakeDiff
 * @param  string $mode 表示形態 'text' or 'table' Default=>'text'
 * @param  string $flg  変更前を表示するかのフラグ 'all' or 'after' Default=>'all'
 * @return string $str
 */
function remakeDiff2String($remakeDiff, $mode = 'text', $flg = 'all')
{
$str = '';

    //テキストモードの場合
    if ($mode == 'text') {
        //全て表示する場合
        if ($flg == 'all') {
            foreach ($remakeDiff as $k => $v) {
                $str .= $v['label'].' : '.$v['before'].' => '.$v['after']."\n";
            }

        //変更前は表示しない場合
        } else {
            foreach ($remakeDiff as $k => $v) {
                $str .= $v['label'].' : '.$v['after']."\n";
            }
        }

    //テーブルモードの場合
    } else {
        if ($v['before'] == '') {
            $v['before'] = '　';
        }
        if ($v['after'] == '') {
            $v['after'] = '　';
        }
        //全て表示する場合
        if ($flg == 'all') {
             $str .= "<table border=0 cellpadding=0 cellspacing=1>\n<tr>\n";
            $str .= "<td class=h_ttl>Item</td><td class=h_ttl>Before</td><td class=h_ttl>After</td>\n";
            $str .= "</tr>\n";
            foreach ($remakeDiff as $k => $v) {
                $str .= "<tr><td class=h_item>".$v['label'].'</td><td class=h_value>'.nl2br(htmlspecialchars($v['before'], ENT_QUOTES)).'</td><td class=h_value>'.nl2br(htmlspecialchars($v['after'], ENT_QUOTES))."</td></tr>\n";
            }
            $str .= "</table>\n";

        //変更前は表示しない場合
        } else {
            $str .= "<table border=0 cellpadding=0 cellspacing=1>\n<tr>\n";
            $str .= "<td class=h_ttl>Item</td><td class=h_ttl>After</td>\n";
            $str .= "</tr>\n";
            foreach ($remakeDiff as $k => $v) {
                $str .= "<tr><td class=h_item>".$v['label'].'</td><td class=h_value>'.nl2br(htmlspecialchars($v['after'], ENT_QUOTES))."</tr>\n";
            }
            $str .= "</table>\n";

        }
    }


return $str;
}




/**
 * アクセス競合対策、Display時のデータと更新直前のDBのデータを比較する
 *
 * @param  array $beforeData  // 直近のDBデータ
 * @param  object $session
 * @return string $str  他端末から更新された項目
 */
/*
function DuplicateAccess($beforeData,&$session) 
{
    $num =0;

    while(list ($key, $val) = each($beforeData)) {
      if (($key==last_modify_date)||($key==last_modify_editor)) continue;
      if ($session->getParameter($key) != $val) { 
        $lock_error[$num] .= $key;   // エラー項目配列
        $num ++;
//        break;  // 全項目を調べる
      }
    }

    while(list ($key, $val) = each($beforeData)) {
       unset($_SESSION[$key]);
    }

// 項目名を日本語化するには、下記２行をメインルーチンに追加
//    $qformAdmin->accept($renderer);
//    $this->renderer->assign('form', $renderer->toArray());
// 項目名を画面表示するには、下記の行をメインルーチンに追加
//      $this->renderer->assign('colname', $lock_error); 

return $lock_error;
}
*/


/**
 * データを即保存して他ページに移動するときの移動先判定
 *
 * @param  string $btnName  // 押下ボタンのvalue
 * @return string $str  他端末から更新された項目
 */
function SaveAndGo($btnName) 
{
    switch ($btnName) {
    case '基本':
	$toPage= "Basic";
	break;
    case '座長':
	$toPage= "Zacho";
	break;
    case '演者':
        $toPage= "Enja";
	break;
    case '手配':
	$toPage= "Tehai";
	break;
    case '人員':
	$toPage= "Jinin";
	break;
    case ' 他 ':
	$toPage= "Schedule";
	break;
    case '担当':
	$toPage= "Tantou";
	break;
    case 'ｱｯﾌﾟ':
	$toPage= "Upload";
	break;
    case '帳票':
	$toPage= "List";
    }
    return $toPage;
}

/**
 * アクセス競合対策、Display時のデータと更新直前のDBのデータを比較する
 *
 * @param  string $beforeVal   // 直近の更新日時
 * @param  string $currentVal  // 読込時の更新日時
 * @return boolean   同じ時:True 異なる時:False
 */
function CheckAccessTime($beforeVal,$currentVal) 
{
    if ($beforeVal == $currentVal) {
	return true;
    } else {
	return false;
    }
}



/**
 * Error logの出力
 *
 * $ErrorLog('r','a',$beforePostData)
 */
function ErrorLog($mod,$typ,$arr) {
    mb_language("Japanese");
    mb_internal_encoding("SJIS");

    $filename = _LOG_DIR_ . "error.log";
    $outstr = date("Y-n-j H:i:s") . ":" . $mod . $typ . "\n";

    foreach ($arr as $key => $value) { 
	$value = mb_convert_encoding($value,"SJIS","UTF-8"); 
	$outstr .= $key . ":" . $value . ",";
    }
    $outstr .= "\n";

    $fp = fopen($filename,"a+");
    fputs($fp,$outstr);
    fclose($fp);

    return;
}



/**
 * 日付解体
 *
 * $UpdateErrorLog('r','a',$id,$arr)
 */
function AutoCalcDate($kaisaibi){
	$weekjp_array = array('日', '月', '火', '水', '木', '金', '土');
	$banban = explode("/", $kaisaibi);
	if (strlen($banban[0]) == 4 ) {
		$dAry['y']=$banban[0]; // 年が4桁のとき
	} else {
		$dAry['y']="20" . $banban[0];
	}
	if (substr($banban[1],0,1) == "0" ) {
		$dAry['m']=substr($banban[1],1,1);
	} else {
		$dAry['m']=$banban[1];
	}
	if (substr($banban[2],0,1) == "0" ) {
		$dAry['d']=substr($banban[2],1,1);
	} else {
		$dAry['d']=substr($banban[2],0,2);
	}
	$pyear = $dAry['y'];
/*
	$ptimestamp = mktime(0, 0, 0, $dAry['m'], $dAry['d'], $pyear);
	$weekno = date('w', $ptimestamp);
	$dAry['w']= $weekjp_array[$weekno];
*/
//	$dAry['kaisaibi']= date('Y/m/d', $ptimestamp);

	$saijitsu=Holidays(date('Y')); // 祝日を取得
//print_r($saijitsu);
	$nichimae=97;
	$dAry['before97']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	$sa = isHoliday($dAry['before97'],$saijitsu);
	$nichimae += $sa;
	$dAry['before97W']= date('w', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	if ($dAry['before97W'] == 0 ) $nichimae += 2;
	 else if ($dAry['before97W'] == 6 )  $nichimae += 1;
	$dAry['before97']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));

	$nichimae=100;
	$dAry['before100']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	$sa = isHoliday($dAry['before100'],$saijitsu);
	$nichimae += $sa;
	$dAry['before100W']= date('w', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	if ($dAry['before100W'] == 0 ) $nichimae += 2;
	 else if ($dAry['before100W'] == 6 )  $nichimae += 1;
	$dAry['before100']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));

	$nichimae=103;
	$dAry['before103W']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	$sa = isHoliday($dAry['before103'],$saijitsu);
	$nichimae += $sa;
	$dAry['before103W']= date('w', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));
	if ($dAry['before103W'] == 0 ) $nichimae += 2;
	 else if ($dAry['before103W'] == 6 )  $nichimae += 1;
	$dAry['before103']= date('y/m/d', mktime(0, 0, 0, $dAry['m'], $dAry['d']-$nichimae, $pyear));

	$nichimae=0;
	$dAry['before1month']= date('y/m/d', mktime(0, 0, 0, $dAry['m']-1, $dAry['d'], $pyear));
	// 実在しない日付対策
	if (!checkdate($dAry['m']-1, $dAry['d'], $pyear)) {
	    $uruu = $pyear % 4;
	    if ($dAry['m']==3) {
		$nichimae = ($uruu == 0) ? 2 : 3;
     	    } else {
		$nichimae=1;
	    }
	    $dAry['before1month']= date('y/m/d', mktime(0, 0, 0, $dAry['m']-1, $dAry['d']-$nichimae, $pyear));
	}

	$sa = isHoliday($dAry['before1month'],$saijitsu);
	$nichimae += $sa;
	$dAry['before1monthW']= date('w', mktime(0, 0, 0, $dAry['m']-1, $dAry['d']-$nichimae, $pyear));
	if ($dAry['before1monthW'] == 0 ) $nichimae += 2;
	 else if ($dAry['before1monthW'] == 6 )  $nichimae += 1;
	$dAry['before1month']= date('y/m/d', mktime(0, 0, 0, $dAry['m']-1, $dAry['d']-$nichimae, $pyear));

	unset($dAry['before97W']);
	unset($dAry['before100W']);
	unset($dAry['before103W']);
	unset($dAry['before1monthW']);
	return $dAry;
}

/**
 * 祝日取得
 * @param  integer $year   // 年
 * @return array  直近2年の祝日
 */
function Holidays($year){

	//前年
	$pre_year = $year - 1;
       // ライブラリの読み込み
        require_once 'Date/Holidays.php';
 
       // 翻訳ファイルパス
          $translationfile = '/usr/share/pear-data/Date_Holidays_Japan/lang/Japan/ja_JP.xml';
//        $translationfile = '/usr/share/pear/data/Date_Holidays_Japan/lang/Japan/ja_JP.xml';
 
       // Date_Holidaysインスタンスを生成。国言語、年を設定する
	$holiday = Date_Holidays::factory('Japan', $year, 'ja_JP');

       // 翻訳ファイルを設定する
        $holiday->addTranslationFile($translationfile, 'ja_JP');

        // 祝日とその名称を表示する
        foreach($holiday->getHolidays() as $h){
//	  $Ary[]=$h->getDate()->format('%Y-%m-%d') . ' : ' . $h->getTitle() . '';
	  $Ary[]=$h->getDate()->format('%Y-%m-%d');
        }

	$holiday2 = Date_Holidays::factory('Japan', $pre_year, 'ja_JP');
        $holiday2->addTranslationFile($translationfile, 'ja_JP');
        foreach($holiday2->getHolidays() as $h){
	  $Ary[]=$h->getDate()->format('%Y-%m-%d');
        }

	return $Ary;
}



/**
 * 祝日なら1を返し、祝日でなければ0を返す
 * @param  string $day          // 年
 * @param  array $holidays     // 祝日
 * @return integer  $before_day // 前日 or 連休前の日までの日数
 */
function isHoliday($day,$saijitsu){

    $day = "20" . str_replace("/","-",$day);
    $tsukihi = substr($day,5,5);

    if (in_array($day,$saijitsu) == true || $tsukihi == '01-02' ||$tsukihi == '01-03') {
	if ($tsukihi == '05-05' || $tsukihi == '01-02') $before_day = 3;
	 else if ($tsukihi == '05-04' || $tsukihi == '01-01') $before_day = 2;
	 else if ($tsukihi == '01-03') $before_day = 4;
	 else $before_day = 1;
    } else {
	$before_day = 0;
    }
    return $before_day;
}



/*< unhtmlspecialchars >***************************/
/*      HTMLエンティティを特殊文字に直す。        */
/**************************************************/
function unhtmlspecialchars($val)
{
  $val = stripslashes($val);
  $val = ereg_replace("''", "'", $val);
  $val = preg_replace("/&amp;/","&",$val);
  $val = preg_replace("/&quot;/","\"",$val);
//  $val = preg_replace("/&#039;/","\'",$val);
  $val = preg_replace("/&lt;/","<",$val);
  $val = preg_replace("/&gt;/",">",$val);

  return $val;
}
/*< unhtmlspecialchars >***************************/
/*      HTMLエンティティを特殊文字に直す。        */
/**************************************************/
function unq($val)
{
//  $val = preg_replace('\"','"',$val);
  $val = ereg_replace("''", "\'", $val);

  return $val;
}


/**  
* checkbox対策
* 文字列をQuickform表示用配列に変換  
*  
* @param  string カンマ区切り文字列  
* @return Array
*/ 

function quickArray($str)  
{  
    if (is_null($str)) {  
	return false;  
    }
    $convArr = explode(",",$str);
    $num = count($convArr); 
    for ($i=0;$i<$num;$i++) {
	$newArr[$convArr[$i]] = 1;
    }

    return $newArr;  
}



?>
