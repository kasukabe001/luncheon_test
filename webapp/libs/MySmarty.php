<?php
require_once _SMARTY_DIR_ . 'Smarty.class.php';

class MySmarty extends Smarty {

    function MySmarty ()
    {
        $this->Smarty();

        $this->template_dir = _SMARTY_TEMPLATE_DIR_;
        $this->compile_dir  = _SMARTY_COMPILE_DIR_;

        $this->plugins_dir  = array("plugins", _LIB_DIR_ . "SmartyPlugins");
        //$this->default_modifiers = array('escape:"html"');
        //$this->config_dir   = _LIB_DIR_."SmartyConfigs";

        $this->register_modifier('number_format', 'number_format');
        $this->register_modifier('stripslashes',  'stripslashes');

        if (is_dir(_SMARTY_COMPILE_DIR_) === false) {
            mkdir(_SMARTY_COMPILE_DIR_, 0755);
        }

        if (is_dir($this->compile_dir) === false) {
            mkdir($this->compile_dir, 0755);
        }

    }

}
?>
