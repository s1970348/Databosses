<?php
// access session
session_start(); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <?
        require_once ('meta.php');
        ?>

    <script type="text/javascript" src="fieldhider.js">
</script><!--[if !IE]><!-->
    <link rel="stylesheet" type="text/css" href=
    "../css/bookstyle2.css"><!--<![endif]-->
    <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="../css/bookstyle.css" />
<![endif]-->
    <title>
      Manage your account
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
          <?require_once('db-connect.php');
                              
          if (!isset ( $_SESSION['e-mail']) or !isset($_SESSION['password'])) {
          echo('You need to login first, redirecting to the login page..');
          echo "<BR />";
          echo "<font size='-1'>(<a href='login.php'>Or click here if you don't want to wait!</a>)</font>";
          //echo "<meta http-equiv=\"refresh\" content=\"3;login.php\">";
          } else {
              echo( date('H:i:s d-m-Y', $_SESSION['login_time']));
              echo('<br />email:'.$_SESSION['e-mail'].'<br />password:'.$_SESSION['password']);
              echo('<br /><br />GIANT FORM WITH USER OPTIONS');  
          }
          ?>
          <br>
          <input type="radio" name="e-libbut" id="e-libbut"
          onclick="visibility('e-lib')"> Id like to create my
          e-library
          <fieldset name='e-lib' id='e-lib'>
            <legend>Create my e-library</legend> create elib
            stuff here {under contruction!}<br>
            <input type="radio" name="e-libbut" id="e-libbut"
            onclick="geen_visibility('e-lib')"> hide
          </fieldset><br>
          <input type="radio" name="libbut" id="libbut" onclick=
          "visibility('cr8-lib')"> Id like to create my library
          <fieldset name='cr8-lib' id='cr8-lib'>
            <legend>Create my e-library</legend> create library
            stuff here {under contruction!}<br>
            <input type="radio" name="libbut" id="libbut"
            onclick="geen_visibility('cr8-lib')"> hide
          </fieldset><br>
          <input type="radio" name="libwindowbut" id=
          "libwindowbut" onclick="visibility('librarywindow')">
          Id like to view my library<br>
          <fieldset name="librarywindow" id="librarywindow">
            <legend>Your library</legend> 
						<?
            //query for users library
            $query= ("SELECT * FROM Catalog NATURAL JOIN Document WHERE Email = '".$_SESSION['e-mail']."' AND Password = '".$_SESSION['password']."' AND Type = 'paper'");
            $result1 = mysql_query($query) or die('library query failed:'.mysql_error());

           
            echo " < table border = 1 >" ;
            echo " <tr > < th > ISBN </ th > < th > title </ th > < th > Author </ th > < th > Year </ th > < th > Pages </ th > < th > Weight </ th > < th > Binding </ th > < th > Format </ th > < th > Location </ th > < th > Location URL </ th > < th > Rating </ th > </ tr > " ;
            while ($row = mysql_fetch_array($result1)){
            echo " <tr > < td > ". $row['ISBN'] ."</ td > " ;
            echo " <td > ". $row['Title'] ." </td> " ;
            echo " <td > ". $row['Author'] ." </td> " ;
            echo " <td > ". $row['Year'] ." </td> " ;
            echo " <td > ". $row['Pages'] ." </td> " ;
            echo " <td > ". $row['Weight'] ." </td> " ;
            echo " <td > ". $row['Binding'] ." </td> " ;
            echo " <td > ". $row['Format'] ." </td> " ;
            echo " <td > ". $row['Location'] ." </td> " ;
            echo " <td > ". $row['LocationURL'] ." </td> " ;
            echo " <td > ". $row['Rating'] ." </td> " ;
            echo "</tr>";
            }
            ?>
            <br>
            <input type="radio" name="libwindowbut" id=
            "libwindowbut" onclick=
            "geen_visibility('librarywindow')"> hide
          </fieldset><input type="radio" name="e-libwindowbut"
          id="e-libwindowbut" onclick=
          "visibility('e-librarywindow')"> Id like to view my
          e-library
          <fieldset name="e-librarywindow" id="e-librarywindow">
            <legend>Your e-library</legend> 
             <?
            require_once('db-connect.php');
            //query for users library
            $query= ("'SELECT *
            FROM Catalog
            NATURAL JOIN Document
            WHERE Email = '".$_SESSION['e-mail']."'
            AND Password = '".$_SESSION['password']."'
            AND Type = 'electronic'");
            $result = mysql_query($query) or die('library query failed:'.mysql_error());

            $row = mysql_fetch_array($result) or die('mysql_fetch_array failed:'.mysql_error());

            echo " < table border = 1 >" ;
            echo " <tr > < th > ISBN </ th > < th > title </ th > < th > Author </ th > < th > Year </ th > < th > Pages </ th > < th > Weight </ th > < th > Binding </ th > < th > Format </ th > < th > Location </ th > < th > Location URL </ th > < th > Rating </ th > </ tr > " ;
            while ($row = mysql_fetch_array($result)){
            echo " <tr > < td > ". $row['ISBN'] ."</ td > " ;
            echo " <td > ". $row['Title'] ." </td> " ;
            echo " <td > ". $row['Author'] ." </td> " ;
            echo " <td > ". $row['Year'] ." </td> " ;
            echo " <td > ". $row['Pages'] ." </td> " ;
            echo " <td > ". $row['Weight'] ." </td> " ;
            echo " <td > ". $row['Binding'] ." </td> " ;
            echo " <td > ". $row['Format'] ." </td> " ;
            echo " <td > ". $row['Location'] ." </td> " ;
            echo " <td > ". $row['LocationURL'] ." </td> " ;
            echo " <td > ". $row['Rating'] ." </td> " ;
            echo "</tr>";
            }
            mysql_close($link);
            ?>
            <br>
            <input type="radio" name="e-libwindowbut" id=
            "e-libwindowbut" onclick=
            "geen_visibility('e-librarywindow')"> hide
          </fieldset>
          <form method='post' action=
          ".%20$_SERVER['PHP_SELF']%20.">
            <fieldset>
              <legend>Settings</legend>
              <table naam='Manage' id='Manage'>
                <tr>
                  <td>
                    <input type="checkbox" name="public" value=
                    "public" checked>
                  </td>
                  <td>
                    Make your library public?
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" name="e-public" value=
                    "e-public" checked>
                  </td>
                  <td>
                    Make your e-library public?
                  </td>
                </tr>
              </table><input type='submit' name='submit' value=
              'Save changes'>
            </fieldset>
          </form>
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
          <a href="#">Sitemap</a>
        </div>
      </div>
    </div>
  </body>
</html>
