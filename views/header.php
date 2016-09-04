<?php require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<?php if (!empty($title)): ?>
            <title>tenison4: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>tenison4</title>
        <?php endif ?>
		
		<link rel="stylesheet" href="/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/public/css/bootstrap-theme.min.css">
		
		<link rel="shortcut icon" href="/public/img/favicon.ico">
		
		<style>
		body{
			padding-top: 40px;
		}
		h1, h2, h3, h4, h5, h6, p, div{
			
		}
		</style>
	</head>
	
	<body>
		
		<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
			<div class="container">
				<div class="navbar-header">
					<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbar-collapse'>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a href="/" class="navbar-brand">tenison4</a>
				</div>
				
				<div class='collapse navbar-collapse' id='navbar-collapse'>
					<?php if (empty($navbar)): ?>
					<ul class="nav navbar-nav">
						<li><a href="/public/finance.php">Stock Manager</a>
						<li><a href="/public/pass_manager.php">Password Manager</a>
						<!-- <li><a href="/public/feedback.php">Feedback</a> -->
						<?php if (empty($_SESSION["username"])): ?>
						<li><a href="/public/login.php">Login/Register</a>
						<?php endif ?>
						<?php if (!empty($_SESSION["username"])): ?>
						<?php $user = $_SESSION["username"]; ?>
						<li><a href="/public/logout.php">Log Out (<?php echo "{$user}"?>)</a>
						<?php endif ?>
					</ul>
					<?php endif ?>
					
					<?php if ($navbar == 'stock'): ?>
					<?php if (empty($_SESSION['id'])): ?>
					<?php redirect('../public/login.php'); ?>
					<?php exit(); ?>
					<?php endif ?>
					<ul class="nav navbar-nav">
						<li><a href="/public/finance.php">Portfolio</a>
						<li><a href="/public/quote.php">Quote Stock</a>
						<li><a href="/public/buy.php">Buy Stock</a>
						<li><a href="/public/sell.php">Sell Stock</a>
						<li><a href="/public/history.php">History</a>
						<?php if (!empty($_SESSION["username"])): ?>
						<?php $user = $_SESSION["username"]; ?>
						<li><a href="/public/logout.php">Log Out (<?php echo "{$user}"?>)</a>
						<?php endif ?>
					</ul>
					<?php endif ?>
					
					<?php if ($navbar == 'pass'): ?>
					<?php if (empty($_SESSION['id'])): ?>
					<?php redirect('../public/login.php'); ?>
					<?php exit(); ?>
					<?php endif ?>
					<ul class="nav navbar-nav">
						<li><a href="/public/pass_manager.php">My Passwords</a>
						<li><a href="/public/add.php">Add Password</a>
						<li><a href="/public/edit.php">Edit Password</a>
						<li><a href="/public/remove.php">Remove Password</a>
						<?php if (!empty($_SESSION["username"])): ?>
						<?php $user = $_SESSION["username"]; ?>
						<li><a href="/public/logout.php">Log Out (<?php echo "{$user}"?>)</a>
						<?php endif ?>
					</ul>
					<?php endif ?>
				</div>
				
			</div>
		</nav>
		
		 <div class='jumbotron'>
		 	<div class='container text-center'>
		 		<img src='/public/img/header-logo.png'>
		 	</div>
		 </div>