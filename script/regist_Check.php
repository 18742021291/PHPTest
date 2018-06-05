<?php
require "../model/MyDB.php";
$db=dbcn::getInstance();
$sql1="SELECT * from user where username='{$_POST["username"]}'";
$sql2 = "INSERT INTO user (username, password)VALUES ('{$_POST["username"]}','{$_POST["password"]}')";
$attr = $db->query($sql1);
if($attr->rowCount()>=1){
    echo 1;
}
else{
    $db->query($sql2);
    echo 2;
}
