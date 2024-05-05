<?php

include('dbcon.php'); 

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	

	$query = "delete from `students` where `id` = ?";
	$statement = mysqli_prepare($connection, $query);
	// Bind the parameter
    mysqli_stmt_bind_param($statement, "i", $id);

	// Execute the statement
    $result = mysqli_stmt_execute($statement);

	if (!$result) {
		die("Query Failed:".mysqli_error($connection));
	}
	else{
		header('location:home_admin.php?delete_msg=You have deleted the record.');
	}
	
	// Close the statement
    mysqli_stmt_close($statement);

	}
 ?>