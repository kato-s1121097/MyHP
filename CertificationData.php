<?php

require_once( 'CertificationDAO.php' );

$dao = new CertificationDAO();
$certifications = $dao->getAllData();

?>