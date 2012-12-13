<?php
require_once('logincredentials.php');

$link = mysql_connect($host, $user, $password);
if (!$link)
{
				die('Initial connection to database failed: ' . mysql_error());
}

$db_selected = mysql_select_db($databasename, $link);
if (!$db_selected)
{
				die('Connection to the database succeeded, however couldnt find:'.$databasename .' error returned: ' . mysql_error());
}
/**
 * @author Jesse Veentjer
 * @copyright 2012
 */
?>