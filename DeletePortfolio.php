<!--
    DeletePortfolio.php
    ポートフォリオ削除確認画面
    Update: 2022/03/26(Sat)
            ・DAOではなくPortfolioData.phpで取得した全データの中から検索するように変更
            ・CSRF対策用のトークンを埋め込むためにPOSTで処理するように変更
-->

<?php

// ログイン認証
require_once( 'LoginAuth.php' );
$auth = new LoginAuth();
$auth->login();

require_once( 'PortfolioData.php' );

$title = "";
$image = "";
$description = "";

if ( !isset( $_GET['id'] ) )
{
    // クエリでIDが送られていなければ不正なアクセス
    header( 'Location: ./ListPortfolio.php' );
}
else
{
    $id = (int)$_GET['id'];

    foreach ( $apps as $app )
    {
        if ( $app->getId() == $id )
        {
            $title = $app->getTitle();
            $image = $app->getImage();
            $description = $app->getDescription();
            $url = $app->getUrl();
            $release_date = $app->getReleaseDate();
        }    
    }

}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>削除データ確認</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>

        <h1>削除データ確認</h1>
        <h3>以下のデータを削除してよろしいですか？</h3>
        <table>
            <tr><th>タイトル</th><td><?php echo htmlspecialchars( $title, ENT_QUOTES, 'UTF-8' ) ?></td></tr>
            <tr><th>画像ファイル</th><td><img src="./image/<?php echo htmlspecialchars( $image, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
            <tr><th>説明</th><td><?php echo htmlspecialchars( $description, ENT_QUOTES, 'UTF-8' ) ?></td></tr>
            <tr><th>ダウンロードファイル名：</th><td><?php echo htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' ) ?></td></tr>
            <tr><th>リリース日：</th><td><?php echo htmlspecialchars( $release_date, ENT_QUOTES, 'UTF-8' ) ?></td></tr>
        </table>
        <form action="DeleteApp.php" method="post">
            <input type="submit" value="OK">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' ) ?>">
            <input type="hidden" name="token" value="MyHpToken">
        </form>
        <a href="./ListPortfolio.php">キャンセル</a>
    </body>
</html>