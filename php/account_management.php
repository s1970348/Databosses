
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

require_once('db-connect.php');

if (!isset ( $_SESSION['e-mail']) or !isset($_SESSION['password'])) {
echo('You need to login first, redirecting to the login page..');
echo "<BR />";
echo "<font size='-1'>(<a href='login.php'>Or click here if you don't want to wait!</a>)</font>";
//echo "<meta http-equiv=\"refresh\" content=\"3;login.php\">";
} else {
    echo( date('H:i:s d-m-Y', $_SESSION['login_time']));
    echo('<br />email:'.$_SESSION['e-mail'].'<br />password:'.$_SESSION['password']);
    $libraryquery = ('SELECT PIE');
    $libraryresult = mysql_query($libraryquery) or die ('Requesting library failed' . mysql_error());
    
     $query4 = ('SELECT * FROM  `halloffame` WHERE 1 ORDER BY  `RightAnswers` DESC LIMIT 5');
        $halloffame = mysql_query($query4) or die('Requesting of hall of fame failed' .
            mysql_error());
        echo ('<table border="1"><tr><td>User</td><td>#correct</td></tr>');
        while ($row = mysql_fetch_array($halloffame)) {
            echo ('<tr>');
            echo ('<td>' . $row['username'] . '</td>');
            echo ('<td>' . $row['RightAnswers'] . '</td>');
            echo ('<tr>');
        }
    $elibraryquery = ('SELECT ePIE');
    $elibraryresult = mysql_query($elibraryquery) or die ('Requesting e-library failed' . mysql_error());
    
    echo("<br />
    
<input type='submit' onClick=\"window.open('test.php','mywindow','width=400,height=200,toolbar=no,location=no,directories=no,statu s=no,menubar=no,scrollbars=no,copyhistory=no,resizable=no')\" value='add book to library'/>


<br /><input TYPE=\"radio\"NAME=\"e-libbut\"ID=\"e-libbut\"ONCLICK=\"visibility('e-lib')\"/> 
Id like to view my library
<fieldset NAME='e-lib' ID='e-lib' style=\"display:none\">
<legend>View my library</legend>
<!--  Library view
--!>


<br />               
<input TYPE=\"radio\"
NAME=\"e-libbut\"
ID=\"e-libbut\"
ONCLICK=\"geen_visibility('e-lib')\"
/> hide
</fieldset>
<!--  E-Library view
--!>

<br />
<input TYPE=\"radio\"NAME=\"libbut\"ID=\"libbut\"ONCLICK=\"visibility('lib')\"/> 
Id like to view my e-library
<fieldset NAME='lib' ID='lib' style=\"display:none\">
<legend> my library</legend>
elib stuff here {under contruction!}
<br />               
<input TYPE=\"radio\"
NAME=\"libbut\"
ID=\"libbut\"
ONCLICK=\"geen_visibility('lib')\"
/> hide
</fieldset>
<br />

<input TYPE=\"radio\"
NAME=\"publicbut\"
ID=\"publicbut\"
ONCLICK=\"visibility('publicfield')\"
/> Id like to set my privacy settings

<fieldset name=\"publicfield\" id=\"publicfield\" style=\"display:none\" >
<legend>Settings</legend>
<table NAAM='Manage' ID='Manage'>
<form method = 'post' action=". $_SERVER['PHP_SELF'] .">
<tr>
<td>
<input type=\"checkbox\" name=\"public\" value=\"public\" checked>
</td>
<td>Make your library public?</td>
</tr>
<tr>
<td><input type=\"checkbox\" name=\"e-public\" value=\"e-public\" checked></td>
<td>Make your e-library public?</td>
</tr>
</table>
<input TYPE='submit'NAME='submit'VALUE='Save changes' />
</form>
<br />
<input TYPE=\"radio\" NAME='publicbut' ID=\"publicbut\" ONCLICK=\"geen_visibility('publicfield')\" /> hide
</fieldset>


");  
}
?>

</body>