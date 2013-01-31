<?
session_start();
// log session start time. 
$_SESSION['login_time']=$_SERVER["REQUEST_TIME"]+(60*60); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <?
                    require_once ('meta.php');
                    ?>
    <!--[if !IE]><!-->
    <link rel="stylesheet" type="text/css" href=
    "../css/bookstyle2.css"><!--<![endif]-->
    <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="../css/bookstyle.css" />
<![endif]-->
    <title>
      register
    </title>
  </head>
  <body class="normal">
    <div class="container">
      <div class="banner"></div>
      <?php include("menu.php"); ?>
				<?if (isset ( $_SESSION['e-mail']) or isset($_SESSION['password'])) {
				echo(' <tr><td><a href="account_management.php">Account</a></td></tr> ');
				}?>
      </table>
      <div class="textwrapper">
        <div class="text">
          <form action="insert.php" enctype=
          "multipart/form-data" method="post">
            First Name:<br>
            <input type="text" name="Fname"><br>
            <br>
            Last Name:<br>
            <input type="text" name="Lname"><br>
            <br>
            Do you want your books to be visible for other users? yes/no<br>
            <input type="text" name="Visibility"><br>
            <br>
            E-mail:<br>
            <input type="text" name="Email"><br>
            <br>
            Choose a password:<br>
            <input type='password' name="Password"><br>
            <br>
						Type password again:<br>
            <input type='password' name="Passwordcheck"><br>
            <br>
            <input type="Submit" value="Register now!">
          </form>
        </div>
        <div class="login">
          <?php include("login.php"); ?>
          </div>
        <div class="shoutbox">
          <h3>
            Shoutbox
          </h3><?php include("shoutmini.txt"); ?>
        </div>
        <div class="news">
          <h3>
            News
          </h3>This is the box where newsitems will be displayed
          when the site is done.
        </div>
        <div class="footer">
          <br>
          <p>
            <a href="#">Sitemap</a>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
