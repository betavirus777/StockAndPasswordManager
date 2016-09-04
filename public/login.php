<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("login_form.php", ["title" => "Log In", 'navbar' => '']);
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
        
        $rows = DB::query("SELECT * FROM users WHERE username = %s", $_POST["username"]);

        if (count($rows) == 1)
        {
            $row = $rows[0];

            if (password_verify($_POST["password"], $row["hash"]))
            {
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                render('main.php', ['title' => 'Stock and Password Manager', 'navbar' => '']);
            }
        }

        render('display.php', ['message' => "Invalid username and/or password.", 'navbar' => '']);
    }
    
    else
    {
    	render('display.php', ['message' => "ERROR : login.php", 'navbar' => '']);
    	exit;
    }

?>