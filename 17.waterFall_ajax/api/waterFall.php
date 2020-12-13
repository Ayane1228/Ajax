<?php

// 设置返回的为 json
header('content-type:application/json;charset=utf-8');

if(array_key_exists('currentPage',$_POST)&&array_key_exists('pageSize',$_POST)){
    // 获取 数据
    // 页码
    $currentPage = $_POST['currentPage'];
    
    // 页容量
    $pageSize = $_POST['pageSize'];
    
    // 读取数据 string
    $jsonString = file_get_contents('../info/data.json');
    
    // 转化 string -> obj
    $totalArr = json_decode($jsonString);
    
    // var_dump($totalArr);
    
    // 获取 指定的数据
    // 假设 第一页  页容量为5  (1-1) * 5 = 0;
    // 假设 第二页  页容量为5  (2-1) * 5 = 5;
    $pageData = array_slice($totalArr,($currentPage-1)*$pageSize,$pageSize);
    
    // 返回给用户  当前页
    $currentPage;
    // 总页数 根据用户传递的参数 叶荣良计算出来的
    $totalPage = ceil(count($totalArr)/$pageSize);
    
    // 包装为 关系型数组
    echo json_encode( array(
		'currentPage'=>$currentPage,
		'totalPage'=>$totalPage,
		'message'=>'success',
		'pageSize'=>$pageSize,
		"items"=>$pageData
    ));
    
}else{
     echo json_encode(array(
		 'message'=>'pageSize and currentPage is necessary please check and retry'
	 ));
}

sleep(2);
?>