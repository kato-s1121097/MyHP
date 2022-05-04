<!--
    NewPortfolio.php
    ポートフォリオ新規追加画面
    Update: 2022/05/01(Sun)
            ・バリデーションをJavaScriptで行う施策に伴う変更
-->

<?php
require_once( 'util.php' );
require_once( 'LoginAuth.php' );
require_once( 'CategoryData.php' );

// ログイン認証
$auth = new LoginAuth();
$auth->login();

?>

<html>
    <head>
        <link rel="stylesheet" href="./style/admin_common.css">
        <meta charset="utf-8">
        <script src="./script/jquery-3.6.0.js"></script>
        <title>ポートフォリオ新規追加</title>
    </head>
    <body>
        <header>
            <a href="Logout.php">ログアウト</a>
        </header>

        <h1>ポートフォリオ新規追加</h1>
        <div class="error-message"></div>
        <form action="AddApp.php" method="post">
            <table>
                <tr><th>タイトル：</th><td><input type="text" name="title" class="input" maxlength="30"></td></tr>
                <tr><th>画像：</th><td><input type="text" name="image" class="input" maxlength="50"></td></tr>
                <tr><th>ダウンロードファイル名：</th><td><input type="text" name="url" class="input" maxlength="50"></td></tr>
                <tr><th>リリース日：</th><td><input type="date" name="release-date" class="input"></td></tr>
                <tr>
                    <th>カテゴリ</th>
                    <td>
                        <select name="category-id" class="input">
                            <option value="0" selected>カテゴリを選択してください</option>
                            <?php foreach ( $categories as $category ) : ?>
                                <option value="<?php echo $category->getId() ?>">
                                    <?php echo $category->getName() ?>
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
                    <textarea name="description" class="input" maxlength="250" rows="10" cols="30"></textarea>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="from" value="New">
            <input type="hidden" name="token" value="MyHpToken">
            <input type="submit" value="送信">
        </form>
        <script src="./script/validation.js"></script>
    </body>
</html>