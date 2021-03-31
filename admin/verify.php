<?php

if(!empty($_POST['email'])){
    $emial=$_POST['email'];
    require_once("database.php");
    $query="SELECT Id FROM users WHERE user_email='$emial'";

    $stmt=$con->prepare($query);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows()>0){
        $con->close();
        $stmt->close();

        require("database.php");
        $query="SELECT * FROM blood_donation WHERE user_email='$emial'";
        $stm=$con->prepare($query) or die($con->error);
        $stm->execute() or die($con->error);
        $stm->bind_result($Id, $usrMail,$lastDon, $unitsDon)or die($con->error);
        $stm->store_result() or die($con->error);

        if($stm->num_rows()<1){
            echo "Success";
            exit;
        }else{
$stm->fetch();
$today=date("d/m/Y");

$lastDay=date_create_from_format("d/m/Y",$lastDon);

$difference=round(abs(strtotime($today)-strtotime($lastDon))/86400);

if($difference<30){
    echo "Sorry, You can only donate once every 30 days";
    exit;
}
echo "Success";

        }



    }else{
        echo "This User is not registered yet";
        exit;
    }
}