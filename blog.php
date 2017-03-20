<?php require_once("includes/connection.php");?>
<?php include_once 'includes/functions.inc.php';?>
<?php require_once("includes/functions.php");?>
<?php
if(isset($_GET['id'])){
		$edit=true;
	}else{$edit=false;}
	if (isset($_POST['submit'])) {
		$error_coln = array('title','entry');
   foreach ($error_coln as $error_name) {
   	if (!isset($_POST[$error_name])||empty($_POST[$error_name])) {
   		$error[]=$error_name;
   } 
	}
	if (empty($error)) {
	$id=$_GET['id'];
	$title=trim($_POST['title']);
	$entry=$_POST['entry'];
	$query="UPDATE entries SET title=? ,entry=?  WHERE id=?";
	$stmt=$db->prepare($query);
	$stmt->execute(array($title,$entry,$id));
	$stmt->closeCursor();
	if ($stmt->rowCount()==1) {
		//success
		$message="The update was successful!!";
	}else{
		//failed
		if ($stmt->errorInfo()) {

		$message1="The update was unsuccessful!!<br/>".print_r($stmt->errorInfo());
		}
	}
	}else{
		//error occured
		if (count($error)==1) {
			$message1="There was 1 error in the form.";
		}elseif (count($error)>1) {
			$message1="There were ".count($error)." errors in the form.";
		}
		
	}

}elseif (isset($_POST['cancel'])) {
	header('blog.php?id='.$_GET['id']);
	
}
	?>
 <?php selected_page($db,true); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title> Simple Blog </title>
		<link href="stylesheets/blog.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<section>
				<a href="blog_list.php"><center>Return to list</center></a>
				<h1> Simple Blog Application </h1>
					<?php 
					if (!empty($message)) {
						echo "<h3 style=\"color:blue;\">". $message ."</h3>" ;
					}
					if (!empty($message1)) {
						echo "<h3 style=\"color:red;\">". $message1 ."</h3>" ;
					}
					?>				
				<form method="post" action="<?php if($edit){echo "blog.php?id=".$_GET['id'];}else{echo "includes/update.inc.php";}?>">
					<fieldset>
						<legend><?php if($edit){ echo"Update";}else{echo "New Entry Submission";}?></legend>
						<label>Title
							<input type="text" name="title" maxlength="150" value="<?php if($edit){echo $e['title'];}?>"/>
						</label>
						<label>Entry
							<textarea name="entry" cols="45" rows="10"><?php if($edit){echo $e['entry'];}?></textarea>
						</label>
						<input type="submit" name="submit" value="<?php if($edit){echo'Update';}else{ echo'Save Entry';}?>" />&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"/>
						<?php if($edit){ ?>
						<a href="delete_blog.php?id=<?php echo urlencode($_GET['id']); ?>" onclick="return confirm('Are you sure!');">Delete Blog</a>
						<?php } ?>
					</fieldset>
				</form>
			</section>
		</div>
	</body>
</html>