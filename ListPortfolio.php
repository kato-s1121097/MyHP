<!--
    ListPortfolio.php
    ポートフォリオ一覧ページ（管理用）
    Update: 2022/03/19(Sat)
            ・ログイン認証処理を追加
-->
<?php 

// ログイン認証
require_once( 'LoginAuth.php' );
$auth = new LoginAuth();
$auth->login();

require_once( 'PortfolioData.php' );

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>ポートフォリオ一覧</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>
        <h1>ポートフォリオ一覧</h1>
        <a href="NewPortfolio.php">新規追加</a>
        <table>
            <?php foreach( $apps as $app ) : ?>
                <tr>
                    <td><?php echo htmlspecialchars( $app->getTitle(), ENT_QUOTES, 'UTF-8' ) ?></td>
                    <td><a href="EditPortfolio.php?id=<?php echo $app->getId() ?>">編集</a></td>
                    <td><a href="DeletePortfolio.php?id=<?php echo $app->getId() ?>">削除</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>