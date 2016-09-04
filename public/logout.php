<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    logout();

    render('display.php', ['message' => 'Logged out Successfully.', 'navbar' => ''])

?>
