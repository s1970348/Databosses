<?
session_start();
// log session start time. 
$_SESSION['login_time']=$_SERVER["REQUEST_TIME"]+(60*60); 
?>

<!Doctype html>
<html lang="en">
<head>
<?
require_once ( 'meta.php ' );
?>
<title>Log into your databosses account!</title>
</head>
<body>
<?PHP

if (isset($_POST['submit'])) {
require_once('db-connect.php');
$query= ('"SELECT Email,password from User where Email is '.$_POST["e-mail"].'"');
$result = mysql_query($query) or die(mysql_error());

$row = mysql_fetch_array($query) or die(mysql_error());
$requested_password = $row['password'] ;
$requested_email = $row['Email'] ;


// If login data was correct then redirect to previous page else give an error

if($requested_email=$_POST['e-mail'] AND
$requested_password=$_POST['password'] ){
echo "You have been successfully logged in! Please wait and you will be redirected!";
echo "<BR />";
echo "<font size='-1'>(<a href='".$_POST['referer']."'>Or click here if you don't want to wait!</a>)</font>";
echo "<meta http-equiv=\"refresh\" content=\"3;account_management.php\">";
//store entered (correct) )email and password in session
$_SESSION['e-mail']=$requested_email;
$_SESSION['password']=$requested_password;
mysql_close($host, $user, $password);
exit();
} else {
die("E-mail or password was incorrect or not found! Please try again! <br /> Error returned: " . mysql_error());
}
}else{ 
// if no currentsession data can be found then print form to query user for login data
    echo("
<form method = 'post' action=". $_SERVER['PHP_SELF'] .">
<fieldset>
<legend>Login</legend>
<table NAAM='login' ID='login'>
<tr>
<td>E-mail:</td>
<td>
<input TYPE='text' NAME='e-mail'ID='e-mail'MAXLENGTH='50' />
</td>
</tr>
<tr>
<td>Password:</td>
<td>
<input TYPE='password'NAME='password'ID='password'MAXLENGTH='50' />
</td>
</tr>
</table>
<input TYPE='submit'NAME='submit'VALUE='submit' />
</fieldset>

<input type='hidden' name='referer' value='".$_SERVER['HTTP_REFERER']."' />

</form>"

);}
?>
</body>
</html>

