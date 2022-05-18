<!--
    Logout.php
    ログアウト処理(セッション破棄など)を行いログイン画面へリダイレクトする
    Create: 2022/03/19(Sat)
    Update: 2022/03/19(Sat)
-->
<?php
    require_once( 'MyHPSessionManager.php' );
    $session_manager = new MyHPSessionManager();

    $session_manager->end();
    header( 'Location: ./Login.php', true, 307 );
?>