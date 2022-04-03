<!--
    DeleteApp.php
    DBのappデータ削除処理
    Update: 2022/03/26(Sat)
    　　　　・DAOクラスコンストラクタのデフォルト引数変更に伴い引数無しに変更
    　　　　・CSRF対策としてトークン認証を追加
-->
<?php

require_once( 'DAO.php' );
require_once( 'util.php' );

if ( AuthToken() == AUTH_TOKEN_NG )
{
    echo '不正アクセスを検知しました';
    die();
}

if ( isset( $_POST['id'] ) )
{
    $id = (int)$_POST['id'];

    $dao = new DAO();
    $dao->deleteAppById( $id );
}

header( 'Location: ./ListPortfolio.php' );

?>