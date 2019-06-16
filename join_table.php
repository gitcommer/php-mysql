<?php
/*
NOTE
****
how to relate 2 table: 	- pangita og (pariha og unique) na data nga naa sa doha ka table
*/


//rl.store.branches.php
$result = mysqli_query($link, "SELECT * FROM advertise WHERE admin_id='$_GET[id]'");
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)) {
		$store_name = $row['store_name'];

		$storeResult = mysqli_query($link, "SELECT * FROM stores WHERE adminID='$_GET[id]'");
		while($storeRow = mysqli_fetch_array($storeResult))	{
			$storeBranch = $storeRow['storeBranch'];
		}
	}
}



//order.bus.receive.php
$link = mysqli_connect("localhost", "root", "", "sinugba");
$sql = "SELECT DISTINCT orders.id, orders.order_date, orders.payment, 
                        order_items.order_id, order_items.status
        FROM order_items INNER JOIN orders 
        /*select same order_id from order_items and orders ang tag-iya kay kinsa naka login*/
        ON order_items.order_id = orders.order_id WHERE business_id = '".$_SESSION['id']."' order by id desc "; 
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result)) {
	while($row = mysqli_fetch_assoc($result)) {
		$status = $row['status'];
		$payment = $row['payment'];
		?>
		<table border="1">
			<tr>
				<!--order_items table-->
				<td><?php echo $status; ?></td>
				<!--orders table-->
				<td><?php echo $payment; ?></td>
			</tr>
		</table>
		<?php
	}
}
?>