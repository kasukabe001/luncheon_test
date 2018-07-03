<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php';

class InfoForm extends AppQuickForm
{
    //Constructor
    function InfoForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues($enshaNum=null)
    {
//	$this->addElement('hidden', 'last_date', '最終更新日');
        $this->addElement('text', 'last_date', '最終更新日', array('size'=>58, 'maxlength'=>58));

/* ***********************************
   基本情報
*********************************** */

        $this->addElement('text', 'gakkai', '学会名', array('size'=>92, 'maxlength'=>100,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'kaisaibi', '開催日', array('size'=>58, 'maxlength'=>58));
        $this->addElement('text', 'kaisaiji', '開催時', array('size'=>58, 'maxlength'=>58));
        $this->addElement('text', 'hinmoku', '品目', array('size'=>24, 'maxlength'=>24));
        $this->addElement('text', 'nendo', '年度', array('size'=>24, 'maxlength'=>24));
        $this->addElement('text', 'seminar', 'セミナー名', array('size'=>30, 'maxlength'=>60,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'ryoiki', '領域', array('size'=>20, 'maxlength'=>36));
        $this->addElement('text', 'kaiki', '会期', array('size'=>58, 'maxlength'=>58));

        $this->addElement('text', 'place', '会場', array('size'=>92, 'maxlength'=>100));
        $this->addElement('text', 'syukan', '共催', array('size'=>40, 'maxlength'=>48));
        $this->addElement('text', 'syukan2', '第二共催', array('size'=>40, 'maxlength'=>48));
        $this->addElement('text', 'zaseki', '座席数', array('size'=>20, 'maxlength'=>24));

        $this->addElement('text', 'yobi2', 'URL', array('size'=>67, 'maxlength'=>100));
        $this->addElement('text', 'thema', 'テーマ', array('size'=>90, 'maxlength'=>80,'style'=>'ime-mode:active;'));

        $this->addElement('text', 'chair1', '座長1',array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'cyaku1', '座長役職1',array('size'=>60, 'maxlength'=>80));
        $this->addElement('text', 'chair2', '座長2',array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'cyaku2', '座長役職1',array('size'=>60, 'maxlength'=>80));
        $this->addElement('text', 'chair3', '座長3',array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'cyaku3', '座長役職3',array('size'=>60, 'maxlength'=>80));

        $this->addElement('text', 'enshaname1', '演者1',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku1', '演者1役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai1', '演題1',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname2', '演者2',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku2', '演者2役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai2', '演題2',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname3', '演者3',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku3', '演者3役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai3', '演題3',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname4', '演者4',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku4', '演者4役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai4', '演題4',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname5', '演者5',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku5', '演者5役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai5', '演題5',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname6', '演者6',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku6', '演者6役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai6', '演題6',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname7', '演者7',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku7', '演者7役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai7', '演題7',array('size'=>80, 'maxlength'=>160));

        $this->addElement('text', 'enshaname8', '演者8',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku8', '演者8役職',array('size'=>60, 'maxlength'=>100));
        $this->addElement('text', 'endai8', '演題8',array('size'=>80, 'maxlength'=>160));

	// 学会事務局
        $this->addElement('text', 'sekinin', 'Astellas責任者', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cltantou', 'ＣＬ窓口', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:active;'));

        $this->addElement('text', 'hotel', '学会参加見込人数',array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'yobi1', '学会会員数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'yobi4', '総セミナー数', array('size'=>20, 'maxlength'=>24));

	// アンケート業者
	$aryAnq = array();
        $aryAnq[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'anq0'));
        $aryAnq[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'anq1'));
        $this->addGroup($aryAnq, 'anquete', 'アンケート有無', "&nbsp;&nbsp;");
	// 収録
	$aryKiroku = array();
        $aryKiroku[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'syur0'));
        $aryKiroku[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'syur1'));
        $this->addGroup($aryKiroku, 'syuroku', '収録有無', "&nbsp;&nbsp;");

        $this->addElement('text', 'status', '年度', array('size'=>24, 'maxlength'=>24));


/* ***********************************
   進捗情報
*********************************** */
$this->addElement('text', 'amail', '案内メールAPI', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

        $this->addElement('text', 'annai2', '案内状送付CL', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

$this->addElement('text', 'tirasi1', 'チラシ作成依頼', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
$this->addElement('text', 'tirasi2', 'チラシ経過・完成', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
$this->addElement('text', 'tirasi3', 'チラシ納品日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));

        $this->addElement('text', 'mousi_c', '追加申込締切', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'syoroku', '抄録締', array('size'=>20, 'maxlength'=>36));

        $this->addElement('text', 'hikae_k', '控室名', array('size'=>20, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'hikae_t', '控室使用時間', array('size'=>20, 'maxlength'=>36));
        $this->addElement('text', 'hikae_a', '控室案内', array('size'=>20, 'maxlength'=>36));

        $this->addElement('text', 'tojitu', '当日配布物手配', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'yakubun2', '分担表最終版送付', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'bento', '弁当数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'sizaisu', '資材数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'sizaino', '資材No', array('size'=>20, 'maxlength'=>24));

/* ***********************************
   開催結果
*********************************** */
        $this->addElement('text', 'report', '事後報告書', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'nyujosha', '入場者数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'an_kaisyu', 'アンケート回収者数', array('size'=>20, 'maxlength'=>24));
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
