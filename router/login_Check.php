<?php
require "../model/MyDB.php";
session_start();
$db = dbcn::getInstance();
$sql = "SELECT * FROM user WHERE username='{$_POST["username"]}' and password='{$_POST["password"]}' limit 1";
$result = $db->query($sql);
if($result->rowCount() == 0){
    echo 1;
}
else{
    $row=$result->fetch();
    $_SESSION['userId']=$row['id'];
    $_SESSION['password']=$row['password'];
    $_SESSION['username']=$row['username'];
    echo 2;
}
