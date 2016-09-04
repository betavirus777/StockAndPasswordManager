<?php

require_once "/home/vhosts/tenison4.ueuo.com/include/helpers.php";

echo <<<_END
<div class='container text-center'>
<form action="sell.php" method="post">
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <select class="form-control" name="symbol">
                <option disabled selected value="">Symbol</option>
_END;

    $id = $_SESSION['id'];
    $rows = DB::query("SELECT symbol FROM portfolios WHERE user_id = %i", $id);
    foreach($rows as $row)
    {
        $sym = $row['symbol'];
        echo "<option value='{$sym}'>{$sym}</option>";
    }

echo <<<_END
            </select>
        </div>
        <div class='form-group col-lg-4 col-lg-offset-4'>
            <button class="btn btn-danger" type="submit">Sell</button>
        </div>
</form>
</div>
_END;

?>