<?php
    session_start();
    if(isset($_SESSION['name'])) {
        header("Location: ".$_SERVER['HTTP_ORIGIN']."/admin_profile.php");
    }
?>
<?php 
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
?>

<!doctype html>
<html lang="en">
<head>
    <title>Webinar Project</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<header>
    <div class="p-5 text-center bg-light">
            <h1 class="mb-3"> Webinar Admin Panel</h1>
            <h4 class="mb-3">Login Page</h4>
        </div>      
</header>

<body>
    
    <div class="container">
        <div class="login-container">
            <h1>Login to Your Account</h1>
            <br>
			<form id="indexForm" name="" action="db/user_read.php" method="POST">
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
