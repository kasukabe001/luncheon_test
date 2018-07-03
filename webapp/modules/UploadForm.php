<?php
require_once _LIB_DIR_ . 'AppQuickForm.php';
require_once 'HTML/QuickForm/Renderer/ArraySmarty.php';

class UploadForm extends AppQuickForm
{
    //Constructor
    function UploadForm($arg)
    {
        parent::AppQuickForm($arg);
    }


    function buildFormValues()
    {
        //hidden要素

        // Study Group
        $aryRemark = array();
        $aryRemark[] = $this->createElement('radio', null, $GLOBALS['FILEKIND'][0], $GLOBALS['FILEKIND'][0] , $GLOBALS['FILEKIND'][0], array('id'=>'sg_flg0'));
        $aryRemark[] = $this->createElement('radio', null, $GLOBALS['FILEKIND'][1], $GLOBALS['FILEKIND'][1] , $GLOBALS['FILEKIND'][1], array('id'=>'sg_flg1'));
        $aryRemark[] = $this->createElement('radio', null, $GLOBALS['FILEKIND'][2], $GLOBALS['FILEKIND'][2] , $GLOBALS['FILEKIND'][2], array('id'=>'sg_flg2'));
        $aryRemark[] = $this->createElement('radio', null, $GLOBALS['FILEKIND'][3], $GLOBALS['FILEKIND'][3] , $GLOBALS['FILEKIND'][3], array('id'=>'sg_flg3'));
        $aryRemark[] = $this->createElement('radio', null, $GLOBALS['FILEKIND'][4], $GLOBALS['FILEKIND'][4] , $GLOBALS['FILEKIND'][4],array('id'=>'sg_flg4'));
        $this->addGroup($aryRemark, 'remark', 'File remark', "<br />");

        $this->addElement('file',     'org_filename',       'File name', array('size'=>40));

    }



    /**
     * フォームで検証する項目
     */
    function buildFormRules($kind=null)
    {
      if (is_null($kind)) {
        $this->addRule('remark', '種類が選択されていません.',         'required');
      }
        $this->addRule('org_filename', 'ファイルを指定してください.', 'uploadedfile');

        $this->registerRule('extension','callback', '_extensionCheck', get_class($this));
        $this->registerRule('filename', 'callback', '_fileLength', get_class($this));
        $this->registerRule('kaijioudaku', 'callback', '_fileNumKaiji', get_class($this));


// 動作確認済みだが, 2007以降のmimetypeの検出が困難
//	$this->addRule("org_filename", "You can submit these file ( doc,docx,pdf ).","mimetype", array("application/pdf", "application/msword", "application/excel", "application/vnd.ms-excel","application/zip","application/x-zip", "text/plain"));

      if (is_null($kind)) {
	$this->addRule('org_filename', 'ファイルサイズは3MBまでです', 'maxfilesize', 3000000);
      } else {
	$this->addRule('org_filename', 'Cannot exceed 1M bytes', 'maxfilesize', 1000000);
      }
        $this->addRule('org_filename', 'You can submit these file ( doc,docx,pdf ).',   'extension');
        $this->addRule('org_filename', 'File name is too long.(within 60 letters).',   'filename');

	$remark=$this->getElementValue('remark');
      if ($kind == "DENPYO") {$remark = "伝票";}
        if ($remark == "開示承諾書" || $remark == "応諾書" || $remark == "伝票") {
	    $this->addRule('remark', $remark . 'は10個アップされています','kaijioudaku');
	}


/*
// ディレクトリの存在チェック
$dir=$UPLOAD_FILE_PATH . sprintf("%04d", $semi_id);
if(!is_dir($dir)) {
	$Error .= "<LI>アップロード用ディレクトリがありません";
}
*/

    }


    function buildFormFilters()
    {
        $this->applyFilter('__ALL__', 'trim');
        $this->applyFilter('__ALL__', 'pg_escape_string');
        $this->applyFilter('__ALL__', 'htmlspecialchars');
	
    }



   // 拡張子のチェック
   function _extensionCheck($ary) {
	$str_d = substr($ary['name'], -4);
	$str_1 = substr($str_d, 0,1);

	if ($str_1 == ".") $ext = substr($str_d, -3);
	 else $ext = $str_d;

	// pdf doc docx 以外は false を返す
	if (preg_match('/(pdf|doc|docx)/i', $ext)) {
	    return true;
	} else {
	    return false;
	}
   }



   // ファイルの長さをチェックする
   function _fileLength($ary) {
	$chk_len = mb_strlen($ary['name']);

	// 48を超えたら false を返す
	if ($chk_len > 64) {
	    return false;
	} else {
	    return true;
	}
   }



   // 開示承諾書の数をチェックする
   function _fileNumKaiji($remark) {

	$snum = $_SESSION['semi_id'];
	// $this->session->getParameter('semi_id') は使えない

        $updbh =& new UploadDAO();
        $ary=$updbh->getFileNum($snum);

	if ($remark == "開示承諾書") {
	    if ( $ary['kaiji'] >= 10) {
		return false;
	    } else {
		return true;
	    }
	}
	if ($remark == "応諾書") {
	    if ( $ary['oudaku'] >= 10) {
		return false;
	    } else {
		return true;
	    }
	}
	if ($remark == "伝票") {
	    if ( $ary['denpyo'] >= 10) {
		return false;
	    } else {
		return true;
	    }
	}

   }


}
?>
