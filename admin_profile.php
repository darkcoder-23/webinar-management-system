<?php
    $page_name = 'User Profile';
    include_once('templates/header.php');
    include_once 'db/user_read.php';
    if(isset($_SESSION['user_id'])) {
        $result = select_user_profile($_SESSION['user_id']);
        $display_name = $result['name'];
        $email = $result['email'];
    }

?>
<?php 
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
?>

<body>
    <div class="container">
        <div class="col-md-12">
            <form action="db/profile_write.php" method="POST">
                <div class="form-group">
                    <label class="required" for="en_name">
                        Display Name
                    </label>
                    <input type="text" class="form-control" name="name" value="<?php echo $display_name?>" id="name">
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="en_slug">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" Value="<?php echo $email?> "id="email">
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>
                        <input type="hidden" name="profile_id" value="<?php echo $_SESSION['user_id']?>">
                        <input type="submit" name="submit" value="Update Profile">
                <div>
                <br>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-12">
            <form action="db/profile_write.php" method="POST">
                <div class="form-group">
                    <label class="required" for="en_name">
                        Current Password
                    </label>
                    <input type="password" class="form-control" name="curr_pass" id="curr_pass">
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="en_slug">
                        Re-type Current Password
                    </label>
                    <input type="password" class="form-control" name="retype_pass" id="retype_pass">
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="en_slug">
                        Enter New Password
                    </label>
                    <input type="password" class="form-control" name="new_pass" id="new_pass">
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>
                        <input type="hidden" name="update_password" value="<?php echo $_SESSION['user_id']?>">
                        <input type="submit" name="submit" value="Update Password">
                <div>
                
                <br>
            </form>
        </div>
    </div>
</body>


