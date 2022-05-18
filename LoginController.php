<!--
    LoginController.php
    ログイン画面から受け取ったデータでログイン認証を行い、ページ遷移を行う
    Create: 2022/03/19(Sat)
    Update: 2022/03/19(Sat)
-->

<?php

require_once( 'LoginAuth.php' );
$auth = new LoginAuth();
if ( $auth->login( $_POST['user'], $_POST['password']) )
{
    // ログイン認証に成功したらポートフォリオ一覧へ遷移
    header( 'Location: ./ListPortfolio.php' );
}

?>