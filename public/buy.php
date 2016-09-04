<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if (($_SERVER["REQUEST_METHOD"] == "POST") || (($_SERVER["REQUEST_METHOD"] == "GET")&&(!empty($_GET['i']))))
    {
        if(!lookup($_POST['symbol']))
        {
            render('display.php', ['message' => "Error : Invaid_Symbol.", 'navbar' => 'stock']);
            exit;
        }
        if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            render('display.php', ['message' => "Error : Invaid_Share_Value.", 'navbar' => 'stock']);
            exit;
        }
        
        $user_balance = DB::query("SELECT cash FROM users WHERE id = %i", $_SESSION["id"]);
        if(!$user_balance)
        {
            render('display.php', ['message' => "Error : Session_Expired.", 'navbar' => 'stock']);
            exit;
        }
        $user_balance = $user_balance[0];
        $user_balance = $user_balance['cash'];
        
        $share = lookup($_POST['symbol']);
        $symbol = $share['symbol'];
        $price = $share['price'];
        $cost = $price*$_POST["shares"];
        $date = date("d/m/Y h:i:sa");
        
        if($user_balance < $cost)
        {
            render('display.php', ['message' => "Error : Not_Enough_Cash", 'navbar' => 'stock']);
            exit;
        }
        
        $maxid = DB::queryFirstField("SELECT max(id) FROM portfolios");
        $maxid = $maxid + 1;
        
        DB::startTransaction();
        $ret = DB::query("INSERT INTO portfolios VALUES(%i, %i, %s, %i, %d) ON DUPLICATE KEY UPDATE shares = shares + %i", $maxid, $_SESSION["id"], $symbol, $_POST["shares"], $cost, $_POST["shares"]);
        $ret = DB::query("UPDATE users SET cash = cash - %i WHERE id = %i", $cost, $_SESSION['id']);
        DB::commit();
        
        $ret = DB::query("INSERT INTO history VALUES(%i, %i, %s, %i, %d, %s)", $_SESSION["id"], 1, $symbol, $_POST["shares"], $cost, $date);
        
        render("display.php", ["message" => "Shares Bought Successfully.", 'navbar' => 'stock']);
    }
    else
    {
    	render("buy_form.php", ["title" => "Buy", 'navbar' => 'stock']);
    }
    
?>