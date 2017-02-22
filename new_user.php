<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(isset($_POST['submit'])){
		$error_coln = array('username','password');
   foreach ($error_coln as $error_name) {
   	if (!isset($_POST[$error_name])||(empty($_POST[$error_name])&&$_POST[$error_name]!=0)) {
   		$error[]=$error_name;
   } 
	}
	if (empty($error)) {
	$name = trim($_POST['username']);
	$pass= md5(trim($_POST['password']));


	$sql = "INSERT INTO tbl_user  (name, password, status) VALUES (?, ?,1)  ";
	$stmt = $db->prepare($sql);
		if ($stmt->execute(array($name,$pass))) {
		//success
			$stmt->closeCursor();
		$message="New user is added!!";
	}else{
		//failed
		$message1="Could not add the user!!<br/>".print_r($stmt->errorInfo());
	}
	}else{
		//error occured
		if (count($error)==1) {
			$message1="There was 1 error in the form.";
		}elseif (count($error)>1) {
			$message1="There were ".count($error)." errors in the form.";
		}
		
	}
}else{
	$name="";
	$pass="";
}
?>
<?php include("includes/header.php");?>
     <table id="structure">
			<tr>
				<td id="navigation">
					<ul class="pages">
					<li><a href="students.php">Return to menu</a></li>
					</ul>
				</td>
				<td id="pages">
					<?php 
					if (!empty($message)) {
						echo "<h3 style=\"color:blue;\">". $message ."</h3>" ;
					}
					if (!empty($message1)) {
						echo "<h3 style=\"color:red;\">". $message1 ."</h3>" ;
						foreach ($error as $errors) {
							echo "<br/> {$errors} ";
						}
					}
					?>
				<p><h2>Add new user</h2></p>
				<form method="post" action="new_user.php">
	  				Username: <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($name)?>"><br/>
					Password: <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($pass)?>"><br/>
					<input type="submit" name="submit" value="Create user" style="align:centre;">		
				</form>
				</tr>
		</table>
<?php include("includes/footer.php");?>