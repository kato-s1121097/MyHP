<!--
    UpdateApps.php
    DBのappデータ更新処理
    Update: 2022/04/09(Sat)
        ・DAOリファクタリング施策に伴い、以下の変更
            >require_once()内をDAO.phpからAppDAO.phpへ変更
            >DAOインスタンス生成部分をAppDAOインスタンス生成へ変更
            >updateApp()メソッド呼び出しをupdate()メソッドへ変更
        ・カテゴリ追加に伴い、AppDataコンストラクタにcategory_idを追加
-->
<?php

require_once( 'AppDAO.php' );
require_once( 'util.php' );

if ( AuthToken() == AUTH_TOKEN_NG )
{
    echo '不正アクセスを検知しました';
    die();
}

if ( !isset( $_POST['id'] ) )
{
    $errors = "idが不明";
    header( 'Location: ./EditPortfolio.php?errors=' . $errors );
}
else
{
    $dao = new AppDAO();

    $app = new AppData( (int)$_POST['id'], $_POST['title'], $_POST['image'], $_POST['description'], $_POST['url'], $_POST['release-date'], (int)$_POST['category-id'] );
    $dao->update( $app );

    header( 'Location: ./ListPortfolio.php' );
}

?>