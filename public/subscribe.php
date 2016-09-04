<?php
	
	require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render('main.php', ['title' => 'Stock and Password Manager', 'navbar' => '']);
	}
	
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["name"]))
		{
			render('display.php', ['message' => "You must provide Name.", 'navbar' => '']);
		}
		else if (empty($_POST["email"]))
		{
			render('display.php', ['message' => "You must provide your Email.", 'navbar' => '']);
		}
		
		$ret = DB::query("SELECT * FROM subscribe WHERE email = %s", $_POST["email"]);
		if($ret)
		{
			render('display.php', ['message' => "You are already subscribed.", 'navbar' => '']);
		}
		else 
		{
			DB::query("INSERT INTO subscribe VALUES(%s, %s)", $_POST["name"], $_POST["email"]);
			render('display.php', ['message' => "Subscribed Successfully.", 'navbar' => '']);
		}
	}
	
?>