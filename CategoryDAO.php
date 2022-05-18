<?php
/********************************************************************
 * CategoryDAO
 * categoriesテーブルのDAO
 * Create: 2022/04/09(Sat)
 * Update: 2022/04/09(Sat)
 ********************************************************************/

require_once( 'DAO.php' );
require_once( 'Category.php' );

class CategoryDAO extends DAO
{
    public function getAllData()
    {
        $query = 'SELECT * FROM categories';
        $result = $this->dbh->query( $query );
        if ( $result )
        {
            $categories = array();

            foreach ( $result as $category )
            {
                $categories []= new Category( $category['id'], $category['name'] );
            }

            return $categories;
        }

        print 'categoriesデータの取得に失敗';
        return array();
    }
}

?>