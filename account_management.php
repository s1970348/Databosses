
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
<script TYPE="text/javascript" SRC="fieldhider.js"></script>

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
require_once('db-connect.php');
//query for users library
$query= ('select ISBN,Title,Author,Year,Pages,Weight,Binding,Format,Location,LocationURL,Rating from Document
where ISBN IS NOT NULL
and Title IS NOT NULL
and Author IS NOT NULL
and Year IS NOT NULL
and Pages IS NOT NULL
and Weight IS NOT NULL
and Binding IS NOT NULL
and Format IS NOT NULL
and Location IS NOT NULL
and LocationURL IS NOT NULL
and Rating IS NOT NULL');
$result = mysql_query($query) or die('library query failed:'.mysql_error());

$row = mysql_fetch_array($query) or die('mysql_fetch_array failed:'.mysql_error());

echo " < table border = 1 >" ;
echo " <tr > < th > ISBN </ th > < th > title </ th > < th > Author </ th > < th > Year </ th > < th > Pages </ th > < th > Weight </ th > < th > Binding </ th > < th > Format </ th > < th > Location </ th > < th > Location URL </ th > < th > Rating </ th > </ tr > " ;
while ( $row = $qh -> fetchRow ( DB_FETCHMODE_ASSOC )) {
echo " <tr > < td > ". $row['ISBN'] ."</ td > " ;
echo " <td > ". $row['Title'] ." </td> " ;
echo " <td > ". $row['Author'] ." </td> " ;
echo " <td > ". $row['Year'] ." </td> " ;
echo " <td > ". $row['Pages'] ." </td> " ;
echo " <td > ". $row['Weight'] ." </td> " ;
echo " <td > ". $row['Binding'] ." </td> " ;
echo " <td > ". $row['Format'] ." </td> " ;
echo " <td > ". $row['Location'] ." </td> " ;
echo " <td > ". $row['LocationURL'] ." </td> " ;
echo " <td > ". $row['Rating'] ." </td> " ;
echo "</tr>";
}
mysql_close($host, $user, $password);
?>

<br />
<input TYPE="radio"NAME="libwindowbut"ID="libwindowbut"ONCLICK="geen_visibility('librarywindow')"/> hide
</fieldset>
<input TYPE="radio"NAME="e-libwindowbut"ID="e-libwindowbut"ONCLICK="visibility('e-librarywindow')"/> 
Id like to view my e-library
<fieldset name="e-librarywindow" id="e-librarywindow">
<legend>Your e-library</legend>
<? 
echo('You do not have an e-library yet <br />');
?>


<?
require_once('db-connect.php');
//query for users library
$query= ('select ISBN,Title,Author,Year,Pages,Weight,Binding,Format,Location,LocationURL,Rating from Document
where ISBN IS NOT NULL
and Title IS NOT NULL
and Author IS NOT NULL
and Year IS NOT NULL
and Pages IS NOT NULL
and Weight IS NOT NULL
and Binding IS NOT NULL
and Format IS NOT NULL
and Location IS NOT NULL
and LocationURL IS NOT NULL
and Rating IS NOT NULL');
$result = mysql_query($query) or die('library query failed:'.mysql_error());

$row = mysql_fetch_array($query) or die('mysql_fetch_array failed:'.mysql_error());

echo " < table border = 1 >" ;
echo " <tr > < th > ISBN </ th > < th > title </ th > < th > Author </ th > < th > Year </ th > < th > Pages </ th > < th > Weight </ th > < th > Binding </ th > < th > Format </ th > < th > Location </ th > < th > Location URL </ th > < th > Rating </ th > </ tr > " ;
while ( $row = $qh -> fetchRow ( DB_FETCHMODE_ASSOC )) {
echo " <tr > < td > ". $row['ISBN'] ."</ td > " ;
echo " <td > ". $row['Title'] ." </td> " ;
echo " <td > ". $row['Author'] ." </td> " ;
echo " <td > ". $row['Year'] ." </td> " ;
echo " <td > ". $row['Pages'] ." </td> " ;
echo " <td > ". $row['Weight'] ." </td> " ;
echo " <td > ". $row['Binding'] ." </td> " ;
echo " <td > ". $row['Format'] ." </td> " ;
echo " <td > ". $row['Location'] ." </td> " ;
echo " <td > ". $row['LocationURL'] ." </td> " ;
echo " <td > ". $row['Rating'] ." </td> " ;
echo "</tr>";
}
mysql_close($host, $user, $password);
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