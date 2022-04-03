<?php
/**********************
* DAO.php
* Update: 2022/03/26(Sat)
*　　　　・DAOクラスコンストラクタのデフォルト引数変更に伴って引数無しに変更
*　　　　・enum対応がPHP8.1で比較的新しいためコメントアウト
*
************************/

require_once( 'AppData.php' );

/* enumはPHP8.1以上でないと対応していないためコメントアウト
enum AppKey : string
{
    case KEY_ID = 'id';
    case KEY_TITLE = 'title';
    case KEY_IMAGE = 'image';
    case KEY_DESCRIPTION = 'description';
    case KEY_URL = 'download_url';
    case KEY_RELEASE = 'released_on';
}

enum Order : string
{
    case ORDER_ASC = 'ASC';
    case ORDER_DESC = 'DESC';
}
*/

const KEY_ID = 'id';
const KEY_TITLE = 'title';
const KEY_IMAGE = 'image';
const KEY_DESCRIPTION = 'description';
const KEY_URL = 'download_url';
const KEY_RELEASE = 'released_on';

const ORDER_ASC = 'ASC';
const ORDER_DESC = 'DESC';

class DAO
{
    // DBコネクションハンドル
    public $dbh;

    public function __construct( $user = 'hpadmin', $pass = 'MyHp' )
    {
        try
        {
            $this->dbh = new PDO( 'mysql:host=localhost;dbname=MyHP', $user, $pass );
        } 
        catch ( PDOException $e )
        {
            print "エラー：" . $e->getMessage() . "<br/>";
            die();
        }
    }

    /*
    public function getApps()
    {
        $sql = 'SELECT * FROM apps';
        $result = $this->dbh->query( $sql );
        if ( $result ) return $result;
        else
        {
            print 'Appsデータの取得に失敗.<br/>';
            return array();
        }
    }
    */

    /* enumはPHP8.1以上でないと対応していないためコメントアウト
    public function getApps( AppKey $enum_key = AppKey::KEY_ID, Order $enum_order = Order::ORDER_ASC )
    {
        $key = $enum_key->value;
        $order = $enum_order->value;
        $sql = 'SELECT * FROM apps ORDER BY ' . $key . ' ' . $order;
        $result = $this->dbh->query( $sql );
        if ( $result ) return $result;

        print 'Appsデータの取得に失敗';
        return array();
    }
    */

    public function getApps( $key = KEY_ID, $order = ORDER_ASC )
    {
        $sql = 'SELECT * FROM apps ORDER BY ' . $key . ' ' . $order;
        $result = $this->dbh->query( $sql );
        if ( $result ) return $result;

        print 'Appsデータの取得に失敗';
        return array();
    }

    public function getAppById( $id )
    {
        $sql = 'SELECT * FROM apps WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $id );
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getCertifications()
    {
        $sql = 'SELECT * FROM certifications ORDER BY got_on ASC';
        $result = $this->dbh->query( $sql );
        if ( $result ) return $result;
        else
        {
            print 'Certificationsデータの取得に失敗.<br/>';
            return array();
        }
    }

    public function insertApp( AppData $app )
    {
        $sql = 'INSERT INTO apps (title, image, description, download_url, released_on) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $app->getTitle() );
        $stmt->bindParam( 2, $app->getImage() );
        $stmt->bindParam( 3, $app->getDescription() );
        $stmt->bindParam( 4, $app->getUrl() );
        $stmt->bindParam( 5, $app->getReleaseDate() );

        $stmt->execute();
    }

    public function updateApp( AppData $app )
    {
        $sql = 'UPDATE apps SET title=?,image=?,description=?,download_url=?,released_on=? WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $app->getTitle() );
        $stmt->bindParam( 2, $app->getImage() );
        $stmt->bindParam( 3, $app->getDescription() );
        $stmt->bindParam( 4, $app->getUrl() );
        $stmt->bindParam( 5, $app->getReleaseDate() );
        $stmt->bindParam( 6, $app->getId() );

        $stmt->execute();
    }

    public function deleteAppById( $id )
    {
        $sql = 'DELETE FROM apps WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $id );
        $stmt->execute();
    }
}

?>