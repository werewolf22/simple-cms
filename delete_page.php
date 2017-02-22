<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php 
    if (intval($_GET['editpage']==0)) {
		header("location:content.php");
   		exit();
	}
	$id=$_GET['editpage'];
	if ($page=get_page_byid($id,$db)) {
	
	$query="DELETE FROM edit WHERE id=? LIMIT 1";
	$stmt=$db->prepare($query);
	$stmt->execute(array($id));
	if ($stmt->rowcount()==1) {
		header("LOCATION: content.php");
		exit();
    }else{
    	echo "Page deletion failed!!<br/>";
    	echo "<a href=\"content.php\">Return to main page</a>";
    }
  }else{
  	// not in the database.
		header("LOCATION: content.php");
		exit();  	
}
?>
<?php mysql_close(); $db=NULL;?>