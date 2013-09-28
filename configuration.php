<?php
//语言包参数，目前参数值zh,en
$langPackagePara="zh";

//配置信息
$webRoot=strtr(dirname(__FILE__),"\\","/")."/";
$metaDesc="iCreditCard";
$metaKeys="iCreditCard";
$metaAuthor="";
$siteName="iWanted";
$copyright="2013 陆键霏 版权所有 ";
$domainRemark="";
$offLine=0;
$adminEmail="";
$siteDomain="http://{$_SERVER['HTTP_HOST']}/";

//时区设置
date_default_timezone_set ("Asia/Shanghai");

//当前时间
defined('NOWTIME') or define('NOWTIME',date('Y-m-d H:i:s',time()));

//支持库配置
$baseLibsPath="iweb_mini_lib/";

//防刷新时间设置,只限制insert动作.单位:秒
$allowRefreshTime=5;

//超限系统延时设置,单位:秒
$delayTime=5;

//开启缓存
$ctrlCache=1;

//缓存更新延时设置,单位为秒
$cache_update_delay_time=1;

//出生年份范围
$setMinYear=1950;
$setMaxYear=2020;

//站点调试信息设置
ini_set("display_errors",0);

//站点关闭提示信息
$offlineMessage="本网站目前正在维护中,请稍后再来访问";

?>