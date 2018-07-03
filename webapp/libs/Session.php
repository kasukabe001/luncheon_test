<?php
/**
 * Maple 3.1.0 �Υ��å���󥯥饹����Ѥ��Ƥ��ޤ���
 * ���� Method ���ɲä����ꤷ�Ƥޤ���
 *
 * @see http://kunit.jp/maple/
 */
class Session {

    /**
     * ���󥹥ȥ饯����
     *
     * @access  public
     */
    function Session()
    {
    }

    /**
     * ���ꤵ��Ƥ����ͤ��ֵ�
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  string  �ѥ�᡼������
     * @access  public
     */
    function getParameter($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * ���ꤵ��Ƥ����ͤ��ֵ�(���֥������Ȥ��ֵ�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  Object  �ѥ�᡼������
     * @access  public
     */
    function &getParameterRef($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * �ͤ򥻥å�
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @param   string  $value  �ѥ�᡼������
     * @access  public
     */
    function setParameter($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * �ͤ򥻥å�(���֥������Ȥ򥻥å�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @param   Object  $value  �ѥ�᡼������
     * @access  public
     */
    function setParameterRef($key, &$value)
    {
        $_SESSION[$key] =& $value;
    }

    /**
     * �ͤ��ֵ�(������ֵ�)
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @return  string  �ѥ�᡼������(����)
     * @access  public
     */
    function getParameters()
    {
        if (isset($_SESSION)) {
            return $_SESSION;
        }
    }

    /**
     * �ͤ�������
     *
     * @param   string  $key    �ѥ�᡼��̾
     * @access  public
     */
    function removeParameter($key)
    {
        unset($_SESSION[$key]);
    }


    /**
     * �ͤ����ƺ������
     *
     * @author  Hiromichi HARUNA
     * @access  public
     */
    function removeParameters()
    {
        unset($_SESSION);
    }


    /**
     * ���å��������򳫻�
     *
     * @access  public
     */
    function start()
    {
        @session_start();
    }

    /**
     * ���å���������λ
     *
     * @access  public
     */
    function close()
    {
        $_SESSION = array();
        session_destroy();
    }

    /**
     * ���å����̾���ֵ�
     *
     * @return  string  ���å����̾
     * @access  public
     */
    function getName()
    {
        return session_name();
    }

    /**
     * ���å����̾�򥻥å�
     *
     * @param   string  $name   ���å����̾
     * @access  public
     */
    function setName($name = '')
    {
        if ($name) {
            session_name($name);
        }
    }

    /**
     * ���å����ID���ֵ�
     *
     * @return  string  ���å����ID
     * @access  public
     */
    function getID()
    {
        return session_id();
    }

    /**
     * ���å����ID�򥻥å�
     *
     * @param   string  $id ���å����ID
     * @access  public
     */
    function setID($id = '')
    {
        if ($id) {
            session_id($id);
        }
    }

    /**
     * save_path�򥻥å�
     *
     * @param   string  $savePath   save_path
     * @access  public
     */
    function setSavePath($savePath)
    {
        if (!isset($savePath)) {
            return;
        }
        session_save_path($savePath);
    }

    /**
     * cache_limiter�򥻥å�
     *
     * @param   string  $cacheLimiter   cache_limiter
     * @access  public
     */
    function setCacheLimiter($cacheLimiter)
    {
        if (!isset($cacheLimiter)) {
            return;
        }
        session_cache_limiter($cacheLimiter);
    }

    /**
     * cache_expire�򥻥å�
     *
     * @param   string  $cacheExpire    cache_expire
     * @access  public
     */
    function setCacheExpire($cacheExpire)
    {
        if (!isset($cacheExpire)) {
            return;
        }
        session_cache_expire($cacheExpire);
    }

    /**
     * use_cookies �򥻥å�
     *
     * @param   string  $useCookies use_cookies
     * @access  public
     */
    function setUseCookies($useCookies)
    {
        if (!isset($useCookies)) {
            return;
        }
        ini_set('session.use_cookies', $useCookies ? 1 : 0);
    }

    /**
     * cookie_lifetime �򥻥å�
     *
     * @param   string  $cookieLifetime cookie_lifetime
     * @access  public
     */
    function setCookieLifetime($cookieLifetime)
    {
        if (!isset($cookieLifetime)) {
            return;
        }

        $cookie_params = session_get_cookie_params();
        session_set_cookie_params($cookieLifetime, $cookie_params['path'], $cookie_params['domain'], $cookie_params['secure']);
    }

    /**
     * cookie_path �򥻥å�
     *
     * @param   string  $cookiePath cookie_path
     * @access  public
     */
    function setCookiePath($cookiePath)
    {
        if (!isset($cookiePath)) {
            return;
        }

        $cookie_params = session_get_cookie_params();
        session_set_cookie_params($cookie_params['lifetime'], $cookiePath, $cookie_params['domain'], $cookie_params['secure']);
    }

    /**
     * cookie_domain �򥻥å�
     *
     * @param   string  $cookieDomain   cookie_domain
     * @access  public
     */
    function setCookieDomain($cookieDomain)
    {
        if (!isset($cookieDomain)) {
            return;
        }

        $cookie_params = session_get_cookie_params();
        session_set_cookie_params($cookie_params['lifetime'], $cookie_params['path'], $cookieDomain, $cookie_params['secure']);
    }

    /**
     * cookie_secure �򥻥å�(SSL���ѻ��ʤɤ�secure°�������ꤹ��)
     *
     * @param   string  $cookieSecure   cookie_secure
     * @access  public
     */
    function setCookieSecure($cookieSecure)
    {
        if (!isset($cookieSecure)) {
            return;
        }

        if (preg_match('/^true$/i', $cookieSecure) ||
            preg_match('/^secure$/i', $cookieSecure) ||
            preg_match('/^on$/i', $cookieSecure) ||
            ($cookieSecure === '1') || ($cookieSecure === 1)) {
            $cookieSecure = true;
        } else {
            $cookieSecure = false;
        }

        $cookie_params = session_get_cookie_params();
        session_set_cookie_params($cookie_params['lifetime'], $cookie_params['path'], $cookie_params['domain'], $cookieSecure);
    }

/*
    function Session()
    {

    }

    function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    function getSession($name)
    {
        return $_SESSION[$name];
    }

    function getSessions()
    {
        return $_SESSION;
    }
*/

}
?>
