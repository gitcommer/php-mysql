<?php
//insert textfield, dropdown, radio, checkbox, textarea and view success message 
if (isset($_POST["submit"])) {
	$link=mysqli_connect("localhost", "root", "");
	mysqli_select_db($link, "practice");
	$reg_date = date("Y-m-d H:i:s");
	$fname=$_POST["fname"];
	$checkbox= implode(', ', $_POST["instrument"]);
	mysqli_query($link, "insert into practice values('', '$fname', '$_POST[dropdown]', '$_POST[radio]', '$checkbox', '$_POST[textarea]', '$reg_date')");
	?>
	<script type="text/javascript">
		alert("data is inserted!");
		setTimeout(function() {window.loacation="index.php"}, 3000);
	</script>
	<?php
}
?>
<form action="" method="post">
	<input type="text" name="fname">
	<select name="dropdown">
		<option disabled selected value>Gender</option>
		<option value="male">Male</option>
		<option value="female">Female</option>
	</select>
	<input type="radio" name="radio" value="tae" required>
	<input type="radio" name="radio" value="tubol">
	<input type="checkbox" name="instrument[]" value="guitar" required="">
	<input type="checkbox" name="instrument[]" value="bass">
	<input type="checkbox" name="instrument[]" value="drum">
	<textarea cols="20" rows="1" name="textarea"></textarea>
	<input type="submit" name="submit">
</form>
