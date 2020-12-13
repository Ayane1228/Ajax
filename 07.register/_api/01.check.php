<?php

// header('content-type:text/html;charset=utf-8');
// 为了能够自动转化 设置返回的内容为json
header('content-type:application/json;charset=utf-8');
// 接受发送的数据 $_GET
$name = $_GET['name'];
// 读取json格式字符串 string
$jsonString = file_get_contents('./data/arr.json');
// php中 也有 转化JSON格式字符串的代码
// string->arr(obj)
// print_r(json_decode($jsonString));
$nameArr = json_decode($jsonString);
// 数组的操作
// 判断 某个值 是否在 数组中
$result = in_array($name,$nameArr);

// 准备一个 返回数据的 关系型数组
$backInfo = array();

// true false
if($result==true){
    // 用户名存在 用不了
    $backInfo['message'] = '真遗憾,已被注册';
    $backInfo['status'] = 'cannot';
}else{
    // 如果为false 可以用
    $backInfo['message'] = '恭喜你,可以使用';
    $backInfo['status'] = 'can';
}
    // PHP中 关系型数组
    // print_r($backInfo);
    // 为了 让浏览器 解析方便 把数组 转化为 JSON格式的字符串
    // arr ->JSON string
echo json_encode($backInfo);

// 延迟一会
sleep(2);
?>