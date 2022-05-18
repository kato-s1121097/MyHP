<!--
    AddApp.php
    DBへのappデータ追加処理
    Update: 2022/04/09(Sat)
        ・DAOリファクタリング施策に伴い、以下の変更
            require_once内をDAO.phpからAppDAO.phpへ変更
            DAOインスタンスの生成をAppDAOに変更
            メソッド呼び出しをinsertApp()からinsert()に変更
        ・カテゴリ追加に伴い、カテゴリを扱う処理を追加
-->
<?php

require_once( 'AppDAO.php' );
require_once( 'util.php' );

if ( AuthToken() == AUTH_TOKEN_NG )
{
    echo '不正アクセスを検知しました';
    die();
}

$title = $_POST['title'];
$image = $_POST['image'];
$description = $_POST['description'];
$url = $_POST['url'];
$release_date = $_POST['release-date'];
$category_id = (int)$_POST['category-id'];
$app = new AppData( 0, $title, $image, $description, $url, $release_date, $category_id );

$dao = new AppDAO();
$dao->insert( $app );

header( 'Location: ./ListPortfolio.php' );

?>