<?php
//ISAGOL ANG DATA SA OSA KA COLUMN
$order_id = uniqid();  //uniqid is a tracking number
$address = $_POST['Street'].','.$_POST['Baranggay'].','.$_POST['Province'].','.$_POST['zip-code'].'('.$_POST['land-mark'].')';
$connect=mysqli_connect("localhost","root","","sinugba");
$insertToOrders = "insert into orders(customer_id,order_id,total,delivery_address,notes)
                   values('".$_SESSION['id']."','".$order_id."','".$total."','".$address."','".$_POST['Notes']."')";
$insertToOrders_result = mysqli_query($connect, $insertToOrders);

//INSERT DERITSO ANG FORMS
mysqli_query($link,"insert into admin values('','$_POST[purpose]','$dst1','$_POST[username]','$_POST[pwd]','$_POST[fname]',1)");

?>