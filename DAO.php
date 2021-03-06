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

    public function __construct( $user = 'hpadmin', $pass = 'MyHP' )
    {
        try
        {
            $this->dbh = new PDO( 'mysql:host=localhost;dbname=myhp', $user, $pass );
        } 
        catch ( PDOException $e )
        {
            print "エラー：" . $e->getMessage() . "<br/>";
            die();
        }
    }
}

?>