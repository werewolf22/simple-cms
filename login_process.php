<?php 
require_once "includes/session.php";
require_once "includes/connection.php";
require_once "includes/functions.php";
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


        $sql = "SELECT id,name from tbl_user where name=? and password=? and status =1 limit 0,1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($name,$pass));
        if($stmt->rowCount()==1){
            $found_user=$stmt->fetch();
            $_SESSION['user_id']=$found_user['id'];
            $_SESSION['user_name']=$found_user['name'];                         
            header("location:students.php");
            $stmt->closeCursor();
        exit();
        }else{
            header("location:login_error.php");
            exit();
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