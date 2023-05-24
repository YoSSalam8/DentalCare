<?php

$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}


?>