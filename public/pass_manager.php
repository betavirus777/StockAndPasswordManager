<?php 
	
	require_once "/home/vhosts/tenison4.ueuo.com/include/config.php";
	
	if(empty($_SESSION["id"]))
	{
		redirect("/public/login.php");
	}
	$id = $_SESSION["id"];
	
	$rows = DB::query("SELECT * FROM passwords WHERE user_id = %i", $id);
	
	render('my_pass.php', ['title' => 'Passwords', 'navbar' => 'pass', 'rows' => $rows]);
	
?>