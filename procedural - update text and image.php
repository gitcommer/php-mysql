<?php
/*
1. connect to database
2. when click button or link or image, send the id to url and display the id data
3. insert again the data
*/

/*NOTE*/
$update_query = "UPDATE comments SET comment_status=1 WHERE comment_status=0";





/******************************************/

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");

$res=mysqli_query($link,"select * from product where admin_id='{$_SESSION['admin']}'");
while($row=mysqli_fetch_array($res))
{
?>
<img src="../admin.responsive/<?php echo $row["product_img"]; ?>" alt="" height="300"/>
<h2>&#x20B1;<?php echo $row["product_price"]; ?></h2>

<li><a href="admin.delete.product.php?product_id=<?php echo $row["product_id"]; ?>"><i class="fa fa-trash-o"></i>Remove</a></li>
<?php
}
?>

<!--***********************************************-->

<?php
//edit.php
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "sinugba");
$product_id=$_GET["product_id"];
//delete image from folder
$res=mysqli_query($link,"select * from product where product_id=$product_id");
while($row=mysqli_fetch_array($res)){
	$product_img=$row["product_img"];
  $product_name=$row["product_name"];
}
?>
<input type="file" class="form-control" name="product_img" value="<?php echo $product_img; ?>">
<input type="text" class="form-control" placeholder="Enter product name" name="product_name" value="<?php echo $product_name; ?>" required="">
<?php
//1. if image is not empty update text only
if (isset($_POST["submit"])) {
    $img=$_FILES["product_img"]["name"];
    //this will update text only
    if ($img=="") {
        mysqli_query($link,"update product set product_name='$_POST[product_name]', 
                                               product_price='$_POST[product_price]', 
                                               product_desc='$_POST[product_desc]' 
                                               where product_id=$product_id");
    }
    //2. update text and image
    else{
       $v1=rand(1111,9999);
       $v2=rand(1111,9999);
       $v3=$v1.$v2;
       $v3=md5($v3);
       $fnm=$_FILES["product_img"]["name"];
       $dst="./product_image/".$v3.$fnm;
       $dst1="product_image/".$v3.$fnm;
       move_uploaded_file($_FILES["product_img"]["tmp_name"],$dst);
       mysqli_query($link,"update product set product_img='$dst1', 
                                              product_name='$_POST[product_name]', 
                                              product_price='$_POST[product_price]', 
                                              product_desc='$_POST[product_desc]' 
                                              where product_id=$product_id");
    }
    ?>
    <script type="text/javascript">
        window.location="admin.display.product.php";
    </script>
    <?php
}



/*W3SCHOOL UPDATE
****************/
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
