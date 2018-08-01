<?php

/**
 * $GLOBALS で使用する変数を設定します。
 *
 */

//手配品
/*
$TEHAIHIN = array(
    '0'=>'講師CV',
    '1'=>'謝礼',
    '2'=>'宿泊',
    '3'=>'文具',
    '4'=>'メディア（モニター等）',
    '5'=>'共催社スタッフ証',
    '6'=>'座長･講師用軽食',
    '7'=>'コーヒー･冷水等',
    '8'=>'データ受用ＰＣ',
    '9'=>'その他'
);
*/

//
$SETSUGU = array(
    '0'=>'接遇有',
    '1'=>'接遇無'
);

$OURO = array(
    '0'=>'往路',
    '1'=>'来日'
);

$FUKURO = array(
    '0'=>'復路',
    '1'=>'離日'
);


$OS = array(
    'Windows 7'   => 'Windows 7',
    'Windows Vista'   => 'Windows Vista',
    'Windows XP'   => 'Windows XP',
    'Mac'   => 'Mac',
    'その他'   => 'その他'
);

$TANTOU = array(
    0=>'アステラス',
    1=>'コプロ',
    2=>'リンケージ',
    3=>'運営会社',
    4=>'会場',
    5=>'アンケート',
    6=>'収録',
    7=>'その他'
);

$DetailTantou = array(
    0=>'アステラス',
    1=>'コプロ',
    2=>'コプロ',
    3=>'リンケージ',
    4=>'運営会社',
    5=>'会場',
    6=>'アンケート',
    7=>'収録',
);

$TEHAISHA = array(
    '学会' => '学会',
    'Astellas' => 'Astellas',
    'CL' => 'CL',
    'その他' => 'その他'
);

$TBLNAME = array(
    'jinin' => '人員配置',
    'tehai' => '手配物',
    'luncheon' => '基本情報',
    'lch_tantou' => '担当者',
    'schedule' => 'スケジュール',
    'cheirspeaker' => '座長/演者'
);

$FILEKIND = array(
    0 => 'チラシ',
    1 => '開示承諾書',
    2 => '応諾書',
    3 => '控室案内',
    4 => 'CV',
    5 => 'syuisho',
    6 => 'enquate',
    7 => 'yakuwari',
    8 => 'MR_mail',
);


$NENDO = array(
    '2016' => '2016',
    '2017' => '2017',
    '2018' => '2018',
    '----' => '----',
    '2015' => '2015',
    '2014' => '2014',
    '2013' => '2013',
    '2012' => '2012',
    '2011' => '2011',
    '2010' => '2010',
    '2009' => '2009',
    '2008' => '2008',
    '2007' => '2007'
);

$STATUS = array(
    '進行中' => '進行中',
    '終了' => '終了'
);

$PROGRESS_STATUS = array(
    '準備中' => '準備中',
    '進行中' => '進行中',
    '締切済' => '締切済',
    '抄録受付中' => '抄録受付中',
    '抄録締切済' => '抄録締切済',
    '一部演者 抄録未入手' => '一部演者 抄録未入手',
    '全演者 抄録入手済' => '全演者 抄録入手済',
);

//管理者名リスト
$ADMIN_NAME_LIST = array(
    _ADMIN2_AUTH_FLG_ => 'GakuJou',
    _ADMIN3_AUTH_FLG_ => 'CL'
);



//CSV,Form共有　ステータス
$COMMON_STATUS = array(
    't' => '有効',
    'f' => 'キャンセル',
);



$YesNo = array(
    'y' => 'はい',
    'n' => 'いいえ'
);


$Siryo = array(
    0 => '事務局に印刷を依頼する',
    1 => '自分で印刷し、会場に持参する'
);

$Hope = array(
    0 => '希望する',
    1 => '希望しない'
);

$Kahi = array(
    '不' => '不',
    '可' => '可'
);


//CSV,Form用　使用機材　PC使用
$PC_USE = array(
    '0' => '持込PC',
    '1' => '事務局PC',
    '2' => 'PCは使用しない'
);


//DB登録を失敗時
$ERROR_ADD_DB = array(
    'ja'=>'データベースへの登録に失敗しました。',
    'en'=>'DB Insert Error!'
);

//DBへ変更を失敗した時
$ERROR_EDIT_DB = array(
    'ja'=>'データベースの変更に失敗しました。',
    'en'=>'DB Update Error!'
);

//DBから削除を失敗した時
$ERROR_DEL_DB = array(
    'ja'=>'データベースへの削除に失敗しました。',
    'en'=>'DB Delete Error!'
);
//競合が発生した時
$ERROR_LOCK_DB = array(
    'ja'=>'データアクセスが競合したため、データを変更できませんでした。',
    'en'=>'DB Lock Error!'
);


/**
 * テンプレートで使用する"登録"、"変更"、"削除"の振り分け
 */
$TYPE_NAME_LABEL = array(
    'Edit' => array('ja'=>'変更', 'en'=>'Edit'),
    'Del'  => array('ja'=>'削除', 'en'=>'Delete'),
    'Add'  => array('ja'=>'登録', 'en'=>'Registration'),
    ''     => array('ja'=>'登録', 'en'=>'Registration'),
);
?>
