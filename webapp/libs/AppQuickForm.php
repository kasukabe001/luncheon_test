<?php

// INCLUDE HTML QuickForm
require_once 'HTML/QuickForm.php';
require_once 'HTML/QuickForm/Rule/Range.php';

/**
 * ActionForm
 *
 */
class AppQuickForm extends HTML_QuickForm
{
    function AppQuickForm()
    {
        parent::HTML_QuickForm();

        $rules = $GLOBALS['_HTML_QuickForm_registered_rules'];
        $rules['maxlength']   = array('html_quickform_rule_multibyte_range', __FILE__);
        $rules['minlength']   = array('html_quickform_rule_multibyte_range', __FILE__);
        $rules['rangelength'] = array('html_quickform_rule_multibyte_range', __FILE__);
        $GLOBALS['_HTML_QuickForm_registered_rules'] = $rules;
    }

    /**
     * 入力値が渡された語数を超えているかチェック
     *
     * @param  string  $words
     * @param  integer $num 語数
     * @return bool
     */
    function _ruleOverWords($words, $num)
    {
        // split text by ' ',\r,\n,\f,\t
        $split_array = preg_split('/\s+/', $words);

        // count matches that contain alphanumerics
        $word_count = preg_grep('/[a-zA-Z0-9\\x80-\\xff]/', $split_array);

        if (count($word_count) > $num) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * ルール追加(文字数チェックに変更)
 */
class HTML_QuickForm_Rule_Multibyte_Range extends HTML_QuickForm_Rule_Range
{
    /**
     * Validates a value using a range comparison
     *
     * @param     string    $value      Value to be checked
     * @param     mixed     $options    Int for length, array for range
     * @access    public
     * @return    boolean   true if value is valid
     */
    function validate($value, $options)
    {
        $length = mb_strlen($value);
        switch ($this->name) {
            case 'minlength': return ($length >= $options);
            case 'maxlength': return ($length <= $options);
            default:          return ($length >= $options[0] && $length <= $options[1]);
        }
    } // end func validate
}

?>