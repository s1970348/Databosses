
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
<script TYPE="text/javascript"
      SRC="fieldhider.js"></script>

<link rel="stylesheet" href="css.css" type="text/css" media="screen"/>
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
//echo "<meta http-equiv=\"refresh\" content=\"3;login.php\">";
} else {
    echo( date('H:i:s d-m-Y', $_SESSION['login_time']));
    echo('<br />email:'.$_SESSION['e-mail'].'<br />password:'.$_SESSION['password']);
    echo('<br /><br />GIANT FORM WITH USER OPTIONS');  
}
?>
<br />
<input TYPE="radio"NAME="e-libbut"ID="e-libbut"ONCLICK="visibility('e-lib')"/> 
Id like to create my e-library
<fieldset NAME='e-lib' ID='e-lib'>
<legend>Create my e-library</legend>
create elib stuff here {under contruction!}
<br />               
<input TYPE="radio"
NAME="e-libbut"
ID="e-libbut"
ONCLICK="geen_visibility('e-lib')"
/> hide
</fieldset>
<br />
<input TYPE="radio"NAME="libbut"ID="libbut"ONCLICK="visibility('cr8-lib')"/> 
Id like to create my library
<fieldset NAME='cr8-lib' ID='cr8-lib'>
<legend>Create my e-library</legend> 
create library stuff here  {under contruction!}
<br />                  
<input TYPE="radio"
NAME="libbut"
ID="libbut"
ONCLICK="geen_visibility('cr8-lib')"
/> hide
</fieldset>
<br />
<input TYPE="radio"NAME="libwindowbut"ID="libwindowbut"ONCLICK="visibility('librarywindow')"/> 
Id like to view my library
<br />
<fieldset name="librarywindow" id="librarywindow">
<legend>Your library</legend>
<? 
echo('You do not have a library yet');
?>
<br />
<input TYPE="radio"NAME="libwindowbut"ID="libwindowbut"ONCLICK="geen_visibility('librarywindow')"/> hide
</fieldset>
<input TYPE="radio"NAME="e-libwindowbut"ID="e-libwindowbut"ONCLICK="visibility('e-librarywindow')"/> 
Id like to view my e-library
<fieldset name="e-librarywindow" id="e-librarywindow">
<legend>Your e-library</legend>
<? 
echo('You do not have an e-library yet');
?>
<br />
<input TYPE="radio"NAME="e-libwindowbut"ID="e-libwindowbut"ONCLICK="geen_visibility('e-librarywindow')"/> hide
</fieldset>

<form method = 'post' action=". $_SERVER['PHP_SELF'] .">
<fieldset>
<legend>Settings</legend>
<table NAAM='Manage' ID='Manage'>
<tr>
<td>
<input type="checkbox" name="public" value="public" checked>
</td>
<td>Make your library public?</td>
</tr>
<tr>
<td><input type="checkbox" name="e-public" value="e-public" checked></td>
<td>Make your e-library public?</td>
</tr>
</table>
<input TYPE='submit'NAME='submit'VALUE='Save changes' />
</form>
</body>