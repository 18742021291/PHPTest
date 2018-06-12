<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/3
 * Time: 13:26
 * description:负责查询房产信息并返回结果给前端LianJia_HousingInfo.html
 */
require "../model/MyDB.php";
$db=dbcn::getInstance();
$page=$_POST["page"]; //获取前台传过来的页码
$pageSize=50;  //设置每页显示的条数
$start=($page-1)*$pageSize; //从第几条开始取记录
$result=$db->query("select * from housing_info limit {$start},{$pageSize}");
$count=$db->query("select * from housing_info")->rowCount();//记录总条数
$totalPage=ceil($count/$pageSize);//页码数
$array=array();
while($row=($result->fetch())){
    $value=array("Id"=>$row['Id'],"city_code"=>$row['city_code'],"house_no"=>$row['house_no'],"assignee_name"=>$row['assignee_name'],"address"=>$row['address'],"create_at"=>$row['created_at'],"count"=>$count,"totalPage"=>$totalPage);
    $array[]= $value;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE);
