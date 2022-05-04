<?php
/********************
* AppData.php
* Update: 2022/04/09(Sat)
*       ・$category_idフィールドとそのゲッター、セッターを追加
* 
*********************/

class AppData
{
    private $id;
    private $title;
    private $image;
    private $description;
    private $url;
    private $release_date;
    private $category_id;

    public function __construct( $id, $title = "", $image = "", $description = "", $url = "", $release_date = "", $category_id = 0 )
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->url = $url;
        $this->release_date = $release_date;
        $this->category_id = $category_id;
    }

    /* PHPにオーバーロードが無いため
    public function __construct( array $app )
    {
        $this->id = $app['id'];
        $this->title = $app['title'];
        $this->image = $app['image'];
        $this->description = $app['description'];
        $this->url = $app['download_url'];
        $this->release_date = $app['released_on'];
        $this->category_id = $app['category_id'];
    }
    */

    public function getId() { return $this->id; }
    public function setId( $id ) { $this->id = $id; }
    public function getTitle() { return $this->title; }
    public function setTitle( $title ) { if ( is_string( $title ) ) $this->title = $title; }
    public function getImage() { return $this->image; }
    public function setImage( $image ) { if ( is_string( $image ) ) $this->image = $image; }
    public function getDescription() { return $this->description; }
    public function setDescription( $description ) { if ( is_string( $description ) ) $this->description = $description; }
    public function getUrl() { return $this->url; }
    public function setUrl( $url ) { if ( is_string( $url ) ) $this->url = $url; }
    public function getReleaseDate() { return $this->release_date; }
    public function setReleaseDate( $release_date ) { $this->release_date = $release_date; }
    public function getCategoryId() { return $this->category_id; }
    public function setCategoryId( $category_id ) { $this->category_id = $category_id; }

    /*****************************************************
     * Method: getEncodedDescription
     * Description: 改行コードを改行タグ<br>に変換し、改行タグ以外にエスケープを施したdescriptionを返す
     * Return: 上記処理を施したdescription
     ******************************************************/
    public function getEncodedDescription()
    {
        $escaped = htmlspecialchars( $this->description, ENT_QUOTES, 'UTF-8' );
        return nl2br( $escaped );
    }
}

/*
$dao = new DAO( 'hpadmin', 'agnusdei' );
$result = $dao->getApps( AppKey::KEY_RELEASE, Order::ORDER_DESC );
$apps = array();
foreach ( $result as $app )
{
    $apps []= new AppData( $app['id'], $app['title'], $app['image'], $app['description'], $app['download_url'], $app['released_on'] );
}
*/

?>