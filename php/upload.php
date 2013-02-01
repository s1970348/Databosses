<?
session_start();
?>
<title>
Add new book
</title>
<script language="Javascript">
function hideA()
    {

    document.getElementById("A").style.display="none";
    document.getElementById("B").style.display="block";
    document.getElementById("C").style.display="none";
    document.getElementById("D").style.display="none"; 

    }

    function hideB()
    {
    document.getElementById("B").style.display="none";
    document.getElementById("A").style.display="block";
    document.getElementById("C").style.display="none";
    document.getElementById("D").style.display="none";
    } 

    function hideC()
    {

    document.getElementById("C").style.display="none";
    document.getElementById("D").style.display="block";


    }

    function hideD()
    {

    document.getElementById("D").style.display="none";
    document.getElementById("C").style.display="block";


    }
</script>


<?php
require_once ('db-connect.php');
if (empty($_POST['submit'])) {
    echo ("
    <form method = 'post' action=" . $_SERVER['PHP_SELF'] . "  enctype=\"multipart/form-data\">
		<h1>Add a book</h1>
		<table border=\"0\">
		<tr>
      <td>ISBN number:</td><td><input type='text' name='ISBN' size='10' maxlength='10' ></td></tr>
			<tr>
			<td>Title:</td><td><input type=
      'text' name='Title'></td></tr>
			<tr>
			<td>Author:</td><td><input type='text' name=
      'Author'></td></tr>
			<tr>
			<td>Release date (year):</td><td><input type='text' name='Year'></td></tr>
			<tr>
			<td>Total pages:</td><td><input type='text' name='Pages'></td></tr>
			<tr>
			<td>Rate your book (between 1 and 10):</td><td><input type='text' name='Rating'></td></tr>
			<tr>
      <td>Document type:</td><td><input type='radio' name='aorb' onclick=
      \"hideB()\">Paper<br><input type='radio' name='aorb'
      onclick=\"hideA()\">Electronic<td></tr></table>
			
      <table border=\"0\" style=\"display:none\" id=\"A\">
			<tr>
        <td>Weight (in grams):</td><td><input type='text' name='Weight'></td></tr>
				<tr>
        <td>Binding type:</td><td><SELECT NAME=\"Binding\">
		<OPTION>Hard cover</OPTION>
		<OPTION>Paperback</OPTION>
		</SELECT></td></tr>
				<tr>
        <td>Book location:</td><td><input type='text' name='Location'></td></tr>
				<tr>
        <td><input type='submit' name='submit' action='submit' value=\"Add book\"></td></tr>
      </table>
      <table border=\"0\" style=\"display:none\" id=\"B\">
        <tr>
				<td>Electronic book location:</td><td><input type='radio' name='aorb' onclick=
        \"hideD()\">Via website<br>
        <input type='radio' name='aorb' onclick=
        \"hideC()\">Upload book</td></tr>
				<tr>
        <td>File format:</td><td><SELECT NAME=\"Format\">
		<OPTION>PDF</OPTION>
		<OPTION>Text file</OPTION>
		<OPTION>Microsoft Word</OPTION>
		</SELECT></td></tr>
		</table>
		</FORM>
      
      <table border=\"0\" style=\"display:none\" id=\"C\">
        <tr>
				<td>URL location:</td><td><input type='text' name='LocationURL'></td></tr>
				<tr>
        <td><input type='submit' name='submit' action='submit' value=\"Add book\"></td></tr>
      </table>
      <table border=\"0\" style=\"display:none\" id=\"D\">
			<tr>
        <td>File:</td><td><input type='file' name='file' size='100'></td</tr>
				<tr>
        <td><input type='submit' name='entered' action='submit' value=\"Add book\"></td></tr>
			</table>
    </form>
");
} else {


    if (preg_match('[^A-Za-z0-9]', $_POST["ISBN"])) {
        echo "The ISBN number is not correct.";
    } else {
        if (strlen($_POST["ISBN"]) < 10) {
            echo "The ISBN number does not have the correct length , only ISBN-10 is supported";

        } else {
            $ISBN = $_POST['ISBN'];
        }
    }

    if (preg_match('[^A-Za-z0-9]', $_POST["Title"])) {
        echo "The title contains illegal characters.";
    } else {
        $Title = $_POST['Title'];
    }
    if (preg_match('[^A-Za-z]', $_POST["Author"])) {
        echo "The name of the author contains illegal characters";
    } else {
        $Author = $_POST['Author'];
    }
    if (preg_match('[^0-9]', $_POST["Year"])) {
        echo "The year is incorrect";
    } else {
        $Year = $_POST['Year'];
    }
    if (preg_match('[^0-9]', $_POST["Pages"])) {
        echo "The amound of pages entered is incorrect.";
    } else {
        $Pages = $_POST['Pages'];
    }
    if (preg_match('[^0-9]', $_POST["Rating"])) {
        echo "The rating entered contains illegal characters.";
    } else {
        $Rating = $_POST['Rating'];
    }

    if (isset($_POST['Weight'])) {

        if (preg_match('[^0-9]', $_POST["Weight"])) {
            echo "The book weight contains illegal characters.";
        } else {
            $Weight = $_POST['Weight'];
        }
        ///check if exist
        $Binding = $_POST['Binding'];

        if (preg_match('[^A-Za-z0-9]', $_POST["Location"])) {
            echo "The location entered contains invalid characters.";
        } else {
            $Location = $_POST['Location'];
        }

        $queryPaper = "INSERT INTO Document values('','" . $ISBN . "', '" . $Title .
            "', '" . $Author . "', " . $Year . ", " . $Pages . ", " . $Weight . ", '" . $Binding .
            "','', '" . $Location . "', '', " . $Rating . ", 'paper')";

        $queryexecutePaper = mysql_query($queryPaper) or die('Adding the book to the database failed :' .
            mysql_error());
		
		$Book_ID = mysql_query("select ID from Document where ISBN ='".$ISBN."' and Title ='".$Title."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$Owner_ID = mysql_query("select U_ID from User where Email = '".$_SESSION['e-mail']."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$addOwnership = mysql_query("insert into Ownership values('".$Owner_ID."', '".$Book_ID."','no',''") or die('Adding the book and owner to Ownership: ' .
            mysql_error());

    } else {

        //check if exist
        $Format = $_POST['Format'];


        if (isset($_POST['LocationURL'])) {

            if (preg_match("[^'\"`<>]", $_POST["LocationURL"])) {
                echo "The location of the URL entered contains illegal characters.";
            } else {
                $LocationURL = $_POST['LocationURL'];
            }

            $queryElectronicOnline = "INSERT INTO Document values('','" . $ISBN . "', '" . $Title .
                "', '" . $Author . "', '" . $Year . "', '" . $Pages . "', '', '', '" . $Format .
                "', '', '" . $LocationURL . "', '" . $Rating . "', ' electronic')";

            $queryexecuteElectronicOnline = mysql_query($queryElectronicOnline) or die('Adding the e-book to the database failed :' .
                mysql_error());
			
		$Book_ID = mysql_query("select ID from Document where ISBN ='".$ISBN."' and Title ='".$Title."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$Owner_ID = mysql_query("select U_ID from User where Email = '".$_SESSION['e-mail']."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$addOwnership = mysql_query("insert into Ownership values('".$Owner_ID."', '".$Book_ID."','no',''") or die('Adding the book and owner to Ownership: ' .
            mysql_error());

        } else {

            if (($_FILES["file"]["type"] == "application/msword") || ($_FILES["file"]["type"] ==
                "application/pdf") || ($_FILES["file"]["type"] == "text/plain") && ($_FILES["file"]["size"] <
                52428800)) {

                if (preg_match('[^A-Za-z0-9/.\\]', $_FILES["file"]["name"])) {
                    echo "The file contains illegal characters.";

                } else {

                    if (file_exists("siegfried.let.rug.nl/s1815911/uploads/" . $_FILES["file"]["name"])) {
                        echo $_FILES["file"]["name"] .
                            " already exists, please change the name of the file. ";
                        echo ("input type='hidden' value='1'");
                    } else {
                        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $_FILES["file"]["name"]);
                        echo "The book has been succesfully added.";
                    }
                }
            } else {

                echo "Invalid file!";

            }
        }

        $queryElectronicFile = "INSERT INTO Document values('','" . $ISBN . "', '" . $Title .
            "', '" . $Author . "', " . $Year . ", " . $Pages . ", '', '', '" . $Format .
            "', '', 'siegfried.let.rug.nl/s1815911/uploads/" . $_FILES["file"]["name"] .
            "',' " . $Rating . "' ,'electronic')";

        $queryexecuteElectronicFile = mysql_query($queryElectronicFile) or die('Adding the book to the database failed: ' .
            mysql_error());
			
		$Book_ID = mysql_query("select ID from Document where ISBN ='".$ISBN."' and Title ='".$Title."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$Owner_ID = mysql_query("select U_ID from User where Email = '".$_SESSION['e-mail']."'") or die('Searching the Book ID failed: ' .
            mysql_error());
		$addOwnership = mysql_query("insert into Ownership values('".$Owner_ID."', '".$Book_ID."','no',''") or die('Adding the book and owner to Ownership: ' .
            mysql_error());

        echo ('
        <script>
        window.opener.location.reload();
        window.close()
        </script>
        ');
    }
}

?>
