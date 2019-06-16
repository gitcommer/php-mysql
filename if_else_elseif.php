<?php
/*
note:  - unsay sulod sa {} sa if statement kay iya ng i perform tanan pero kong imong ipagawas kay dili na niya i apil
*/


//you can use string to check
$orderStatus = "saved";
if($orderStatus == "saved"):

//check if user login
session_start();
if (isset($_SESSION['id']) == "") {
  ?>
  <script type="text/javascript">
    window.location="login.order.php";
  </script>
  <?php
}else{

//example_2
if($pending >= 1) {
	$status = "Pending";
} else if($inProgress >= 1) {
	$status = "Delivering";
} else if($completed >= 1) {
	$status = "Completed";
} else {
	$status = "Declined";
}

//example_3
if(isset($_POST['order_id'])) {  /*<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">*/
//example_4
if($status == "Completed" AND $oderId == isset($ratingCheck)){



//loop but when see a Mark it will redirect
$resultCusID = mysqli_query($link, "select * from sales where customer_id='$_SESSION[id]'");
if (mysqli_num_rows($resultCusID)) {
	while ($rowCusID = mysqli_fetch_assoc($resultCusID)) {
		$cusStatus = $rowCusID['status'];
		if ($cusStatus == "Mark") {
			?>
			<script type="text/javascript">
				alert("Were very sorry for inconvenience. But we have problem to this account.");
				window.location='checkout.m.cus.php?id='; //kinahanglan naa ng ?id= para dili mo error ang line 148
			</script>
			<?php
		}
	}
}
?>