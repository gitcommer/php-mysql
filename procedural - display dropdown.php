<?php
/*DISPLAY DROPDWON
******************
note:   - pwede rasad sa system kay i blank lang ang field para mo insert nalang siya og balik

https://www.youtube.com/watch?v=1I_Ubx2d2tw
$link=mysqli_connect("localhost", "root", "", "practice_code_php");
or*/

$link=mysqli_connect("localhost", "root", "");
      mysqli_select_db($link,"practice_code_php");
?>

<form name="form1" action="" method="post">
	<select>
		<?php
		//$res=mysqli_query($link,"select * from cruds order by name asc");  //display alphabetically
		$res=mysqli_query($link,"select * from cruds");
		while ($row=mysqli_fetch_array($res)) {
		?>
		<option><?php echo $row["display_dropdown"]; ?></option>
		<?php
		}
		?>
	</select>
</form>