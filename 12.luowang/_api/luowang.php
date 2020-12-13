<?php
// 设置返回的是json
header('content-type:application/json;charset=utf-8');
// 读取数据 ->obj
$arr = json_decode(file_get_contents('./data/info.json'));

// 总个数
$totalNum = count($arr);

// 定义返回的信息
$message = 'success';

// 定义索引值
$index = 0;

// 获取提交的索引
if(array_key_exists('index',$_GET)){
    // 获取 提交的索引
    $getIndex = $_GET['index'];
    // 判断是否越界
    if($getIndex>($totalNum)-1){
        // 获取 随机的索引
        $index = array_rand($arr);
        // 修改信息
        $message = 'index 参数 越界 返回随机值';
    }else{
        // 未 越界
        $index = $getIndex;
    }
}else{
    $message = '未设置 index 参数 默认返回 第一个';
}

echo json_encode(array(
    'message'=>$message,
    'index'=>$index,
    'max'=>$totalNum-1,
    'item'=>$arr[$index]
    )
);

// 延迟
sleep(2);
?>

