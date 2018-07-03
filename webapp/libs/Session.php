<?php
/**
 * Maple 3.1.0 のセッションクラスを使用しています。
 * 少し Method を追加したりしてます。
 *
 * @see http://kunit.jp/maple/
 */
class Session {

    /**
     * コンストラクター
     *
     * @access  public
     */
    function Session()
    {
    }

    /**
     * 設定されている値を返却
     *
     * @param   string  $key    パラメータ名
     * @return  string  パラメータの値
     * @access  public
     */
    function getParameter($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * 設定されている値を返却(オブジェクトを返却)
     *
     * @param   string  $key    パラメータ名
     * @return  Object  パラメータの値
     * @access  public
     */
    function &getParameterRef($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * 値をセット
     *
     * @param   string  $key    パラメータ名
     * @param   string  $value  パラメータの値
     * @access  public
     */
    function setParameter($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * 値をセット(オブジェクトをセット)
     *
     * @param   string  $key    パラメータ名
     * @param   Object  $value  パラメータの値
     * @access  public
     */
    function setParameterRef($key, &$value)
    {
        $_SESSION[$key] =& $value;
    }

    /**
     * 値を返却(配列で返却)
     *
     * @param   string  $key    パラメータ名
     * @return  string  パラメータの値(配列)
     * @access  public
     */
    function getParameters()
    {
        if (isset($_SESSION)) {
            return $_SESSION;
        }
    }

    /**
     * 値を削除する
     *
     * @param   string  $key    パラメータ名
     * @access  public
     */
    function removeParameter($key)
    {
        unset($_SESSION[$key]);
    }


    /**
     * 値を全て削除する
     *
     * @author  Hiromichi HARUNA
     * @access  public
     */
    function removeParameters()
    {
        unset($_SESSION);
    }


    /**
     * セッション処理を開始
     *
     * @access  public
     */
    function start()
    {
        @session_start();
    }

    /**
     * セッション処理を終了
     *
     * @access  public
     */
    function close()
    {
        $_SESSION = array();
        session_destroy();
    }

    /**
     * セッション名を返却
     *
     * @return  string  セッション名
     * @access  public
     */
    function getName()
    {
        return session_name();
    }

    /**
     * セッション名をセット
     *
     * @param   string  $name   セッション名
     * @access  public
     */
    function setName($name = '')
    {
        if ($name) {
            session_name($name);
        }
    }

    /**
     * セッションIDを返却
     *
     * @return  string  セッションID
     * @access  public
     */
    function getID()
    {
        return session_id();
    }

    /**
     * セッションIDをセット
     *
     * @param   string  $id セッションID
     * @access  public
     */
    function setID($id = '')
    {
        if ($id) {
            session_id($id);
        }
    }

    /**
     * save_pathをセット
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
     * cache_limiterをセット
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
     * cache_expireをセット
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
     * use_cookies をセット
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
     * cookie_lifetime をセット
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
     * cookie_path をセット
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
     * cookie_domain をセット
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
     * cookie_secure をセット(SSL利用時などにsecure属性を設定する)
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
