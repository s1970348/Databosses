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
      Public Library
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
          <?php include("db-connect.php"); ?>
					
					<?
					$sql = "select distinct ISBN, Title, Author, Year, Pages, Weight, Binding, Format, Location, LocationURL, Rating, Type from Document inner join Ownership on ID=Book_ID inner join User on Owner_ID=U_ID where Visibility='yes'";
$result = mysql_query($sql)or die(mysql_error()); 

echo "<table id='results'>";
while($row = mysql_fetch_array($result)){ 
$ISBN     = $row['ISBN'];
	$Title    = $row['Title'];  	
  $Author = $row['Author'];	
	$Year = $row['Year'];
	$Pages = $row['Pages'];
	$Weight = $row['Weight'];
	$Binding = $row['Binding'];
	$Format = $row['Format'];
	$Location = $row['Location'];
	$LocationURL = $row['LocationURL'];
	$Rating = $row['Rating'];
	$Type = $row['Type'];
						
					echo "<tr><td><b>ISBN:</b> $ISBN</td></tr><tr><td><b>Title:</b> $Title</td></tr><tr><td><b>Author:</b> $Author</td></tr><tr><td><b>Year:</b> $Year</td></tr><tr><td><b>Pages:</b> $Pages</td></tr><tr><td><b>Weight:</b> $Weight</td></tr><tr><td><b>Binding:</b> $Binding</td></tr><tr><td><b>Format:</b> $Format</td></tr><tr><td><b>Location:</b> $Location</td></tr><tr><td><a href=".$LocationURL.">Link to location</a></td></tr><tr><td><b>Rating:</b> $Rating</td></tr><tr><td><b>Type:</b> $Type</td></tr>";
					
								 }								 
echo "</table>";	
					
					?>
					
					
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
