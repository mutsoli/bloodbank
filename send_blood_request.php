<?php
session_start();

if(!empty($_POST['username']) && !empty($_POST['bloodgroup']) && !empty($_POST['units']) && !empty($_POST['phone']) &&
!empty($_POST['email'])){
    $userName=$_POST['username'];
    $bloodGroup=$_POST['bloodgroup'];
    $units=$_POST['units'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];

    if(strlen($phone)>10){
       echo '<script> alert("phone number must not exceed 10 digits");
        window.location.replace("send_request.html");</script>';
        exit;  
    }

    if(!isset($_SESSION['email'])){
       
    }

    require_once("database.php");
    $sql="INSERT INTO blood_requests(user_email,user_phone,blood_group,required_units,status) VALUES (?,?,?,?,?)";
    $stm=$con->prepare($sql);
    $pending="pending";
    $stm->bind_param("sssis",$email,$phone,$bloodGroup,$units,$pending);
    $stm->execute();

    echo '<script> alert("Request was sent successfully");
    window.location.replace("index.html");</script>';

    


}else{
    echo '<script> alert("One or more fields were empty. please input all fields");
    window.location.replace("login.html");</script>';
}