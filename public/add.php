<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if (($_SERVER["REQUEST_METHOD"] == "POST") || (($_SERVER["REQUEST_METHOD"] == "GET")&&(!empty($_GET['i']))))
    {
    	if (empty($_POST["name"]))
    	{
    		render('display.php', ['message' => "You must provide Name.", 'navbar' => 'pass']);
    	}
    	else if (empty($_POST["password"]))
    	{
    		render('display.php', ['message' => "You must provide your password.", 'navbar' => 'pass']);
    	}
    	else if($_POST["password"] !== $_POST["confirmation"])
    	{
    		render('display.php', ['message' => "Password doesn't match.", 'navbar' => 'pass']);
    	}
    	
    	$hash = DB::queryFirstField("SELECT hash FROM users WHERE username = %s", $_SESSION["username"]);
    	if (!password_verify($_POST["password_"], $hash))
    	{
    		logout();
    		render('display.php', ['message' => "Invalid Account Password. Please Login to Continue", 'navbar' => '']);
    	}
    	
    	$rows = DB::query("SELECT name FROM passwords WHERE user_id = %i", $_SESSION["id"]);
    	foreach($rows as $row)
    	{
    		if($row['name'] == $_POST["name"])
    		{
    			render('display.php', ['message' => "A password with the same name Already Exists.", 'navbar' => 'pass']);
    		}
    	}
    	
    	$maxid = DB::queryFirstField("SELECT max(id) FROM passwords");
    	$maxid = $maxid + 1;
    	
    	$ret = DB::query("INSERT INTO passwords VALUES(%i, %i, %s, %s)", $maxid, $_SESSION["id"], $_POST["name"], $_POST["password"]);
    	
    	render('display.php', ['message' => "Password added Successfully.", 'navbar' => 'pass']);
    }
    
    else
    {
    	render("add_form.php", ["title" => "Add Password", 'navbar' => 'pass']);
    }
    
?>