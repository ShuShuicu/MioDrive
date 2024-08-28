<?php
/**
 * PHP简单文件下载系统：MioDrive
 * 
 * @package MioDrive
 * @author 鼠子(ShuShuicu)
 * @link https://blog.miomoe.cn/
 */
require './config.inc.php'; 
$pageTitle = $indexTitle; 
session_start();

// 设置 token，通常在用户登录或访问页面时生成并存储
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16)); // 生成一个随机 token
}

$baseDir = $configPath; // 基础目录，隐藏在URL中
$relativeDir = isset($_GET['dir']) ? $_GET['dir'] : '';
$path = __DIR__ . '/' . $baseDir . '/' . $relativeDir;

if (!is_dir($path)) {
    die("指定的目录不存在。");
}

$items = scandir($path);

// 将文件夹和文件分开处理，并按文件的修改时间排序
$directories = [];
$files = [];

foreach ($items as $item) {
    if ($item === '.' || $item === '..') {
        continue;
    }

    $itemPath = $path . '/' . $item;
    if (is_dir($itemPath)) {
        $directories[] = $item;
    } else {
        $files[] = $item;
    }
}

// 文件夹按名称排序，文件按修改时间降序排序
sort($directories);
usort($files, function($a, $b) use ($path) {
    return filemtime($path . '/' . $b) - filemtime($path . '/' . $a);
});
require_once './inc/header.php'; 
?>
<div class="mdui-card mdui-hoverable mdui-card-content" style="border-radius: 8px;">
    <ul class="mdui-list">
    <?php
        if ($relativeDir !== '') {
            // 提供返回上一级的链接
            $parentDir = dirname($relativeDir);
            echo '<a href="?dir=' . urlencode($parentDir === '.' ? '' : $parentDir) . '">
            <li class="mdui-list-item mdui-ripple">
                <div class="mdui-list-item-content">返回上一级</div>
            </li></a>';
        }
        // 显示文件夹
        foreach ($directories as $directory) {
            $itemPath = $relativeDir . '/' . $directory;
            echo '<a href="?dir=' . urlencode($itemPath) . '">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">folder</i>
                <div class="mdui-list-item-content">' . htmlspecialchars($directory) . '</div>
            </li></a>';
        }
        echo '<div class="mdui-divider"></div>'; 
        // 显示文件
        foreach ($files as $file) {
            $itemPath = $relativeDir . '/' . $file;
            $token = $_SESSION['token']; // 从会话中获取 token
            echo '<a href="download.php?file=' . urlencode($itemPath) . '&token=' . urlencode($token) . '">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">file_download</i>
                <div class="mdui-list-item-content">' . htmlspecialchars($file) . '</div>
            </li></a>';
        }
    ?>
    </ul>
</div>
<?php require_once './inc/footer.php'; ?>