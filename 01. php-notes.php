- trap negative input and if order is greater than quantity




$order_id = uniqid();  //uniqid is a tracking number
id="'.$row["id"];  //you can add also db row on id in css

trap negative input and if order is greater than quantity
*********************************************************
<input class="form-control" type="number" name="quantity" min="1" max="<?php echo $row["product_qty"]; ?>" value="1">
