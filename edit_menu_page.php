<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if (intval($_GET['editpage'])==0) {
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
	$id=$_GET['editpage'];
	$menu_name=trim($_POST['name']);
	$position=$_POST['position'];
	$visible=$_POST['visible'];
	$content=$_POST['detail'];
	$query="UPDATE edit SET name=?,position=?,detail=?,visible=? WHERE id=?";
	$stmt=$db->prepare($query);
	$stmt->execute(array($menu_name,$position,$content,$visible,$id));
	if ($stmt->rowcount()==1) {
		//success
		$message="The update was successful!!";
	}else{
		//failed
		$message1="The update was unsuccessful!!<br/>".print_r($stmt->errorInfo());
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
					<h2>edit page:<?php echo $select_page['name'];?></h2>
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
					<form action="edit_menu_page.php?editpage=<?php echo urlencode($select_page['id']); ?>" method="post">
					<p>Name: <input type="text" name="name" value="<?php echo $select_page['name'];?>" id="name"/></p>
						<p>Position: <select name="position" >
						<?php 
						$count_page=get_edit_page($select_page['nav_id'],$db);
						$sount=$count_page->rowCount();
						for ($i=1; $i <=$sount ; $i++) { 
						echo "<option vlaue=\"$i\"";
						if ($select_page['position']==$i) {
							echo" selected";
						}
						echo ">$i</option>";
						} 
						?>
						
						</select> </p>
						<p>
							Content:<br/>
							<textarea name="detail" rows="20" cols="80">  <?php echo $select_page['detail'];?></textarea>
						</p>
						<p>Visible: 
						<input type="radio" name="visible" value="1"
						<?php
						if ($select_page['visible']==1) {
							echo" checked";
						}
						?>
						/>Yes
						&nbsp;
						<input type="radio" name="visible" value="0"
						<?php
						if ($select_page['visible']==0) {
							echo" checked";
						}
						?>
						/>No
						</p>
						 <input type="submit" name="submit" value="Update page" />
						 &nbsp;&nbsp;
						 <a href="delete_page.php?editpage=<?php echo urlencode($select_page['id']); ?>" onclick="return confirm('Are you sure?');">Delete page</a>
					</form><br/>
					<a href="content.php?page=<?php echo urlencode($select_page['id']); ?>">Cancel</a>
				</td>
			</tr>
		</table>
<?php require("includes/footerr_i.php");?>  