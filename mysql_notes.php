<?php
/*SELECT OR DISPLAY
*******************
- i select ang pinaka bag-o na na insert na

*/


//i select ang pinaka bag-o na na insert na
$res=mysqli_query($link,"select id from checkout_address order by id desc limit 1");

$res=mysqli_query($link,"select * from admin_login where username='$_POST[username]' && password='$_POST[pwd]'"); //select what you have entered
$res=mysqli_query($link,"select * from confirm_order_product where order_id=$id"); //order_id is the column of confirm_order_product (table) youtube_project/admin/shop.php
$res=mysqli_query($link,"select * from {$statement} LIMIT {$startpoint} , {$limit}"); //pwede sad sudlan nimo ang mysql og php variable
$res=mysqli_query($link,"select * from product"); //pwede nimo i display tanan or magpili raka og column na imong i display
$res=mysqli_query($link,"select * from product where admin_id='{$_SESSION['admin']}'"); //selecting session data
$res = mysqli_query($link, "select * from product where product_image='$img1'"); //pwede sd image imong gamiton
$sql = "select * from orders WHERE customer_id = '".$_SESSION['id']."'order by id desc";
$query_1 = "SELECT * FROM comments WHERE comment_status=0"; //select active number
$sql = "SELECT * FROM Orders LIMIT 30";   //return 30 records
$sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";   //mo return siya og 10 records, pero mag start siyaog ihap sa 16
or
$sql = "SELECT * FROM Orders LIMIT 15, 10";
$sql = "SELECT id, firstname, lastname FROM MyGuests";

UPDATE
******
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

DELETE
******
$sql = "DELETE FROM MyGuests WHERE id=3";
*/



//INNER JOIN
        /*1. i select ni sila tanan
             unsay naa diri kay mao sd na ang ma print*/
$sql = "SELECT DISTINCT orders.id, orders.order_date, orders.payment, order_items.order_id, order_items.status
        /*2. ani na mga table*/
        FROM order_items INNER JOIN orders
        /*3. order_items=25/orders/25/user=25*/
        ON order_items.order_id = orders.order_id WHERE business_id = '".$_SESSION['id']."' order by id desc ";
$result = mysqli_query($link, $sql);

<tbody>
<?php if(mysqli_num_rows($result)):
    while($row = mysqli_fetch_assoc($result)):
?>
<tr>
    <td><?php echo strtoupper($row['order_id']); ?></td> <!--orders table-->
    <td><?php echo date('M d, Y', strtotime($row['order_date'])); ?></td> <!--orders table-->
    <td><?php echo date('h:m:s A', strtotime($row['order_date'])); ?></td>
    <td><?php echo $row['payment']; ?></td> <!--orders table-->
    <td><?php echo $row['status']; ?></td> <!--order_items table-->
    <!--pwede ra sa order_items or orders table kay pariha raman og data-->
    <td><a href="orders.bus.view.php?id=<?php echo $row['id']; ?>">View Order</a></td>
</tr>
<?php endwhile; endif; ?>
</tbody>
?>
