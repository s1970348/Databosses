<?php
session_start();
include ('db-connect.php');
if (!isset($_SESSION['e-mail']) or !isset($_SESSION['password'])) {
    echo ('You need to login first, redirecting to the login page..');
    echo "<BR />";
    echo "<font size='-1'>(<a href='login.php'>Or click here if you don't want to wait!</a>)</font>";
    //echo "<meta http-equiv=\"refresh\" content=\"3;index.php\">";
} else {
    if ($_GET['userid'] != "" ) {
        $userID = $_GET['userid'];
        $bookID = $_GET['bookid'];
        $sql = 'delete from Ownership where Owner_ID = '.$userID . ' and Book_ID = "'.$bookID.'"';
        mysql_query($sql) or die('Deleting failed ' .mysql_error());
        echo("
        <script>
        window.opener.location.reload();
        window.close()
        </script>
        ");
    }else{
        echo('Deleting the book did not succeed, anarchy and chaos is upon us!');
    }
}

?>

