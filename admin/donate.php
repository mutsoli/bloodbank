<?php

if(!empty($_POST['email']) && !empty($_POST['units'])){
$email=$_POST['email'];
$units=$_POST['units'];

require_once("database.php");
$query="SELECT Id FROM blood_donation WHERE user_email='$email'";
$retval=$con->query($query)or die($con->error);
$total=$retval->num_rows;

$date=date("d/m/Y");
print_r($date);

if($total>0){
    $query="UPDATE blood_donation SET last_date='$date', units='$units' WHERE user_email='$email'";
    $stmt=$con->prepare($query) or die($con->error);
$stmt->execute();
if($stmt->affected_rows>0){
    echo '<script> alert("Success");
    window.location.replace("index.html");</script>';
    exit;  

}
}
$query="INSERT INTO blood_donation (user_email,last_date, units) VALUES(?,?,?)";
$stmt=$con->prepare($query);
$stmt->bind_param("ssi",$email, $date, $units);
$stmt->execute();


if($stmt->affected_rows>0){
    echo '<script> alert("Success");
    window.location.replace("index.html");</script>';
    exit;  

}
}else{
    echo "Input a valid user Email";
    exit;
}