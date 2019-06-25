<?php
include('db.php'); // para naay data ang fetch connect to database
include('function.php');

$query = '';
$output = array(); // empty rani siya na array masudlan ni siya sa ubos
$query .= "SELECT * FROM users ";  //= meaning pwede nimo i concatinate or i sumpot ang sql query tanan



//this will receive the form search data

if(isset($_POST["search"]["value"]))  //meaning kong naay mo type sa search form check value
{
	$query .= 'WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" ';  // .= like - SELECT * FROM users WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" '
	$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}



//mao ni mo receive if naay mo click sa arrow to order the data

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';  //display default data search
}



//mao ni mo receive if naay mo click sa dropdown to choose pila ka data iyang i display

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}



// run sql query

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();



foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')  //if image form is not empty then display
	{
		$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';  //if image is not available, blank the upload form image
	}


	//mao ni ang data na mo display da table

	$sub_array = array();  //default array function, meaning isulod nimo ang mga variable sa array
	$sub_array[] = $image;
	$sub_array[] = $row["first_name"];
	$sub_array[] = $row["last_name"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;  // all data ni $sub_array i assign ni $data
}



//this will get number of data ang send to datatables

$output = array(
	"draw"				=>	intval($_POST["draw"]),  // "draw" is a variable iyang sulod kay si intval($_POST["draw"])
	"recordsTotal"		=> 	$filtered_rows, 		 //total of all records
	"recordsFiltered"	=>	get_total_all_records(),  //get_total_all_records() will get the data from function get_total_all_records() in function.php
	"data"				=>	$data
);

echo json_encode($output);  //this will send to ajax request "ajax":{ url:"fetch.php",
?>