<?
session_start();
// log session start time. 
$_SESSION['login_time']=$_SERVER["REQUEST_TIME"]+(60*60); 
?>
<?
$name = $_POST['name'];//Haal variabelen uit form
$shout = $_POST['shout'];
$datfile = "shout.txt";
$datfile2 = "shoutmini.txt";
$MAX_LENGTH = 51; //Max lengte berichten
$NUM_COMMENTS = 20; //Max aantal berichten op pagina
if (!$name)
{ $name = "Anoniem"; } //"Anoniem" verschijnt indien er geen naam is ingevuld
else $name .= ":";

$shout = preg_replace("/</","&lt;",$shout);
$shout = preg_replace("/>/","&gt;",$shout); 

$comfile = file($datfile);
if ($shout != "") {
if (strlen($shout) < $MAX_LENGTH) {
$fd = fopen ($datfile, "w");
$shout = stripslashes($shout);
$date_time = date('d-m-Y/H:i:s'); //Datum/Tijd invoeren
$space = "&nbsp;&nbsp;&nbsp;";
fwrite ($fd, "<br><b>$name</b>$space<i>$date_time</i>:<br><br> $shout<br><br><hr />");
for ($i = 0; $i < $NUM_COMMENTS; $i++) {
fwrite ($fd, $comfile[$i]);
}
}
fclose($fd);
}

$comfile = file($datfile2);
if ($shout != "") {
if (strlen($shout) < $MAX_LENGTH) {
$fd = fopen ($datfile2, "w");
$shout = stripslashes($shout);
$datetime = date('d-m-Y/H:i:s'); //Datum/Tijd invoeren
$space = "&nbsp;&nbsp;&nbsp;";
fwrite ($fd, "<b>$name</b>&nbsp;<i>$datetime</i><br>$shout<br>---------------<br>");
for ($i = 0; $i < $NUM_COMMENTS; $i++) {
fwrite ($fd, $comfile[$i]);
}
}
fclose($fd);


}
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
      Shoutbox
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
				Klik <a href="shout.php">hier</a> om ook een
          bericht te plaatsen.<br>
         <?php include("shout.txt"); ?>
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
