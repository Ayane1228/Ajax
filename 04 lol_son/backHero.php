<?php 
  // 设置返回的是JSON
  header('content-type:application/json;charset=utf-8');

  // 读取JSON文件
  // 返回读取的数据
  echo file_get_contents('./data/info.json');
 ?>