<?php
/*
NOTE
****
- pwede ka mogamit og session, isumpay nimo sa link
- pwede ka mogamit og id, isumpay nimo sa link
- pwede sad inig redirect sa page, isumpay nimo sa link
- pwede sad variable imong i display sa url


ERROR
*****
- mo error siya kong mogamit raka of if() like tago tago-an ra nimo ang data kay dili man mo refresh ang page

*/
?>

<!--try-->
<a href="orders.bus.view.php?id=<?php echo $row['id']; ?>">View Order</a>

<!--pwede link lang dyud i try lang dili ba mo error-->
<a href="orders.bus.view.php">View Order</a>

<!--pwede ra id ra imong ibutang sa value=""-->
<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">



<script type="text/javascript">
//kinahanglan naa ng ?id= para dili mo error ang line 148
window.location='checkout.m.cus.php?id=';
//line 148
$_SESSION['business_id'] = $_GET['id'];
</script>