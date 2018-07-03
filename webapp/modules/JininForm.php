<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php' ;

class JininForm extends AppQuickForm
{
    //Constructor
    function JininForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
    // 管理項目
	$this->addElement('hidden', 'ji_reg_date1','Ji最終更新日1');

        $this->addElement('text',   'ji_yakuwari1', '役割1',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,91)'));
//        $this->addElement('text',   'ji_as1',  'AS1',   array('size'=>20, 'maxlength'=>120));
        $this->addElement('textarea', 'ji_as1', 'AS1',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co11',  'コプロ1_1',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co21',  'コプロ2_1',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl1',  'CL1',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai1',  '学会1',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou1', '人員備考1',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del1',  'JI削除1',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari2', '役割2',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,92)'));
        $this->addElement('textarea', 'ji_as2', 'AS2',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co12',  'コプロ1_2',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co22',  'コプロ2_2',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl2',  'CL2',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai2',  '学会2',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou2', '人員備考2',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del2',  'JI削除2',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari3', '役割3',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,93)'));
        $this->addElement('textarea', 'ji_as3', 'AS3',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co13',  'コプロ1_3',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co23',  'コプロ2_3',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl3',  'CL3',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai3',  '学会3',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou3', '人員備考3',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del3',  'JI削除3',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari4', '役割4',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,94)'));
        $this->addElement('textarea', 'ji_as4', 'AS4',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co14',  'コプロ1_4',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co24',  'コプロ2_4',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl4',  'CL4',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai4',  '学会4',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou4', '人員備考4',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del4',  'JI削除4',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari5', '役割5',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,95)'));
        $this->addElement('textarea', 'ji_as5', 'AS5',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co15',  'コプロ1_5',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co25',  'コプロ2_5',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl5',  'CL5',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai5',  '学会5',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou5', '人員備考5',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del5',  'JI削除5',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari6', '役割6',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,96)'));
        $this->addElement('textarea', 'ji_as6', 'AS6',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co16',  'コプロ1_6',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co26',  'コプロ2_6',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl6',  'CL6',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai6',  '学会6',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou6', '人員備考6',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del6',  'JI削除6',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari7', '役割7',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,97)'));
        $this->addElement('textarea', 'ji_as7', 'AS7',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co17',  'コプロ1_7',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co27',  'コプロ2_7',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl7',  'CL7',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai7',  '学会7',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou7', '人員備考7',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del7',  'JI削除7',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari8', '役割8',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,98)'));
        $this->addElement('textarea', 'ji_as8', 'AS8',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co18',  'コプロ1_8',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co28',  'コプロ2_8',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl8',  'CL8',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai8',  '学会8',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou8', '人員備考8',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del8',  'JI削除8',  '&nbsp;', 'del1');

        $this->addElement('text',   'ji_yakuwari9', '役割9',   array('size'=>18,  'maxlength'=>24,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,99)'));
        $this->addElement('textarea', 'ji_as9', 'AS9',   array("cols"=>16, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('text',   'ji_co19',  'コプロ1_9',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_co29',  'コプロ2_9',   array('size'=>12, 'maxlength'=>48));
        $this->addElement('text',   'ji_cl9',  'CL9',   array('size'=>16, 'maxlength'=>48));
        $this->addElement('text',   'ji_gakkai9',  '学会9',   array('size'=>15, 'maxlength'=>48));
        $this->addElement('textarea', 'ji_bikou9', '人員備考9',   array("cols"=>22, "rows"=>2,'style'=>'ime-mode:active;'));
        $this->addElement('checkbox',   'ji_del9',  'JI削除9',  '&nbsp;', 'del1');
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
