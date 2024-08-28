<?php
/**
 * PHP简单文件下载系统：MioDrive
 * 
 * @package MioDrive
 * @author 鼠子(ShuShuicu)
 * @link https://blog.miomoe.cn/
 */
require './config.inc.php'; 
session_start();

$token = $_SESSION['token'] ?? null;

if (!isset($_GET['file']) || !isset($_GET['token'])) {
    die("参数无效。");
}

$file = basename($_GET['file']); // 仅获取文件名，避免路径注入
$relativePath = dirname($_GET['file']); // 获取相对路径（如果存在）
$baseDir = $configPath;
$path = __DIR__ . '/' . $baseDir . '/' . $relativePath . '/' . $file;

if (!is_file($path)) {
    die("文件不存在。");
}

// 验证 token 是否正确
if ($_GET['token'] !== $token) {
    die("无效的 token。");
}

// 处理文件下载
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));
readfile($path);
exit;
