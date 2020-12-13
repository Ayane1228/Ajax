<?php 
	// 获取数据
	$mobile = $_POST['mobile'];

	// 数组
	$mobileArr  = json_decode(file_get_contents('./data/mobile.json'));
	
	
	// 判断并返回结果
	$result = in_array($mobile,$mobileArr);
	if($result){
		echo '很遗憾,已被使用';
	}else{
		echo '恭喜你,可以使用';
	}
	sleep(1);
 ?>