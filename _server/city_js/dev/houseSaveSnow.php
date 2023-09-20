<?php
if(!file_exists("house_snow") ) {
	mkdir("house_snow");
}
$id = (int)$_POST['id'];
$cur = (int)$_POST['cur'];
$total = (int)$_POST['total'];
$partsize = 1000000;
if($total>0) {
	file_put_contents("house_snow/{$id}_{$cur}.js", $_POST['data']);
	//m	ove_uploaded_file($_FILES["file"]["tmp_name"], "house_snow/".$_POST['id'].'.js');
	if($cur+$partsize>=$total) {
        $data = '';
		for($i=0; $i<$total; $i+=$partsize) {
            $data .= file_get_contents("house_snow/{$id}_{$i}.js");
        }
        file_put_contents("house_snow/{$id}.js", $data);
        for($i=0; $i<$total; $i+=$partsize) {
            unlink("house_snow/{$id}_{$i}.js");
        }
	}
}

