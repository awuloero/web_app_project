<?php
include('dbcon.php');
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['uname']);
    $password = mysqli_real_escape_string($connection, $_POST['pword']);

    // Prepare statement
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND password = PASSWORD(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['uname'] = $username;
        if ($_SESSION['uname'] == "admin") {
            header('location:home_admin.php');
        } else {
            header('location:home.php');
        }
    } else {
        header('location:index.php?message=Sorry your username or password is invalid!');
        exit();
    }
}
?>
