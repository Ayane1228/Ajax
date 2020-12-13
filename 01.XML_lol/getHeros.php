<?php
/*
注意点：
1.必须设置返回的内容是 xml
2.列表页的渲染 -- 后台渲染
直接在服务端 把html css js 全部生成完毕
3.ajax的作用 在实际开发中的分工 -- 前台渲染
在不刷新页面的基础上 请求一些 数据（不含有htmlcssjs等结构）
拿到数据之后 在浏览器端 去完成页面的渲染
4.ajax 为什么不去请求html结构 而是 单纯的数据
初期，ajax的目的，是尽可能的降低请求的数据量
现在 随着光纤的普及互联网速度的提升
*/
// 设置返回的内容是 xml
header('content-type:text/xml;charset=utf-8');
// 创建xml文件
// 	xxx.xml
// 读取xml文件
// 返回xml数据
/*
     <?xml version="1.0" encoding="UTF-8"?>
     xml文件顶部的声明 不写 也可以 但是 如果要添加 不要乱写
*/
echo file_get_contents('data/heros.xml');
?>