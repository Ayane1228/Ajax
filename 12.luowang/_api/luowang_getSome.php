<?php

header('content-type:application/json;charset=utf-8');

// 读取数据 ->obj
$arr = json_decode(file_get_contents('./data/info.json'));

// 总个数
$totalNum = count($arr);

// 定义返回的信息
$message = '';

// 定义随机的个数 默认值 是全部返回
$randomNum = $totalNum;

// 获取 随机的个数
if(array_key_exists('num',$_GET)){
    $randomNum = $_GET['num'];
    // 判断是否超过总个数
    if($randomNum>$totalNum){
        $message = 'num 超出最大值,全部返回';
    }
}else{
    $message = 'num 未设置 全部返回';
}

// 定义索引 获取随机值
$randomKeyArr = array_rand($arr,$randomNum);

// 定义 新数组 接收数据
$items = array();
for($i = 0;$i<count($randomKeyArr);$i++){
    $items[$i] = $arr[$randomKeyArr[$i]];
}

echo json_encode(array(
'message'=>$message,
'max'=>$totalNum,
'items'=>$items
));

// 延迟
sleep(2);
?>