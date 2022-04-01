<?php
session_start();

require"../includes/database_connect.php";

if(!isset($_SESSION['user_id'])){
    echo json_encode(array("success"=>false, "is_logged_in"=>false));
    return;
}

$user_id = $_SESSION['user_id'];
$property_id= $_GET['property_id'];

$sql_1 ="SELECT * FROM interested_users_properties WHERE user_id= $user_id AND property_id =$property_id";
$result_1 =mysqli_query($conn,$sql_1);
if(!$result_1){
    echo json_encode(array("success"=> false,"message"=> "something went wrong"));
    return;
}
if(mysqli_num_rows($result_1)>0){
    $sql_2 ="DELETE FROM interested_users_properties WHERE user_id=$user_id AND property_id =$property_id";
    $result_2 = mysqli_query($conn,$sql_2);
    if(!$result_2){
        echo json_encode(array("success" => false,"message"=>"something went wrong"));
        return;
    }else{
        echo json_encode(array("success"=>true,"is_interested" => false, "property_id" => $property_id));
        return;
    }
} else{
    $sql_3="INSERT INTO interested_users_properties (user_id, property_id)VALUES ('$user_id','$property_id')";
    $result_3 =mysqli_query($coon,$sql_3);
    if(!$result_3){
        echo json_encode(array("success"=> false, "message"=>"something went wrong"));
     return;
    }else{
        echo json_encode(array("success"=>true,"is_interested"=>true, "property_id"=>$property_id));
    return;
    }
}



