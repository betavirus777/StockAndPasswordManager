<?php

require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

echo <<<_END
<div class='container text-center'>
<form action="edit.php" method="post">
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <select class="form-control" name="name">
                <option disabled selected value="">Name</option>
_END;

    $id = $_SESSION['id'];
    $rows = DB::query("SELECT name FROM passwords WHERE user_id = %i", $id);
    foreach($rows as $row)
    {
        $name = $row['name'];
        echo "<option value='{$name}'>{$name}</option>";
    }
    $random = random_string(25);

echo <<<_END
            </select>
        </div>
		<div class="form-group col-lg-4 col-lg-offset-4">
			<button type='button' id="buttonedit" class='btn btn-info btn-sm' onClick="random_('{$random}'); return false;"> Generate Random Password</button>
		</div>
		<div class="form-group col-lg-4 col-lg-offset-4">
            <input class="form-control" name="password" placeholder="New Password" type="password"  id='pass1'/>
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            <input class="form-control" name="confirmation" placeholder="New Password Again" type="password" id='pass2'/>
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            Your tenison4 Account Password: <input class="form-control" name="password_" placeholder="tenison4 Account Password" type="password"/>
        </div>
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <button class="btn btn-warning" type="submit">Edit</button>
        </div>
</form>
</div>
_END;

?>

<script language="javascript" type="text/javascript">

    function random_(text){
        document.getElementById('pass1').value = text;
        document.getElementById('pass2').value = text;
    }
</script>