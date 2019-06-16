<table class="table table-bordered">
    <thead>
        <tr style="background-color:#df514d; color: #ffffff;">
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
	</thead>
    <tbody>

    <?php
      $res1=mysqli_query($link,"select * from admin where id='{$_SESSION['id']}'");
      while($row1=mysqli_fetch_array($res1))
      {
        $admin_id=$row1["admin_id"];
      }

    $total = 0; //maong nag declare ka og zero diri para mag start sa zero ang computation
    //first query
    $sql = "select * from order_items WHERE order_id = '" . $row['order_id'] . "' and business_id=".$admin_id; 
    $resultOrderItems = mysqli_query($link, $sql);
    if(mysqli_num_rows($resultOrderItems)):
        while($orderItems = mysqli_fetch_assoc($resultOrderItems)):

            //second query
            $sql = "select * from product WHERE product_id = " . $orderItems['product_id'];
            $resultProductItems = mysqli_query($link, $sql);
            if(mysqli_num_rows($resultProductItems)):
                while($productItems = mysqli_fetch_assoc($resultProductItems)):
                    $total += $orderItems['quantity'] * $productItems['product_price'];
        ?>
        <tr>
            <td><?php echo $productItems['product_name']; ?></td>
            <td><?php echo $productItems['product_price']; ?></td>
            <td>X <?php echo $orderItems['quantity']; ?></td>
            <td><?php echo $orderItems['quantity'] * $productItems['product_price']; ?></td>
        </tr>
            <?php endwhile; endif; ?>
    <?php endwhile; endif; ?>
    </tbody>
</table>