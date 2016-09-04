<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("remove_form.php", ["title" => "Remove Password", 'navbar' => 'pass']);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if(empty($_POST['remove']))
    	{
    		render('display.php', ['message' => "You must select Name.", 'navbar' => 'pass']);
    	}
    	
    	$hash = DB::queryFirstField("SELECT hash FROM users WHERE username = %s", $_SESSION["username"]);
    	if (!password_verify($_POST["password_"], $hash))
    	{
    		logout();
    		render('display.php', ['message' => "Invalid Account Password. Please Login to Continue", 'navbar' => '']);
    	}
    	
    	$ret = DB::query("DELETE FROM passwords WHERE (name = %s AND user_id = %i)", $_POST['remove'], $_SESSION['id']);
    	
    	render("display.php", ["message" => "Password Deleted Successfully.", 'navbar' => 'pass']);
    }
    
?>