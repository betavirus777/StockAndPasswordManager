<?php 
	
	require_once "/home/vhosts/tenison4.ueuo.com/include/config.php";
	
	if(empty($_SESSION["id"]))
	{
		redirect("/public/login.php");
	}
	$id = $_SESSION["id"];
	
	$rows = DB::query("SELECT * FROM portfolios WHERE user_id = %i", $id);
	$cash = DB::queryFirstField("SELECT cash FROM users WHERE id = %i", $id);
	
	$positions = [];
	foreach ($rows as $row)
	{
		$stock = lookup($row["symbol"]);
		if ($stock !== false)
		{
			$positions[] = [
					"name" => $stock["name"],
					"price" => $stock["price"],
					"shares" => $row["shares"],
					"symbol" => $row["symbol"]
			];
		}
	}
	
	render('portfolio.php', ['title' => 'Portfolio', 'navbar' => 'stock', "positions" => $positions, "cash" => $cash]);
	
?>