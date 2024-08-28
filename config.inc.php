<?php 
/**
 * PHP简单文件下载系统：MioDrive
 * 
 * @package MioDrive
 * @author 鼠子(ShuShuicu)
 * @version 1.0.0
 * @link https://blog.miomoe.cn/
 */

// 显示目录：echo htmlspecialchars($relativeDir); 

$configPath = './files'; // 文件路径
$assetsUrl = './assets'; // 静态资源URL，支持远程URL

$favicon = './assets/images/favicon.ico'; // 站点favicon图标
$siteTitle = 'MioDrive'; // 站点标题
$indexTitle = 'Powered by 鼠子'; // 首页副标题 
$siteKeywords = '网盘,简单网盘,文件下载系统,MioDrive'; // 站点关键词
$siteDescription = 'MioDrive是基于PHP前端MDUI的简单文件下载系统。'; // 站点介绍