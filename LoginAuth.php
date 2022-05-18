<!--
    LoginAuth.php
    LoginAuthクラスの定義
    Create: 2022/03/19(Sat)
    Update: 2022/03/26(Sat)
    　　　　・パスワードの変更に伴う認証ハッシュの変更
-->
<?php

require_once( 'MyHPSessionManager.php' );

/*****************************************************
 * class: LoginAuth
 * description: ログイン認証に関わる処理を行うクラス
 *****************************************************/
class LoginAuth
{
    private $session_manager;

    public function __construct()
    {
        $this->session_manager = new MyHPSessionManager();
    }

    /***************************************************
     * method: auth
     * description: ユーザ名とパスワードが正しいか判定する
     * params: $user = ユーザ名, $password = パスワード
     * return: true = ユーザ名とパスワードが正しい
     *         false = ユーザ名かパスワードが間違っている
     *************************************************/
    public function auth( $user = "", $password = "" )
    {
        if ( $user != 'hpadmin' ) return false;
        if ( hash( 'sha256', 'hashsalt' . $password ) != '03f652b36e3cecd54577fec6ff2e556413ce68da1c319b8def7b8914bf2a65f2' ) return false;
        return true;
    }

    /************************************************************************************
     * method: login
     * description: ログイン認証処理を行い結果に応じてリダイレクトやセッション情報をセットする
     * params: $user = ユーザ名, $password = パスワード(渡されていない場合はセッション中とみなし、セッション変数から設定される)
     * return: true = ログイン成功, false = ログイン失敗
     ***********************************************************************************/
    public function login( $user = "", $password = "" )
    {
        $this->session_manager->start();
        if ( $user == "" ) $user = $this->session_manager->get( 'user' );
        if ( $password == "" ) $password = $this->session_manager->get( 'password' );

        if ( !$this->auth( $user, $password ) )
        {
            $url = "./Login.php";
            if ( $user != "" || $password != "" ) $url .= "?error=1&user={$user}&password={$password}";
            header( "Location: " . $url, true, 307 );
            return false;
        }

        // 認証に成功したらセッションIDを変更
        $this->session_manager->regenerate();

        $this->session_manager->set( 'user', $user );
        $this->session_manager->set( 'password', $password );

        return true;
    }

    /******************************************************************
     * method: logout
     * description: セッションの終了とログイン画面へのリダイレクトを行う
     ******************************************************************/
    public function logout()
    {
        if ( $this->session_manager->sessionExists() ) $this->session_manager->end();
        header( 'Location: ./Login.php', true, 307 );
    }
}

?>