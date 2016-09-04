<?php 

    $num = number_format($price, 2,'.', '');
echo
<<<_END
	<div class='container text-left'>
    <table class="table table-striped">
	<thead>
    <tr>
        <th>Symbol</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
	<tr>
        <td>{$symbol}</td>
        <td>{$name}</td>
        <td>{$num}</td>
    </tr>
	</tbody>
</table>
</div>
_END;
    
?>