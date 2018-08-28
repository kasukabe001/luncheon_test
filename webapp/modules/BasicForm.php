<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php';

class BasicForm extends AppQuickForm
{
    //Constructor
    function BasicForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
	$this->addElement('hidden', 'last_date', '最終更新日');

/* ***********************************
   基本情報
*********************************** */

        $this->addElement('text', 'gakkai', '学会名', array('size'=>92, 'maxlength'=>100,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'kaisaibi', '開催日', array('size'=>58, 'maxlength'=>58));
        $this->addElement('text', 'kaisaiji', '開催時', array('size'=>58, 'maxlength'=>58));
        $this->addElement('text', 'hinmoku', '品目', array('size'=>24, 'maxlength'=>24));
        $this->addElement('select', 'nendo', '年度', array(""=>"▼選択") + $GLOBALS['NENDO']);
        $this->addElement('text', 'seminar', 'セミナー名', array('size'=>30, 'maxlength'=>80,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'ryoiki', '領域', array('size'=>20, 'maxlength'=>36,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialog()'));
        $this->addElement('text', 'kaiki', '会期', array('size'=>58, 'maxlength'=>58));

        $this->addElement('text', 'place', '会場', array('size'=>90, 'maxlength'=>100));
        $this->addElement('text', 'room', '部屋', array('size'=>90, 'maxlength'=>100)); // 2018
        $this->addElement('textarea', 'tokkijiko', '特記事項',  array("cols"=>62, "rows"=>2, 'style'=>'ime-mode:active;')); // 2018


        $this->addElement('text', 'syukan', '共催', array('size'=>37, 'maxlength'=>48,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,11)'));
        $this->addElement('text', 'syukan2', '第二共催', array('size'=>37, 'maxlength'=>48,'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,12)'));
        $this->addElement('text', 'zaseki', '座席数', array('size'=>20, 'maxlength'=>24));

        $this->addElement('text', 'yobi2', 'URL', array('size'=>67, 'maxlength'=>100));
        $this->addElement('text', 'thema', 'テーマ', array('size'=>90, 'maxlength'=>80,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'tokki', '特記事項', array('size'=>90, 'maxlength'=>80,'style'=>'ime-mode:active;'));

        $this->addElement('text', 'chair1', '座長1',array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cyaku1', '座長役職1',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,14)'));
        $this->addElement('hidden', 'zacs_id1', 'zacs_id1');
        $this->addElement('text', 'chair2', '座長2',array('size'=>20, 'maxlength'=>48, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cyaku2', '座長役職2',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,15)'));
        $this->addElement('hidden', 'zacs_id2', 'zacs_id2');
        $this->addElement('text', 'chair3', '座長3',array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'cyaku3', '座長役職3',array('size'=>64, 'maxlength'=>80, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,16)'));
        $this->addElement('hidden', 'zacs_id3', 'zacs_id3');
        $this->addElement('text', 'enshaname1', '演者1',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku1', '演者1役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,17)'));
        $this->addElement('text', 'endai1', '演題1',array('size'=>90, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id1', 'encs_id1');

        $this->addElement('text', 'enshaname2', '演者2',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku2', '演者2役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,18)'));
        $this->addElement('text', 'endai2', '演題2',array('size'=>90, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id2', 'encs_id2');

        $this->addElement('text', 'enshaname3', '演者3',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku3', '演者3役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,19)'));
        $this->addElement('text', 'endai3', '演題3',array('size'=>90, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id3', 'encs_id3');

        $this->addElement('text', 'enshaname4', '演者4',array('size'=>20, 'maxlength'=>48,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'enshayaku4', '演者4役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,20)'));
        $this->addElement('text', 'endai4', '演題4',array('size'=>90, 'maxlength'=>160,'style'=>'ime-mode:active;'));
        $this->addElement('hidden', 'encs_id4', 'encs_id4');

//if ($_SESSION['演者'] > 4) {
        $this->addElement('text', 'enshaname5', '演者5',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku5', '演者5役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,21)'));
        $this->addElement('text', 'endai5', '演題5',array('size'=>90, 'maxlength'=>160));
        $this->addElement('hidden', 'encs_id5', 'encs_id5');
//}
//if ($_SESSION['演者'] > 5) {
        $this->addElement('text', 'enshaname6', '演者6',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku6', '演者6役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,22)'));
        $this->addElement('text', 'endai6', '演題6',array('size'=>90, 'maxlength'=>160));
        $this->addElement('hidden', 'encs_id6', 'encs_id6');
//}
        $this->addElement('text', 'enshaname7', '演者7',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku7', '演者7役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,23)'));
        $this->addElement('text', 'endai7', '演題7',array('size'=>90, 'maxlength'=>160));
        $this->addElement('hidden', 'encs_id7', 'encs_id7');

        $this->addElement('text', 'enshaname8', '演者8',array('size'=>20, 'maxlength'=>48));
        $this->addElement('text', 'enshayaku8', '演者8役職',array('size'=>64, 'maxlength'=>100, 'style'=>'ime-mode:active;background-color:#e6e6fa;','ondblclick'=>'doDialogAll(this.form,24)'));
        $this->addElement('text', 'endai8', '演題8',array('size'=>90, 'maxlength'=>160));
        $this->addElement('hidden', 'encs_id8', 'encs_id8');

	// 学会事務局
//      $this->addElement('text', 'sec_name', '事務局業者',array('size'=>92, 'maxlength'=>100));

        $this->addElement('text', 'sekinin', 'Astellas責任者', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:active;'));
        $this->addElement('text', 'soshiki', '組織化担当', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:active;')); //2018
        $this->addElement('text', 'cltantou', 'ＣＬ窓口', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:active;'));

        $this->addElement('text', 'hotel', '学会参加見込人数',array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'yobi1', '学会会員数', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'yobi4', '総セミナー数', array('size'=>20, 'maxlength'=>24,'style'=>'ime-mode:inactive;'));

	// アンケート業者
	$aryAnq = array();
        $aryAnq[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'anq0'));
        $aryAnq[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'anq1'));
        $this->addGroup($aryAnq, 'anquete', 'アンケート有無', "&nbsp;&nbsp;");
        $this->addElement('text', 'anquete_make', 'アンケート作成日', array('size'=>20, 'maxlength'=>24)); // 2018
	// 収録
	$aryKiroku = array();
        $aryKiroku[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'syur0'));
        $aryKiroku[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'syur1'));
        $this->addGroup($aryKiroku, 'syuroku', '収録有無', "&nbsp;&nbsp;");
	// 海外演者 2018
	$aryKaigai = array();
        $aryKaigai[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'kaigai0'));
        $aryKaigai[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'kaigai1'));
        $this->addGroup($aryKaigai, 'kaigai', '海外演者', "&nbsp;&nbsp;"); // 2018

        $this->addElement('textarea', 'cl1', 'メモ1',  array("cols"=>62, "rows"=>4, 'style'=>'ime-mode:active;'));
        $this->addElement('select', 'status', '年度', array(""=>"▼選択") + $GLOBALS['STATUS']);


/* ***********************************
   進捗情報
*********************************** */
        $this->addElement('text', 'amail_yotei', '案内メールAPI予定日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;border: none;',readonly)); // 2018
        $this->addElement('text', 'amail', '案内メールAPI', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'annai2_yotei', 'MR宛mail予定日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;border: none;',readonly)); // 2018
        $this->addElement('text', 'annai2', 'MR宛mail', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'tirasi1', 'チラシ作成依頼', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'tirasi2', 'チラシ経過・完成', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'tirasi3', 'チラシ納品日', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'mousi_k', 'LS申込', array('size'=>20, 'maxlength'=>24)); // 2018復活
        $this->addElement('text', 'yoko', '趣意書入手', array('size'=>20, 'maxlength'=>24)); // 2018復活
        $this->addElement('text', 'yakuketsu_yotei', '役割者決定予定日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;border: none;',readonly)); // 2018
        $this->addElement('text', 'yakuketsu', '役割者決定', array('size'=>20, 'maxlength'=>24)); // 2018
        $this->addElement('text', 'seminar_mousi', 'セミナー申込日', array('size'=>20, 'maxlength'=>24)); // 2018
        $this->addElement('text', 'mousi_c', '追加申込締切', array('size'=>20, 'maxlength'=>24));
//        $this->addElement('text', 'sintyoku', '抄録進捗', array('size'=>20, 'maxlength'=>36));
	$arySyoroku = array();
        $arySyoroku[] = $this->createElement('radio', null, "有", "有", "有", array('id'=>'syoroku0'));
        $arySyoroku[] = $this->createElement('radio', null, "無", "無", "無", array('id'=>'syoroku1'));
        $this->addGroup($arySyoroku, 'syoroku_umu', '抄録有無', "&nbsp;&nbsp;");// 2018
        $this->addElement('text', 'syoroku_seigen', '文字制限', array('size'=>8, 'maxlength'=>20)); // 2018
        $this->addElement('text', 'syoroku_url', '演題登録ページURL', array('size'=>68, 'maxlength'=>100)); // 2018

        $this->addElement('text', 'hikae_k', '控室名', array('size'=>20, 'maxlength'=>36, 'style'=>'ime-mode:active;'));
        $this->addElement('text', 'hikae_t', '控室使用時間', array('size'=>20, 'maxlength'=>36));
        $this->addElement('text', 'hikae_a_yotei', '控室案内予定日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;border: none;',readonly)); // 2018
        $this->addElement('text', 'hikae_a', '控室案内', array('size'=>20, 'maxlength'=>36));
        $this->addElement('select', 'syoroku_status', '抄録進捗', array(""=>"") + $GLOBALS['PROGRESS_STATUS'],array('onChange'=>'this.form.syoroku.value=this.options[this.selectedIndex].text')); // 2018
        $this->addElement('text', 'syoroku', '抄録締', array('size'=>30, 'maxlength'=>36));
        $this->addElement('text', 'anquete_yotei', 'アンケート作成予定日', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;border: none;',readonly)); // 2018

        $this->addElement('text', 'tojitu', '当日配布物手配', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'sizai_order', '進捗状況', array('size'=>20, 'maxlength'=>24)); // 2018
        $this->addElement('text', 'yakubun2', '分担表最終版送付', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'bento', '弁当数', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'sizaisu', '資材数', array('size'=>20, 'maxlength'=>24, 'style'=>'ime-mode:inactive;'));
        $this->addElement('text', 'sizaino', '資材No', array('size'=>20, 'maxlength'=>24));
        $this->addElement('textarea', 'cl2', 'メモ2',  array("cols"=>62, "rows"=>4, 'style'=>'ime-mode:active;'));

// require_once _MODULE_DIR_ . 'MembersDAO.php';
$dbh =& new MembersDAO();
$sekinin_members=$dbh->getTantouMembers(0);
$soshiki_members=$dbh->getTantouMembers(1);
$cltantou_members=$dbh->getTantouMembers(2);

        $this->addElement('select', 'sekinin_menu', '製品担当選択', array(""=>"") + $sekinin_members,array('onChange'=>'this.form.sekinin.value=this.options[this.selectedIndex].text'));
        $this->addElement('select', 'soshiki_menu', '組織化担当選択', array(""=>"") + $soshiki_members,array('onChange'=>'this.form.soshiki.value=this.options[this.selectedIndex].text'));
        $this->addElement('select', 'cltantou_menu', 'CL担当選択', array(""=>"") + $cltantou_members,array('onChange'=>'this.form.cltantou.value=this.options[this.selectedIndex].text'));

/* ***********************************
   開催結果
*********************************** */
        $this->addElement('text', 'report', '事後報告書', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'nyujosha', '入場者数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('text', 'an_kaisyu', 'アンケート回収者数', array('size'=>20, 'maxlength'=>24));
        $this->addElement('textarea', 'cl3', 'メモ3',  array("cols"=>62, "rows"=>4, 'style'=>'ime-mode:active;'));

    }

    /**
     * フォームで検証する項目
     */
    function buildFormRules()
    {
	$ary = $this->getElementValue('nendo');
        if ($ary[0] <= '2011') {
            $this->addRule('chair3','2011年度以前は座長は2人までです','maxlength',0);
            $this->addRule('cyaku3','2011年度以前は座長は2人までです','maxlength',0);
            $this->addRule('enshaname5','2011年度以前は演者は4人までです','maxlength',0);
            $this->addRule('enshayaku5','2011年度以前は演者は4人までです','maxlength',0);
	}
        if ($this->getElementValue('syukan2') != '') {
            $this->addRule('syukan','共催社が一社の左の欄に入力してください','required');
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
