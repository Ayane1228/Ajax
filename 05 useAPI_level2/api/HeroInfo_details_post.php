<?php
// 设置返回的是 json
header('content-type:application/json;charset=utf-8');

if(array_key_exists('name',$_POST)){
    // 获取提交数值
    $name = $_POST['name'];

     // 读取json数据
    $jsonString = file_get_contents('data/heros_detailsWIthURL.json');
    // print_r($jsonString);
    // 转化为 数组
    $jsonArr = json_decode($jsonString,true);
    // print_r($jsonArr);

    // 判断是否有这个英雄
    if(array_key_exists($name,$jsonArr)){
        // 返回英雄数据
        echo json_encode(
            array(
            'status'=>'success',
            'info'=>'获取成功',
            'data'=>$jsonArr[$name],
            )
        );
    }else{
        // 不存在的英雄
        // 格式化JSON数据并返回
        echo json_encode(
            array(
            'status'=>'error',
            'info'=>'不存在的英雄,请检查'
            )
        );
    }

  
}else{
    echo json_encode(
        array(
        'status'=>'error',
        'info'=>'必须传递name属性,请检查'
        )
    );
}

?>