<?php
/*
QUESTIONS
*********
- input only 12 number in forms - https://www.w3schools.com/html/html_form_input_types.asp (this will work only kong naay internet)
- instead of input your can use button
- dapat dili na mag balik balik og input ang user sa inyang data

*/
?>



<!--instead of input your can use button-->
<button class="btn btn-primary" name="check_total">Checkout</button>

<?php
//check maxlength of number
$contactLength = 12;
if ($_POST['submit']) {
	if ($contactLength != 12) {
		echo "contact number must 12 number";
	}
}
?>

<!--para mawala ang history-->
<form action="/action_page.php" method="get" autocomplete="off">

<!--dapat dili na mag balik balik og input ang user sa inyang data-->
<input type="text" class="form-control" placeholder="Enter username" name="username" required value="<?php if($_POST) {echo $_POST['username'];} ?>">