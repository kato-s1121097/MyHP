<!--
    MyHPSessionManager.php
    MyHPSessionManagerクラスの定義
    Create: 2022/03/19(Sat)
    Update: 2022/03/19(Sat)
-->
<?php

require( 'SessionManager.php' );

class MyHPSessionManager extends SessionManager
{
    public function removeAuthData( $id = null )
    {
        parent::end();
    }
}

?>