<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("sell_form.php", ["title" => "Sell", 'navbar' => 'stock']);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if(empty($_POST['symbol']))
    	{
    		render('display.php', ['message' => "You must provide Symbol.", 'navbar' => 'stock']);
    	}
        $sym = $_POST['symbol'];
        $cost = lookup($sym);
        $cost = $cost['price'];
        $shares = DB::queryFirstField("SELECT shares FROM portfolios WHERE (user_id = %i AND symbol = %s)",$_SESSION['id'], $sym);
        $cost = $cost*$shares;
        $date = date("d/m/Y h:i:sa");

        DB::startTransaction();
        $ret = DB::query("DELETE FROM portfolios WHERE user_id = %i AND symbol = %s", $_SESSION['id'], $sym);
        if($ret == 0)
        {
            DB::rollback();
            apologize("Error : USER_DOES_NOT_EXIST");
            exit;
        }
        $ret = DB::query("UPDATE users SET cash = cash + %i WHERE id = %i", $cost, $_SESSION['id']);
        DB::commit();
        
        $ret = DB::query("INSERT INTO history VALUES(%i, %i, %s, %i, %d, %s)", $_SESSION["id"], 2, $sym, $shares, $cost, $date);
        
        render("display.php", ["message" => "Transaction Successful", 'navbar' => 'stock']);
    }