<?php
/*
note: notification: bisan kapila siya mo edit, butangi lang og 1 and database meaning nagpahibaw na naay gi update sa post
      				inig click nimo sa notification i update ang 1 og 0 meaning na read na nimo ang update

      count notification: - i sulod lang og while loop then pag declare of 0 variable
						  - kong pila kabook 1 kay i count lang using while
*/


//example_1
$sql = "select * from order_items WHERE order_id = '" . $oderId . "'";
$status = '';
$resultOrders = mysqli_query($link, $sql);
if(mysqli_num_rows($resultOrders)){
    while($rowOrders = mysqli_fetch_assoc($resultOrders)) {
        $status = $rowOrders['status'];
    }
}

//i convert and data using json_decode into string array
//$orders = json_decode($row['order_items'], true);

if( $status == "Pending") { //check the url single_order.php?id=41&status=Pending
    $statusClass = 'info';
} else if( $status == "Delivering") {
    $statusClass = 'warning';
} else if( $status == "Completed") {
    $statusClass = 'success';
} else {
    $statusClass = 'warning';
}
?>

<?php
	if ($row['payment'] == 'Cash-On-Delivery'){
?>
<p><label>Status: </label> <span class="label label-<?php echo $statusClass; ?>"><?php echo $status; ?></span></p>
?>