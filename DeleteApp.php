<!--
    DeleteApp.php
    DBのappデータ削除処理
    Update: 2022/04/09(Sat)
        ・DAOリファクタリング施策に伴い、以下の変更
            >require_once()の中身をDAO.phpからAppDAO.phpへ変更
            >DAOインスタンス生成部分をAppDAOインスタンス生成へ変更
            >deleteAppById()メソッド呼び出し部分をdeleteById()メソッドへ変更
-->
<?php

require_once( 'AppDAO.php' );
require_once( 'util.php' );

if ( AuthToken() == AUTH_TOKEN_NG )
{
    echo '不正アクセスを検知しました';
    die();
}

if ( isset( $_POST['id'] ) )
{
    $id = (int)$_POST['id'];

    $dao = new AppDAO();
    $dao->deleteById( $id );
}

header( 'Location: ./ListPortfolio.php' );

?>