<?php
	require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

    echo
<<<_END
	<div class='container text-left'>
    <table class="table table-striped">
	<thead>
    <tr>
        <th>Name</th>
        <th>Action</th>
        <th>Password</th>
		<th> </th>
    </tr>
    </thead>
    <tbody>
_END;

    $count = 0;
    foreach($rows as $row)
    {
    	$count = $count + 1;
    	$name = $row['name'];
    	$password = $row['password'];
    	$pass = [];
    	$length = strlen($password);
    	
    	for($i=0; $i<$length; $i=$i+1)
    		$pass[$i] = '*';
    	$pass = implode($pass);
    	
    	echo
    	<<<_END
    
    <tr>
        <td>$name</td>
        <td><button type='button' id="button{$count}" class='btn btn-warning btn-sm' onClick='replace_value("{$password}", "pass{$count}", "button{$count}", "{$pass}");'> Show Password</button></td>
        <td id="pass{$count}">{$pass}</td>
    </tr>
_END;
    }
    	
    echo
    <<<_END
    </tbody>
    </table>
</div>
    		
<div class='text-center'>
    <h4><a href="/public/edit.php">Edit</a> a Password.</h4>
    <h4><a href="/public/add.php">Add</a> a Password.</h4>
</div>
    
_END;
?>
    
    <script language="javascript" type="text/javascript">

    function replace_value(new_value, id1, id2, pass){
    	var elem1 = document.getElementById(id1);
    	var elem2 = document.getElementById(id2);
    	if (elem2.innerHTML==" Show Password"){
        	elem2.innerHTML = " Hide Password";
            elem1.innerHTML = new_value;
    	}
        else{
            elem2.innerHTML = " Show Password";
            elem1.innerHTML = pass;
        }
    	
    }

    </script>