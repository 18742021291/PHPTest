<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/11
 * Time: 15:18
 */
session_start();
if(!isset($_SESSION['UserInfo'])) //没有session
{
    if(!isset($_COOKIE['UserInfo']))//也没有cookies
    {
        echo "<script type=\"text/javascript\">";
        echo "window.location.href='../view/LianJia_Login.html';";
        echo "</script>";
    }
    else{//有cookies，把cookies的信息载入session
        $UserInfo=$_COOKIE['UserInfo'];
        $_SESSION['UserInfo']=$UserInfo;
    }
    }
?>
