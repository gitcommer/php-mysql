<?php
/* 
QUSTIONS: 	- how to insert cookie (ok)
				- how to display cookie (ok)
				- how to update cookie 
						- mao mo increment siya kay maaddan man siya og 1
						- meaning kong ni exists na si img addi og 1 si quantity
				- how to delete cookie (ok)
				- success message (ok)
				- how to check if cookie is available 	if (empty($_COOKIE['item'])) { echo ""; } (ok)
				- transfer cookie variable to session variable (ok)
				- insert cookie to database (ok)
				- how to increment notifications
                        - foreach ($_COOKIE['item'] as $name1 => $value),  just echo the <p>$<?php echo $name1; ?></p>, pero ayaw siya i sulod sa foreach
				- how to clear cookie after submetting the order

NOTE: 			- cookie are global variable
*/
?>



<?php
/*COOKIE BASIC EXAMPLE 1*/
//https://www.youtube.com/watch?v=tOuym4a7XjY
//set.php
setcookie('username', 'alex', time() + 10);  //this cookie last for  10 seconds
											 //1. meaning inig run ani ma insert siya sa browser
											 //username ra iyang pangalan sa browser

//view.php
echo $_COOKIE['username'];					 //2. inig run ani kay mo display na siya sa browser
//output: alex								 //kong ma expire na siya kay lain iyang data na sa browser

//note: run first the set.php then the view.php to see the cookie output
?>




<?php
/*
DELETE COOKIE ******************************************************
AMIT_ANDIPARA_ECOMMERCE/youtube_project/user/cart.php
note:  single id deletion - put the id in forms para inig send niya i delete niya ang specific id

question:   - how to delete speciic customer cookie after ordering?
                answer: get the id of that customer
       
*/

//[1]
if (empty($_COOKIE['item'])) {
	echo "";
}else{
	if (is_array($_COOKIE['item'])) //check cookie if available or not
	{ 
		foreach ($_COOKIE['item'] as $name1 => $value) 
		{
			if (isset($_POST["delete$name1"])) //name="delete<?php echo $name1; (i delete nimo kay i get niya ang id sa cookie)
			{ 
				setcookie("item[$name1]", "", time() - 1800); //-1800 this will (delete) the cookie
															  //+1800 this will (add) the cookie
				?>											
				<script type="text/javascript">
					window.location="cart.php";
					//window.location.href = window.location.href; //this will refrest the page
					// setTimeout(function(){
				    // window.location="shop.php";
				    // },3000);
				</script>
				<?php
			}
		}
	}
}
?>

<!--[2] button-->
<td><input type="submit" name="delete<?php echo $name1; ?>" value="del" id="s3"></td>



<?php
// DISPLAY COOKIE ******************************************************

if (is_array($_COOKIE['item'])) //check cookie if available or not
{ 
	foreach ($_COOKIE['item'] as $name1 => $value)   //this is for looping as per cookies if 3 cookies then loop move
	{
		$values11 = explode("__", $value); //explode breaks the strings into array
		?>
		<tr>
			<td class="cart_product">
				<a href=""><img src="../admin/<?php echo $values11[0]; ?>" alt="" height="100" width="100"></a>
?>



<?php
// TRANSFER COOKIE VARIABLE TO SESSION VARIABLE ***********************

$tot=0;
//gi check napud diri ang variable cookie
if (is_array($_COOKIE['item'])) 
{
	foreach ($_COOKIE['item'] as $name1 => $value)   //this is for looping as per cookies if 3 cookies then loop move
	{
		$values11 = explode("__", $value);
		$tot = $tot + $values11[4]; //array 4 the total of the order
	}

	echo "$".$tot;
	$_SESSION["pay"]=$tot; 
}
?>



<?php
// INSERT COOKIE ******************************************************
// UPDATE COOKIE PART COOKIE ******************************************

/* get the id data of the url */
    $res3 = mysqli_query($link, "select * from product where id=$id");
    while ($row3 = mysqli_fetch_array($res3)) 
    {
        $img1 = $row3["product_image"]; //this is the data from database to be inserted in cookies
        $nm = $row3["product_name"]; 
        $prize = $row3["product_price"]; 
        $qty = "1"; 
        $total = $prize * $qty; //pila ang price sa product i times sa quantity
    }

    //this will check if kaigo pa ba ang inventory sa gi order na mga product
    //everytime mo add og product kay ma addan sd ang quantity sa cookie, then ma total sd siya automatic

    if (is_array($_COOKIE['item']))  
    {
        foreach ($_COOKIE['item'] as $name1 => $value)   
        {                                                
            $values11 = explode("__", $value); //get the cookie data in array format (like "select" in the database)

            $found = 0; //sa ubos ni siya magamit
            //this is for getting data quantity in cookie
            if ($img1 == $values11[0])  //compare $img1(database) and $values11[0](cookie) para maka add kag quantity sa the same user
            {                           
                $found = $found + 1; 
                $qty = $values11[3] + 1;  //everytime mo add ka og product sa the same user kay ma addan ang quantity ani na user


                $tb_qty;
                //this is for getting data quantity in database
                $res = mysqli_query($link, "select * from product where product_image='$img1'");
                while ($row = mysqli_fetch_array($res)) 
                {
                    $tb_qty = $row["product_qty"]; //product_qty: meaning unsa man gidaghanon ang product sa (inventory)
                }


                if ($tb_qty < $qty) //kong daghan ang order sa user kay sa quatity na naa sa database
                {                   
                ?>
                <script type="text/javascript">
                    alert("this much quantity not available");
                </script>
                <?php
                } else {

                    $total = $values11[2] * $qty; //$values11[2] (price) meaning total all the cookie quantity

                    //insert cookie to browser
                    setcookie("item[$name1]", $img1 . "__" . $nm . "__" . $prize . "__" . $qty . "__" . $total, time() + 1800); 
                }                            //[0]           [1]          [2]             [3]                                        
            }
        }
    }
?>



<?php
// INSERT COOKIE INTO THE DATABASE ***********************************
//note:   - pwede ra diretso, dili naka mogait og if (is_array($_COOKIE['item'])) { this is use only kong naakay i check na cookie na naka save

foreach ($_COOKIE['item'] as $name1 => $value)   //get the cookie data
{
    $values11 = explode("__", $value);
    mysqli_query($link,"insert into confirm_order_product values('','$id','$values11[1]','$values11[2]','$values11[3]','$values11[0]','$values11[4]')"); //insert cookie data into confirm_order_product (table)
}
?>



<?php
/*DELETE COOKIE AFTER SENDING TRANSACTION
****************************************/
//https://stackoverflow.com/questions/686155/remove-a-cookie

//A clean way to delete a cookie is to clear both of $_COOKIE value and browser cookie file :
if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
}
?>




<?php
/*CREATE COOKIE**********/

$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>


<?php
/*MODIFY COOKIE VALUE***********/

$cookie_name = "user";
$cookie_value = "Alex Porter";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>


<?php
/*DELETE COOKIE***********/

// set the expiration date to one hour ago
setcookie("user", "", time() - 3600);
?>
<html>
<body>

<?php
echo "Cookie 'user' is deleted.";
?>


<?php
/*CHECK IF COOKIE ARE ENABLE***********/

setcookie("test_cookie", "test", time() + 3600, '/');
?>
<html>
<body>

<?php
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
?>


