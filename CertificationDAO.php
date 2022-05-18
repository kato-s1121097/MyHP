<?php
/**********************
* CertificationDAO.php
* Create: 2022/04/09(Sat)
* Update: 2022/04/09(Sat)
************************/

require_once( 'DAO.php' );
require_once( 'Certification.php' );

class CertificationDAO extends DAO
{
    public function getAllData()
    {
        $sql = 'SELECT * FROM certifications ORDER BY got_on ASC';
        $result = $this->dbh->query( $sql );
        if ( $result )
        {
            $certifications = array();

            foreach ( $result as $certification )
            {
                $certifications []= new Certification( $certification['got_on'], $certification['name'] );
            }

            return $certifications;
        }
        else
        {
            print 'Certificationsデータの取得に失敗.<br/>';
            return array();
        }
    }
}

?>