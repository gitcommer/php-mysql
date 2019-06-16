<?php
/*DELETE TEXT & IMAGE (PERMANENTLY)*/

//connect to database
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");
//select dat to display
$res=mysqli_query($link,"select * from product where admin_id='{$_SESSION['admin']}'");
while($row=mysqli_fetch_array($res))
{
?>
<!--display data-->
<img src="../admin.responsive/<?php echo $row["product_img"]; ?>" alt="" height="300"/>
<h2>&#x20B1;<?php echo $row["product_price"]; ?></h2>
<!--display id to url-->
<li><a href="admin.delete.product.php?product_id=<?php echo $row["product_id"]; ?>">
<i class="fa fa-trash-o"></i>Remove</a></li>
<?php
}

//*********************************************

//delete.php
//connect to database
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "sinugba");
//get the id from url
$product_id=$_GET["product_id"];
//select data from url
$res=mysqli_query($link,"select * from product where product_id=$product_id");
while($row=mysqli_fetch_array($res)){
	$img=$row["product_img"];
}
unlink($img); //unlink the image sa folder para ma delete siya
//delete data from front-end table and in the database
mysqli_query($link,"delete from product where product_id=$product_id");
?>
<script type="text/javascript">
	alert("Do you really want to remove this product?");
	window.location="admin.display.product.php";
</script>



<?php
/*W3SCHOOL DELETE
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
// sql to delete a record
$sql = "DELETE FROM MyGuests WHERE id=3";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>


<?php
if(isset($_POST['order_id'])) {  /*<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">*/
   $sql = "DELETE FROM order_items WHERE order_id = '". $_POST['order_id'] . "'"; 
   mysqli_query($connect, $sql);
?>
