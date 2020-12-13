<?php
  // JSON也要设置一段内容 (可选)
  // 告诉浏览器 返回的是 JSON格式的数据 编码是 utf-8
  header('content-type:application/json;charset=utf-8');

  // 读取JSON文件
  $jsonString = file_get_contents('data/stars.json');

  // 返回读取的内容
  echo $jsonString;
?>