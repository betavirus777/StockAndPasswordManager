<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("quote_form.php", ["title" => "Quote", 'navbar' => 'stock']);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["symbol"]))
            render('display.php', ['message' => "Please enter the symbol.", 'navbar' => 'stock']);
            
        $stock = lookup($_POST["symbol"]);
        if($stock == false)
            render('display.php', ['message' => "Invalid symbol.", 'navbar' => 'stock']);
            
        $symbol = $stock["symbol"];
        $price = $stock['price'];
        $name = $stock['name'];
    	
    	render('quote_result.php', ['title' => $name, 'symbol' => $symbol, 'price' => $price, 'name' => $name, 'navbar' => 'stock']);
    }
    
    else
        render('display.php', ['message' => "Something went wrong... Please try again", 'navbar' => 'stock']);

?>
