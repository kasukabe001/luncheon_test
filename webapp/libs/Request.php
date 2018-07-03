<?php
/**
 * Maple 3.1.0 �Υꥯ�����ȥ��饹����Ѥ��Ƥ��ޤ���
 * ���� Method ���ɲä����ꡢ$_POST, $_GET �ǤϤʤ� $_REQUEST ���������褦�ˤ��Ƥ��ޤ���
 *
 * @see http://kunit.jp/maple/
 */
class Request {

    /**
     * @var POT/GET�Ǽ�����ä��ͤ��ݻ�����
     *
     * @access  private
     */
    var $_params;

    /**
     * ���󥹥ȥ饯����
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
     * REQUEST_METHOD���ͤ��ֵ�
     *
     * @return  string  REQUEST_METHOD����
     * @access  public
     */
    function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * POST/GET���ͤ��ֵ�
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  string  �ѥ�᡼������
     * @access  public
     */
    function getParameter($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }
    }

    /**
     * POST/GET���ͤ��ֵ�(���֥������Ȥ��ֵ�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  Object  �ѥ�᡼������
     * @access  public
     */
    function &getParameterRef($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }
    }

    /**
     * POST/GET���ͤ򥻥å�
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @param   string  $value  �ѥ�᡼������
     * @access  public
     */
    function setParameter($key, $value)
    {
        $this->_params[$key] = $value;
    }

    /**
     * POST/GET���ͤ򥻥å�(���֥������Ȥ򥻥å�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @param   Object  $value  �ѥ�᡼������
     * @access  public
     */
    function setParameterRef($key, &$value)
    {
        $this->_params[$key] =& $value;
    }

    /**
     * POST/GET���ͤ��ֵ�(������ֵ�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  string  �ѥ�᡼������(����)
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
      // �̾�Υꥯ�����ȥѥ�᡼����Ʊ�ͤ˰�����褦��
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
