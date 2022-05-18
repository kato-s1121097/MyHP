<?php
/**********************
* DAO.php
* Update: 2022/04/09(Sat)
*       ・DAOをテーブルごとに分ける施策のため、このソースコードをDAO基底クラスのものとする
************************/

class DAO
{
    // DBコネクションハンドル
    public $dbh;

    public function __construct( $user = 'o7491_hpadmin', $pass = 'amgynhups_24' )
    {
        try
        {
            $this->dbh = new PDO( 'mysql:host=mysql90.conoha.ne.jp;dbname=o7491_myhp', $user, $pass );
        } 
        catch ( PDOException $e )
        {
            print "エラー：" . $e->getMessage() . "<br/>";
            die();
        }
    }
}

?>