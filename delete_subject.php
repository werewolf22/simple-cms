<?php include "includes/session.php";?>
<?php confirm_logged_in();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php 
if (intval($_GET['editnav']==0)) {
    header("location:content.php");
    exit();
}
$id=$_GET['editnav'];
if ($subject=get_navmenu_byid($id,$db)) {
    // delete pages of the menu
    $query="DELETE FROM edit WHERE nav_id=?";
	$stmt=$db->prepare($query);
	$stmt->execute(array($id));

	$query="DELETE FROM navigation WHERE id=$id LIMIT 1";
	$stmt=$db->prepare($query);
	$stmt->execute(array($id));
	if ($stmt->rowcount()==1) {
		header("LOCATION: content.php");
		exit();
    }else{
    	echo "Navigation deletion failed!!<br/>";
    	echo "<a href=\"content.php\">Return to main page</a>";
    }
}else{
  	// not in the database.
    header("LOCATION: content.php");
    exit();  	
}
?>
<?php mysql_close(); $db=null; ?>