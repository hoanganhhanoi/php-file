<?php
	$dir    = 'C:\xampp\htdocs\test';
	$files = glob($dir . "\*.bin");
	$list_files = array();
	foreach ($files as $key => $value) {
		array_push($list_files, basename($value));
	}

	echo json_encode($list_files);
?>