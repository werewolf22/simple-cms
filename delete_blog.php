<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.inc.php");?>
<?php 
 //    if (intval($_GET['id']==0)) {
	// 	header("location:blog_list.php");
 //   		exit();
	// }
	$id=$_GET['id'];
	if ($subject=retrieveEntries($db,$id)) {
	
	$query="DELETE FROM entries WHERE id=$id LIMIT 1";
	$stmt=$db->prepare($query);
	$stmt->execute(array($id));
	if ($stmt->rowcount()==1) {
	echo $id;
		header("LOCATION: blog_list.php");
		exit();
    }else{
    	echo "Navigation deletion failed!!<br/>";
    	echo "<a href=\"blog_list.php\">Return to main page</a>";
    }
  }else{
  	// not in the database.
		header("LOCATION: blog_list.php");
		exit();  	
}
?>
<?php mysql_close(); $db=null; ?>