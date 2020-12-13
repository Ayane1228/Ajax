<?php 
  // echo 'console.log("数据给你,拿去")';
  // doSomething
  $methodName = $_GET['callback'];

  // 把数据 拼接到 函数名的后面
  echo $methodName.'({"name":"jack","food":"西兰花"})';
?>