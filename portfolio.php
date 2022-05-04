<!-- 
    Portfolio.php
    ポートフォリオ公開用ページ
    Update: 2022/04/30(Sun)
            ・ダウンロードURLがnullの場合リンクを表示しないようにする
            ・footer部分の共通化
-->
<?php require_once( 'PortfolioData.php' ) ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./style/common.css">
    <link rel="stylesheet" href="./style/portfolio.css">
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
        <div class="filter-btn">フィルタ</div>
        <div class="filter-wrapper">
            <div class="filter-modal">
                フィルタを設定して決定ボタンを押してください
                <div class="filter" id="win-filter">Win</div>
                <div class="filter" id="web-filter">Web</div>
                <div class="filter" id="iapp-filter">iapp</div>
                <div class="filter" id="vba-filter">VBA</div>
                <div class="btn-menu" id="decide-filter">決定</div>
            </div>
        </div>
        <div class="main-contents">
            <h1>Portfolio</h1>
            <p>※過去に作ったアプリケーションがまだまだたくさんありますので公開準備が整い次第順次追加していきます。</p>
            <?php foreach( $apps as $app ) : ?>
                <div class="app <?php echo "category{$app->getCategoryId()}" ?>">
                    <img class="category-img" src="image/<?php echo IMAGE_FILE[$app->getCategoryId()] ?>">
                    <div class="app-title"><?php echo htmlspecialchars( $app->getTitle(), ENT_QUOTES, 'UTF-8' ) ?></div>
                    <div class="release-date">リリース日：<?php echo htmlspecialchars( $app->getReleaseDate(), ENT_QUOTES, 'UTF-8' ) ?></div>
                    <div class="app-profile">
                        <div class="app-image"><img src="./image/<?php echo $app->getImage() ?>"></div>
                        <div class="app-description"><?php echo $app->getEncodedDescription() ?></div>
                    </div>
                    <?php if( strcmp( $app->getUrl(), 'null' ) ): ?>
                        <a href="<?php echo htmlspecialchars( $app->getUrl() ) ?>">実際に使ってみる</a>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
        <footer>
        </footer>
        <script src="./script/common.js"></script>
        <script src="./script/portfolio.js"></script>
    </div>
</body>
</html>