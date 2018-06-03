<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/11
 * Time: 15:18
 */
session_start();
if(!isset($_SESSION['username'])||!isset($_SESSION['password'])) {
    echo "<script type=\"text/javascript\">";
    echo "window.location.href='../view/LianJia_Login.php';";
    echo "</script>";
    }
?>
