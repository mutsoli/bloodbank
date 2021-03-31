<?php
session_start();
if(!isset($_SESSION['email'])){
    echo "You need to log in First";
    exit;
}
$email=$_SESSION['email'];

require_once("database.php");

if(!isset($_SESSION['admin'])){
$query="SELECT * FROM blood_requests WHERE user_email='$email'";
}else{
    $query="SELECT * FROM blood_requests";
}
$stmt=$con->prepare($query) or die($con->error);
$stmt->execute();
$stmt->bind_result($id,$mail,$phone,$group,$required_units,$req_date,$status);
$stmt->store_result();

if($stmt->num_rows()<1){
    echo "No Requests Available";
    exit;
}

$result=array();

while($stmt->fetch()){
    $arr=["reqId"=>$id,
    "group"=>$group,
"units"=>$required_units,
"date"=>$req_date,
"status"=>$status
];
array_push($result,$arr);

}
echo json_encode($result);