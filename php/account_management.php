
<!Doctype html>
<html lang="en">
<head>
<?
require_once ('meta.php ');
?>
<script TYPE="text/javascript" SRC="fieldhider.js"></script>
<link rel="stylesheet" href="css.css" type="text/css" media="screen"/>
<title>Manage your settings</title>
</head>
<body>
<?
// be sure to have entered your own password and database name in logincredentials.php

require_once ('db-connect.php');

if (!isset($_SESSION['e-mail']) or !isset($_SESSION['password'])) {
    echo ('You need to login first, redirecting to the login page..');
    echo "<BR />";
    echo "<font size='-1'>(<a href='index.php'>Or click here if you don't want to wait!</a>)</font>";
    //echo "<meta http-equiv=\"refresh\" content=\"3;index.php\">";
} else {
    echo ('Welcome,' . $_SESSION['e-mail'] . '.<br /> you logged in at ' . date('H:i:s d-m-Y',
        $_SESSION['login_time']));
    $visiquery = 'SELECT `Visibility` FROM `user` WHERE Email = "' . $_SESSION['e-mail'] .
        '"';
    $visiqueryresult = mysql_query($visiquery) or die('Requesting visible query failed' .
        mysql_error());
    $visiqueryresult_row = mysql_fetch_array($visiqueryresult) or die('Translating vision query failed' .
        mysql_error());

    if (isset($_POST['yesnopublic'])) {

        if ($visiqueryresult_row['Visibility'] != $_POST['yesnopublic']) {
            #update db
            echo ('<br /><br /> Library visibility has been updated!');
            $updatevisionquery = "UPDATE `user` SET `Visibility` = '" . $_POST['yesnopublic'] .
                "' WHERE `Email` = '" . $_SESSION['e-mail'] . "'";
            mysql_query($updatevisionquery) or die('Updating visibility failed ' .
                mysql_error());

        }
    }


    $libraryquery = ('SELECT distinct ISBN,Title,Author,Year,Pages,weight,binding,location,rating,Type,Email ,Book_ID, U_ID
from Document
inner join Ownership
on ID=Book_ID
inner join User
on Owner_ID=U_ID
where Type = "paper" and Email = "' . $_SESSION['e-mail'] . '"
');
    $libraryresult = mysql_query($libraryquery) or die('Requesting library failed' .
        mysql_error());
    $elibraryquery = ('SELECT distinct ISBN,Title,Author,Year,Pages,format,locationURL,rating,Type,Email ,Book_ID, U_ID
from Document
inner join Ownership
on ID=Book_ID
inner join User
on Owner_ID=U_ID
where Type = "electronic" and Email = "' . $_SESSION['e-mail'] . '"
');
    $elibraryresult = mysql_query($elibraryquery) or die('Requesting e-library failed' .
        mysql_error());

    echo ("<br />

<input type='submit' onClick=\"window.open('upload.php','mywindow','width=500,height=500,toolbar=no,location=no,directories=no,statu s=no,menubar=no,scrollbars=no,copyhistory=no,resizable=no')\" value='add book to library'/>


<br /><input TYPE=\"radio\"NAME=\"e-libbut\"ID=\"e-libbut\"ONCLICK=\"visibility('e-lib')\"/> 
Id like to view my library
<fieldset NAME='e-lib' ID='e-lib' style=\"display:none\">
<legend>View my library</legend>
<!--  Library view
--!>
<table id='library' border='1'>
<tr><th> ISBN </th> <th> Title </th> <th> Author </th> <th> Pages </th> <th> Year </th> <th> weight </th> <th> binding </th> <th> rating </th> <th> Remove </th> </tr>

");
    while ($row = mysql_fetch_array($libraryresult)) {
        echo ('<tr>');
        echo ('<td>' . $row['ISBN'] . '</td>');
        echo ('<td>' . $row['Title'] . '</td>');
        echo ('<td>' . $row['Author'] . '</td>');
        echo ('<td>' . $row['Pages'] . '</td>');
        echo ('<td>' . $row['Year'] . '</td>');
        echo ('<td>' . $row['weight'] . '</td>');
        echo ('<td>' . $row['binding'] . '</td>');
        echo ('<td>' . $row['rating'] . '</td>');
        //removebuttan
        echo ("<td> <input type='submit' onClick=\"window.open('delete.php?userid=" . $row['U_ID'] .
            "&bookid=" . $row['Book_ID'] .
            " ','mywindow','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,copyhistory=no,resizable=no')\" value=' X '/> </td>");
        echo ('</tr>');
    }
    echo ("

</table>
<br />               
<input TYPE=\"radio\"
NAME=\"e-libbut\"
ID=\"e-libbut\"
ONCLICK=\"geen_visibility('e-lib')\"
/> hide
</fieldset>

<br />
<input TYPE=\"radio\"NAME=\"libbut\"ID=\"libbut\"ONCLICK=\"visibility('lib')\"/> 
Id like to view my e-library
<fieldset NAME='lib' ID='lib' style=\"display:none\">
<legend> View my e-library</legend>

<table id='elibrary' border='1'>
<tr><th> ISBN </th> <th> Title </th> <th> Author </th> <th> Pages </th> <th> Year </th> <th> View </th> <th> Rating </th> <th> Remove </th> </tr>

");
    while ($row1 = mysql_fetch_array($elibraryresult)) {
        echo ('<tr>');
        echo ('<td>' . $row1['ISBN'] . '</td>');
        echo ('<td>' . $row1['Title'] . '</td>');
        echo ('<td>' . $row1['Author'] . '</td>');
        echo ('<td>' . $row1['Pages'] . '</td>');
        echo ('<td>' . $row1['Year'] . '</td>');
        echo ('<td> <a href="' . $row1['locationURL'] . '" target =\'_blank\'> View book </a> </td>');
        echo ('<td>' . $row1['rating'] . '</td>');
        echo ("<td> <input type='submit' onClick=\"window.open('delete.php?userid=" . $row1['U_ID'] .
            "&bookid=" . $row1['Book_ID'] .
            " ','mywindow','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,copyhistory=no,resizable=no')\" value=' X '/> </td>");
        echo ('</tr>');
    }
    echo ("

</table>

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
<form method = 'post' action=" . $_SERVER['PHP_SELF'] . ">
<tr> Your library is currently 
");
    if (isset($_POST['yesnopublic'])) {
        if ($_POST['yesnopublic'] == 'no') {
            echo ('<b>not</b>');
        }

    } elseif ($visiqueryresult_row['Visibility'] == 'no') {
        echo ('<b>not</b>');
    }
    echo (" visible to others</tr><br /><br />
<tr> Make your library public?</tr>
<tr><td>
<input type=\"radio\" name=\"yesnopublic\" value=\"yes\" >
</td><td>yes</td>
</tr>
<tr>
<td><input type=\"radio\" name=\"yesnopublic\" value=\"no\" ></td>
<td>no</td>
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