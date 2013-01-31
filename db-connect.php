<?php
$host='localhost';
$user='root';
$password='';
$databasename='s1970348';

$con = mysql_connect($host, $user, $password);
if (!$con)
{
				die('Initial connection to database failed: ' . mysql_error());
}

$db_selected = mysql_select_db($databasename, $con);
if (!$db_selected)
{
				die('Connection to the database succeeded, however couldnt find:'.$databasename .' error returned: ' . mysql_error());
}

/**
 * @author Jesse Veentjer
 * @copyright 2012
 */
?>