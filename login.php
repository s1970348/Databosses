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
//temporary
$email = 'example@example.com';
$password = 'example';

if (isset($_POST['submit'])) {

/* SQL stuffz
$login = "SELECT * FROM users WHERE username='$username' AND password='$password' AND is_admin = '1'";
$rlogin = mysql_query($login);
$row = mysql_fetch_array($rlogin);
if($row) {
$_SESSION['user'] = $username;
$_SESSION['pass'] = $password;
ob_end_clean();
*/
// If login data was correct then redirect to previous page else give an error
if($email=$_POST['e-mail'] AND
$password=$_POST['password'] ){
echo "You have been successfully logged in! Please wait and you will be redirected!";
echo "<BR />";
echo "<font size='-1'>(<a href='".$_POST['referer']."'>Or click here if you don't want to wait!</a>)</font>";
echo "<meta http-equiv=\"refresh\" content=\"3;account_management.php\">";
//store entered (correct) )email and password in session
$_SESSION['e-mail']=$email;
$_SESSION['password']=$password;

exit();
} else {
die("Username or password was incorrect! Please try again!" . mysql_error());
}
}else{ 
// if no currentsession data can be found then print form to query user for data
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
/*
echo($_POST['e-mail'] .'AND PW:'. $_POST['password']);
echo ('<br />');
echo($email .' = email PRESET AND preset PW:'. $password);
*/
?>

</body>
</html>

