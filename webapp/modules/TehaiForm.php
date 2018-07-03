<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class TehaiForm extends AppQuickForm
{
    //Constructor
    function TehaiForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues($h_num=null,$k_num=null)
    {
    // 管理項目
	$this->addElement('hidden', 'th_reg_date1','Th最終更新日1');

//      $this->addElement('text',   'th_hinmei1',  '品名1',   array('size'=>24,  'maxlength'=>24));
        $this->addElement('textarea', 'th_hinmei1', '品名1',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,31)'));
        $this->addElement('text',   'th_su1',  '数1',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha1',  '手配者1',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text',   'kakunin1',  '確認者1',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text',   'th_bikou1',  '控備考1',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del1',  'TH削除1',  '&nbsp;', 'del1');

        $this->addElement('textarea', 'th_hinmei2', '品名2',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,32)'));
        $this->addElement('text',   'th_su2',  '数2',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha2',  '手配者2',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha1','tehaisha2')")); 
        $this->addElement('text',   'kakunin2',  '確認者2',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin1','kakunin2')"));
        $this->addElement('text',   'th_bikou2',  '控備考2',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del2',  'TH削除2',  '&nbsp;', 'del2');

        $this->addElement('textarea', 'th_hinmei3', '品名3',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,33)'));
        $this->addElement('text',   'th_su3',  '数3',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha3',  '手配者3',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha2','tehaisha3')"));
        $this->addElement('text',   'kakunin3',  '確認者3',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin2','kakunin3')"));
        $this->addElement('text',   'th_bikou3',  '控備考3',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del3',  'TH削除3',  '&nbsp;', 'del3');

        $this->addElement('textarea', 'th_hinmei4', '品名4',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,34)'));
        $this->addElement('text',   'th_su4',  '数4',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha4',  '手配者4',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha3','tehaisha4')"));
        $this->addElement('text',   'kakunin4',  '確認者4',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin3','kakunin4')"));
        $this->addElement('text',   'th_bikou4',  '控備考4',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del4',  'TH削除4',  '&nbsp;', 'del4');

        $this->addElement('textarea', 'th_hinmei5', '品名5',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,35)'));
        $this->addElement('text',   'th_su5',  '数5',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha5',  '手配者5',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha4','tehaisha5')"));
        $this->addElement('text',   'kakunin5',  '確認者5',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin4','kakunin5')"));
        $this->addElement('text',   'th_bikou5',  '控備考5',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del5',  'TH削除5',  '&nbsp;', 'del5');

        $this->addElement('textarea', 'th_hinmei6', '品名6',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,36)'));
        $this->addElement('text',   'th_su6',  '数6',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha6',  '手配者6',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha5','tehaisha6')"));
        $this->addElement('text',   'kakunin6',  '確認者6',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin5','kakunin6')"));
        $this->addElement('text',   'th_bikou6',  '控備考6',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del6',  'TH削除6',  '&nbsp;', 'del6');

        $this->addElement('textarea', 'th_hinmei7', '品名7',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,37)'));
        $this->addElement('text',   'th_su7',  '数7',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha7',  '手配者7',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha6','tehaisha7')"));
        $this->addElement('text',   'kakunin7',  '確認者7',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin6','kakunin7')"));
        $this->addElement('text',   'th_bikou7',  '控備考7',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del7',  'TH削除7',  '&nbsp;', 'del7');

        $this->addElement('textarea', 'th_hinmei8', '品名8',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,38)'));
        $this->addElement('text',   'th_su8',  '数8',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha8',  '手配者8',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha7','tehaisha8')"));
        $this->addElement('text',   'kakunin8',  '確認者8',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin7','kakunin8')"));
        $this->addElement('text',   'th_bikou8',  '控備考8',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del8',  'TH削除8',  '&nbsp;', 'del8');

        $this->addElement('textarea', 'th_hinmei9', '品名9',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,39)'));
        $this->addElement('text',   'th_su9',  '数9',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha9',  '手配者9',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha8','tehaisha9')"));
        $this->addElement('text',   'kakunin9',  '確認者9',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin8','kakunin9')"));
        $this->addElement('text',   'th_bikou9',  '控備考9',   array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del9',  'TH削除9',  '&nbsp;', 'del9');

//    if ($h_num > 9) {
        $this->addElement('textarea', 'th_hinmei10', '品名10',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,40)'));
        $this->addElement('text',   'th_su10',  '数10',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text',   'tehaisha10',  '手配者10',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha9','tehaisha10')"));
        $this->addElement('text',   'kakunin10',  '確認者10',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin9','kakunin10')"));
        $this->addElement('text',   'th_bikou10',  '控備考10', array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del10',  'TH削除10',  '&nbsp;', 'del10');
//    }
//    if ($h_num > 10) {
        $this->addElement('textarea', 'th_hinmei11', '品名11',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,41)'));
        $this->addElement('text',   'th_su11',  '数11',   array('size'=>4, 'maxlength'=>6));
        $this->addElement('text',   'tehaisha11',  '手配者11',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha10','tehaisha11')"));
        $this->addElement('text',   'kakunin11',  '確認者11',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin10','kakunin11')"));
        $this->addElement('text',   'th_bikou11',  '控備考11', array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del11',  'TH削除11',  '&nbsp;', 'del11');
//    }
//    if ($h_num > 11) {
        $this->addElement('textarea', 'th_hinmei12', '品名12',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,42)'));
        $this->addElement('text',   'th_su12',  '数12',   array('size'=>4, 'maxlength'=>6));
        $this->addElement('text',   'tehaisha12',  '手配者12',  array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha11','tehaisha12')"));
        $this->addElement('text',   'kakunin12',  '確認者12',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin11','kakunin12')"));
        $this->addElement('text',   'th_bikou12',  '控備考12', array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del12',  'TH削除12',  '&nbsp;', 'del12');
//    }




// Seminar room
        $this->addElement('textarea', 'th_hinmei61', '品名61',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,61)'));
        $this->addElement('text', 'th_su61',  '数61',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha61',  '手配者61',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'kakunin61',  '確認者61',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou61',  '会備考61',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del61',  'TH削除61',  '&nbsp;', 'del61');

        $this->addElement('textarea', 'th_hinmei62', '品名62',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,62)'));
        $this->addElement('text', 'th_su62',  '数62',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha62',  '手配者62',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha61','tehaisha62')"));
        $this->addElement('text', 'kakunin62',  '確認者62',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou62',  '会備考62',  array('size'=>52, 'maxlength'=>60));
         $this->addElement('checkbox',   'th_del62',  'TH削除62',  '&nbsp;', 'del62');

        $this->addElement('textarea', 'th_hinmei63', '品名63',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,63)'));
        $this->addElement('text', 'th_su63',  '数63',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha63',  '手配者63',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha62','tehaisha63')"));
        $this->addElement('text', 'kakunin63',  '確認者63',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou63',  '会備考63',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del63',  'TH削除63',  '&nbsp;', 'del63');

        $this->addElement('textarea', 'th_hinmei64', '品名64',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,64)'));
        $this->addElement('text', 'th_su64',  '数64',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha64',  '手配者64',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha63','tehaisha64')"));
        $this->addElement('text', 'kakunin64',  '確認者64',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou64',  '会備考64',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del64',  'TH削除64',  '&nbsp;', 'del64');

        $this->addElement('textarea', 'th_hinmei65', '品名65',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,65)'));
        $this->addElement('text', 'th_su65',  '数65',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha65',  '手配者65',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha64','tehaisha65')"));
        $this->addElement('text', 'kakunin65',  '確認者65',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou65',  '会備考65',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del65',  'TH削除65',  '&nbsp;', 'del65');

        $this->addElement('textarea', 'th_hinmei66', '品名66',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,66)'));
        $this->addElement('text', 'th_su66',  '数66',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha66',  '手配者66',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha65','tehaisha66')"));
        $this->addElement('text', 'kakunin66',  '確認者66',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou66',  '会備考66',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del66',  'TH削除66',  '&nbsp;', 'del66');

        $this->addElement('textarea', 'th_hinmei67', '品名67',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,67)'));
        $this->addElement('text', 'th_su67',  '数67',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha67',  '手配者67',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha66','tehaisha67')"));
        $this->addElement('text', 'kakunin67',  '確認者67',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou67',  '会備考67',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del67',  'TH削除67',  '&nbsp;', 'del67');

        $this->addElement('textarea', 'th_hinmei68', '品名68',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,68)'));
        $this->addElement('text', 'th_su68',  '数68',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha68',  '手配者68',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha67','tehaisha68')"));
        $this->addElement('text', 'kakunin68',  '確認者68',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin67','kakunin68')"));
        $this->addElement('text', 'th_bikou68',  '会備考68',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del68',  'TH削除68',  '&nbsp;', 'del68');

        $this->addElement('textarea', 'th_hinmei69', '品名69',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,69)'));
        $this->addElement('text', 'th_su69',  '数69',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha69',  '手配者69',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha68','tehaisha69')"));
        $this->addElement('text', 'kakunin69',  '確認者69',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin68','kakunin69')"));
        $this->addElement('text', 'th_bikou69',  '会備考69',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del69',  'TH削除69',  '&nbsp;', 'del69');

        $this->addElement('textarea', 'th_hinmei70', '品名70',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,70)'));
        $this->addElement('text', 'th_su70',  '数70',   array('size'=>4, 'maxlength'=>6));
        $this->addElement('text', 'tehaisha70',  '手配者70',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha69','tehaisha70')"));
        $this->addElement('text', 'kakunin70',  '確認者70',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin69','kakunin70')"));
        $this->addElement('text', 'th_bikou70',  '会備考70',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del70',  'TH削除70',  '&nbsp;', 'del70');

        $this->addElement('textarea', 'th_hinmei71', '品名71',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,71)'));
        $this->addElement('text', 'th_su71',  '数71',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha71',  '手配者71',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha70','tehaisha71')"));
        $this->addElement('text', 'kakunin71',  '確認者71',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin70','kakunin71')"));
        $this->addElement('text', 'th_bikou71',  '会備考71',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del71',  'TH削除71',  '&nbsp;', 'del71');

        $this->addElement('textarea', 'th_hinmei72', '品名72',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,72)'));
        $this->addElement('text', 'th_su72',  '数72',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha72',  '手配者72',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha71','tehaisha72')"));
        $this->addElement('text', 'kakunin72',  '確認者72',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin71','kakunin72')"));
        $this->addElement('text', 'th_bikou72',  '会備考72',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del72',  'TH削除72',  '&nbsp;', 'del72');

        $this->addElement('textarea', 'th_hinmei73', '品名73',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,73)'));
        $this->addElement('text', 'th_su73',  '数73',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha73',  '手配者73',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha72','tehaisha73')"));
        $this->addElement('text', 'kakunin73',  '確認者73',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin72','kakunin73')"));
        $this->addElement('text', 'th_bikou73',  '会備考73',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del73',  'TH削除73',  '&nbsp;', 'del73');

        $this->addElement('textarea', 'th_hinmei74', '品名74',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,74)'));
        $this->addElement('text', 'th_su74',  '数74',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha74',  '手配者74',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha73','tehaisha74')"));
        $this->addElement('text', 'kakunin74',  '確認者74',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin73','kakunin74')"));
        $this->addElement('text', 'th_bikou74',  '会備考74',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del74',  'TH削除74',  '&nbsp;', 'del74');

        $this->addElement('textarea', 'th_hinmei75', '品名75',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,75)'));
        $this->addElement('text', 'th_su75',  '数75',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha75',  '手配者75',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha74','tehaisha75')"));
        $this->addElement('text', 'kakunin75',  '確認者75',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'kakunin74','kakunin75')"));
        $this->addElement('text', 'th_bikou75',  '会備考75',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del75',  'TH削除75',  '&nbsp;', 'del75');

        $this->addElement('textarea', 'th_hinmei76', '品名76',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,76)'));
        $this->addElement('text', 'th_su76',  '数76',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha76',  '手配者76',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha75','tehaisha76')"));
        $this->addElement('text', 'kakunin76',  '確認者76',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou76',  '会備考76',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del76',  'TH削除76',  '&nbsp;', 'del76');

        $this->addElement('textarea', 'th_hinmei77', '品名77',   array("cols"=>18, "rows"=>1,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,77)'));
        $this->addElement('text', 'th_su77',  '数77',   array('size'=>4, 'maxlength'=>6,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tehaisha77',  '手配者77',   array('size'=>10, 'maxlength'=>24,'ondblclick'=>"doCopy(this.form,'tehaisha76','tehaisha77')"));
        $this->addElement('text', 'kakunin77',  '確認者77',   array('size'=>10, 'maxlength'=>24));
        $this->addElement('text', 'th_bikou77',  '会備考77',  array('size'=>52, 'maxlength'=>60));
        $this->addElement('checkbox',   'th_del77',  'TH削除77',  '&nbsp;', 'del77');
    }

    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
        //使用PC
//        $this->addRule('pc_use', '必須項目です',         'required');
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
