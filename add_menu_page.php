<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if (intval($_GET['editnav']==0)) {
		header("location:content.php");
   	exit();
	}
	if (isset($_POST['submit'])) {
		$error_coln = array('name','position','detail','visible');
   foreach ($error_coln as $error_name) {
   	if (!isset($_POST[$error_name])||(empty($_POST[$error_name])&&$_POST[$error_name]!=0)) {
   		$error[]=$error_name;
   } 
	}
	if (empty($error)) {
	$id=$_GET['editnav'];
	$menu_name=trim($_POST['name']);
	$position=$_POST['position'];
	$visible=$_POST['visible'];
	$content=$_POST['detail'];
	$query="INSERT INTO edit (nav_id,name,position,detail,visible) VALUES (?,?,?,?,?) ";
	$stmt=$db->prepare($query);
	$stmt->execute(array($id,$menu_name,$position,$content,$visible));
	$stmt->closeCursor();
	if ($stmt->rowcount()==1) {
		//success
		$message="The page was added successfully!!";
	}else{
		//failed
		$message1="The page was not added!!<br/>".print_r($stmt->errorInfo());
	}
	}else{
		//error occured
		if (count($error)==1) {
			$message1="There was 1 error in the form.";
		}elseif (count($error)>1) {
			$message1="There were ".count($error)." errors in the form.";
		}
		
	}

}
?>
<?php selected_page($db); ?>
<?php include("includes/header_content.php");?>
     <table id="structure">
			<tr>
				<td id="navigation">
					<?php navigation($select_page,$db); ?> 	
				</td>
				<td id="pages">
					<h2>Add page in the navigation:<?php echo urlencode($select_menu['menu_name']); ?></h2>
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
					<form action="add_menu_page.php?editnav=<?php echo urlencode($select_menu['id']); ?>" method="post">
					<p>Name: <input type="text" name="name" id="name"/></p>
						<p>Position: <select name="position" >
						<?php 
						$count_page=get_edit_page($select_menu['id'],$db);
						$sount=$count_page->rowCount();
					
						for ($i=1; $i <=$sount+1 ; $i++) { 
						echo "<option vlaue=\"$i\">$i</option>";
						} 
						?>
						
						</select> </p>
						<p>
							Content:<br/>
							<textarea name="detail" rows="20" cols="80">
							</textarea>
						</p>
						<p>Visible: 
						<input type="radio" name="visible" value="1"/>Yes
						&nbsp;
						<input type="radio" name="visible" value="0"/>No
						</p>
						 <input type="submit" name="submit" value="Add page" />
					</form><br/>
					<a href="content.php?editnav=<?php echo urlencode($select_menu['id']); ?>">Cancel</a>
				</td>
			</tr>
		</table>
<?php require("includes/footerr_i.php");?>  