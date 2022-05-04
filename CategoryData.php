<?php
/****************************************************
 * CategoryData.php
 * categoriesテーブルから全件取得を行う
 * Create: 2022/04/09(Sat)
 * Update: 2022/04/09(Sat)
 ****************************************************/
require_once( 'CategoryDAO.php' );

$dao = new CategoryDAO();
$categories = $dao->getAllData();

?>