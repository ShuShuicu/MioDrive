<?php 
/**
 * PHP简单文件下载系统：MioDrive
 * 
 * @package MioDrive
 * @author 鼠子(ShuShuicu)
 * @link https://blog.miomoe.cn/
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link rel="dns-prefetch" href="//apps.bdimg.com">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $siteTitle . '丨' . $pageTitle; ?></title>
    <meta name="keywords" content="<?php echo $siteKeywords; ?>" />
    <meta name="description" content="<?php echo $siteDescription; ?>" />
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/miodrive.css">
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/mdui.min.css">
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sweetalert2.min.css">
    <link href="<?php echo $favicon; ?>" rel="icon" />
    <meta name="generator" content="MioDrive" />
</head>
<body class="mdui-appbar-with-toolbar mdui-theme-auto mdui-theme-layout-auto mdui-theme-primary-blue-grey mdui-theme-accent-pink mdui-loaded">
    <div class="app">
        <header class="appbar mdui-appbar mdui-appbar-fixed">
            <div class="mdui-toolbar mdui-color-theme">
                <a class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content:'MioDrive'}">
                    <i class="mdui-icon material-icons">cloud</i>
                </a>
                <a href="/" class="mdui-typo-headline"><?php echo $siteTitle; ?></a>
                <div class="mdui-toolbar-spacer"></div>
                <a id="search" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content:'文件搜索'}">
                    <i class="mdui-icon material-icons">search</i>
                </a>
                <a id="toggleTheme" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content:'切换主题'}">
                    <i class="mdui-icon material-icons">brightness_6</i>
                </a>
                <a href="https://gitee.com/ShuShuicu/MioDrive" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content:'查看源码'}">
                    <i class="mdui-icon material-icons">code</i>
                </a>
            </div>
        </header>
    <div class="mdui-container">
        <div class="mdui-card mdui-hoverable mdui-m-y-5" style="border-radius: 8px;">
            <div class="mdui-card-media mdui-card-content">
                <div class="mdui-card-primary-title mdui-text-truncate" style="text-align: center;">
                <?php echo $siteTitle; ?><br><small><?php echo $siteDescription; ?></small>
                </div>
            </div>
        </div>