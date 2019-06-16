<?php
/*
GET & POST
**********
notes: 	- pwede ra mo send ka og id sa url unya kohaon na sa bisan asa na page using GET like advertisement.php?id='.$_SESSION['id'] then inig ka GET pud dapat $_GET["id"];
*/


if(isset($_GET['action']) == 'delete') {  //mao ni makita sa link checkout.m.cus.php?action=delete&product_id=12
<a href="?action=delete&product_id=<?php echo $item['product_id']; ?>"><button type="button" class="btn btn-danger btn-xs">Remove</button></a>

//ang GET mo search na siya og data sa url like kini na link pwede id ra iyang koha-on sa $_GET['id']
checkout.m.cus.php?action=delete&id=22
?>
