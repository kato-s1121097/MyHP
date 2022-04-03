<!--
    CheckPortfolio.php
    入力されたAppデータのバリデーションを行い、リダイレクトを行う
    Update: 2022/03/26(Sat)
    　　　　・ソースファイル名変更に伴い、リダイレクト先を変更
-->
<?php

require_once( 'util.php' );
require_once( 'AppData.php' );

// 入力チェック関数
function Validate( AppData $app )
{
    $errors = array();

    if ( !strcmp( $app->getTitle(), "" ) ) $errors []= "タイトルが入力されていません";
    if ( !strcmp( $app->getImage(), "" ) ) $errors []= "画像ファイル名が入力されていません";
    if ( !strcmp( $app->getDescription(), "" ) ) $errors []= "説明が入力されていません";
    if ( !strcmp( $app->getUrl(), "" ) ) $errors []= "ダウンロードファイル名が入力されていません";
    if ( !strcmp( $app->getReleaseDate(), "" ) ) $errors []= "リリース日が入力されていません";

    return $errors;
}

// 遷移元を取得
$from = $_POST['from'];

$id = ( $from == 'New' ) ? 0 : GetPost( 'id' );
$title = GetPost( 'title' );
$image = GetPost( 'image' );
$description = GetPost( 'description' );
$download_url = GetPost( 'url' );
$release_date = GetPost( 'release-date' );
$app = new AppData( $id, $title, $image, $description, $download_url, $release_date );
$errors = Validate( $app );

if ( count( $errors ) > 0 )
{
    $url = ( $from == 'New' ) ? './NewPortfolio.php?errors=' : './EditPortfolio.php?errors=';
    foreach ( $errors as $error )
    {
        $url .= $error . ',';
    }
    $url .= "&id={$id}";
    $url .= "&title={$title}";
    $url .= "&image={$image}";
    $url .= "&description={$description}";
    $url .= "&url={$download_url}";
    $url .= "&release-date={$release_date}";

    header( 'Location: ' . $url );
}
else
{
    $url = ( $from == 'New' ) ? './AddApp.php' : './UpdateApp.php';
    header( 'Location: ' . $url, true, 307 );
}

?>