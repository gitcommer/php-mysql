<html>
	<head>
		<title>Webslesson Demo - PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Image</th>
							<th width="35%">First Name</th>
							<th width="35%">Last Name</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label>Enter First Name</label>
					<input type="text" name="first_name" id="first_name" class="form-control" />
					<br />
					<label>Enter Last Name</label>
					<input type="text" name="last_name" id="last_name" class="form-control" />
					<br />
					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">

					<!-- hidden inig send meaning apil na sila na data pero dili lang i display ilang forms -->
					<!-- famit sa hidden data kay para check ra didto sa insert.php -->

					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

	//when forms is click (modal)
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	


	//display database data to datatables

	var dataTable = $('#user_data').DataTable({  //#user_data is <table id="user_data" class="table table-bordered table-striped">
												 //meaning diri na table i add and datatable
		"processing":true,  //process the datatable plugin
		"serverSide":true,  //activate or connect to serverside
		"order":[],

		"ajax":{
			url:"fetch.php",  //get the data from the database
			type:"POST"
		},

		"columnDefs":[
			{
				"targets":[0, 3, 4],  // 0 is image, 3 edit, 4 is delete column
				"orderable":false,    //meaning diri order and display sa data
			},
		],

	});



	/* insert data to database */

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#first_name').val();
		var lastName = $('#last_name').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();  //file extesion of image
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  //if wla ani na file extension
			{
				alert("Invalid Image File");
				$('#user_image').val('');  //empty the image form
				return false;
			}
		}	
		if(firstName != '' && lastName != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),  //send the data of the forms
				contentType:false,  // meaning send bisan unsa na filename na data
				processData:false,
				success:function(data)  //if success ang pag send sa data perform na sa ubos
				{
					alert(data);
					$('#user_form')[0].reset();  //reset form field
					$('#userModal').modal('hide');  //hide user modal after sending the data
					dataTable.ajax.reload();  //reload, update, of refresh datatables to display the new inserted data
				}
			});
		}
		else
		{
			alert("Both Fields are Required");
		}
	});



	//update data
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});



	//delete
	
	$(document).on('click', '.delete', function(){ 				//inig click sa delete button
		var user_id = $(this).attr("id");   					//get the id on that delete button
		if(confirm("Are you sure you want to delete this?"))    //confirm alert has ok and cancel button
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id}, 						//send tha data na naa sa var user_id
				success:function(data)
				{
					alert(data);								//display alert message that data is deleted
					dataTable.ajax.reload(); 					//update or reload the page
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>