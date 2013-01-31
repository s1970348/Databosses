<?
require_once('db-connect.php');

$firstname=$_POST['Fname'];
$lastname=$_POST['Lname'];
$visibility=$_POST['Visibility'];
$email=$_POST['Email'];
$password=$_POST['Password'];
$passwordcheck=$_POST['Passwordcheck'];

if ($password != $passwordcheck) {
	 						die("<p id='error'>Passwords do not match.</p>");
                         }

$query = "INSERT INTO User VALUES ('','$firstname','$lastname','$email','$visibility','$password')";
if (!mysql_query($query))
                         {
                           die("<p id='error'>Please go back and try again.</p>");
                         }
												 
echo("<p id='center'>Registration Successful!</p>"); 

mysql_close();
?>