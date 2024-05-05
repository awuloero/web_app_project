<?php
include 'dbcon.php';

if(isset($_POST['add_student'])){
    $fname = mysqli_real_escape_string($connection, $_POST['f_name']);
    $lname = mysqli_real_escape_string($connection, $_POST['l_name']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);

    if (empty($fname) && empty($lname) && empty($age)) {
        header('location:home_admin.php?message=You need to fill the first name, Last name and Age!');
        exit;
    }

    if (empty($fname)) {
        header('location:home_admin.php?message=You need to fill the first name!');
        exit;
    }

    if (empty($lname)) {
        header('location:home_admin.php?message=You need to fill the last name!');
        exit;
    }

    if (empty($age)) {
        header('location:home_admin.php?message=You need to fill the age!');
        exit;
    }

    // database insertion using prepared statement
    $query = "INSERT INTO `students` (`first_name`, `last_name`, `age`) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $fname, $lname, $age);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('location:home_admin.php?insert_msg=Your data has been added successfully.');
        exit;
    }
}
?>
