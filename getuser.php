<?php
require_once'./db_functions.php';
$db=new DB_Functions();
$response=array();
 if(isset($_POST['phone']))
 
 {
      $phone=$_POST['phone'];
   $user=$db->getUserInformation($phone);
   if($user)
   {
    $response["phone"]=$user["Phone"];
    $response["name"]=$user["Name"];
    $response["birthdate"]=$user["Birthdate"];
    $response["address"]=$user["Address"];
    echo json_encode($response);

   }
   else{
       $response["error_msg"]="User Doesn't Exists";
       echo json_encode($response);
   }
  }
 
 
 
 else{
     $response["error_msg"]="Unknown Error Occured";
     echo json_encode($response);
 }
 ?>
