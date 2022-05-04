<?php
/**************************************************************
 * Category.php
 * categoriesテーブルのレコードを表すオブジェクト(DTO)
 * Create: 2022/04/09(Sat)
 * Update: 2022/04/09(Sat)
 **************************************************************/

class Category
{
    private $id;
    private $name;

    public function __construct( $id = 0, $name = "" )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() { return $this->id; }
    public function setId( $id ) { $this->id = $id; }
    public function getName() { return $this->name; }
    public function setName( $name ) { $this->name = $name; }
}

?>