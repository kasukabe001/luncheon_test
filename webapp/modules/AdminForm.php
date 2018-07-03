<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php';

class AdminForm extends AppQuickForm
{
    //Constructor
    function AdminForm($arg)
    {
        parent::AppQuickForm($arg);
    }


    function buildFormValues()
    {
        //hidden要素
        $this->addElement('hidden', 'ta_id');
	//最終更新日
        $this->addElement('hidden', 'last_update', '最終更新日');

        //区分
        $arySiten = array();
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][0],"共催(".$GLOBALS['TANTOU'][0].")",$GLOBALS['TANTOU'][0], array('id'=>'siten0'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][1],"共催(".$GLOBALS['TANTOU'][1].")",$GLOBALS['TANTOU'][1], array('id'=>'siten1'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][2],"当日運営(".$GLOBALS['TANTOU'][2].")",$GLOBALS['TANTOU'][2], array('id'=>'siten2'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][3],"学会運営事務局(".$GLOBALS['TANTOU'][3].")",$GLOBALS['TANTOU'][3], array('id'=>'siten3'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][4],$GLOBALS['TANTOU'][4],$GLOBALS['TANTOU'][4], array('id'=>'siten4'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][5],$GLOBALS['TANTOU'][5],$GLOBALS['TANTOU'][5], array('id'=>'siten5'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][6],$GLOBALS['TANTOU'][6],$GLOBALS['TANTOU'][6], array('id'=>'siten6'));
        $arySiten[] = $this->createElement('radio', null, $GLOBALS['TANTOU'][7],$GLOBALS['TANTOU'][7],$GLOBALS['TANTOU'][7], array('id'=>'siten7'));
        $this->addGroup($arySiten, 'ta_code', '区分', "<br />");

        $this->addElement('text', 'ta_corp', '会社・団体名',   array('size'=>64, 'maxlength'=>100,'style'=>'ime-mode:active;'));

        $this->addElement('text', 'ta_zip', '〒',   array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:disabled;'));
        //住所
	$this->addElement('textarea', 'ta_addr', '住所',   array("cols"=>48, "rows"=>3,'style'=>'ime-mode:active;'));

        //TEL
        $this->addElement('text', 'ta_tel',  'TEL', array('size'=>18,'maxlength'=>20,'style'=>'ime-mode:disabled;'));
        //FAX
        $this->addElement('text', 'ta_fax', 'FAX',   array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:disabled;'));
        //E-mail
        $this->addElement('text', 'ta_email', 'E-mail',   array('size'=>40, 'maxlength'=>52,'style'=>'ime-mode:inactive;'));
        //担当者
        $this->addElement('text', 'ta_man', '担当者名',   array('size'=>20, 'maxlength'=>20,'style'=>'ime-mode:active;'));
	//携帯
        $this->addElement('text', 'ta_mobile', '携帯番号',   array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:disabled;'));



	// status
        $aryStatus = array();
        $aryStatus[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'stat0'));
        $aryStatus[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'stat1'));
        $this->addGroup($aryStatus, 'ta_status', '状況', "&nbsp;&nbsp;");

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
        //区分
        $this->addRule('ta_code', '区分を選択してください<br>',        'required');
	//携帯
//        $this->addRule('ta_mobile', '携帯番号が入力されていません<br>',         'required');
	//ta_corp
        $this->addRule('ta_corp', '会社・団体名が入力されていません<br>', 'required');
	//TEL
//        $this->addRule('ta_tel', '電話番号が入力されていません<br>',         'required');
        //zip
//      $this->addRule('ta_zip', '郵便番号が入力されていません<br>',        'required');

    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
