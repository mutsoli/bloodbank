<?php
session_start();
$_SESSION['admin']="Test";
if(!isset($_SESSION['admin'])){
    echo "You need to log in First";
    exit;
}
//$email=$_SESSION['email'];

require_once("database.php");

    $query="SELECT * FROM users";
    $stmt=$con->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id,$mail,$phn,$bld,$urg,$nm,$loc,$pass,$status);
$stmt->store_result();

if($stmt->num_rows()<1){
    echo "No Users Available";
    exit;
}

$result=array();

while($stmt->fetch()){
    $arr=["userId"=>$id,
    "group"=>$bld,
"location"=>$loc,
"age"=>$urg,
"name"=>$nm,
"email"=>$mail,
"phone"=>$phn
];
array_push($result,$arr);

}
echo json_encode($result);