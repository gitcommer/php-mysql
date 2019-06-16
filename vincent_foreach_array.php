<?php

?>
<tbody>
    <!--get session data, transfer to $item and display-->
    <?php foreach($_SESSION['cart'] as $item): ?>
    <tr>
        <td><?php echo $item['product_name']; ?></td>
        <td>&#x20B1;<?php echo $item['product_price']; ?></td>
        <td>X <?php echo $item['quantity']; ?></td>
        <td>&#x20B1;<?php echo $item['quantity'] * $item['product_price'];?></td>
    </tr>
    <?php endforeach;?>
</tbody>