<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
   $error_coln = array('menu_name','position','visible');
   foreach ($error_coln as $error_name) {
   	if (!isset($_POST[$error_name])||empty($_POST[$error_name])) {
   		$error[]=$error_name;
   }
   }
   if(!empty($error)){
   	header("location:add_page.php");
   	exit();
   }
?>
<?php 
$menu_name=$_POST['menu_name'];
$position=$_POST['position'];
$visible=$_POST['visible'];
if($menu_name !=''){
$query="INSERT INTO navigation (menu_name,position,visible) VALUES (?,?,?)";
$stmt=$db->prepare($query);

if ($stmt->execute(array($menu_name,$position,$visible))) {
   $stmt->closeCursor();
	header("LOCATION: content.php");
	exit();
}else{
	echo "<p><h2>adding navigation failed!</h2></p>";
	echo "<p>".print_r($stmt->errorInfo())."</p>";
}
}
else{
	header("LOCATION: content.php");
	exit();
}
?>
<?php $stmt=null; ?>