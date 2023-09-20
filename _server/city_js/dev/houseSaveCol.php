<?php
if(!file_exists("house_colliders") ) {
	mkdir("house_colliders");
}
$id = (int)$_POST['id'];
$place = (int)$_POST['place'];

file_put_contents("house_colliders/{$id}_{$place}.js", $_POST['data']);
	
	


