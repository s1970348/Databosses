<?	  
$dbhost = 'localhost';
$username="root";
$password="";
$database="s1970348";

$link = mysql_connect($dbhost,$username,$password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
		}
mysql_select_db($database) or die( "Unable to select database");
?>