<?php 
	// 获取数据
	$userName = $_GET['name'];

	// 数组
	$nameArr  = json_decode(file_get_contents('./data/user.json'));
	
	
	// 判断并返回结果
	$result = in_array($userName,$nameArr);
	if($result){
		echo '很遗憾,用不了';
	}else{
		echo '恭喜你 可以使用';
	}
	sleep(1);
 ?>