<?php
/**
 * Maple 3.1.0 のリクエストクラスを使用しています。
 * 少し Method を追加したり、$_POST, $_GET ではなく $_REQUEST を取得するようにしています。
 *
 * @see http://kunit.jp/maple/
 */
class Request {

    /**
     * @var POT/GETで受け取った値を保持する
     *
     * @access  private
     */
    var $_params;

    /**
     * コンストラクター
     *
     * @access  public
     */
    function Request()
    {
/*
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request = $_POST;
        } else {
            $request = $_GET;
        }
*/
        $request = $_REQUEST;

        if (get_magic_quotes_gpc()) {
            foreach ($request as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $value[$subKey] = stripslashes($subValue);
                    }
                } else {
                    $value = stripslashes($value);
                }

                $request[$key] = $value;
            }
        }

        if (!ini_get("mbstring.encoding_translation") &&
            (_CHARSET_ != _INTERNAL_CODE_)) {
             mb_convert_variables(_INTERNAL_CODE_, _CHARSET_, $request);
        }

        $this->_params = $request;
    }

    /**
     * REQUEST_METHODの値を返却
     *
     * @return  string  REQUEST_METHODの値
     * @access  public
     */
    function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * POST/GETの値を返却
     *
     * @param   string  $key    パラメータ名
     * @return  string  パラメータの値
     * @access  public
     */
    function getParameter($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }
    }

    /**
     * POST/GETの値を返却(オブジェクトを返却)
     *
     * @param   string  $key    パラメータ名
     * @return  Object  パラメータの値
     * @access  public
     */
    function &getParameterRef($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }
    }

    /**
     * POST/GETの値をセット
     *
     * @param   string  $key    パラメータ名
     * @param   string  $value  パラメータの値
     * @access  public
     */
    function setParameter($key, $value)
    {
        $this->_params[$key] = $value;
    }

    /**
     * POST/GETの値をセット(オブジェクトをセット)
     *
     * @param   string  $key    パラメータ名
     * @param   Object  $value  パラメータの値
     * @access  public
     */
    function setParameterRef($key, &$value)
    {
        $this->_params[$key] =& $value;
    }

    /**
     * POST/GETの値を返却(配列で返却)
     *
     * @param   string  $key    パラメータ名
     * @return  string  パラメータの値(配列)
     * @access  public
     */
    function getParameters()
    {
        return $this->_params;
    }

/*
    var $params = array();
    var $title  = "";

    function Request()
    {
      // 通常のリクエストパラメータも同様に扱えるように
      if ( is_array($_REQUEST) ) {
        foreach( $_REQUEST as $name => $value ) {
           $this->setParameter($name, $value);
        }
      }
    }

    function setParameter($name, $value)
    {
        $this->params[$name] = $value;
    }

    function getParameter($name)
    {
        return $this->params[$name];
    }


    function getParameters()
    {
        return $this->params;
    }


    function setTitle($title)
    {
      $this->title = $title;
    }


    function getTitle()
    {
      return $this->title;
    }
*/

}

?>
