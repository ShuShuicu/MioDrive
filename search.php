<?php
/**
 * PHP简单文件下载系统：MioDrive
 * 
 * @package MioDrive
 * @author 鼠子(ShuShuicu)
 * @link https://blog.miomoe.cn/
 */
require './config.inc.php'; 
$pageTitle = '搜索'; 
session_start();

$baseDir = $configPath; // 基础目录，搜索范围限定在此目录及其子目录
$searchTerm = isset($_GET['q']) ? trim($_GET['q']) : '';

function searchFiles($dir, $searchTerm) {
    $results = [];
    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $itemPath = $dir . '/' . $item;

        if (is_dir($itemPath)) {
            // 递归搜索子目录
            $results = array_merge($results, searchFiles($itemPath, $searchTerm));
        } elseif (stripos($item, $searchTerm) !== false) {
            // 匹配文件名
            $results[] = $itemPath;
        }
    }

    return $results;
}

$results = [];
if ($searchTerm !== '') {
    $results = searchFiles(__DIR__ . '/' . $baseDir, $searchTerm);
}

// 对搜索结果进行排序：文件夹优先，文件按修改时间排序
$directories = [];
$files = [];

foreach ($results as $result) {
    if (is_dir($result)) {
        $directories[] = $result;
    } else {
        $files[] = $result;
    }
}

// 文件夹按名称排序，文件按修改时间降序排序
sort($directories);
usort($files, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

$sortedResults = array_merge($directories, $files);
require_once './inc/header.php'; 
?>
<div class="mdui-card mdui-hoverable mdui-card-content" style="border-radius: 8px;">
    <form action="search.php" method="get">
        <div class="mdui-textfield">
            <i class="mdui-icon material-icons">search</i>
            <input class="mdui-textfield-input" type="text" name="q" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="输入文件名后 · 按回车(Enter)搜索">
        </div>
    </form>
</div>
    <?php if ($searchTerm !== '' && count($sortedResults) > 0): ?>
    <div class="mdui-card mdui-hoverable mdui-card-content mdui-m-y-5" style="border-radius: 8px;">
    <div class="mdui-card-primary-title mdui-text-truncate">搜索结果：</div>
    <div class="mdui-divider"></div>
        <ul class="mdui-list">
            <?php foreach ($sortedResults as $filePath): ?>
                <?php
                $relativePath = str_replace(__DIR__ . '/' . $baseDir . '/', '', $filePath);
                $fileName = basename($filePath);
                $token = $_SESSION['token']; // 从会话中获取 token
                ?>
                <a href="download.php?file=<?php echo urlencode($relativePath); ?>&token=<?php echo urlencode($token); ?>">
                    <li class="mdui-list-item mdui-ripple">
                    <div class="mdui-list-item-content"><?php echo htmlspecialchars($relativePath); ?></div>
                </li></a>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($searchTerm !== ''): ?>
        <p>没有找到匹配的文件。</p>
    <?php endif; ?>
<?php require_once './inc/footer.php'; ?>