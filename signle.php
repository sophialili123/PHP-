<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 2:29 PM
 * 单例模式
 */
class Mysql extends ParMysql
{
    //用来保存实例
    private static $connect;

    //构造函数为private,防止创建对象
    private function __construct(){
        self::$connect = mysqli_connect('localhost','root','123456');
    }

    //创建一个用来实例化对象的方法
    public static function getInstance(){
        if(!(self::$connect instanceof self)){
            self::$connect = new self;
        }
        return self::$connect;
    }

    //防止对象被复制
    public function __clone()
    {
        // TODO: Implement __clone() method.
        trigger_error('Clone is not allowed!');
    }
}

//只能这样取得实例，不能new和clone
$mysql_conn = Mysql::getInstance();