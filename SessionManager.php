<!--
    SessionManager.php
    SessionManagerクラスの定義
    Create: 2022/03/19(Sat)
    Update: 2022/03/19(Sat)
-->

<?php
    /****************************************************************************
    * Class:SessionManager
    * description: セッションの基本的な操作を管理する
    *              アプリケーションに応じてRemoveAuthDatas()をオーバーライドして使う
    *****************************************************************************/
    abstract class SessionManager
    {
        /***************************************************************************
        * method: start
        * description: セッションをスタートする
        * params: sess_name = セッション名を変更する場合に指定する
        * return: false = 異常を検知(セッションハイジャックや不安定なネットワークの可能性)
        *         true = 正常にセッションスタート
        ****************************************************************************/
        public function start( $sess_name = null )
        {
            session_start();

            if ( isset( $_SESSION['destroyed']) )
            {
                if ( $_SESSION['destroyed'] < time() - 300 )
                {
                    $this->removeAuthData();
                    return false;
                }
                if ( isset( $_SESSION['new_session_id'] ) )
                {
                    session_commit();
                    session_id( $_SESSION['new_session_id'] );
                    session_start();

                    return true;
                }
            }

            return true;
        }

        /**********************************************************
        * method: regenerate
        * description: セッションIDの再設定(セッションID固定攻撃対策)
        **********************************************************/
        public function regenerate()
        {
            session_regenerate_id();
            /*
            $new_session_id = session_create_id();
            $_SESSION['new_session_id'] = $new_session_id;

            $_SESSION['destroyed'] = time();
            session_commit();

            session_id( $new_session_id );
            ini_set( 'session.use_strict_mode', 0 );
            session_start();
            ini_set( 'session.use_strict_mode', 1 );

            unset( $_SESSION['destroyed'] );
            unset( $_SESSION['new_session_id'] );
            */
        }

        /***********************************************************
         * method: sessionExists
         * description: セッションが存在するか判定する
         * return: true = セッションが存在する
         *         false = セッションが存在しない
         ***********************************************************/
        public function sessionExists()
        {
            return isset( $_COOKIE[session_name()] ) ? true : false;
        }

        /***********************************************************
         * method: clear
         * description: セッション変数をクリアする
         ***********************************************************/
        public function clear()
        {
            $_SESSION = array();
        }

        /***********************************************************
         * method: deleteCookie
         * description: Webブラウザにセッションクッキーの削除を要求する
         ***********************************************************/
        public function deleteCookie()
        {
            if ( $this->sessionExists() )
            {
                $params = session_get_cookie_params();
                setcookie( session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly'] );
            }
        }

        /***********************************************************
         * method: end
         * description: セッションを終了する(ログアウト時などに呼び出す)
         **********************************************************/
        public function end()
        {
            $this->clear();
            $this->deleteCookie();
            session_destroy();
        }

        /*********************************************************
         * method: set
         * description: セッション変数のセット
         * params: $key = セッション変数のキー
         *         $value = セッション変数の値
         ********************************************************/
        public function set( $key, $value )
        {
            $_SESSION[$key] = $value;
        }

        /**********************************************************
         * method: get
         * description: セッション変数の取得
         * params: $key = 取得するセッション変数のキー
         *         $default = セッション変数が存在しない場合のデフォルト値
         * return: (セッション変数が存在する)セッション変数の値
         *         (セッション変数が存在しない)$defaultに指定した値
         **********************************************************/
        public function get( $key, $default = null )
        {
            return isset( $_SESSION[$key] ) ? $_SESSION[$key] : $default;
        }

        /************************************************************
         * method: remove
         * description: $keyに指定したセッション変数を削除する
         * params: $key = 削除するセッション変数のキー
         ************************************************************/
        public function remove( $key )
        {
            if ( isset( $_SESSION[$key] ) ) unset( $_SESSION[$key] );
        }

        /*****************************************************************************************
         * method: removeAuthData
         * description: 全ての認証情報に関わるセッション変数を削除する(セッションハイジャック対策)
         *              アプリケーションごとにSessionManagerを継承してこのメソッドをオーバーライドする
         ****************************************************************************************/
        abstract protected function removeAuthData( $id = null );
    }
?>