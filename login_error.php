<?php include "includes/connection.php";?>
<?php   $login_page=true; ?>
<?php include "includes/header_i.php"; ?>
			     <section>
					<div id="pages" >
					<div class="col1" ><h2 style="color:RED;">Try again, either your username or password is incorrect.<br/></h2>
					<form name="login" action="login_process.php" method="post">
					Username: <input type="text" name="username">
                    Password: <input type="password" name="password">
                    <input type="submit" name="submit" value="Login">
                    </form>
                    </div>
                    </div>
                    </section>
<?php include("includes/footerr_i.php");?>
