<?php
$host="localhost:3306";//mysql数据库服务器,比如localhost:3306
$user="root"; //mysql数据库默认用户名
$pwd="123456"; //mysql数据库默认密码
$db="creditcard"; //默认数据库名
global $tablePreStr;//设置外部变量
$tablePreStr="tb_";//表前缀

//当前提供服务的mysql数据库
global $dbServs;
$dbServs=array($host,$db,$user,$pwd);
?>