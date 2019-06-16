<?php
/*
********** NOTES *******************************************

<form name="form1" action="" method="post"> 	- default na ang action="", meaning mo send ra siya sa kaogalingon na page
increment 	- to increment use loop
checking variables 	- ang pag check variable kay katong naana sa ubos like gi declare siya sa taas unya gi update siya sa ubos ang i check kay kato ng naa sa ubos

WHERE - is use in selecting specific (column) in the (table)
how FK works - makabalo ka kinsay owner ani na product or order
			 - inig insert nimo sa product kay i insert sd nimo ang owner id then if i select nimo sa owner id
			   kay i display niya ang product ani na owner id
SELECT 		 - is use to get data in the database
selecting timestamp: 	$row_User['Timestamp'];
display image: 	<img src="../admin.responsive/<?php echo $row["product_img"]; ?>" alt="" height="300"/>

relation: - pwede ka mag select using session
		  - pwede ka mag select using GET id

*/
?>


<!--********** MYSQL *******************************************-->

<?php
$res=mysqli_query($link,"select id from checkout_address order by id desc limit 1"); //i select and pinaka latest na data na nisulod (desc from 1 to highest)
$res=mysqli_query($link,"select * from admin_login where username='$_POST[username]' && password='$_POST[pwd]'"); //select what you have entered
$res=mysqli_query($link,"select * from confirm_order_product where order_id=$id"); //order_id is the column of confirm_order_product (table) youtube_project/admin/shop.php
$res=mysqli_query($link,"select * from {$statement} LIMIT {$startpoint} , {$limit}"); //pwede sad sudlan nimo ang mysql og php variable
$res=mysqli_query($link,"select * from product"); //pwede nimo i display tanan or magpili raka og column na imong i display
$res=mysqli_query($link,"select * from product where admin_id='{$_SESSION['admin']}'"); //selecting session data
$res = mysqli_query($link, "select * from product where product_image='$img1'"); //pwede sd image imong gamiton
$query_1 = "SELECT * FROM comments WHERE comment_status=0"; //select active number
?>


<!--********** SELECT NEW INSERTED DATA ************************-->

<?php
//SELECT NEW INSERTED DATA
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");
	$res=mysqli_query($link,"select id from checkout_address order by id desc limit 1");
	while($row=mysqli_fetch_array($res))
	{
		$_SESSION["order_id"]=$row["id"]; 
	}
	?>
	<script type="text/javascript">
		alert("click ok to transferring to you in paypal");
		setTimeout(function(){
			window.location="paypal.php";
	},4000); 
</script>
<?php
}
?>


<!--********** GET SPECIFIC ID, GET THE DATA & INSERT THE DATA-->

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");
$order_id=$_GET["id"]; 
$res=mysqli_query($link,"select * from checkout_address where id=$order_id"); 
while($row=mysqli_fetch_array($res)) 
{
	$fname=$row["firstname"]; //firstname mao na ang pagnalan sa column sa database
	$lname=$row["lastname"];
	$email=$row["email"];
	$address=$row["address"];
	$city=$row["city"];
	$pincode=$row["pincode"];
	$contactno=$row["contactno"];
}
mysqli_query($link,"insert into confirm_order_address values('','$fname','$lname','$email','$address','$city','$pincode','$contactno')");
?>


<!--********** DISPLAY ALL DATA *****************************-->

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");
$res=mysqli_query($link,"select * from admin"); 
while($row=mysqli_fetch_array($res))  
{
	?>
	<li><a href=""><i class="fa fa-user"></i><?php echo $row['username']; ?></a></li>
	<?php 
}



/*W3SCHOOL SELECT
****************/
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>



<!--SELECT INSIDE SELECT-->
<?php
$sql = "select * from orders WHERE customer_id = '".$_SESSION['id']."'order by id desc";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result)){
	while($row = mysqli_fetch_assoc($result)){
		?>
		<td><?php echo strtoupper($row['order_id']); ?></td>
		<?php

		$sql = "select * from order_items WHERE order_id = '" . $row['order_id'] . "'";
    	$result1 = mysqli_query($link, $sql);
    	if(mysqli_num_rows($result1)){
      		while($orderStatus = mysqli_fetch_assoc($result1)){
      			?>
      			<td><?php echo $row['payment']; ?></td>
      			<?php
      		}
    	}
	}
}
?>



<?php
//TABLE RELATION
$orderIdRes = mysqli_query($connect, "select * from orders where id='$_GET[id]'");
if (mysqli_num_rows($orderIdRes) > 0) {
  while ($orderRow = mysqli_fetch_array($orderIdRes)) {
    $orderId = $orderRow['id'];  //order pk id
    $orderid = $orderRow['order_id']; //order tracking id

        $salesRes = mysqli_query($connect, "select * from sales where order_id='$orderid'");
        if (mysqli_num_rows($salesRes) > 0) {
          while ($salesRow = mysqli_fetch_array($salesRes)) {
            $delCharge = $salesRow['delivery_charge'];
          }
        }
  }
}
?>

<!--orders.bus.view.php?id=68 - is the order id in orders table (relate to admin table id=29 is the customer id)-->
<div class="col-sm-8"></div>
<div class="col-sm-4"><h4>Delivery Charge: <span style="color: #df514d;">&#x20B1;<?php echo $delCharge; ?></span></h4>
  <p style="font-size: 25px;">Total Amount: &#x20B1;<?php echo $total; ?></p>
</div>