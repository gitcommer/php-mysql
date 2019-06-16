<?php
/*shop.php
when link or image is click send the id to url

NOTES
*****
- pwede sad use redirect to display id to url like
    - header('location:advertisement.php?id='.$_SESSION['id']);
- pwede sad inig load sa page kay i display ra nimo ang url sa link
- when click link display id to url using session
- pwd ra i GET nimo ang id sa url then inig link or submit button or redirect id kay GET ra imong gamiton gihapon
*/
                    

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");

$res=mysqli_query($link,"select * from product");
while($row=mysqli_fetch_array($res))
{
?>
 <div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="../admin/<?php echo $row["product_image"]; ?>" alt="" width="180" height="381" />
                <h2>$<?php echo $row["product_price"]; ?></h2>
                <p><?php echo $row["product_name"]; ?></p>
                <a href="product_details.php?id=<?php echo $row["id"]; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Description</a>
            </div>
<?php
}
?>

<!--*****************************************************************-->

<?php
//product_details.php
//display data here

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "youtube_project");
$id = $_GET["id"];

$res = mysqli_query($link, "select * from product where id=$id");
while ($row = mysqli_fetch_array($res))
{
?>

<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="../admin/<?php echo $row["product_image"]; ?>" alt=""/> <!--display database image-->
            </div>
        </div>


        <!-- FORMS ######################################################-->

        <form name="form1" action="" method="post">
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->

                    <!--DISPLAY DATA HERE ###############################-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt=""/> <!-- display NEW image -->
                    <h2><?php echo $row["product_name"]; ?></h2> 
                    <p>Web ID: <?php echo $row["id"]; ?></p>
					<span>
						<span>US $<?php echo $row["product_price"]; ?></span>
						<label>Quantity:</label>
						<input type="text" value="1"/>
						<button type="submit" name="submit1" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
					</span>
                    <p><b>Availability:</b> <?php echo $row["product_qty"]; ?></p>
                    <p><b>Condition:</b> New</p>
                </div>
                <!--/product-information-->
            </div>
    </div>
    <!--/product-details-->
    </form>
    <!-- end here-->
    <?php
    }
?>

<!--example_3-->
<td><a href="single_order.php?id=<?php echo $row['id']; ?>&status=<?php echo $status; ?>">View Order</a>&nbsp;




<?php
//when click link display id to url using session
$res=mysqli_query($link,"select * from categories");  //pwede ra walay {}
while($row=mysqli_fetch_array($res))
{
  $_SESION['catProduct']=$row["catName"];
?>
<a href="index.php?id=<?php echo $_SESION['catProduct']; ?>"><p style="padding-left: 15px; font-size: 16px;"><?php echo $row["catName"]; ?></p></a>
<?php
}
?>