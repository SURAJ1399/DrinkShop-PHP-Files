<?php
require_once'./db_functions.php';
$db=new DB_Functions();
$response=array();
$menu=$db->getMenu();
echo json_encode($menu);