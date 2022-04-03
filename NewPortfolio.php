<!--
    NewPortfolio.php
    ポートフォリオ新規追加画面
    Update: 2022/03/26(Sat)
            ・CSRF対策用のトークンを追加
-->

<?php

// ログイン認証
require_once( 'LoginAuth.php' );
$auth = new LoginAuth();
$auth->login();

require_once('util.php');

$title = GetParam( 'title' );
$image = GetParam( 'image' );
$description = GetParam( 'description' );
$url = GetParam( 'url' );
$release_date = GetParam( 'release-date' );

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>ポートフォリオ新規追加</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>

        <h1>ポートフォリオ新規追加</h1>
        <?php
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
            <input type="hidden" name="from" value="New">
            <input type="hidden" name="token" value="MyHpToken">
            <input type="submit" value="送信">
        </form>
    </body>
</html>