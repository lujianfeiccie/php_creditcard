<?php
//header("Content-Type: text/html;charset=utf-8");
header("Content-type: text/json;charset=utf-8");
require("iweb_mini_lib/conf/dbconf.php"); //$tablePreStr,$dbServs
require("iweb_mini_lib/cdbex.class.php"); //dbex
require("iweb_mini_lib/fdbtarget.php");   //dbtarget
require("foundation/freq_filter.php");   //short_check
require("foundation/fgetandpost.php");   //get_args
require("configuration.php");
 //取得表名
 $t_good = $tablePreStr."good";
 //取得请求参数值
 $count = short_check(get_args("count"));//单条页数

 $page = short_check(get_args("page")); //页码
 
 $good_typeid = short_check(get_args("good_typeid")); //银行
 
 $low_integral = short_check(get_args("low_integral")); //最低积分
 
 $high_integral = short_check(get_args("high_integral")); //最高积分
 
 $good_name = trim(get_args("good_name")); //商品名称
 
 if($good_typeid==null){
 	$json_data = array("data"=>"","status" => "0","info"=>"good_typeid should not be null");
 	echo json_encode($json_data);
 	return;
 }
 //实例化核心数据库操作类
 $dbo = new dbex();
 //连接数据库
 dbtarget('r',$dbServs);
 //查询语句
 $sql = " select good_name,good_integral,good_no,good_imgurl from $t_good where good_typeid = $good_typeid ";
 
 //加入积分范围查询
 if($low_integral!=null && $high_integral!=null){
 	$sql = $sql." and good_integral between $low_integral and $high_integral ";
 } 
 //加入了商品名称的查询
 if($good_name!=null){
 	$sql = $sql. " and good_name like '%$good_name%' ";
 }
 if($count!=null){
 	if($page==null){
 		$sql = $sql." limit $count ";
 		//echo $sql;
 	}else{
 		$min = (int)($page-1)*(int)$count;//设定起始页
 		$sql = $sql." limit $min, $count";
 		//echo $sql;
 	}
 }

 //得到数据集
 $t_good_list = $dbo->getRs($sql);
 //组装json
$json_data = array("data" =>$t_good_list,"status" => "1","info"=>"success");
 //输出json   
 echo json_encode($json_data);
?>