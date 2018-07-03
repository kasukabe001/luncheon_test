<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class ListForm extends AppQuickForm
{
    //Constructor
    function ListForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {

        $this->addElement('text', 'chair1', '座長1',array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cyaku1', '座長役職1',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,14)'));
        $this->addElement('hidden', 'zacs_id1', 'zacs_id1');
        $this->addElement('text', 'chair2', '座長2',array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cyaku2', '座長役職1',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,15)'));
        $this->addElement('hidden', 'zacs_id2', 'zacs_id2');

        $this->addElement('text', 'enshaname1', '演者1',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku1', '演者1役職',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,17)'));
        $this->addElement('text', 'endai1', '演題1',array('size'=>80, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id1', 'encs_id1');

        $this->addElement('text', 'enshaname2', '演者2',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku2', '演者2役職',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,18)'));
        $this->addElement('text', 'endai2', '演題2',array('size'=>80, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id2', 'encs_id2');

        $this->addElement('text', 'enshaname3', '演者3',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku3', '演者3役職',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,19)'));
        $this->addElement('text', 'endai3', '演題3',array('size'=>80, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id3', 'encs_id3');

        $this->addElement('text', 'enshaname4', '演者4',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku4', '演者4役職',array('size'=>60, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,20)'));
        $this->addElement('text', 'endai4', '演題4',array('size'=>80, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id4', 'encs_id4');

        $this->addElement('hidden', 'nendo', 2011);

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
	//搬送方法1',
//      $this->addRule('R3', '必須項目です',         'required');

    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
