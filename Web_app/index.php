	<?php 
	include('header.php');
	include('dbcon.php'); 
	?>


	
	<div class="container-sm align-items-center w-50 p-3" id="login_title">
		<h1>LOGIN PAGE</h1>

		<?php 

			if (isset($_GET['message'])) {
            // Sanitized the message
            $message = htmlspecialchars($_GET['message']);
            echo "<h6>".$message."</h6>";
			}
		 ?>

		<form class="form" action="login_process.php" method="post">
			<div class="form-group">
				<label for="uname" class="form-label">Username</label>
				<input id="uname" type="text" name="uname" class="form-control" value="<?= htmlspecialchars($_POST["uname"] ?? "") ?>">
			</div>
			<div class="form-group" class="form-label">
				<label for="pword">Password</label>
				<input id="pword" type="Password" name="pword" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="login" value="Login" class="btn btn-success">
			</div>
		</form>
	</div>

	<?php include('footer.php'); ?>