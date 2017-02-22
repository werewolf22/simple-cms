<?php
if($_SERVER['REQUEST_METHOD']=='POST'
&& $_POST['submit']=='Save Entry')
{
	$title=$_POST['title'];
	$entry=$_POST['entry'];
// Include database credentials and connect to the database
 require_once("connection.php");
// Save the entry into the database
$sql = "INSERT INTO entries (title, entry) VALUES (?, ?)";
$stmt = $db->prepare($sql);
$stmt->execute(array($title, $entry));
$stmt->closeCursor();
// Get the ID of the entry we just saved
$id_obj = $db->query("SELECT LAST_INSERT_ID()");
$id = $id_obj->fetch();
$id_obj->closeCursor();
// Send the user to the new entry
header('Location: ../index.php?id='.$id[0]);
exit;
}
// If both conditions aren't met, sends the user back to the form page
else
{
header('Location: ../blog.php');
exit;
}
?>