<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class ScheduleForm extends AppQuickForm
{
    //Constructor
    function ScheduleForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
	$this->addElement('hidden', 'last_date', '最終更新日');

        //スケジュール
        $this->addElement('textarea', 'schedule', 'スケジュール',   array("cols"=>70, "rows"=>6,'style'=>'ime-mode:active;'));

        // 講演会情報
        $this->addElement('textarea', 'kouenkai', '講演会情報',   array("cols"=>70, "rows"=>6,'style'=>'ime-mode:active;'));

        // コレポン
//        $this->addElement('textarea', 'corepon', 'コレポン',   array("cols"=>70, "rows"=>10,'style'=>'ime-mode:active;'));

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
	//搬送方法1',
//      $this->addRule('hansou1', '必須項目です',         'required');
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
