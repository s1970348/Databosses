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
      Personal Library Space
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
          <?
					echo( $_SESSION['e-mail'] .'<br>' . $_SESSION['password']);
					?>
					<h1>Welcome to Personal Library Space.</h1>
					<p>Personal Library Space is an online library where you can not only borrow
					books, but also share them with your friends. Upload your books
					and work on your personal online library. There is also a public library
					where all the public books can be borrowed. </p>
					<p>We also have the option to upload and view e-books online. So register now
					and enjoy the benefits of our online library service.</p>
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
