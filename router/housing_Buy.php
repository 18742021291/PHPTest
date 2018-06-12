<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/3
 * Time: 13:26
 * description:负责处理用户购买房产的处理,处理结果返回给前端LianJia_HousingInfo.html
 * 利用数据库事务特性以及悲观锁for update来控制并发读写的风险
 */
require "../control/validate.php";
require "../model/MyDB.php";
$db=dbcn::getInstance();
$house_id=$_POST["houseId"]; //获取房屋id
//$userId=$_POST["userId"];//获取用户id
$userId=$_SESSION['userId'];//获取购房人信息
$flag=-1;
try{
    $db->getConnection()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db->getConnection()->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $db->getConnection()->beginTransaction();
    $result1=$db->query("select Id from housing_info where Id='$house_id' and state=0 for update");
    if($result1->rowCount()==1)
    {
        $sql2="insert into buyrecord (userId,houseId)value('$userId','$house_id')";
        $db->getConnection()->exec($sql2);
        $sql3="update housing_info set state=1 where Id='$house_id'";
        $db->getConnection()->exec($sql3);
        $flag=1;
    }
    else{
        $flag=2;
    }
    $db->getConnection()->commit();
}catch (Exception $e){
    $db->getConnection()->rollBack();
}
if($flag==1)
{
    echo 1;
}
else{
    echo 2;
}
?>