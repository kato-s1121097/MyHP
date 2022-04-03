<?php
/*****************************
 * PortfolioData.php
 * ポートフォリオデータ読み込み用ソース
 * Create: 2022/03/13(Sun)
 * Update: 2022/03/26(Sat)
 * 　　　　・DAOクラスコンストラクタのデフォルト引数変更に伴い引数無しに変更
 */
require_once( 'DAO.php' ); 

$dao = new DAO();
$result = $dao->getApps( KEY_RELEASE, ORDER_DESC );
$apps = array();
foreach ( $result as $app )
{
    $apps []= new AppData( $app['id'], $app['title'], $app['image'], $app['description'], $app['download_url'], $app['released_on'] );
}

?>