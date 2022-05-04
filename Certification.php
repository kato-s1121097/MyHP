<?php
/*******************************************************************
 * Certification.php
 * certificationsテーブルのレコードを表すクラス(DTO)
 * Create: 2022/04/09(Sat)
 * Update: 2022/04/09(Sat)
 *******************************************************************/

 class Certification
 {
    private $date;
    private $name;

    public function __construct( $date, $name ) { $this->setDate( $date ); $this->setName( $name ); }
    public function getDate() { return $this->date; }
    public function setDate( $date ) { if ( is_string( $date ) ) $this->date = $date; }
    public function getName() { return $this->name; }
    public function setName( $name ) { if ( is_string( $name ) ) $this->name = $name; }
 }

?>