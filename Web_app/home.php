<?php 
session_start();
include('header.php');
include('dbcon.php'); 

if (isset($_SESSION['uname'])) {
    echo "<h2>Hello ".$_SESSION['uname'].",</h2>";
} else {
    header('location:index.php?message=You need login to enter the site');
    exit(); // exit to stop further execution
}
?>

<div class="box1">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD STUDENT</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
        </tr>
    </thead>
    
    <tbody>
        <?php 
        $query = "select * from students";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Query Failed".mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['age']; ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<?php
if(isset($_GET['message'])){
    echo "<h6>".htmlspecialchars($_GET['message'])."</h6>"; // sanitized output
}
?>

<?php
if(isset($_GET['insert_msg'])){
    echo "<h6>".htmlspecialchars($_GET['insert_msg'])."</h6>"; // sanitized output
}
?>

<!-- Modal -->
<form action="insert_data.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD STUDENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="f_name">First Name</label>
                        <input id="f_name" type="text" name="f_name" class="form-control" value="<?= htmlspecialchars($_POST["f_name"] ?? "") ?>">
                    </div>
                    <div class="form-group">
                        <label for="l_name">Last Name</label>
                        <input id="l_name" type="text" name="l_name" class="form-control" value="<?= htmlspecialchars($_POST["l_name"] ?? "") ?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input id="age" type="text" name="age" class="form-control" value="<?= htmlspecialchars($_POST["age"] ?? "") ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_student" value="Add">
                </div>
            </div>
        </div>
    </div>
</form>

<a href="logout_process.php" class="btn btn-danger">Logout</a>

<?php include('footer.php'); ?>
