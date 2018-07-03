<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class EnjaForm extends AppQuickForm
{
    //Constructor
    function EnjaForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues($enshaNum=null)
    {

    // 管理項目
	$this->addElement('hidden', 'cs_id1','演者No1');
	$this->addElement('hidden', 'cs_id2','演者No2');
	$this->addElement('hidden', 'cs_id3','演者No3');
	$this->addElement('hidden', 'cs_id4','演者No4');
	$this->addElement('hidden', 'cs_reg_date1','最終更新日1');
	$this->addElement('hidden', 'cs_reg_date2','最終更新日2');
	$this->addElement('hidden', 'cs_reg_date3','最終更新日3');
	$this->addElement('hidden', 'cs_reg_date4','最終更新日4');

	$this->addElement('hidden', 'cs_id5','演者No5');
	$this->addElement('hidden', 'cs_id6','演者No6');
	$this->addElement('hidden', 'cs_id7','演者No7');
	$this->addElement('hidden', 'cs_id8','演者No8');
	$this->addElement('hidden', 'cs_reg_date5','最終更新日5');
	$this->addElement('hidden', 'cs_reg_date6','最終更新日6');
	$this->addElement('hidden', 'cs_reg_date7','最終更新日7');
	$this->addElement('hidden', 'cs_reg_date8','最終更新日8');


// 演者1 --------------------------------------------------
	$this->addElement('text',     'cs_name1',         '演者1',    array('size'=>20, 'maxlength'=>24, 'readonly'));
//	$this->addElement('text',     'cs_kana1',         '演者1カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;','onMouseOut'=>"doQuickSave(this.form,'cs_kana1')"));
	$this->addElement('text',     'cs_kana1',         '演者1カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku1',         '演者1役職',    array('size'=>36, 'maxlength'=>120, 'readonly'));
        $this->addElement('text',     'cs_endai1',        '演題名1',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo1',    'MR1営業所',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name1',        'MR1氏名',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai1',    'MR1携帯',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu1 = array();
        $arySetsugu1[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu10'));
        $arySetsugu1[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu11'));
        $this->addGroup($arySetsugu1, 'mr_setsugu1', '現場接遇1', "&nbsp;&nbsp;");
        $this->addElement('text', 'mr_tel1', 'MR1TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax1', 'MR1FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));

	// PC
        $this->addElement('text',     'os1',        '機種OS1',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
//      $this->addElement('select', 'os', 'PC_OS', array(""=>"▼選択") + $GLOBALS['OS']);
        $this->addElement('text',     'soft1',        'ソフト1',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version1',        'ソフトバージョン1',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi1',        '持込み形態1',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga1 = array();
        $aryPcDouga1[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga10'));
        $aryPcDouga1[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga11'));
        $this->addGroup($aryPcDouga1, 'douga1', 'PC動画1', "&nbsp;&nbsp;");

        $aryPcAudio1 = array();
        $aryPcAudio1[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio10'));
        $aryPcAudio1[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio11'));
        $this->addGroup($aryPcAudio1, 'onsei1', 'PC音声1', "&nbsp;&nbsp;");

	// 交通
        $aryIki1 = array();
        $aryIki1[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki10'));
        $aryIki1[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki11'));
        $this->addGroup($aryIki1, 'ourai1', '往路/来日1', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki1', '行き1',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri1 = array();
        $aryKaeri1[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri10'));
        $aryKaeri1[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri11'));
        $this->addGroup($aryKaeri1, 'fukuri1', '復路/離日1', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri1', '帰り1',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel1',    'ホテル1',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki1',      '手配先1',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,1)'));
	$this->addElement('text',     'inn_in1',    '宿泊In1',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out1',    '宿泊out1',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai1', '宿泊手配1',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku1',    '応諾書1',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv1',    '開示承諾書1',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi1',    '支払い予定日1',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin1',    '支払い額1',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki1',        '略歴有無1',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko1', 'MR1備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者2 --------------------------------------------------
	$this->addElement('text',     'cs_name2',         '演者2',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana2',         '演者2カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku2',         '演者2役職',    array('size'=>36, 'maxlength'=>120, 'readonly'));
        $this->addElement('text',     'cs_endai2',        '演題名2',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo2',    'MR営業所2',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name2',        'MR氏名2',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai2',    'MR携帯2',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_tel2', 'MR2TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax2', 'MR2FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu2 = array();
        $arySetsugu2[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu20'));
        $arySetsugu2[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu21'));
        $this->addGroup($arySetsugu2, 'mr_setsugu2', '現場接遇2', "&nbsp;&nbsp;");

	// PC
        $this->addElement('text',     'os2',        '機種OS2',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
//      $this->addElement('select', 'os', 'PC_OS', array(""=>"▼選択") + $GLOBALS['OS']);
        $this->addElement('text',     'soft2',        'ソフト2',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version2',        'ソフトバージョン2',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi2',        '持込み形態2',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga2 = array();
        $aryPcDouga2[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga20'));
        $aryPcDouga2[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga21'));
        $this->addGroup($aryPcDouga2, 'douga2', 'PC動画2', "&nbsp;&nbsp;");

        $aryPcAudio2 = array();
        $aryPcAudio2[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio20'));
        $aryPcAudio2[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio21'));
        $this->addGroup($aryPcAudio2, 'onsei2', 'PC音声2', "&nbsp;&nbsp;");

	// 交通
        $aryIki2 = array();
        $aryIki2[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki20'));
        $aryIki2[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki21'));
        $this->addGroup($aryIki2, 'ourai2', '往路/来日2', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki2', '行き2',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri2 = array();
        $aryKaeri2[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri20'));
        $aryKaeri2[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri21'));
        $this->addGroup($aryKaeri2, 'fukuri2', '復路/離日2', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri2', '帰り2',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel2',    'ホテル2',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki2',      '手配先2',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,2)'));
	$this->addElement('text',     'inn_in2',    '宿泊In2',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out2',    '宿泊out2',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai2', '宿泊手配2',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku2',    '応諾書2',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv2',    '開示承諾書2',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi2',    '支払い予定日2',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin2',    '支払い額2',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki2',        '略歴有無2',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko2', 'MR2備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者3 --------------------------------------------------
	$this->addElement('text',     'cs_name3',         '演者3',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana3',         '演者3カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku3',         '演者3役職',    array('size'=>36, 'maxlength'=>120, 'readonly'));
        $this->addElement('text',     'cs_endai3',        '演題名3',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo3',    'MR営業所3',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name3',        'MR氏名3',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai3',    'MR携帯3',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_tel3', 'MR3TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax3', 'MR3FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu3 = array();
        $arySetsugu3[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu30'));
        $arySetsugu3[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu31'));
        $this->addGroup($arySetsugu3, 'mr_setsugu3', '現場接遇3', "&nbsp;&nbsp;");

	// PC
        $this->addElement('text',     'os3',        '機種OS3',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
//      $this->addElement('select', 'os', 'PC_OS', array(""=>"▼選択") + $GLOBALS['OS']);
        $this->addElement('text',     'soft3',        'ソフト3',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version3',        'ソフトバージョン3',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi3',        '持込み形態3',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga3 = array();
        $aryPcDouga3[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga30'));
        $aryPcDouga3[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga31'));
        $this->addGroup($aryPcDouga3, 'douga3', 'PC動画3', "&nbsp;&nbsp;");

        $aryPcAudio3 = array();
        $aryPcAudio3[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio30'));
        $aryPcAudio3[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio31'));
        $this->addGroup($aryPcAudio3, 'onsei3', 'PC音声3', "&nbsp;&nbsp;");

	// 交通
        $aryIki3 = array();
        $aryIki3[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki30'));
        $aryIki3[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki31'));
        $this->addGroup($aryIki3, 'ourai3', '往路/来日3', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki3', '行き3',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri3 = array();
        $aryKaeri3[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri30'));
        $aryKaeri3[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri31'));
        $this->addGroup($aryKaeri3, 'fukuri3', '復路/離日3', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri3', '帰り3',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel3',    'ホテル3',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki3',      '手配先3',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,3)'));
	$this->addElement('text',     'inn_in3',    '宿泊In3',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out3',    '宿泊out3',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai3', '宿泊手配3',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku3',    '応諾書3',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv3',    '開示承諾書3',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi3',    '支払い予定日3',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin3',    '支払い額3',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki3',        '略歴有無3',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko3', 'MR3備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者4 --------------------------------------------------
	$this->addElement('text',     'cs_name4',         '演者4',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana4',         '演者4カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku4',         '演者4役職',    array('size'=>36, 'maxlength'=>120,'readonly'));
        $this->addElement('text',     'cs_endai4',        '演題名4',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo4',    'MR営業所4',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name4',        'MR氏名4',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai4',    'MR携帯4',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_tel4', 'MR4TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax4', 'MR4FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu4 = array();
        $arySetsugu4[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu40'));
        $arySetsugu4[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu41'));
        $this->addGroup($arySetsugu4, 'mr_setsugu4', '現場接遇4', "&nbsp;&nbsp;");

	// PC
        $this->addElement('text',     'os4',        '機種OS4',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'soft4',        'ソフト4',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version4',        'ソフトバージョン4',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi4',        '持込み形態4',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga4 = array();
        $aryPcDouga4[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga40'));
        $aryPcDouga4[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga41'));
        $this->addGroup($aryPcDouga4, 'douga4', 'PC動画4', "&nbsp;&nbsp;");

        $aryPcAudio4 = array();
        $aryPcAudio4[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio40'));
        $aryPcAudio4[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio41'));
        $this->addGroup($aryPcAudio4, 'onsei4', 'PC音声4', "&nbsp;&nbsp;");

	// 交通
        $aryIki4 = array();
        $aryIki4[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki40'));
        $aryIki4[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki41'));
        $this->addGroup($aryIki4, 'ourai4', '往路/来日4', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki4', '行き4',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri4 = array();
        $aryKaeri4[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri40'));
        $aryKaeri4[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri41'));
        $this->addGroup($aryKaeri4, 'fukuri4', '復路/離日4', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri4', '帰り4',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel4',    'ホテル4',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki4',      '手配先4',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,4)'));
	$this->addElement('text',     'inn_in4',    '宿泊In4',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out4',    '宿泊out4',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai4', '宿泊手配4',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku4',    '応諾書4',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv4',    '開示承諾書4',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi4',    '支払い予定日4',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin4',    '支払い額4',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki4',        '略歴有無4',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko4', 'MR4備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者5 --------------------------------------------------
	$this->addElement('text',     'cs_name5',         '演者5',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana5',         '演者5カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku5',         '演者5役職',    array('size'=>36, 'maxlength'=>120,'readonly'));
        $this->addElement('text',     'cs_endai5',        '演題名5',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo5',    'MR営業所5',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name5',        'MR氏名5',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai5',    'MR携帯5',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_tel5', 'MR5TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax5', 'MR5FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu5 = array();
        $arySetsugu5[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu50'));
        $arySetsugu5[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu51'));
        $this->addGroup($arySetsugu4, 'mr_setsugu5', '現場接遇5', "&nbsp;&nbsp;");

	// PC
        $this->addElement('text',     'os5',        '機種OS5',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'soft5',        'ソフト5',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version5',        'ソフトバージョン5',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi5',        '持込み形態5',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga5 = array();
        $aryPcDouga5[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga50'));
        $aryPcDouga5[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga51'));
        $this->addGroup($aryPcDouga5, 'douga5', 'PC動画5', "&nbsp;&nbsp;");

        $aryPcAudio5 = array();
        $aryPcAudio5[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio50'));
        $aryPcAudio5[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio51'));
        $this->addGroup($aryPcAudio5, 'onsei5', 'PC音声5', "&nbsp;&nbsp;");

	// 交通
        $aryIki5 = array();
        $aryIki5[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki50'));
        $aryIki5[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki51'));
        $this->addGroup($aryIki5, 'ourai5', '往路/来日5', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki5', '行き5',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri5 = array();
        $aryKaeri5[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri50'));
        $aryKaeri5[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri51'));
        $this->addGroup($aryKaeri5, 'fukuri5', '復路/離日5', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri5', '帰り5',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel5',    'ホテル5',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki5',      '手配先5',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,5)'));
	$this->addElement('text',     'inn_in5',    '宿泊In5',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out5',    '宿泊out5',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai5', '宿泊手配5',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku5',    '応諾書5',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv5',    '開示承諾書5',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi5',    '支払い予定日5',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin5',    '支払い額5',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki5',        '略歴有無5',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko5', 'MR5備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者6 --------------------------------------------------
	$this->addElement('text',     'cs_name6',         '演者6',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana6',         '演者6カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku6',         '演者6役職',    array('size'=>36, 'maxlength'=>120,'readonly'));
        $this->addElement('text',     'cs_endai6',        '演題名6',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo6',    'MR営業所6',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name6',        'MR氏名6',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai6',    'MR携帯6',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu6 = array();
        $arySetsugu6[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu60'));
        $arySetsugu6[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu61'));
        $this->addGroup($arySetsugu4, 'mr_setsugu6', '現場接遇6', "&nbsp;&nbsp;");
        $this->addElement('text', 'mr_tel6', 'MR6TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax6', 'MR6FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));

	// PC
        $this->addElement('text',     'os6',        '機種OS6',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'soft6',        'ソフト6',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version6',        'ソフトバージョン6',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi6',        '持込み形態6',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga6 = array();
        $aryPcDouga6[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga60'));
        $aryPcDouga6[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga61'));
        $this->addGroup($aryPcDouga6, 'douga6', 'PC動画6', "&nbsp;&nbsp;");

        $aryPcAudio6 = array();
        $aryPcAudio6[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio60'));
        $aryPcAudio6[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio61'));
        $this->addGroup($aryPcAudio6, 'onsei6', 'PC音声6', "&nbsp;&nbsp;");

	// 交通
        $aryIki6 = array();
        $aryIki6[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki60'));
        $aryIki6[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki61'));
        $this->addGroup($aryIki6, 'ourai6', '往路/来日6', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki6', '行き6',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri6 = array();
        $aryKaeri6[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri60'));
        $aryKaeri6[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri61'));
        $this->addGroup($aryKaeri6, 'fukuri6', '復路/離日6', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri6', '帰り6',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel6',    'ホテル6',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki6',      '手配先6',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,6)'));
	$this->addElement('text',     'inn_in6',    '宿泊In6',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out6',    '宿泊out6',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai6', '宿泊手配6',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku6',    '応諾書6',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv6',    '開示承諾書6',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi6',    '支払い予定日6',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin6',    '支払い額6',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki6',        '略歴有無6',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko6', 'MR6備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者7 --------------------------------------------------
	$this->addElement('text',     'cs_name7',         '演者7',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana7',         '演者7カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku7',         '演者7役職',    array('size'=>36, 'maxlength'=>120,'readonly'));
        $this->addElement('text',     'cs_endai7',        '演題名7',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo7',    'MR営業所7',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name7',        'MR氏名7',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai7',    'MR携帯7',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu7 = array();
        $arySetsugu7[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu70'));
        $arySetsugu7[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu71'));
        $this->addGroup($arySetsugu4, 'mr_setsugu7', '現場接遇7', "&nbsp;&nbsp;");
        $this->addElement('text', 'mr_tel7', 'MR7TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax7', 'MR7FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));

	// PC
        $this->addElement('text',     'os7',        '機種OS7',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'soft7',        'ソフト7',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version7',        'ソフトバージョン7',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi7',        '持込み形態7',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga7 = array();
        $aryPcDouga7[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga70'));
        $aryPcDouga7[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga71'));
        $this->addGroup($aryPcDouga7, 'douga7', 'PC動画7', "&nbsp;&nbsp;");

        $aryPcAudio7 = array();
        $aryPcAudio7[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio70'));
        $aryPcAudio7[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio71'));
        $this->addGroup($aryPcAudio7, 'onsei7', 'PC音声7', "&nbsp;&nbsp;");

	// 交通
        $aryIki7 = array();
        $aryIki7[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki70'));
        $aryIki7[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki71'));
        $this->addGroup($aryIki7, 'ourai7', '往路/来日7', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki7', '行き7',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri7 = array();
        $aryKaeri7[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri70'));
        $aryKaeri7[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri71'));
        $this->addGroup($aryKaeri7, 'fukuri7', '復路/離日7', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri7', '帰り7',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel7',    'ホテル7',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki7',      '手配先7',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,7)'));
	$this->addElement('text',     'inn_in7',    '宿泊In7',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out7',    '宿泊out7',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai7', '宿泊手配7',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku7',    '応諾書7',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv7',    '開示承諾書7',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi7',    '支払い予定日7',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin7',    '支払い額7',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki7',        '略歴有無7',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko7', 'MR7備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

// 演者8 --------------------------------------------------
	$this->addElement('text',     'cs_name8',         '演者8',    array('size'=>20, 'maxlength'=>24, 'readonly'));
	$this->addElement('text',     'cs_kana8',         '演者8カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'cs_yaku8',         '演者8役職',    array('size'=>36, 'maxlength'=>120,'readonly'));
        $this->addElement('text',     'cs_endai8',        '演題名8',   array('readonly','size'=>80, 'maxlength'=>120, 'readonly'));
	// MR
	$this->addElement('text',     'mr_eigyo8',    'MR営業所8',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_name8',        'MR氏名8',    array('size'=>24, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'mr_keitai8',    'MR携帯8',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $arySetsugu8 = array();
        $arySetsugu8[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'setsu80'));
        $arySetsugu8[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'setsu81'));
        $this->addGroup($arySetsugu4, 'mr_setsugu8', '現場接遇8', "&nbsp;&nbsp;");
        $this->addElement('text', 'mr_tel8', 'MR8TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));
        $this->addElement('text', 'mr_fax8', 'MR8FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:disabled;'));

	// PC
        $this->addElement('text',     'os8',        '機種OS8',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'soft8',        'ソフト8',   array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'version8',        'ソフトバージョン8',  array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text',     'mochikomi8',        '持込み形態8',   array('size'=>36,  'maxlength'=>48));
        $aryPcDouga8 = array();
        $aryPcDouga8[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_douga80'));
        $aryPcDouga8[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_douga81'));
        $this->addGroup($aryPcDouga8, 'douga8', 'PC動画8', "&nbsp;&nbsp;");

        $aryPcAudio8 = array();
        $aryPcAudio8[] = $this->createElement('radio', null, '有', '有', '有', array('id'=>'pc_audio80'));
        $aryPcAudio8[] = $this->createElement('radio', null, '無', '無', '無', array('id'=>'pc_audio81'));
        $this->addGroup($aryPcAudio8, 'onsei8', 'PC音声8', "&nbsp;&nbsp;");

	// 交通
        $aryIki8 = array();
        $aryIki8[] = $this->createElement('radio', null, '往路','往路','往路', array('id'=>'iki80'));
        $aryIki8[] = $this->createElement('radio', null, '来日','来日','来日', array('id'=>'iki81'));
        $this->addGroup($aryIki8, 'ourai8', '往路/来日8', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'iki8', '行き8',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
        $aryKaeri8 = array();
        $aryKaeri8[] = $this->createElement('radio', null, '復路','復路','復路', array('id'=>'kaeri80'));
        $aryKaeri8[] = $this->createElement('radio', null, '離日','離日','離日', array('id'=>'kaeri81'));
        $this->addGroup($aryKaeri8, 'fukuri8', '復路/離日8', "&nbsp;&nbsp;");
        $this->addElement('textarea', 'kaeri8', '帰り8',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

	// 宿泊
	$this->addElement('text',     'inn_hotel8',    'ホテル8',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki8',      '手配先8',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,8)'));
	$this->addElement('text',     'inn_in8',    '宿泊In8',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
	$this->addElement('text',     'inn_out8',    '宿泊out8',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
        $this->addElement('textarea', 'inn_tehai8', '宿泊手配8',  array("cols"=>64, "rows"=>2, 'style'=>'ime-mode:active;'));

	// 応諾書受領日
	$this->addElement('text',     'cs_shodaku8',    '応諾書8',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_cv8',    '開示承諾書8',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	// 謝金
	$this->addElement('text',     'cs_shakinhi8',    '支払い予定日8',    array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:inactive;'));
	$this->addElement('text',     'cs_shakin8',    '支払い額8',    array('size'=>48, 'maxlength'=>100, 'style'=>'ime-mode:inactive;'));

	// 略歴
        $this->addElement('text',     'ryakureki8',        '略歴有無8',   array('size'=>20, 'maxlength'=>48));
	// 備考
$this->addElement('textarea', 'cs_biko8', 'MR8備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
//        $this->addRule('ptokkyo', '必須項目です',         'required');
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
