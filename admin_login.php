<?php 
$page_name = 'Login Page';
include_once( 'templates/header.php' );
?>

<?php
	include_once 'db/error.php';
	include_once 'db/db_connect.php';
	include_once 'db/user_read.php';
?>

<body>
    <div class="container">
        <div class="login-container">
            <h1>Login to Your Account</h1>
            <br>
			<form id="" name="" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
				<div class="form-group">
					<label class="required" for="username">
						Username
					</label>
					<input type="text" class="form-control" placeholder="Username" name="username" id="username">
				</div>
				<br>
				<div class="form-group">
					<label class="required" for="password">
						Password
					</label>
					<input type="password" class="form-control" placeholder="Password" name="password" id="password">
				</div>
				<br>
				<div class="form-group" style="margin-left : 600px">
					<input type="submit" name="login" value="login" style="background-color: #008CBA;">
				</div>
            </form>
        </div>
    </div>
    <br>
</body>

<?php 
include_once( 'templates/footer.php' );
?>


