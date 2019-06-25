<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);  //like .jpeg or . png
		$new_name = rand() . '.' . $extension[1];  //random extension name
		$destination = './upload/' . $new_name;    //save image to upload folder with new name or random name
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  //create temporary name of an image
		return $new_name;  //return the result
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM users WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}


//number of total records
function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM users");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>