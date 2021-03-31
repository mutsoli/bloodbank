<?php
session_start();
$_SESSION['admin']="Test";
if(!empty($_POST['mode']) && !empty($_POST['id']) && !empty($_POST['email'])){
    if(empty($_SESSION['admin'])){
        echo "You need to log in First";
    exit;
    }

$mode=$_POST['mode'];
$id=$_POST['id'];
$email=$_POST['email'];

if($mode=="accept"){
    require_once ("database.php");
    $query="UPDATE blood_requests SET status='accepted' WHERE Id='$id'";
    $stmt=$con->prepare($query);
    $stmt->execute();
    
    if($stmt->affected_rows>0){
       if(mail($email,"Blood Request"," Your Request for blood was accepted. We will call you shortly with details")){
echo "Update Successful";
exit;
       }
  echo "Could not Send Confirmation Email to ".$email;
  exit;    
    }

    echo "Failed to Complete Operation. Try Again later ".$con->error;
    exit;
}

if($mode=="emailUser"){
   $message=$_POST['message'] ;
   mail($email,"Blood Bank",$message);
   echo "Message Sent";
}

if($mode=="reject"){
    require_once ("database.php");
    $query="UPDATE blood_requests SET status='rejected' WHERE Id='$id'";
    $stmt=$con->prepare($query);
    $stmt->execute();
    
    if($stmt->affected_rows>0){
       if(mail($email,"Blood Request","Unfortunately, Your Request for blood was Rejected.")){
echo "Update Successful";
exit;
       }
  echo "Could not Send Information Email to ".$email;
  exit;    
    }

    echo "Failed to Complete Operation. Try Again later ".$con->error;
    exit;
}

if($mode=="delete"){
    require_once ("database.php");
    $query="DELETE FROM blood_requests  WHERE Id='$id'";
    $stmt=$con->prepare($query);
    $stmt->execute();
    
    if($stmt->affected_rows>0){
       if(mail($email,"Blood Request"," Your Request for blood could not be processed and has been deleted. We will call you shortly with details")){
echo "Update Successful";
exit;
       }
  echo "Could not Send Deletion Email to ".$email;
  exit;    
    }

    echo "Failed to Complete Operation. Try Again later ".$con->error;
    exit;
}

if($mode=="deleteUser"){
    require_once ("database.php");
    $query="DELETE FROM users WHERE Id='$id'";
    $stmt=$con->prepare($query);
    $stmt->execute();
    
    if($stmt->affected_rows>0){
       if(mail($email,"Blood Bank Account"," Your Blood bank account has been deleted. We will call you shortly with details")){
echo "Update Successful";
exit;
       }
  echo "Could not Send Deletion Email to ".$email;
  exit;    
    }

    echo "Failed to Complete Operation. Try Again later ".$con->error;
    exit;
}
}