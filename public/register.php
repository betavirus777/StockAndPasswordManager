<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("register_form.php", ["title" => "Register", 'navbar' => '']);
    }

    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["username"]))
        {
            render('display.php', ['message' => "You must provide your username.", 'navbar' => '']);
        }
        else if (empty($_POST["password"]))
        {
            render('display.php', ['message' => "You must provide your password.", 'navbar' => '']);
        }
        else if (empty($_POST["email"]))
        {
        	render('display.php', ['message' => "You must provide your email.", 'navbar' => '']);
        }
        else if($_POST["password"] !== $_POST["confirmation"])
        {
            render('display.php', ['message' => "Password doesn't match.", 'navbar' => '']);
        }
        
        $ret = DB::query("SELECT * FROM users WHERE username = %s", $_POST['username']);

        if(count($ret) != 0)
        {
            render('display.php', ['message' => "Username already exists.", 'navbar' => '']);
        }
        else
        {
        	$ret = DB::insertIgnore('users', array(
        			'username' => $_POST['username'],
        			'hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        			'email' => $_POST['email'],
        			'cash' => 10000.0
        	));
            $id = DB::queryFirstField("SELECT id FROM users WHERE username = %s", $_POST['username']);
           
            $_SESSION['id'] = $id;
            $_SESSION["username"] = $_POST['username'];
            
            render('display.php', ['message' => 'Registered Successfully!', 'navbar' => '']);
        }
    }
    
    else
        render('display.php', ['message' => 'Something went wrong. Please try again.', 'navbar' => '']);

?>