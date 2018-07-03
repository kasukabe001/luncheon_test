<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class AdminTehaiForm extends AppQuickForm
{
    //Constructor
    function AdminTehaiForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues($th_code)
    {
        $this->addElement('hidden', 'th_code', 'TehaiCode');
    if ($th_code==1) {
        $this->addElement('textarea', 'th_hinmei1', '品名1',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su1',  '数1',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha1',  '手配者1',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text',   'kakunin1',  '確認者1',   array('size'=>8, 'maxlength'=>24));
        $this->addElement('text',   'th_lookup1',  '参照項目1',   array('size'=>14, 'maxlength'=>24));
        $this->addElement('text',   'th_bikou1',  '備考1',   array('size'=>52, 'maxlength'=>60,'style'=>'ime-mode:active;'));
        $aryTeStat1 = array();
        $aryTeStat1[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat10'));
        $aryTeStat1[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat11'));
        $this->addGroup($aryTeStat1, 'th_status1', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei2', '品名2',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su2',  '数2',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha2',  '手配者2',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha1','tehaisha2')")); 
        $this->addElement('text',   'kakunin2',  '確認者2',   array('size'=>8, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin1','kakunin2')"));
        $this->addElement('text',   'th_bikou2',  '備考2',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup2',  '参照項目2',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat2 = array();
        $aryTeStat2[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat20'));
        $aryTeStat2[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat21'));
        $this->addGroup($aryTeStat2, 'th_status2', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei3', '品名3',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su3',  '数3',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha3',  '手配者3',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha2','tehaisha3')"));
        $this->addElement('text',   'kakunin3',  '確認者3',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin2','kakunin3')"));
        $this->addElement('text',   'th_bikou3',  '備考3',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup3',  '参照項目3',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat3 = array();
        $aryTeStat3[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat30'));
        $aryTeStat3[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat31'));
        $this->addGroup($aryTeStat3, 'th_status3', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei4', '品名4',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su4',  '数4',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha4',  '手配者4',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha3','tehaisha4')"));
        $this->addElement('text',   'kakunin4',  '確認者4',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin3','kakunin4')"));
        $this->addElement('text',   'th_bikou4',  '備考4',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup4',  '参照項目4',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat4 = array();
        $aryTeStat4[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat40'));
        $aryTeStat4[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat41'));
        $this->addGroup($aryTeStat4, 'th_status4', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei5', '品名5',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su5',  '数5',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha5',  '手配者5',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha4','tehaisha5')"));
        $this->addElement('text',   'kakunin5',  '確認者5',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin4','kakunin5')"));
        $this->addElement('text',   'th_bikou5',  '備考5',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup5',  '参照項目5',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat5 = array();
        $aryTeStat5[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat50'));
        $aryTeStat5[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat51'));
        $this->addGroup($aryTeStat5, 'th_status5', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei6', '品名6',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su6',  '数6',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha6',  '手配者6',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha5','tehaisha6')"));
        $this->addElement('text',   'kakunin6',  '確認者6',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin5','kakunin6')"));
        $this->addElement('text',   'th_bikou6',  '備考6',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup6',  '参照項目6',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat6 = array();
        $aryTeStat6[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat60'));
        $aryTeStat6[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat61'));
        $this->addGroup($aryTeStat6, 'th_status6', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei7', '品名7',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su7',  '数7',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha7',  '手配者7',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha6','tehaisha7')"));
        $this->addElement('text',   'kakunin7',  '確認者7',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin6','kakunin7')"));
        $this->addElement('text',   'th_bikou7',  '備考7',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup7',  '参照項目7',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat7 = array();
        $aryTeStat7[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat70'));
        $aryTeStat7[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat71'));
        $this->addGroup($aryTeStat7, 'th_status7', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei8', '品名8',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su8',  '数8',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha8',  '手配者8',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha7','tehaisha8')"));
        $this->addElement('text',   'kakunin8',  '確認者8',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin7','kakunin8')"));
        $this->addElement('text',   'th_bikou8',  '備考8',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup8',  '参照項目8',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat8 = array();
        $aryTeStat8[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat80'));
        $aryTeStat8[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat81'));
        $this->addGroup($aryTeStat8, 'th_status8', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei9', '品名9',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su9',  '数9',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha9',  '手配者9',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha8','tehaisha9')"));
        $this->addElement('text',   'kakunin9',  '確認者9',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin8','kakunin9')"));
        $this->addElement('text',   'th_bikou9',  '備考9',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup9',  '参照項目9',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat9 = array();
        $aryTeStat9[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat90'));
        $aryTeStat9[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat91'));
        $this->addGroup($aryTeStat9, 'th_status9', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei10', '品名10',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su10',  '数10',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha10',  '手配者10',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha9','tehaisha10')"));
        $this->addElement('text',   'kakunin10',  '確認者10',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin9','kakunin10')"));
        $this->addElement('text',   'th_bikou10',  '備考10',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup10',  '参照項目10',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat10 = array();
        $aryTeStat10[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat100'));
        $aryTeStat10[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat101'));
        $this->addGroup($aryTeStat10, 'th_status10', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei11', '品名11',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su11',  '数11',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha11',  '手配者11',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha10','tehaisha11')"));
        $this->addElement('text',   'kakunin11',  '確認者11',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin10','kakunin11')"));
        $this->addElement('text',   'th_bikou11',  '備考11',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text',   'th_lookup11',  '参照項目11',   array('size'=>14, 'maxlength'=>24));
        $aryTeStat11 = array();
        $aryTeStat11[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat110'));
        $aryTeStat11[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat111'));
        $this->addGroup($aryTeStat11, 'th_status11', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei12', '品名12',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'th_su12',  '数12',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text',   'tehaisha12',  '手配者12',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha11','tehaisha12')"));
        $this->addElement('text',   'kakunin12',  '確認者12',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin11','kakunin12')"));
        $this->addElement('text',   'th_bikou12',  '備考12',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat12 = array();
        $aryTeStat12[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat120'));
        $aryTeStat12[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat121'));
        $this->addElement('text',   'th_lookup12',  '参照項目12',   array('size'=>14, 'maxlength'=>24));
        $this->addGroup($aryTeStat12, 'th_status12', '状況', "&nbsp;");

    }else if ($th_code==2) {

// Seminar room
        $this->addElement('textarea', 'th_hinmei61', '品名61',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su61',  '数61',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha61',  '手配者61',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin61',  '確認者61',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou61',  '備考61',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat61 = array();
        $aryTeStat61[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat610'));
        $aryTeStat61[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat611'));
        $this->addElement('text',   'th_lookup61',  '参照項目61',   array('size'=>14, 'maxlength'=>24));
        $this->addGroup($aryTeStat61, 'th_status61', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei62', '品名62',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su62',  '数62',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha62',  '手配者62',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin62',  '確認者62',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou62',  '備考62',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat62 = array();
        $aryTeStat62[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat620'));
        $aryTeStat62[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat621'));
        $this->addElement('text',   'th_lookup62',  '参照項目62',   array('size'=>14, 'maxlength'=>24));
        $this->addGroup($aryTeStat62, 'th_status62', '状況', "&nbsp;");
 
        $this->addElement('textarea', 'th_hinmei63', '品名63',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su63',  '数63',   array('size'=>4, 'maxlength'=>6));
        $this->addElement('text', 'tehaisha63',  '手配者63',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin63',  '確認者63',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou63',  '備考63',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup63', '参照項目63',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat63 = array();
        $aryTeStat63[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat630'));
        $aryTeStat63[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat631'));
        $this->addGroup($aryTeStat63, 'th_status63', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei64', '品名64',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su64',  '数64',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha64',  '手配者64',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin64',  '確認者64',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou64',  '備考64',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup64', '参照項目64',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat64 = array();
        $aryTeStat64[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat640'));
        $aryTeStat64[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat641'));
        $this->addGroup($aryTeStat64, 'th_status64', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei65', '品名65',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su65',  '数65',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha65',  '手配者65',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin65',  '確認者65',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_lookup65', '参照項目65',  array('size'=>14, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou65',  '備考65',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat65 = array();
        $aryTeStat65[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat650'));
        $aryTeStat65[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat651'));
        $this->addGroup($aryTeStat65, 'th_status65', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei66', '品名66',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su66',  '数66',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha66',  '手配者66',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin66',  '確認者66',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_lookup66', '参照項目66',  array('size'=>14, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou66',  '備考66',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat66 = array();
        $aryTeStat66[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat660'));
        $aryTeStat66[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat661'));
        $this->addGroup($aryTeStat66, 'th_status66', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei67', '品名67',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su67',  '数67',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha67',  '手配者67',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin67',  '確認者67',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou67',  '備考67',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup67', '参照項目67',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat67 = array();
        $aryTeStat67[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat670'));
        $aryTeStat67[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat671'));
        $this->addGroup($aryTeStat67, 'th_status67', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei68', '品名68',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su68',  '数68',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha68',  '手配者68',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin68',  '確認者68',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou68',  '備考68',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup68', '参照項目68',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat68 = array();
        $aryTeStat68[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat680'));
        $aryTeStat68[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat681'));
        $this->addGroup($aryTeStat68, 'th_status68', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei69', '品名69',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su69',  '数69',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha69',  '手配者69',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin69',  '確認者69',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou69',  '備考69',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup69', '参照項目69',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat69 = array();
        $aryTeStat69[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat690'));
        $aryTeStat69[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat691'));
        $this->addGroup($aryTeStat69, 'th_status69', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei70', '品名70',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su70',  '数70',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha70',  '手配者70',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin70',  '確認者70',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou70',  '備考70',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup70', '参照項目70',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat70 = array();
        $aryTeStat70[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat700'));
        $aryTeStat70[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat701'));
        $this->addGroup($aryTeStat70, 'th_status70', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei71', '品名71',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su71',  '数71',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha71',  '手配者71',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin71',  '確認者71',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou71',  '備考71',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup71', '参照項目71',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat71 = array();
        $aryTeStat71[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat710'));
        $aryTeStat71[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat711'));
        $this->addGroup($aryTeStat71, 'th_status71', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei72', '品名72',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su72',  '数72',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha72',  '手配者72',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin72',  '確認者72',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou72',  '備考72',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup72', '参照項目72',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat72 = array();
        $aryTeStat72[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat720'));
        $aryTeStat72[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat721'));
        $this->addGroup($aryTeStat72, 'th_status72', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei73', '品名73',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su73',  '数73',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha73',  '手配者73',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin73',  '確認者73',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou73',  '備考73',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup73', '参照項目73',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat73 = array();
        $aryTeStat73[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat730'));
        $aryTeStat73[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat731'));
        $this->addGroup($aryTeStat73, 'th_status73', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei74', '品名74',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su74',  '数74',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha74',  '手配者74',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin74',  '確認者74',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou74',  '備考74',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup74', '参照項目74',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat74 = array();
        $aryTeStat74[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat740'));
        $aryTeStat74[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat741'));
        $this->addGroup($aryTeStat74, 'th_status74', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei75', '品名75',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su75',  '数75',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha75',  '手配者75',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin75',  '確認者75',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_lookup75', '参照項目75',  array('size'=>14, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou75',  '備考75',   array('size'=>52, 'maxlength'=>60));
        $aryTeStat75 = array();
        $aryTeStat75[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat750'));
        $aryTeStat75[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat751'));
        $this->addGroup($aryTeStat75, 'th_status75', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei76', '品名76',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su76',  '数76',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha76',  '手配者76',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin76',  '確認者76',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou76',  '備考76',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup76', '参照項目76',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat76 = array();
        $aryTeStat76[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat760'));
        $aryTeStat76[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat761'));
        $this->addGroup($aryTeStat76, 'th_status76', '状況', "&nbsp;");

        $this->addElement('textarea', 'th_hinmei77', '品名77',   array("cols"=>18, "rows"=>2,'style'=>'ime-mode:active'));
        $this->addElement('text', 'th_su77',  '数77',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'tehaisha77',  '手配者77',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin77',  '確認者77',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou77',  '備考77',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('text', 'th_lookup77', '参照項目77',  array('size'=>14, 'maxlength'=>24));
        $aryTeStat77 = array();
        $aryTeStat77[] = $this->createElement('radio', null, 0, '有効', 0,array('id'=>'testat770'));
        $aryTeStat77[] = $this->createElement('radio', null, 1, '無効', 1,array('id'=>'testat771'));
        $this->addGroup($aryTeStat77, 'th_status77', '状況', "&nbsp;");
    }
    }

    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
        //使用PC
        $this->addRule('pc_use', '必須項目です',         'required');
        //配布資料
        $this->addRule('siryo', '必須項目です',         'required');
        //PC事前チェック
        if ($this->getElementValue('pc_use') == '持込PC' || $this->getElementValue('pc_use') == '事務局PC') {
            $this->addRule('jchk_umu', '必須項目です',         'required');
	}

    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
