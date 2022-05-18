<?php

if ( isset( $_POST['plain'] ) )
{
    echo htmlspecialchars( $_POST['plain'] ) . " => " . hash( "sha256", "hashsalt" . $_POST['plain'] );
}

?>

<form action="hash.php" method="post">
    <input name="plain">
    <input type="submit" value="変換">
</form>