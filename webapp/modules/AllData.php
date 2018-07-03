<?php

class AllData
{

    /**
     * Set of Variables
     */
  public $channelNo;
  var $luncheon = array();
  var $zacho = array();
  var $ensha = array();
  var $tehai = array();
  var $k_tehai = array();
  var $jinin = array();
  var $lch_tantou = array();




  /**
  * lucheonテーブルのデータをセット
  *
  * @param  array $row
  * @return none
  */
  function luncheonSet($row){

    foreach ($row as $key => $val) {
      $row[$key] = stripslashes($row[$key]);
//    $row[$key] = mb_convert_encoding(($row[$key]),'UTF-8','EUC-JP');
//      $row[$key] = mb_convert_encoding(($row[$key]),'UTF-8','eucJP-win');
    }
    $this->luncheon =$row;

  }


  /**
  * zachoデータをセット
  *
  * @param  array $rows
  * @return none
  */
  function zachoSet($rows){

    $num = count($rows);
    for ($i=0;$i<$num;$i++) {
      foreach ($rows[$i] as $key => $val) {
        $rows[$i][$key] = stripslashes($rows[$i][$key]);
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','EUC-JP');
        if ($key == 'cs_name') {
	  $rows[$i][$key] = $this->addSensei($rows[$i][$key]);
        }
      }
    $this->zacho[$i] =$rows[$i];
    }

  }


  /**
  * enshaデータをセット
  *
  * @param  array $rows
  * @return none
  */
  function enshaSet($rows){

    $num = count($rows);
    for ($i=0;$i<$num;$i++) {
      foreach ($rows[$i] as $key => $val) {
        $rows[$i][$key] = stripslashes($rows[$i][$key]);
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','EUC-JP');
        if ($key == 'cs_name') {
	  $rows[$i][$key] = $this->addSensei($rows[$i][$key]);
        }
      }
    $this->ensha[$i] =$rows[$i];
    }

  }


  /**
  * 氏名に先生をくわえて返します
  *
  * @param  string $name
  * @return string $name or null
  */
  function addSensei($name){

    if (empty($name)) return;

    $teacher = "先生"; // mb_convert_encoding("先生",'UTF-8','EUC-JP');
    $name = str_replace($teacher, "", $name); // 一旦先生除去
    $name = str_replace("　", " ", $name); 
    $name = trim($name) . " " . $teacher;

    return $name;
  }


  /**
  * tehaiデータをセット
  *
  * @param  array $rows
  * @return none
  */
  function tehaiSet($rows){

    $num = count($rows);
    for ($i=0;$i<$num;$i++) {
      foreach ($rows[$i] as $key => $val) {
        $rows[$i][$key] = stripslashes($rows[$i][$key]);
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','EUC-JP');
      }
    $this->tehai[$i] =$rows[$i];
    }

  }


  /**
  * jininデータをセット
  *
  * @param  array $rows
  * @return none
  */
  function jininSet($rows){

    $num = count($rows);
    for ($i=0;$i<$num;$i++) {
      foreach ($rows[$i] as $key => $val) {
        $rows[$i][$key] = stripslashes($rows[$i][$key]);
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','EUC-JP');
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','eucJP-win');
      }
    $this->jinin[$i] =$rows[$i];
    }

  }


  /**
  * lch_tantouデータをセット
  *
  * @param  array $rows
  * @return none
  */
  function lch_tantouSet($rows){

    $num = count($rows);
    for ($i=0;$i<$num;$i++) {
      foreach ($rows[$i] as $key => $val) {
        $rows[$i][$key] = stripslashes($rows[$i][$key]);
//        $rows[$i][$key] = mb_convert_encoding(($rows[$i][$key]),'UTF-8','EUC-JP');
      }
      $this->lch_tantou[$i] =$rows[$i];
    }

  }



    // 日付解体
    function divideDate($kaisaibi){
	$weekjp_array = array('日', '月', '火', '水', '木', '金', '土');
	$banban = explode("/", $kaisaibi);
	if (strlen($banban[0]) == 4 ) {
		$dAry['y']=$banban[0]; // 年が4桁のとき
//		$dAry['y']=substr($banban[0],2,2); // 年が4桁のとき
	} else {
		$dAry['y']="20" . $banban[0];
//		$dAry['y']=$banban[0];
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

//	$pyear = "20" . $dAry['y'];
	$pyear = $dAry['y'];
	$ptimestamp = mktime(0, 0, 0, $dAry['m'], $dAry['d'], $pyear);
	$weekno = date('w', $ptimestamp);
	$dAry['w']= $weekjp_array[$weekno];

	return $dAry;
    }

    // 時刻整理
    function divideTime($jikan){
	$jikan = str_replace("：",":",$jikan);
	$banban = explode(":", $jikan);
	$tAry['h1']=$banban[0];
	$tAry['m1']=substr($banban[1],0,2);

	$phour = substr($banban[1],-2,1);
	if ($phour != "1" && $phour != "2") {
		$tAry['h2']=substr($banban[1],-1);
	} else {
		$tAry['h2']=substr($banban[1],-2);
	}
	$tAry['m2']=substr($banban[2],0,2);
	$p1 = intval($tAry['h1']) -1;
	$tAry['h0']= strval($p1);

	return $tAry;
    }



  /**
  * 指定した分数前の時刻を返す
  *
  * @param  string  時刻
  * @param  integer 分数
  * @param  integer 0: 時刻だけを返す 1:2つの時刻を-で結んで返す
  * @return string
  */

    function beforeTime($jikoku,$fun,$num=null){

        $kugiri = "：";
//        $kugiri = mb_convert_encoding($kugiri,'UTF-8','eucJP-win');

	$jikoku = str_replace($kugiri,":",$jikoku);
//	$jikoku = str_replace("：",":",$jikoku);
	$banban = explode(":", $jikoku);
	$h=$banban[0];
	$m=substr($banban[1],0,2);

	$startime = mktime($h, $m, 0);
	$byo =$fun * 60;
	$beforeTime = date('H:i',$startime - $byo);
	if ($num == 1) $beforeTime .= "-" . $jikoku;

	return $beforeTime;
    }



  /**
  * セミナー開始時刻を返す
  *
  * @param  string $riyou 開催時間
  * @return time          開始時刻
  */
    function startSeminar($riyou){

        $kara = "～";
//        $kara = mb_convert_encoding($kara,'UTF-8','eucJP-win');

	$riyou = str_replace($kara,"-",$riyou);
	$vpos = strpos($riyou,"-");
	$startTime = substr($riyou,0,$vpos);
//      $end = substr($riyou,$vpos + 1);
	return $startTime;
    }



  /**
  * 部屋名(全角スペースの後ろ)を返す
  *
  * @param  string $place 会場
  * @return time          開始時刻
  */
    function getRoomName($place){

	$sp = "　"; //mb_convert_encoding("　",'UTF-8','EUC-JP');
	$vpos = strpos($place,$sp);
        if ($vpos != 0) $room = substr($place,$vpos + 1);
	 else $room = "";
	return $room;
    }



  /**
  * 全角文字を返す
  *
  * @param  string $han
  * @return string $zen
  */
    function convZen($han){

//	$zen = mb_convert_kana($han,"A","EUC");
	$zen = mb_convert_kana($han,"A","UTF");
//	$zen = mb_convert_encoding($zen,'UTF-8','EUC-JP');
	return $zen;
    }



  /**
  * 会期和暦表示 2015.3.14追加
  * @param  string $kaiki
  * @param  string $kaisaibi セミナー開催日が何日目か判定
  * @return string $jkaiki
  */
    function kaikiJpn($kaiki,$kaisaibi){
	//会期
	$vpos = strpos($kaiki,"/");
        $jkaiki = substr($kaiki,$vpos + 1);
	$jkaiki = preg_replace('/\//', '月', $jkaiki);
	$jkaiki = preg_replace('/-/', '日～', $jkaiki, 1);
	$jkaiki = preg_replace('/月0/', '月', $jkaiki);
	$jkaiki = preg_replace('/～0/', '～', $jkaiki, 1);

	//日目
	$num = 1; //開催日未登録なら1日目になる
	$banban = explode("/", $kaisaibi);
	$year=$banban[0]; // 年
	if ($year % 4 == 0) $uruu = 1;
	 else $uruu = 0;
	if (substr($banban[1],0,1) == "0" ) {
		$month=substr($banban[1],1,1);
	} else {
		$month=substr($banban[1],0,2);
	}
	if ($month == 5 || $month == 7 || $month == 10 || $month == 12) {
		$tukikawari = 30;
	} else if ($month == 2 || $month == 4 || $month == 6 || $month == 8 || $month == 9 || $month == 11) {
		$tukikawari = 31;
	} else if ($month == 3) {
		$tukikawari = 28 + $uruu;
	}
	if (substr($banban[2],0,1) == "0" ) {
		$day=substr($banban[2],1,1);
	} else {
		$day=substr($banban[2],0,2);
	}
	//セミナー開催日が複数の場合
	if (strpos($banban[2],"-") > 0) $fukusu_flag = 1;
	 else $fukusu_flag = 0;
	//会期
	$banban = explode("/", $kaiki);
	if (substr($banban[2],0,1) == "0" ) {
		$hi=substr($banban[2],1,1);
	} else {
		$hi=substr($banban[2],0,2);
	}
	for ($i=0;$i<5;$i++) {
	    if ($day == $hi || $day + $tukikawari == $hi) {
		$num = $i + 1;
		break;
	    }
	    $hi += 1;
	}

	//結合
	if (empty($jkaiki)) $jkaiki = "(会期：未登録(" . $num . "日目))";
	 else $jkaiki = "(会期：" .$jkaiki. "日(" . $num . "日目))";
	if ($fukusu_flag == 1) $jkaiki = preg_replace('/1日目/', '複数日', $jkaiki, 1);
	$jkaiki = preg_replace('/：0/', '：', $jkaiki, 1);
//	$jkaiki = mb_convert_encoding($jkaiki,'UTF-8','EUC-JP');
	return $jkaiki;
    }



}
?>
