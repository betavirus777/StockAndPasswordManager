<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("edit_form.php", ["title" => "Edit Password", 'navbar' => 'pass']);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if(empty($_POST['name']))
    	{
    		render('display.php', ['message' => "You must select Name.", 'navbar' => 'pass']);
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
    	
    	$ret = DB::query("UPDATE passwords SET password = %s WHERE (name = %s AND user_id = %i)", $_POST["password"], $_POST['name'], $_SESSION["id"]);
    	
    	render("display.php", ["message" => "Password Updated Successfully.", 'navbar' => 'pass']);
    }
    
?>