<?php
// access session
session_start(); 
?>
<!Doctype html>
<html lang="en">
<head>
<?
require_once ( 'meta.php ' );
?>
<title>Manage your settings</title>
</head>
<body>
<?
// be sure to have entered your own password and database name in logincredentials.php 

//require_once('db-connect.php');

if (!isset ( $_SESSION['e-mail']) or !isset($_SESSION['password'])) {
echo('You need to login first, redirecting to the login page..');
echo "<BR />";
echo "<font size='-1'>(<a href='login.php'>Or click here if you don't want to wait!</a>)</font>";
echo "<meta http-equiv=\"refresh\" content=\"3;login.php\">";
} else {
    echo( date('H:i:s d-m-Y', $_SESSION['login_time']));
    echo('<br />email:'.$_SESSION['e-mail'].'<br />password:'.$_SESSION['password']);
echo('<br /><br />GIANT FORM WITH USER OPTIONS');  
}
?>

<FORM METHOD="LINK" ACTION="create_library.php">
<INPUT TYPE="submit" VALUE="Create a new library">
</FORM>
<fieldset>
<legend>Your libraries</legend>
<a href="view-lib.php">library</a>
<br />
<a href="view-elib.php">e-library</a>
</fieldset>

<form method = 'post' action=". $_SERVER['PHP_SELF'] .">
<fieldset>
<legend>Settings</legend>
<table NAAM='Manage' ID='Manage'>
<tr>
<td>Make your library public?</td>
<td>
<input type="checkbox" name="public" value="public" checked>
</td>
</tr>
<tr>
<td>Make your e-library public?</td>
<td>
<input type="checkbox" name="e-public" value="e-public" checked>
</td>
</tr>
</table>
<input TYPE='submit'NAME='submit'VALUE='Save changes' />
</form>
</body>