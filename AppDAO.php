<?php
/**********************
* AppDAO.php
* appsテーブルのDAO
* Create: 2022/04/09(Sat)
* Update: 2022/04/09(Sat)
************************/

require_once( 'DAO.php' );
require_once( 'AppData.php' );

/* enumはPHP8.1以上でないと対応していないためオミット
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

class AppDAO extends DAO
{
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

    /* enumはPHP8.1以上でないと対応していないためオミット
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
    public function getAllData( $key = KEY_ID, $order = ORDER_ASC )
    {
        $sql = 'SELECT * FROM apps ORDER BY ' . $key . ' ' . $order;
        $result = $this->dbh->query( $sql );
        if ( $result )
        {
            // リザルトセットをAppDataの配列に変換して返す
            $apps = array();
            foreach ( $result as $app )
            {
                $apps []= new AppData( $app['id'], $app['title'], $app['image'], $app['description'], $app['download_url'], $app['released_on'], $app['category_id'] );
            }

            return $apps;
        }

        print 'Appsデータの取得に失敗';
        return array();
    }

    public function getDataById( $id )
    {
        $sql = 'SELECT * FROM apps WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $id );
        $stmt->execute();
        $app = $stmt->fetch();

        return new AppData( $app['id'], $app['title'], $app['image'], $app['description'], $app['download_url'], $app['released_on'], $app['category_id'] );
    }

    public function insert( AppData $app )
    {
        $sql = 'INSERT INTO apps (title, image, description, download_url, released_on, category_id) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $app->getTitle() );
        $stmt->bindParam( 2, $app->getImage() );
        $stmt->bindParam( 3, $app->getDescription() );
        $stmt->bindParam( 4, $app->getUrl() );
        $stmt->bindParam( 5, $app->getReleaseDate() );
        $stmt->bindParam( 6, $app->getCategoryId() );

        $stmt->execute();
    }

    public function update( AppData $app )
    {
        $sql = 'UPDATE apps SET title=?,image=?,description=?,download_url=?,released_on=?,category_id=? WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $app->getTitle() );
        $stmt->bindParam( 2, $app->getImage() );
        $stmt->bindParam( 3, $app->getDescription() );
        $stmt->bindParam( 4, $app->getUrl() );
        $stmt->bindParam( 5, $app->getReleaseDate() );
        $stmt->bindParam( 6, $app->getCategoryId() );
        $stmt->bindParam( 7, $app->getId() );

        $stmt->execute();
    }

    public function deleteById( $id )
    {
        $sql = 'DELETE FROM apps WHERE id=?';
        $stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( 1, $id );
        $stmt->execute();
    }
}

?>