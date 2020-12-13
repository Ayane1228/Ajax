<?php
header('content-type:application/json;charset=utf-8');

// 读取数据 ->obj
$arr = json_decode(file_get_contents('./data/smzdm_novels.json'));

// 总个数
$totalNum = count($arr);

// 定义索引 获取随机值
$index = array_rand($arr,1);

// 定义返回的信息
$message = '';

// 获取提交的索引
if(array_key_exists('index',$_GET)){
    // 获取 提交的索引
    $getIndex = $_GET['index'];
    // 判断是否越界
    if(($totalNum-1)<$getIndex){
        $message = '索引越界,使用随机索引:'.$index;
    }else{
        // 使用提交的索引
        $index = $getIndex;
        $message = '正常返回,索引:'.$index;
    }
}else{
    $message = '未传递 参数 index ,使用随机值:'.$index;
}

echo json_encode(array(
'total'=>$totalNum,
'message'=>$message,
'max'=>$totalNum-1,
'item'=>$arr[$index]
)
);
sleep(2);
?>