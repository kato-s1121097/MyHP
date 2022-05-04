<!--
    EditPortfolio.php
    ポートフォリオ編集画面
    Update: 2022/05/01(Sun)
            ・バリデーションをJavaScriptで行う施策に伴う変更
-->

<?php

// ログイン認証
require_once( 'LoginAuth.php' );
require_once( 'PortfolioData.php' );
require_once( 'CategoryData.php' );
$auth = new LoginAuth();
$auth->login();


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
            $category_id = $app->getCategoryId();
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
        <link rel="stylesheet" href="./style/admin_common.css">
        <meta charset="utf-8">
        <script src="./script/jquery-3.6.0.js"></script>
        <title>ポートフォリオ編集</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>

        <div class="error-message"></div>
        <form action="UpdateApp.php" method="post">
            <table>
                <tr><th>タイトル：</th><td><input type="text" name="title" class="input" maxlength="30" value="<?php echo htmlspecialchars( $title, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>画像：</th><td><input type="text" name="image" class="input" maxlength="50" value="<?php echo htmlspecialchars( $image, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>ダウンロードファイル名：</th><td><input type="text" name="url" class="input" maxlength="50" value="<?php echo htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>リリース日：</th><td><input type="date" name="release-date" class="input" value="<?php echo htmlspecialchars( $release_date, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr>
                    <th>カテゴリ：</th>
                    <td>
                        <select name="category-id" class="input">
                            <option value="0">カテゴリを選択してください</option>
                            <?php foreach ( $categories as $category ) : ?>
                                <option value="<?php echo $category->getId() ?>" <?php if ( $category->getId() == $category_id ) echo "selected" ?>>
                                    <?php echo htmlspecialchars( $category->getName(), ENT_QUOTES, 'UTF-8' ) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                    説明：<br>
                    </th>
                    <td>
                    <textarea name="description" class="input" maxlength="250" rows="10" cols="30"><?php echo htmlspecialchars( $description, ENT_QUOTES, 'UTF-8' ) ?></textarea>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="from" value="Edit">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="token" value="MyHpToken">
            <input type="submit" value="送信">
        </form>
        <script src="./script/validation.js"></script>
    </body>
</html>