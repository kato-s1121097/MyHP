<!--
    Login.php
    ログイン画面
    Create: 2022/03/19(Sat)
    Update: 2022/03/19(Sat)
-->
<html>
    <head>
        <meta charset="utf-8">
        <title>管理画面ログイン</title>
    </head>
    <body>
        <h1>管理画面ログイン</h1>
        <?php
            $user = "";
            $password = "";

            if ( isset( $_GET['error'] ) )
            {
                echo "<h3>エラー！ユーザ名またはパスワードが間違っています！</h3>";
                $user = $_GET['user'];
                $password = $_GET['password'];
            }
        ?>
        <form action="LoginController.php" method="post">
            <table>
                <tr><th>ユーザ名：</th><td><input name="user" value="<?php echo htmlspecialchars( $user, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><th>パスワード：</th><td><input name="password" type="password" value="<?php echo htmlspecialchars( $password, ENT_QUOTES, 'UTF-8' ) ?>"></td></tr>
                <tr><td><input type="submit"></td></tr>
            </table>
        </form>
    </body>
</html>