<?php
    
    echo
<<<_END
	<div class='container text-left'>
    <table class="table table-striped">
	<thead>
    <tr>
        <th>Type</th>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
_END;

    foreach($rows as $row)
    {
        $type = $row['type'];
        if($type == 1)
        	$type = "BOUGHT";
        else if($type == 2)
        	$type = "SOLD";
        else $type = "Invaid";
        $symbol = $row['symbol'];
        $shares = $row['shares'];
        $price = $row['price'];
        $date = $row['date'];
        echo
<<<_END

    <tr>
        <td>$type</td>
        <td>$symbol</td>
        <td>$shares</td>
        <td>$price</td>
        <td>$date</td>
    </tr>
_END;
    }
   
echo
<<<_END
	</tbody>
</table>
</div>
_END;
    
?>