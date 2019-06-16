<?php
//example_1 (test if connect or not)
$link=mysqli_connect("localhost", "root", "");
$con=mysqli_select_db($link, "practice");
if ($con) {
	echo "connected";
}else{
	echo "not connected";
}
?>

<!--***************************************-->

<?php
//example_2 (use now to cruds)
$link=mysqli_connect("localhost", "root", "");
$con=mysqli_select_db($link, "igit");
if ($con) {
	echo "connected";
}else{
	echo "not connected";
}
?>



<?php 
// EXAMPLE_3 *************************************************

$connect = mysqli_connect("localhost", "root", "", "practice");
if ($connect) {
	echo "connected";
}
?>

