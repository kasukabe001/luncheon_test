<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class AdminJininForm extends AppQuickForm
{
    //Constructor
    function AdminJininForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
        $this->addElement('text',   'ji_yakuwari1', '役割1',  array('size'=>18, 'maxlength'=>24));
        $this->addElement('text',   'ji_as1',  'AS1',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop1',  'コプロ1',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl1',  'CL1',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai1',  '学会1',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou1',  '人員備考1', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup1', '参照項目1', array('size'=>14, 'maxlength'=>24));
        $aryJiStat1 = array();
        $aryJiStat1[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat10'));
        $aryJiStat1[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat11'));
        $this->addGroup($aryJiStat1, 'ji_status1', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari2', '役割2',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as2',  'AS2',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop2',  'コプロ2',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl2',  'CL2',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai2',  '学会2',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou2',  '人員備考2', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup2', '参照項目2', array('size'=>14, 'maxlength'=>24));
        $aryJiStat2 = array();
        $aryJiStat2[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat20'));
        $aryJiStat2[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat21'));
        $this->addGroup($aryJiStat2, 'ji_status2', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari3', '役割3',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as3',  'AS3',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop3',  'コプロ3',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl3',  'CL3',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai3',  '学会3',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou3',  '人員備考3', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup3', '参照項目3', array('size'=>14, 'maxlength'=>24));
        $aryJiStat3 = array();
        $aryJiStat3[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat30'));
        $aryJiStat3[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat31'));
        $this->addGroup($aryJiStat3, 'ji_status3', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari4', '役割4',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as4',  'AS4',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop4',  'コプロ4',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl4',  'CL4',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai4',  '学会4',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou4',  '人員備考4', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup4', '参照項目4', array('size'=>14, 'maxlength'=>24));
        $aryJiStat4 = array();
        $aryJiStat4[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat40'));
        $aryJiStat4[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat41'));
        $this->addGroup($aryJiStat4, 'ji_status4', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari5', '役割5',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as5',  'AS5',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop5',  'コプロ5',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl5',  'CL5',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai5',  '学会5',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou5',  '人員備考5', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup5', '参照項目5', array('size'=>14, 'maxlength'=>24));
        $aryJiStat5 = array();
        $aryJiStat5[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat50'));
        $aryJiStat5[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat51'));
        $this->addGroup($aryJiStat5, 'ji_status5', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari6', '役割6',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as6',  'AS6',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop6',  'コプロ6',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl6',  'CL6',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai6',  '学会6',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou6',  '人員備考6', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup6', '参照項目6', array('size'=>14, 'maxlength'=>24));
        $aryJiStat6 = array();
        $aryJiStat6[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat60'));
        $aryJiStat6[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat61'));
        $this->addGroup($aryJiStat6, 'ji_status6', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari7', '役割7',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as7',  'AS7',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop7',  'コプロ7',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl7',  'CL7',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai7',  '学会7',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou7',  '人員備考7', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup7', '参照項目7', array('size'=>14, 'maxlength'=>24));
        $aryJiStat7 = array();
        $aryJiStat7[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat70'));
        $aryJiStat7[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat71'));
        $this->addGroup($aryJiStat7, 'ji_status7', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari8', '役割8',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as8',  'AS8',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop8',  'コプロ8',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl8',  'CL8',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai8',  '学会8',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou8',  '人員備考8', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup8', '参照項目8', array('size'=>14, 'maxlength'=>24));
        $aryJiStat8 = array();
        $aryJiStat8[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat80'));
        $aryJiStat8[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat81'));
        $this->addGroup($aryJiStat8, 'ji_status8', '状況', "&nbsp;");

        $this->addElement('text',   'ji_yakuwari9', '役割9',   array('size'=>18,  'maxlength'=>24));
        $this->addElement('text',   'ji_as9',  'AS9',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cop9',  'コプロ9',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl9',  'CL9',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai9',  '学会9',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('text',   'ji_bikou9',  '人員備考9', array('size'=>34, 'maxlength'=>60));
        $this->addElement('text',   'ji_lookup9', '参照項目9', array('size'=>14, 'maxlength'=>24));
        $aryJiStat9 = array();
        $aryJiStat9[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'jistat90'));
        $aryJiStat9[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'jistat91'));
        $this->addGroup($aryJiStat9, 'ji_status9', '状況', "&nbsp;");
    }


    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
        //使用PC
//        $this->addRule('pc_use', '必須項目です',         'required');
        //配布資料
//        $this->addRule('siryo', '必須項目です',         'required');
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
