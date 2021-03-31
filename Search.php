
<?php
if(!empty($_POST['group'])){
    $group = $_POST['group'];
    require_once ("database.php");

    $query ="SELECT * FROM blood_table WHERE blood_group='$group' AND units_available>5 ";
    $stm=$con->prepare($query) or die($con->error);
    $stm->execute();
    $stm->bind_result($id, $group, $units);
    $stm->store_result();
    
    if($stm->num_rows()<1){
        echo "This blood group is currently out of stock";
        exit;
    }

    $stm->fetch();
    $result=" Blood group ".$group." has ".$units." Units Available and ";
    $stm->close();
    $con->close();

    require("database.php");
    $query="SELECT * Id FROM users WHERE blood_group='$group'";
    $stmt=$con->prepare($query);
    $stmt->execute();
    $stmt->bind_result($Id);
    $stmt->store_result();

    $total=$stmt->num_rows();
    if($total<1){
        $result=$result."No Donors Available";
    }else{
        $result=$result.$total." Donors Available";
    }

    echo $result;
    
}