<?php
// 接受提交的数据 $_POST
$name = $_POST['name'];
// 读取出JSON // string
$jsonString = file_get_contents('./data/arr.json');
// 转化为 PHP对象 (数组)
// string->arr
$nameArr = json_decode($jsonString);
// 数组的末尾追加
// arr
$nameArr[count($nameArr)] = $name;
// 转化为JSON格式的字符串
$newJsonString = json_encode($nameArr);
// 写入 json文件中
// 参数1 写入的文件
// 参数2 写入的数据
file_put_contents('./data/arr.json',$newJsonString);
// 提示用户 注册成功了

echo '注册成功';

sleep(2);

?>