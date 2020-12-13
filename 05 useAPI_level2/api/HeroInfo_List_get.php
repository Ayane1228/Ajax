<?php
// 设置返回的是 json
header('content-type:application/json;charset=utf-8');
if(array_key_exists('num',$_GET)){
    // 获取提交数值
    $num = $_GET['num'];
    
    if($num==0){
        $num=1;
        echo json_encode(
            array(
            'status'=>'error',
            'info'=>'没有正确传递参数,请检查'
            )
        );
    }
    else if($num==1){
        $num=1;
         // 读取json数据
        $jsonString = file_get_contents('data/heros_list.json');
        
        // 转化为 数组
        $jsonArr = json_decode($jsonString,true);
        $randomKey = array_rand($jsonArr,1);
        echo json_encode(
            array(
            'status'=>'error',
            'info'=>'success',
            'data'=>array($jsonArr[$randomKey])
            )
        );
    }
    else if($num!=1){
        // 读取json数据
        $jsonString = file_get_contents('data/heros_list.json');
        
        // 转化为 数组
        $jsonArr = json_decode($jsonString,true);
        
        if($num>count($jsonArr)){
            die(json_encode(
                array(
                'status'=>'error',
                'info'=>'超出最大个数,请检查'
                )
            ));
        }
        
        // 随机获取 几个
        $randomKey = array_rand($jsonArr,$num);
        // print_r($randomKey);
        // 返回
        $backArr = array();
        for ($i=0; $i < count($randomKey); $i++) {
            // 获取 每一个key
            $randomIndex = $randomKey[$i];
            // 从 总数组中 获取某一个数据 并添加到返回的数组中
            $backArr[$i] = $jsonArr[$randomIndex];
        }
        echo json_encode(
            array(
            'status'=>'success',
            'info'=>'success',
            'data'=>$backArr,
            )
        );
    }
  
}else{
    echo json_encode(
        array(
        'status'=>'error',
        'info'=>'没有正确传递参数,请检查'
        )
    );
}

?>