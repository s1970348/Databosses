<?PHP
                                                  //temporary
                                                  if (isset($_POST['submit'])) {
                                                  require_once('db-connect.php');
																									echo($_POST['e-mail']);
                                                  $query= ("SELECT Email,Password from User where Email = '".$_POST["e-mail"] ."'");
                                                  $result = mysql_query($query) or die('result opslaan faalt'.mysql_error());

                                                  $row = mysql_fetch_array($result) or die('fetcharray faalt'.mysql_error());
                                                  $requested_password = $row['Password'] ;
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
                                                  exit();
                                                  } else {
                                                  die("E-mail or password was incorrect or not found! Please try again! <br /> Error returned: " . mysql_error());
                                                  }
                                                  }else{ 
                                                  // if no currentsession data can be found then print form to query user for login data
                                                      echo("
                                                  <form method = 'post' action=". $_SERVER['PHP_SELF'] .">
                                                  <fieldset>
                                                  <legend><h3>Login</h3></legend>
                                                  <table NAAM='login' ID='login'>
                                                  <tr>
                                                  E-mail:
                                                  </tr>
                                                  <tr>
                                                  <input TYPE='text' NAME='e-mail'ID='e-mail'MAXLENGTH='50' />
                                                  </tr>
                                                  </tr>
                                                  <tr>
                                                  Password:
                                                  </tr>
                                                  <tr>
                                                  <input TYPE='password'NAME='password'ID='password'MAXLENGTH='50' />
                                                  </tr>
                                                  </table>
                                                  <input TYPE='submit'NAME='submit'VALUE='submit' />
                                                  </fieldset>

                                                  <input type='hidden' name='referer' value='".$_SERVER['HTTP_REFERER']."' />

                                                  </form>"

                                                  );}
                                                  ?>