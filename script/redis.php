<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/27
 * Time: 14:56
 */
$redis=new Redis();
$redis->connect("127.0.0.1","6379");
//$redis->lpush("tutorial-list", "Redis");
//$length=$redis->lpush("tutorial-list", "Mongodb");
//echo $length;


//$redis->lpush("tutorial-list", "Mysql");
//// 获取存储的数据并输出
//$arList = $redis->lrange("tutorial-list", 0 ,3);
//echo "Stored string in redis";
//print_r($arList);