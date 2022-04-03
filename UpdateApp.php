<!--
    UpdateApps.php
    DBのappデータ更新処理
    Update: 2022/03/26(Sat)
    　　　　・ファイル名をUpdateApps.phpからUpdateApp.phpに変更（複数レコードの更新をしないため）
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

if ( !isset( $_POST['id'] ) )
{
    $errors = "idが不明";
    header( 'Location: ./EditPortfolio.php?errors=' . $errors );
}
else
{
    $dao = new DAO();

    $app = new AppData( (int)$_POST['id'], $_POST['title'], $_POST['image'], $_POST['description'], $_POST['url'], $_POST['release-date'] );
    $dao->updateApp( $app );

    header( 'Location: ./ListPortfolio.php' );
}

?>