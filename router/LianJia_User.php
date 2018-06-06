<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/3
 * Time: 13:26
 */
require "../model/Login&Regist.php";
$User=new L_R();
switch ($_POST["operate"]){
    case 1:
        $User->login($_POST["username"],$_POST["password"]);
        break;
    case 2:
        $User->register($_POST["username"],$_POST["password"]);
        break;
    default:
        echo -1;
        break;

}