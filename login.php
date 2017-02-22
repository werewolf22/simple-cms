<?php include "includes/session.php";?>
<?php 
     if (isset($_SESSION['user_id'])) {
               header("location:students.php");
               exit();
     }
     if (isset($_GET['logout'])&&$_GET['logout']==1) {
          $message="You are logged out.";
     }
?>
<?php include "includes/connection.php";?>
<?php require_once("includes/functions.php");?>
<?php   $login_page=true; ?>
<?php include "includes/header_i.php"; ?>
			     <section>
					<div id="pages" >
					<div class="col1" >
                         <?php 
                         if (isset($message)) {
                              echo $message;
                         }
                    ?>
                    <h2 style="color:GRAY;">Enter your username and password.<br/></h2>
					<form name="login" action="login_process.php" method="post">
					Username: <input type="text" name="username">
                    Password: <input type="password" name="password">
                    <input type="submit" name="submit" value="Login">
                    </form>
                    </div>
                    </div>
                    </section>
<?php include("includes/footerr_i.php");?>
