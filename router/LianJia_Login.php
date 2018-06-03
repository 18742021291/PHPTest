<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/3
 * Time: 13:26
 */
require "../model/Login&Regist.php";
//session_start();
$login=new L_R();
$result=$login->login($_POST['username'],$_POST['password']);
echo $result;