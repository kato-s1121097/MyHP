<!--
    profile.php
    HPプロフィールページ
    Update: 2022/04/30(Sat)
        ・footerをインクルード化
        ・AOJの判定の説明をコードブロック化
-->

<?php

require_once( "APILibrary.php" );
require_once( "CertificationData.php" );

$res = getAPIDataCurl( "https://judgeapi.u-aizu.ac.jp/users/s1121097" );
$aoj_user_params = json_decode( $res, true );

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./style/common.css">
    <link rel="stylesheet" href="./style/profile.css">
    <link rel="stylesheet" href="./style/responsive.css">
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="ja">
    <meta name="viewport" content="width=devince-width,initial-scale=1.0">
    <script src="./script/jquery-3.6.0.js"></script>
    <title>My Home Page</title>
</head>
<body>
    <header></header>
    <div class="container">
        <div class="main-contents">
            <h1>Profile</h1>
            <div class="profile-table">
                <table>
                    <tr>
                        <th>経歴</th>
                        <td>
                            高校2年生の時にプログラミングの勉強を開始。<br>
                            大学3年までの5年間、空いた時間のほとんどをプログラミングの勉強に注ぎ込んだが、<br>
                            体調不良により大学を中退、その後アルバイトを始めたソフトウェア開発会社でプログラマとしての経験を積めず退社。<br>
                            それから長い年月ITから離れ、親の事業に従事していたが30手前で再びプログラミング熱が再燃。<br>
                            日々、テスターのアルバイトをしながらプログラマとしての就職を目指して勉強中。
                        </td>
                    </tr>
                    <tr>
                        <th>使用言語</th>
                        <th>使用技術</th>
                    </tr>
                    <tr>
                        <th>
                            C++
                        </th>
                        <td>
                            DirectX, Win32API(主にゲーム制作や競技プログラミングに使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            C#
                        </th>
                        <td>
                            XNA, .NET Framework(主にツール系デスクトップアプリケーション開発に使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Java
                        </th>
                        <td>
                            Doja, JDBC, Struts(主にPC以外で動作するアプリケーションの開発に使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            PHP
                        </th>
                        <td>
                            Cake PHP(主にサーバサイドで動く簡易的なWebアプリケーションに使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            JavaScript
                        </th>
                        <td>
                            jQuery,Node.js(主にクライアントサイドやサーバサイドで動く規模の大きいWebアプリケーションに使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            VB
                        </th>
                        <td>
                            .NET Framework, Excel VBA(主にExcel VBAを使ったツール系アプリケーションに使用)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            取得年
                        </th>
                        <th>
                            資格
                        </th>
                    </tr>
                    <?php foreach ( $certifications as $certification ) : ?>
                        <tr>
                            <td><?php echo $certification->getDate() ?></td>
                            <td><?php echo $certification->getName() ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <div class="AOJ-status">
                <h1>AOJ Status</h1>
                <table>
                    <?php foreach( $aoj_user_params['status'] as $key => $value ) : ?>
                    <tr>
                        <th><?php echo $key ?></th>
                        <td><?php echo $value ?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
                <p>
                    <a href="https://judge.u-aizu.ac.jp/onlinejudge/index.jsp">会津オンラインジャッジ(AOJ)</a>という競技プログラミングの過去問を解くことができるサイトでの私の成績です。<br>
                    時間のある時はICPC、サクッと解きたい時はJOIの問題を解いています。<br>
                    <code>
                        submissions: 正解、不正解含めた投稿した解答の総数<br>
                        solved: 正解した問題の数<br>
                        accepted: 正解した解答の数(=solved)<br>
                        wrongAnswer: 出力が間違っていた解答の数(アルゴリズム自体の間違い、出力形式の間違い等)<br>
                        timeLimit: 制限時間内に出力までの処理が終わらなかった解答の数(計算量が大きい、停止しない等)<br>
                        memoryLimit: 制限メモリを超えてしまう(巨大な配列のアロケーション等)<br>
                        outputLimit: 出力のサイズが制限を超えた(無限出力は停止しないためtimeLimitに加算される)<br>
                        compileError: コンパイルエラー(C++でC++11の機能を使用しているのにC++11として投稿していない。テンプレートの型にテンプレートを使用した時に末尾の>>が演算子として認識される等)<br>
                        runtimeError: 実行時エラー<br>
                    </code>
                </p>
            </div>
        </div>
        <footer>
        </footer>
        <script src="./script/common.js"></script>
    </div>
</body>
</html>