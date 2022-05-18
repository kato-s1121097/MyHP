<?php
/*****************************
 * PortfolioData.php
 * ポートフォリオデータ読み込み用ソース
 * Create: 2022/03/13(Sun)
 * Update: 2022/04/09(Sat)
 * 　　　　・DAOリファクタリング施策に伴い、リザルトセットからAppDataへの変換処理を削除
 */
require_once( 'AppDAO.php' ); 

// カテゴリイメージ用の定数配列
const IMAGE_FILE = array( '', 'win.png', 'web.png', 'iapp.png', 'vba.png' );

$dao = new AppDAO();
$apps = $dao->getAllData( KEY_RELEASE, ORDER_DESC );

?>