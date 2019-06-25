<?php
/*
DISPLAY
*******
index.php - <table id="user_data" class="table table-bordered table-striped">
		  - var dataTable = $('#user_data').DataTable({ - get the data in the database and display to html table
fetch.php
function.php - function get_total_all_records()

ADD - noted and understand
**************************
1. index.php - add button with modal
2. index.php - $(document).on('submit', '#user_form', function(event){
3. insert.php
4. function.php

UPDATE
******
1. fetch.php - $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
2. index.php - $(document).on('click', '.update', function(){
3. fetch_single.php
4. insert.php - if($_POST["operation"] == "Edit")

DALETE
******
1. fetch.php $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
2. index.php $(document).on('click', '.delete', function(){
3. delete.php
4. function.php









*/
?>