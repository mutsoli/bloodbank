<?php
session_start();

if(!empty($_POST['useremail']) && !empty($_POST['userpassword'])){
    $email=$_POST['useremail'];
    $password=$_POST['userpassword'];
    if(isset($_SESSION['email'])){
        echo '<script> alert("You are already logged in");
        window.location.replace("index.html");</script>';
        exit; 
    }

    require_once("database.php");
    $query="SELECT * FROM users ";
    $stmt=$con->prepare($query);
    $stmt->bind_result($id,$mail,$phn,$bld,$urg,$nm,$loc,$pass,$status);
$stmt->execute();
    while($stmt->fetch()){
if($email==$mail && $password==$pass){
    $_SESSION['email']=$email;
    if($status=="admin"){
        $_SESSION['admin']=true;
    }
    echo '<script>
        window.location.replace("index.html");</script>';
        exit; 
}
    }

    echo '<script> alert("Incorrect email or password");
    window.location.replace("login.html");</script>';
    exit; 

    
}else{
    echo '<script> alert("One or more fields were empty. please input all fields");
    window.location.replace("login.html");</script>';
}