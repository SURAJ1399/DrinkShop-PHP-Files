<?php

class Db_Connect{



    private $con;
  

function connect (){

    require_once'./config.php';
$this->con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE); //host is set first then user then password then name its rule

if(mysqli_connect_errno()){

echo "Failed to Connect ".mysqli_connect_errno();
return null;

}
return $this->con;


}

}