<!--
    util.php
    MyHPのソースで頻出する処理をまとめた関数ライブラリ
    Update: 2022/05/01(Sun)
    　　　　・リクエストメソッドの判定用関数を追加
-->

<?php

/***********************************************
 * Function: GetServer
 * Description: server環境変数のkeyに格納されている値を取得する
 * Params: key = 取得する値のキー
 *         default = キーが存在しなかった場合の戻り値
 ***********************************************/
function GetServer( $key, $default = null )
{
    return ( isset( $_SERVER[$key] ) ) ? $_SERVER[$key] : $default;
}

/************************************************
 * Function: IsGet
 * Description: リクエストメソッドがGETであるか判定する
 * Return: true = GETリクエストである, false = GETリクエストではない
 ************************************************/
function IsGet()
{
    if ( GetServer( 'REQUEST_METHOD' ) == 'GET' ) return true;
    return false;
}

/****************************************************
 * Function: IsPost
 * Description: リクエストメソッドがPOSTであるか判定する
 * Return: true = POSTリクエストである, false = POSTリクエストではない
 ****************************************************/
function IsPost()
{
    if ( GetServer( 'REQUEST_METHOD' ) == 'POST' ) return true;
    return false;
}

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