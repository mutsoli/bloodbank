<?php
session_start();
if(!empty($_POST['username']) && !empty($_POST['userblood']) && !empty($_POST['useremail']) && !empty($_POST['userphone']) &&
!empty($_POST['userlocation']) && !empty($_POST['userpassword']) && !empty($_POST['userage']) ){

    $userName=$_POST['username'];
    $bloodGroup=$_POST['userblood'];
    $email=$_POST['useremail'];
    $phone=$_POST['userphone'];
    $location=$_POST['userlocation'];
    $password=$_POST['userpassword'];
    $age=$_POST['userage'];



if(isset($_SESSION['email'])){
    echo '<script> alert("You are already logged in");
    window.location.replace("index.html");</script>';
    exit;
}

require_once("database.php");
$sql="INSERT INTO users(user_name, blood_group,user_email,user_phone,user_location,user_password,user_age) VALUES (?,?,?,?,?,?,?)";

$query="SELECT * FROM users WHERE user_email='$email'";
$stm=$con->prepare($query);
$stm->bind_result($id,$mail,$phn,$bld,$urg,$nm,$loc,$pass);
$stm->execute();
$stm->store_result();

$count=$stm->num_rows();

if($count>0){
    echo '<script> alert("This email is already registered");
    window.location.replace("login.html");</script>';
    exit;

}

require("database.php");

$stmt=$con->prepare($sql);
$stmt->bind_param("ssssssi",$userName,$bloodGroup,$email,$phone,$location,$password,$age) or die($con->error);
$stmt->execute() or die($con->error);

if($stmt->affected_rows>0){
    echo '<script>
    window.location.replace("login.html");</script>';
    exit;
}




}else{
    echo '<script> alert("One or more fields were empty. please input all fields");
    window.location.replace("signup.html");</script>';
}