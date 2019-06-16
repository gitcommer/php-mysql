<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");
$order_id=$_GET["id"]; //bisan $order_id and naa paypal.php kay number rana na i send sa url unya kohaon ng numbera ni $_GET["id"]

//1. GET THE (DATABASE) DATA AND INSERT TO confirm_order_address (table)

//this is for getting record from temp table to permanent table
$res=mysqli_query($link,"select * from checkout_address where id=$order_id"); //order_id mao katong return sa paypal.php
while($row=mysqli_fetch_array($res)) //nag gamit siya of while pero gi assign pud niya ang mga forms data sa mga array variable
{
    $fname=$row["firstname"];
    $lname=$row["lastname"];
    $email=$row["email"];
    $address=$row["address"];
    $city=$row["city"];
    $pincode=$row["pincode"];
    $contactno=$row["contactno"];
}

//this will insert the data to confirm_order_address (table)
mysqli_query($link,"insert into confirm_order_address values('','$fname','$lname','$email','$address','$city','$pincode','$contactno')");
?>