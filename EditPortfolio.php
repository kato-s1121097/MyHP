<!--
    EditPortfolio.php
    ポートフォリオ編集画面
    Update: 2022/03/26(Sat)
            ・DAOを使わずPortfolioData.phpで取得した全データの中から検索するように変更
            ・CSRF対策用のトークンを追加
-->

<?php

// ログイン認証
require_once( 'LoginAuth.php' );
$auth = new LoginAuth();
$auth->login();

require_once( 'PortfolioData.php' );

$id = -1;

if ( isset( $_GET['id'] ) )
{
    // 対象Appデータを取得
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
            break;
        }
    }
}
else
{
    // 想定していない方法でのアクセスの場合、ListPortfolio.phpへリダイレクト
    header( 'Location: ./ListPortfolio.php' );
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>ポートフォリオ編集</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>

        <?php
            // エラー処理
            if ( isset( $_GET['errors'] ) )
            {
                echo "<h3>エラー!</h3>";
                echo "<p>". htmlspecialchars( $_GET['errors'], ENT_QUOTES, 'UTF-8' ) . "</p>";
            }
        ?>
        <form action="CheckPortfolio.php" method="post">
            <table>
                <tr><th>タイトル：</th><td><input type="text" name="title" maxlength="30" value="<?php echo htmlspecialchars( $title, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>画像：</th><td><input type="text" name="image" maxlength="50" value="<?php echo htmlspecialchars( $image, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>ダウンロードファイル名：</th><td><input type="text" name="url" maxlength="50" value="<?php echo htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>リリース日：</th><td><input type="date" name="release-date" value="<?php echo htmlspecialchars( $release_date, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr>
                    <th>
                    説明：<br>
                    </th>
                    <td>
                    <textarea name="description" maxlength="250" rows="10" cols="30"><?php echo htmlspecialchars( $description, ENT_QUOTES, 'UTF-8' ) ?></textarea>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="from" value="Edit">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="token" value="MyHpToken">
            <input type="submit" value="送信">
        </form>
    </body>
</html>