<?php

require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php';

class TantouForm extends AppQuickForm
{
    //Constructor
    function TantouForm($arg)
    {
        parent::AppQuickForm($arg);
    }



    function buildFormValues()
    {
    // 管理項目
	$this->addElement('hidden', 'last_update0','lch最終更新日0');
/* ***********************************
   基本情報
*********************************** */

	// astellas本社
        $this->addElement('text', 'lch_corp0', 'as社名',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip0', 'as〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr0', 'as住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel0', 'as_TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax0', 'as_FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile0', 'as携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email0', 'as_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man0', 'as担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// copro1
        $this->addElement('text', 'lch_corp1', 'copro1社名',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip1', 'copro1〒',array('size'=>9, 'maxlength'=>8));
        $this->addElement('text', 'lch_addr1', 'copro1住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel1', 'copro1_TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax1', 'copro1_FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile1', 'copro1携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email1', 'copro1_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man1', 'copro1担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// copro2
        $this->addElement('text', 'lch_corp2', 'copro2社名',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip2', 'copro2〒',array('size'=>9, 'maxlength'=>8));
        $this->addElement('text', 'lch_addr2', 'copro2住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel2', 'copro2_TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax2', 'copro2_FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile2', 'copro2携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email2', 'copro2_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man2', 'copro2担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// CL
        $this->addElement('text', 'lch_corp3', 'CL社名',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip3', 'CL〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr3', 'CL住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel3', 'CL_TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax3', 'CL_FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile3', 'CL携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email3', 'CL_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man3', 'CL担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// 学会事務局
        $this->addElement('text', 'lch_corp4', '学会事務局',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip4', '事務局〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr4', '事務局住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel4', '事務局TEL',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_fax4', '事務局FAX',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_mobile4', '事務局携帯',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
//        $this->addElement('text', 'lch_email4', '事務局email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man4', '事務局担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// 会場
        $this->addElement('text', 'lch_corp5', '会場業者',array('size'=>92, 'maxlength'=>100));
        $this->addElement('text', 'lch_zip5', '会場〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr5', '会場住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel5', '会場TEL',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_fax5', '会場FAX',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_mobile5', '会場携帯',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
//      $this->addElement('text', 'lch_email5', '会場email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man5', '会場担当者',array('size'=>32, 'maxlength'=>36,'style'=>'ime-mode:active'));

	// アンケート業者
        $this->addElement('text', 'lch_corp6', 'anq業者',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip6', 'anq〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr6', 'anq住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel6', 'anq_TEL',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_fax6', 'anq_FAX',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_mobile6', 'anq携帯',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
//      $this->addElement('text', 'lch_email6', 'anq_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man6', 'anq担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// 収録
        $this->addElement('text', 'lch_corp7', 'rec業者',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip7', 'rec〒',array('size'=>9, 'maxlength'=>8,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_addr7', 'rec住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel7', 'rec_TEL',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_fax7', 'rec_FAX',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
        $this->addElement('text', 'lch_mobile7', 'rec携帯',array('size'=>18, 'maxlength'=>20,'style'=>'ime-mode:inactive'));
//      $this->addElement('text', 'lch_email7', 'rec_email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man7', 'rec担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// 予備1
        $this->addElement('text', 'lch_corp8', '予備1業者',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip8', '予備1〒',array('size'=>9, 'maxlength'=>8));
        $this->addElement('text', 'lch_addr8', '予備1住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel8', '予備1TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax8', '予備1FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile8', '予備1携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email8', '予備1email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man8', '予備1担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));

	// 予備2
        $this->addElement('text', 'lch_corp9', '予備2業者',array('size'=>92, 'maxlength'=>100, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_zip9', '予備2〒',array('size'=>9, 'maxlength'=>8));
        $this->addElement('text', 'lch_addr9', '予備2住所',array('size'=>92, 'maxlength'=>120, 'style'=>'ime-mode:active'));
        $this->addElement('text', 'lch_tel9', '予備2TEL',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_fax9', '予備2FAX',array('size'=>18, 'maxlength'=>20));
        $this->addElement('text', 'lch_mobile9', '予備2携帯',array('size'=>18, 'maxlength'=>20));
//      $this->addElement('text', 'lch_email9', '予備2email',array('size'=>40, 'maxlength'=>52));
        $this->addElement('text', 'lch_man9', '予備2担当者',array('size'=>32, 'maxlength'=>36, 'style'=>'ime-mode:active'));
    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
    }

}
?>
