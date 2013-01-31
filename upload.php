<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>
      Nieuw boek toevoegen
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
  </head>
  <body>
    <?php
    require_once('dbconnect.php');
    ?>
    <form method='post' enctype="multipart/form-data">
		<h1>Add a book</h1>
		<table border="0">
		<tr>
      <td>ISBN number:</td><td><input type='text' name='ISBN'></td></tr>
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
      "hideB()">Paper<br><input type='radio' name='aorb'
      onclick="hideA()">Electronic<td></tr></table>
			
      <table border="0" style="display:none" id="A">
			<tr>
        <td>Weight (in grams):</td><td><input type='text' name='Weight'></td></tr>
				<tr>
        <td>Binding type:</td><td><input type='text' name='Binding'></td></tr>
				<tr>
        <td>Book location:</td><td><input type='text' name='Location'></td></tr>
				<tr>
        <td><input type='submit' name='submit' action='submit' value="Add book"></td></tr>
      </table>
      <table border="0" style="display:none" id="B">
        <tr>
				<td>Electronic book location:</td><td><input type='radio' name='aorb' onclick=
        "hideD()">Via website<br>
        <input type='radio' name='aorb' onclick=
        "hideC()">Upload book</td></tr>
				<tr>
        <td>File format:</td><td><input type='text' name='Format'></td></tr>
      </table>
      <table border="0" style="display:none" id="C">
        <tr>
				<td>URL location:</td><td><input type='text' name='LocationURL'></td></tr>
				<tr>
        <td><input type='submit' name='submit' action='submit' value="Add book"></td></tr>
      </table>
      <table border="0" style="display:none" id="D">
			<tr>
        <td>File:</td><td><input type='file' name='file' size='100'></td</tr>
				<tr>
        <td><input type='submit' name='submit' action='submit' value="Add book"></td></tr>
			</table>
    </form>
<?php

$ISBN = $_POST['ISBN'];
$Title = $_POST['Title'];
$Author = $_POST['Author'];
$Year = $_POST['Year'];
$Pages = $_POST['Pages'];
$Rating = $_POST['Rating'];

if(isset($_POST['Weight'])) {

$Weight = $_POST['Weight'];
$Binding = $_POST['Binding'];
$Location = $_POST['Location'];

$queryPaper=("INSERT INTO Document values('',".$ISBN.", ".$Title.", ".$Author.", ".$Year.", ".$Pages.", ".$Weight.", ".$Binding.",'', ".$Location.", '', ".$Rating.", paper);
} else {

$Format = $_POST['Format'];

if(isset($_POST['LocationURL'])) {

$LocationURL = $_POST['LocationURL'];

$queryElectronicOnline=("INSERT INTO Document values('',".$ISBN.", ".$Title.", ".$Author.", ".$Year.", ".$Pages.", '', '', ".$Format.", '', ".$LocationURL.", ".$Rating.", electronic);

} else {

if (file_exists("siegfried.let.rug.nl/s1815911/uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " bestaat al, verzin een andere naam. ";
			echo (input type='hidden' value='1');
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../uploads/" . $_FILES["file"]["name"]);
      echo "Uw bestand is succesvol geüpload.";
      }

$queryElectronicFile=("INSERT INTO Document values('',".$ISBN.", ".$Title.", ".$Author.", ".$Year.", ".$Pages.", '', '', ".$Format.", '', siegfried.let.rug.nl/s1815911/uploads/".$_FILES["file"]["name"].", ".$Rating.", electronic);


?>
  </body>
</html>
