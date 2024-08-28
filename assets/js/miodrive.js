//** 2024 MioDrive! Copyright By ShuShuicu */
console.log("\n%c %s %c %s %c %s\n", "color: #fff; background: #34495e; padding:5px 0;", "MioDrive", "background: #fadfa3; padding:5px 0;", "https://blog.miomoe.cn", "color: #fff;background: #d6293e; padding:5px 0;", "B站@ShuShuicu开发");

// 图片类名 
var images = document.getElementsByTagName('img');
for (var i = 0; i < images.length; i++) {
    images[i].classList.add('mdui-ripple', 'mdui-img-fluid', 'mdui-img-rounded');
}

// 视频类名 
var images = document.getElementsByTagName('video');
for (var i = 0; i < images.length; i++) {
    images[i].classList.add('mdui-video-container', 'mdui-video-fluid');
}

// 搜索弹窗
document.getElementById('search').addEventListener('click', function(e) {
    e.preventDefault(); // 阻止默认的链接点击行为  
    Swal.fire({
        title: "搜索",
        input: "text",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "前往搜索",
        showLoaderOnConfirm: true,
        preConfirm: (query) => {
            if (!query) {
                Swal.showValidationMessage('请输入搜索关键词');
            }
            return query;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            const searchQuery = encodeURIComponent(result.value);
            const searchUrl = `${window.location.origin}/search.php?q=${searchQuery}`;
            window.location.href = searchUrl;
        }
    });
});

// 主题样式
// 切换主题并保存
document.getElementById('toggleTheme').addEventListener('click', function() {
    var body = document.body;
    var currentTheme = body.classList.contains('mdui-theme-layout-light') ? 'mdui-theme-layout-light' :
                    body.classList.contains('mdui-theme-layout-dark') ? 'mdui-theme-layout-dark' :
                    'mdui-theme-layout-auto';

    // 根据当前主题切换到下一个主题
    switch (currentTheme) {
        case 'mdui-theme-layout-auto':
            body.classList.remove('mdui-theme-layout-auto');
            body.classList.add('mdui-theme-layout-light');
            localStorage.setItem('theme', 'mdui-theme-layout-light');
            mdui.snackbar({
                message: '当前为：浅色模式',
                position: 'right-bottom',
            });
            break;
        case 'mdui-theme-layout-light':
            body.classList.remove('mdui-theme-layout-light');
            body.classList.add('mdui-theme-layout-dark');
            localStorage.setItem('theme', 'mdui-theme-layout-dark');
            mdui.snackbar({
                message: '当前为：深色模式',
                position: 'right-bottom',
            });
            break;
        case 'mdui-theme-layout-dark':
            body.classList.remove('mdui-theme-layout-dark');
            body.classList.add('mdui-theme-layout-auto');
            localStorage.setItem('theme', 'mdui-theme-layout-auto');
            mdui.snackbar({
                message: '当前为：自动模式',
                position: 'right-bottom',
            });
            break;
    }
});

// 加载主题设置
document.addEventListener('DOMContentLoaded', function() {
    var body = document.body;
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        // 移除所有可能的主题类
        body.classList.remove('mdui-theme-layout-auto', 'mdui-theme-layout-light', 'mdui-theme-layout-dark');

        // 添加保存的主题类
        body.classList.add(savedTheme);
    }
});

// 复制提示
document.body.oncopy = function() {
    mdui.snackbar({
        message: '复制成功，如需转载请保留链接。',
        position: 'top',
    });
};