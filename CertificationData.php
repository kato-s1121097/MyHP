<?php

require_once( 'DAO.php' );

class CertificationData
{
    private $date;
    private $name;

    public function __construct( $date, $name ) { $this->setDate( $date ); $this->setName( $name ); }
    public function getDate() { return $this->date; }
    public function setDate( $date ) { if ( is_string( $date ) ) $this->date = $date; }
    public function getName() { return $this->name; }
    public function setName( $name ) { if ( is_string( $name ) ) $this->name = $name; }
}

$dao = new DAO();
$result = $dao->getCertifications();

$certifications = array();
foreach ( $result as $certification )
{
    $certifications []= new CertificationData( $certification['got_on'], $certification['name'] );
}

?>