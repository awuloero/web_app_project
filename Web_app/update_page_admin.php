<?php
include('header.php');
include('dbcon.php');


$id = isset($_GET['id']) ? $_GET['id'] : ''; 

if (!empty($id)) {
    $query = "SELECT * FROM `students` WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    } 
}
?>

<?php 
if(isset($_POST['update_student'])){
    $idnew = isset($_GET['id_new']) ? $_GET['id_new'] : '';
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];

    $query = "UPDATE `students` SET `first_name` = ?, `last_name` = ?, `age` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssii', $fname, $lname, $age, $idnew);
    $result = mysqli_stmt_execute($stmt);

    if (!$result){
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location:home_admin.php?update_msg=You have successfully updated the data.');
    }
}
?>

<form action="update_page_admin.php?id_new=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo isset($row['age']) ? $row['age'] : ''; ?>">
    </div>
    <input type="submit" class="btn btn-success" name="update_student" value="Update">
</form>

<?php include('footer.php'); ?>
