<!--
    AddApp.php
    DBへのappデータ追加処理
    Update: 2022/03/26(Sat)
    　　　　・ファイル名をAddApps.phpからAddApp.phpに変更（複数レコード追加はしない、他のソースファイルとの統一性のため）
    　　　　・DAOクラスコンストラクタのデフォルト引数変更に伴い引数無しに変更
    　　　　・CSRF対策のためにトークン認証を追加
-->
<?php

require_once( 'DAO.php' );
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
$app = new AppData( 0, $title, $image, $description, $url, $release_date );

$dao = new DAO();
$dao->insertApp( $app );

header( 'Location: ./ListPortfolio.php' );

?>