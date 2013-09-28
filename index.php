<?php
header("Content-Type: text/html;charset=utf-8");
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
 //实例化核心数据库操作类
 $dbo = new dbex();
 //连接数据库
 dbtarget('r',$dbServs);
 //查询语句
 $sql = "";
 if($count!=null){
 	if($page==null){
 		$sql = "select * from $t_good limit $count";
 		//echo $sql;
 	}else{
 		$min = (int)($page-1)*(int)$count;//设定起始页
 		$sql = "select * from $t_good limit $min, $count";
 		//echo $sql;
 	}
 }else{
 	$sql = "select * from $t_good";
 	//echo $sql;
 }
 //得到数据集
 $t_good_list = $dbo->getRs($sql);

 if($dbo->rowCount==0){ //没有数据时
 	echo"{";
 		echo"\"data\":\"\", \"status\": \"1\"";
 	echo"}";
 	return;
 }
 if($dbo->rowCount==1){ //只有一条数据时
 	echo"{";
 	echo"\"data\": [";
 	echo"{";
 	echo"\"good_name\": \"".$t_good_list[0]["good_name"]."\",";
 	echo"\"good_integral\":\"".$t_good_list[0]["good_integral"]."\",";
 	echo"\"good_no\":\"".$t_good_list[0]["good_no"]."\",";
 	echo"\"good_imgurl\":\"".$t_good_list[0]["good_imgurl"]."\"";
 	echo"}";
 	echo "],";
 	echo "\"status\": \"1\"";
 	echo"}";
 	return;
 }
      
 echo"{";                 //多条数据时
 echo"\"data\": [";
 for($i=0;$i<$dbo->rowCount;$i++){
 	$rs = $t_good_list[$i];
 		echo"{";
 			echo"\"good_name\": \"".$rs["good_name"]."\",";
 			echo"\"good_integral\":\"".$rs["good_integral"]."\",";
 			echo"\"good_no\":\"".$rs["good_no"]."\",";
 			echo"\"good_imgurl\":\"".$rs["good_imgurl"]."\"";
 		echo"}";
 		if($i<$dbo->rowCount-1){
 			echo",";
 		}
 }
 echo "],";
 echo "\"status\": \"1\"";
 echo"}";
?>