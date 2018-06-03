<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/17
 * Time: 14:39
 */
require "MyDB.php";
$con=dbcn::getInstance();
$file=fopen("C:\Users\asus\Desktop\house_data.txt","r")or die("unable to open file!");
while(!feof($file)){
    $line=fgets($file);
    $str=explode("\t",$line);
    $sql1="select * from housing_info where assignee_name like '${str[2]}%'";
    $sql2="select * from housing_info where address like '${str[3]}%'";
    $num1=$con->query($sql1)->num_rows;
    $num2=$con->query($sql2)->num_rows;
    $sql = "INSERT INTO housing_info (city_code, house_no,assignee_name,address,created_at)VALUES ('${str[0]}','${str[1]}','${str[2]}$num1','${str[3]}$num2','${str[4]}')";
    $con->query($sql);
}
fclose($file);