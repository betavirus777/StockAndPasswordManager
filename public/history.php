<?php
	require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

	$ret = DB::query("SELECT * FROM history");
	
	render("history.php", ["rows" => $ret, "title" => "History", 'navbar' => 'stock']);
	
?>