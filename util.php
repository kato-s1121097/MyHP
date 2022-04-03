<!--
    util.php
    MyHPのソースで頻出する処理をまとめた関数ライブラリ
    Update: 2022/03/26(Sat)
    　　　　・トークン認証を行うAuthToken()関数を追加
-->

<?php

function GetParam( string $param )
{
    return isset( $_GET[$param] ) ? $_GET[$param] : "";
}

function GetPost( string $param )
{
    return isset( $_POST[$param] ) ? $_POST[$param] : "";
}

// トークン認証
// 定数
const AUTH_TOKEN_NG = -1;
const AUTH_TOKEN_OK = 0;

/****************************************************************************************
 * Function: AuthToken()
 * Description: トークン認証を行う(主にDB処理を行うソースファイルでCSRF対策のために呼び出す)
 * Return: TOKEN_AUTH_NG(-1) = トークン認証に失敗, TOKEN_AUTH_OK(0) = トークン認証に成功
 ***************************************************************************************/
function AuthToken( $token = 'MyHpToken' )
{
    if ( !isset( $_POST['token'] ) || strcmp( $_POST['token'], $token ) ) return AUTH_TOKEN_NG;
    return AUTH_TOKEN_OK;
}

?>