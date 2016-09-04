<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("feedback_form.php", ["title" => "Remove Password", 'navbar' => 'pass']);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	
    }
    
?>