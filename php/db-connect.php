<?	  
$dbhost = 'localhost';
$username="s1982419";
$password="Zu0ahH2e";
$database="s1982419";

$link = mysql_connect($dbhost,$username,$password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
		}
mysql_select_db($database) or die( "Unable to select database");
?>