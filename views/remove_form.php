<?php

require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

echo <<<_END
<div class='container text-center'>
<form action="remove.php" method="post">
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <select class="form-control" name="remove">
                <option disabled selected value="">Name</option>
_END;

    $id = $_SESSION['id'];
    $rows = DB::query("SELECT name FROM passwords WHERE user_id = %i", $id);
    foreach($rows as $row)
    {
        $name = $row['name'];
        echo "<option value='{$name}'>{$name}</option>";
    }

echo <<<_END
            </select>
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            Your tenison4 Account Password: <input class="form-control" name="password_" placeholder="tenison4 Account Password" type="password"/>
        </div>
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <button class="btn btn-danger" type="submit">Remove Password</button>
        </div>
</form>
</div>
_END;

?>