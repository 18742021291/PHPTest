<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/18
 * Time: 17:20
 */
class dbcn{
    private static $instance;
    private $host="127.0.0.1"; //数据库主机名
    private $username="root";      //数据库连接用户名
    private $password="123456";          //对应的密码
    private $dbName="test";    //使用的数据库
    private $connection;         //连接状态
    private function  __construct(){
        //$this->connection=new MySQLi($this->host,$this->username,$this->password,$this->dbName);
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    private function __clone(){}//在clone前用private修饰,用来禁止克隆
    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance=new self();
        }
        return self::$instance;
    }
    public function query($sql){
        $result=$this->connection->query($sql);
        return $result;
    }
    public function getConnection(){
        return $this->connection;
    }
}
