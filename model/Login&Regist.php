<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/6/3
 * Time: 10:13
 */
session_start();
require 'MyDB.php';
class L_R{
    private $phone_pattern="/^1[34578]\d{9}$/";
    private $email_pattern="/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/";
    public function login($username,$password)
    {
        $message="";
        if(!empty($username)&&!empty($password)){
            if(preg_match($this->email_pattern,$username)||preg_match($this->phone_pattern,$username)){
                $db=dbcn::getInstance();
                $sql="select *from user where username='{$username}' and password='{$password}'";
                $result=$db->query($sql);
                if($result->rowCount()>0){
                    $row=$result->fetch();
                    $message="登录成功";
                    $_SESSION['userId']=$row['id'];
                    $_SESSION['password']=$row['password'];
                    $_SESSION['username']=$row['username'];
                }
                else{
                    $message="用户不存在或者密码错误";
                }
            }
            else{
                $message="用户名格式非法,重新输入";
            }
        }
        else{
            $message="用户名密码为空";
        }
        return $message;
    }
    public function register($username,$password){
        $message="";
        if(!empty($username)&&!empty($password)){
            if(preg_match($this->phone_pattern,$username)||preg_match($this->email_pattern,$username)){
                $db=dbcn::getInstance();
                $sql="select * from user where username='{$username}'";
                $row=$db->query($sql)->rowCount();
                if($row==0){
                    $sql="insert into user (username,password)value ('{$username}','{$password}')";
                    $db->query($sql);
                    $message="用户名注册成功";
                }else{
                    $message="用户已存在!";
                }
            }
            else{
                $message="用户名格式错误,重新输入";
            }
        }
        else{
            $message="用户名密码为空";
        }
        return $message;
    }
}