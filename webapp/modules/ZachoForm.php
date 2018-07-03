<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class ZachoForm extends AppQuickForm
{
    //Constructor
    function ZachoForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
    // 管理項目
	$this->addElement('hidden', 'cs_id1','座長演者No1');
	$this->addElement('hidden', 'cs_id2','座長演者No2');
	$this->addElement('hidden', 'cs_id3','座長演者No3');
	$this->addElement('hidden', 'cs_reg_date1','最終更新日1');
	$this->addElement('hidden', 'cs_reg_date2','最終更新日2');
	$this->addElement('hidden', 'cs_reg_date3','最終更新日3');

// 座長1
$this->addElement('text',     'cs_name1',         '座長1',    array('size'=>20, 'maxlength'=>24, 'readonly'));
$this->addElement('text',     'cs_kana1',         '座長1カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'cs_yaku1',         '座長1役職',    array('size'=>36, 'maxlength'=>120,'readonly'));

// 座長2
$this->addElement('text',     'cs_name2',         '座長2',    array('size'=>20, 'maxlength'=>24, 'readonly'));
$this->addElement('text',     'cs_kana2',         '座長2カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'cs_yaku2',         '座長2役職',    array('size'=>36, 'maxlength'=>120, 'readonly'));

// 座長3
$this->addElement('text',     'cs_name3',         '座長3',    array('size'=>20, 'maxlength'=>24, 'readonly'));
$this->addElement('text',     'cs_kana3',         '座長3カナ',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'cs_yaku3',         '座長3役職',    array('size'=>36, 'maxlength'=>120, 'readonly'));

//担当MR1
$this->addElement('text',     'mr_eigyo1',         '座長MR1営業所',    array('size'=>30, 'maxlength'=>32, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_name1',         '座長MR1氏名',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_keitai1',         '座長MR1携帯',    array('size'=>18, 'maxlength'=>20, 'style'=>'ime-mode:disabled;'));
  //接遇/随行1
$arySetsugu1 = array();
$arySetsugu1[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'zamr1s0'));
$arySetsugu1[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'zamr1s1'));
$this->addGroup($arySetsugu1, 'mr_setsugu1', '座長MR1接遇', "&nbsp;&nbsp;");
$this->addElement('text', 'mr_tel1', '座長MR1TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
$this->addElement('text', 'mr_fax1', '座長MR1FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

//担当MR2
$this->addElement('text',     'mr_eigyo2',         '座長MR2営業所',    array('size'=>30, 'maxlength'=>32, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_name2',         '座長MR2氏名',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_keitai2',         '座長MR2携帯',    array('size'=>18, 'maxlength'=>20, 'style'=>'ime-mode:disabled;'));
  //接遇/随行2
$arySetsugu2 = array();
$arySetsugu2[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'zamr2s0'));
$arySetsugu2[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'zamr2s1'));
$this->addGroup($arySetsugu2, 'mr_setsugu2', '座長MR2接遇', "&nbsp;&nbsp;");
$this->addElement('text', 'mr_tel2', '座長MR2TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
$this->addElement('text', 'mr_fax2', '座長MR2FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

//担当MR3
$this->addElement('text',     'mr_eigyo3',         '座長MR3営業所',    array('size'=>30, 'maxlength'=>32, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_name3',         '座長MR3氏名',    array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'mr_keitai3',         '座長MR3携帯',    array('size'=>18, 'maxlength'=>20, 'style'=>'ime-mode:disabled;'));
  //接遇/随行3
$arySetsugu3 = array();
$arySetsugu3[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0],$GLOBALS['SETSUGU'][0], array('id'=>'zamr3s0'));
$arySetsugu3[] = $this->createElement('radio', null, $GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1],$GLOBALS['SETSUGU'][1], array('id'=>'zamr3s1'));
$this->addGroup($arySetsugu3, 'mr_setsugu3', '座長MR3接遇', "&nbsp;&nbsp;");
$this->addElement('text', 'mr_tel3', '座長MR3TEL',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
$this->addElement('text', 'mr_fax3', '座長MR3FAX',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

//交通1
$aryOuro1 = array();
$aryOuro1[] = $this->createElement('radio', null, $GLOBALS['OURO'][0],$GLOBALS['OURO'][0],$GLOBALS['OURO'][0], array('id'=>'ouro10'));
$aryOuro1[] = $this->createElement('radio', null, $GLOBALS['OURO'][1],$GLOBALS['OURO'][1],$GLOBALS['OURO'][1], array('id'=>'ouro11'));
$this->addGroup($aryOuro1, 'ourai1', '往路1', "&nbsp;&nbsp;");
$this->addElement('textarea', 'iki1', '交通手配行き1',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

$aryFukuro1 = array();
$aryFukuro1[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0], array('id'=>'fukuro10'));
$aryFukuro1[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1], array('id'=>'fukuro11'));
$this->addGroup($aryFukuro1, 'fukuri1', '復路1', "&nbsp;&nbsp;");
$this->addElement('textarea', 'kaeri1', '交通手配帰り1',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

//交通2
$aryOuro2 = array();
$aryOuro2[] = $this->createElement('radio', null, $GLOBALS['OURO'][0],$GLOBALS['OURO'][0],$GLOBALS['OURO'][0], array('id'=>'ouro20'));
$aryOuro2[] = $this->createElement('radio', null, $GLOBALS['OURO'][1],$GLOBALS['OURO'][1],$GLOBALS['OURO'][1], array('id'=>'ouro21'));
$this->addGroup($aryOuro2, 'ourai2', '往路2', "&nbsp;&nbsp;");
$this->addElement('textarea', 'iki2', '交通手配行き2',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
$aryFukuro2 = array();
$aryFukuro2[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0], array('id'=>'fukuro20'));
$aryFukuro2[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1], array('id'=>'fukuro21'));
$this->addGroup($aryFukuro2, 'fukuri2', '復路2', "&nbsp;&nbsp;");
$this->addElement('textarea', 'kaeri2', '交通手配帰り2',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

//交通3
$aryOuro3 = array();
$aryOuro3[] = $this->createElement('radio', null, $GLOBALS['OURO'][0],$GLOBALS['OURO'][0],$GLOBALS['OURO'][0], array('id'=>'ouro30'));
$aryOuro3[] = $this->createElement('radio', null, $GLOBALS['OURO'][1],$GLOBALS['OURO'][1],$GLOBALS['OURO'][1], array('id'=>'ouro31'));
$this->addGroup($aryOuro3, 'ourai3', '往路3', "&nbsp;&nbsp;");
$this->addElement('textarea', 'iki3', '交通手配行き3',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

$aryFukuro3 = array();
$aryFukuro3[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0],$GLOBALS['FUKURO'][0], array('id'=>'fukuro30'));
$aryFukuro3[] = $this->createElement('radio', null, $GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1],$GLOBALS['FUKURO'][1], array('id'=>'fukuro31'));
$this->addGroup($aryFukuro3, 'fukuri3', '復路3', "&nbsp;&nbsp;");
$this->addElement('textarea', 'kaeri3', '交通手配帰り3',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

//宿泊1
$this->addElement('text',     'inn_hotel1',      'ホテル1',    array('size'=>48, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki1',      '手配先1',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,1)'));

$this->addElement('text',     'inn_in1',      'ホテルIn1',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'inn_out1',      'ホテルOut1',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('textarea', 'inn_tehai1', '宿泊手配1',   array("cols"=>64, "rows"=>2,'style'=>'ime-mode:active;'));

//宿泊2
$this->addElement('text',     'inn_hotel2',      'ホテル2',    array('size'=>48, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki2',      '手配先2',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,2)'));
$this->addElement('text',     'inn_in2',      'ホテルIn2',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'inn_out2',      'ホテルOut2',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('textarea', 'inn_tehai2', '宿泊手配2',   array("cols"=>64, "rows"=>2,'style'=>'ime-mode:active;'));

//宿泊3
$this->addElement('text',     'inn_hotel3',      'ホテル3',    array('size'=>48, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'tehaisaki3',      '手配先3',    array('size'=>20, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,3)'));
$this->addElement('text',     'inn_in3',      'ホテルIn3',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('text',     'inn_out3',      'ホテルOut3',    array('size'=>30, 'maxlength'=>80, 'style'=>'ime-mode:active;'));
$this->addElement('textarea', 'inn_tehai3', '宿泊手配3',   array("cols"=>64, "rows"=>2,'style'=>'ime-mode:active;'));

// 応諾書,開示承諾書
$this->addElement('text',     'cs_shodaku1',         '座長1応諾書',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_cv1',         '座長1開示承諾書',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_shodaku2',         '座長2応諾書',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_cv2',         '座長2開示承諾書',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_shodaku3',         '座長3応諾書',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_cv3',         '座長3開示承諾書',    array('size'=>20, 'maxlength'=>24));

// 謝金
$this->addElement('text',     'cs_shakinhi1',         '座長1謝金振込',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_shakinhi2',         '座長2謝金振込',    array('size'=>20, 'maxlength'=>24));
$this->addElement('text',     'cs_shakinhi3',         '座長3謝金振込',    array('size'=>20, 'maxlength'=>24));
// $this->addElement('text',     'cs_shakin1',         '座長1謝金額',    array('size'=>20, 'maxlength'=>24));
// $this->addElement('text',     'cs_shakin2',         '座長2謝金額',    array('size'=>20, 'maxlength'=>24));
// $this->addElement('text',     'cs_shakin3',         '座長3謝金額',    array('size'=>20, 'maxlength'=>24));

// 備考
$this->addElement('textarea', 'cs_biko1', '座長MR1備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
$this->addElement('textarea', 'cs_biko2', '座長MR1備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));
$this->addElement('textarea', 'cs_biko3', '座長MR1備考',   array("cols"=>70, "rows"=>2,'style'=>'ime-mode:active;'));

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
//      $this->addRule('btokkyo', '必須項目です',         'required');
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
