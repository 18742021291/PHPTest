<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/8
 * Time: 16:27
 * description:负责查询用户个人信息以及购买房产情况并返回结果集二维数组给前端
 */
require "../model/MyDB.php";
$result=array();
if(isset($_SESSION["userId"])){
    $db=dbcn::getInstance();
    $sql1="select * from user where id='{$_SESSION["userId"]}'";
    $sql2="select * from buyrecord b join housing_info h on b.houseId = h.Id where b.userId='{$_SESSION["userId"]}'";
    $result1=$db->query($sql1)->fetch(PDO::FETCH_ASSOC);
    $result[]=$result1;
    $result2=$db->query($sql2);
    while($res=$result2->fetch(PDO::FETCH_ASSOC)){
        $result[]=$res;
    }
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);

