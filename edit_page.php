<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if (intval($_GET['editnav'])==0) {
		header("location:content.php");
   	exit();
	}
	if (isset($_POST['submit'])) {
		$error_coln = array('menu_name','position','visible');
   foreach ($error_coln as $error_name) {
   	if (!isset($_POST[$error_name])||(empty($_POST[$error_name])&&$_POST[$error_name]!=0)) {
   		$error[]=$error_name;
   } 
	}
	if (empty($error)) {
	$id=$_GET['editnav'];
	$menu_name=trim($_POST['menu_name']);
	$position=$_POST['position'];
	$visible=$_POST['visible'];
	$query="UPDATE navigation SET menu_name=? ,position=? ,visible=? WHERE id=?";
	$stmt=$db->prepare($query);
	$stmt->execute(array($menu_name,$position,$visible,$id));
	$stmt->closeCursor();
	if ($stmt->rowCount()==1) {
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
					<ul class="pages">
					<li><a href="students.php">Return to menu</a></li>
					</ul> 	
				</td>
				<td id="pages">
					<h2>edit page:<?php echo $select_menu['menu_name'];?></h2>
					<?php 
					if (!empty($message)) {
						echo "<h3 style=\"color:blue;\">". $message ."</h3>" ;
					}
					if (!empty($message1)) {
						echo "<h3 style=\"color:red;\">". $message1 ."</h3>" ;
					}
					?>
					<form action="edit_page.php?editnav=<?php echo urlencode($select_menu['id']); ?>" method="post">
					<p>Name: <input type="text" name="menu_name" value="<?php echo $select_menu['menu_name'];?>" id="menu_name"/></p>
						<p>Position: <select name="position" >
						<?php 
						$count_menu=get_navigation($db);
						$sount=$count_menu->rowCount();
						echo "$sount";
						for ($i=1; $i <=$sount; $i++) { 
						echo "<option vlaue=\"$i\"";
						if ($select_menu['position']==$i) {
							echo" selected";
						}
						echo ">$i</option>";
						} 
						?>
						
						</select> </p>
						<p>Visible: 
						<input type="radio" name="visible" value="1"
						<?php
						if ($select_menu['visible']==1) {
							echo" checked";
						}
						?>
						/>Yes
						&nbsp;
						<input type="radio" name="visible" value="0"
						<?php
						if ($select_menu['visible']==0) {
							echo" checked";
						}
						?>
						/>No
						</p>
						 <input type="submit" name="submit" value="Edit navigation" />
						 &nbsp;&nbsp;
						 <a href="delete_subject.php?editnav=<?php echo urlencode($select_menu['id']); ?>" onclick="return confirm('Are you sure?');">Delete navigation</a>
					</form><br/>
					<a href="content.php">Cancel</a>
					<hr/>
					<h3>Pages under navigation:<?php echo $select_menu['menu_name'];?></h3>
					<ul><?php 
					     $id=$_GET['editnav'];
					   $query="SELECT * FROM `edit` WHERE `nav_id` = ? ORDER by position ASC";
					   $stmt=$db->prepare($query);
					   $stmt->execute(array($id));
					   while ($page_name=$stmt->fetch()) {
					   
					   echo "
					   <li>{$page_name["name"]}</li>
					   ";
					   }
					?></ul>
					<br/>
					<a href="add_menu_page.php?editnav=<?php echo urlencode($select_menu['id']); ?>">add new page</a>
					<br/>
				</td>
			</tr>
		</table>
<?php require("includes/footerr_i.php");?>  