<?php 
if(isset($_GET['call'])) {
    echo $_GET['call'];
}
$page_name = 'Admin Form';
$role = '';
//isset($_GET['action'] ) && $_GET['action'] =='edit' && 
if(isset($_GET['role'] ) && $_GET['role'] =='subscriber') {
    $page_name = 'Subscriber Form';
    $role = 'subscriber';
}

    include_once( 'templates/header.php' );
    include_once 'db/error.php';
    include_once 'db/db_connect.php';
    include_once 'db/user_read.php';


    if(isset($_GET['action'])  && $_GET['action'] == 'edit') {
        //for Edit Form
        $action = 'edit';
        $ids = $_GET['id'];
        $res = select_user_by_id($ids);
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $email = $row['email'];
        $username = $row['username'];
        $passwprd = $row['password'];
        $admin_role = $row['role'];
        $admin_status = $row['status'];
        
    }
    else {
        $action = 'add';
        $name = '';
        $email = '';
        $username = '';
        $passwprd = '';
        $admin_role = '';
        $admin_status = '';
    }
?>
<body>
    <div id ="display_response"></div>
    <div class="container">
        <div class="col-md-12">
            <form id="user_from">
            
                <div class="form-group">
                    <label class="required" for="en_name">
                        Display Name
                    </label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name?>" id="name">
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="en_slug">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email?>"id="email">
                </div>
                <br>
                <div class="form-group">
                    <label for="required">
                        Username
                    </label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username?>" id="username">
                </div>
                <br>
                <div class="form-group">
                    <label for="required">
                        password
                    </label>
                    <input type="password" class="form-control" name="password" value="<?php echo $passwprd?>"id="password">
                </div>
                <br>
                <div>
                    <?php if($role !='subscriber') { ?>
                        <label class="required" for="admin_role">Role</label>
                        <br>
                            <div class="form-check" id="radioButton">
                                <input type="radio" class="form-check-input" id="radio1" name="admin_role" value="super_admin" <?php echo ($admin_role === "super_admin")? "checked" : " " ?>>
                                <label class="form-check-label" for="radio1">Super Admin</label>
                            </div>
                            <div class="form-check" id="LastButton">
                                <input type="radio" class="form-check-input" id="radio2" name="admin_role" value="admin" <?php echo ($admin_role === "admin")? "checked" : " " ?>>
                                <label class="form-check-label" for="radio2">Admin</label>
                            </div>
                    <?php } else { ?>
                            <input type="hidden" name="admin_role" value="subscriber"/>
                        <?php } ?>
                </div>
                <br>
                <div>
                    <label for="role" class="form-label">Admin Status : </label>&emsp;
                    <input type="radio" class="form-radio" name="status" value="1" <?php echo ($admin_status == '1') ? "checked" : " "  ?>>
                    <label class="form-check-label" for="radio1">Enable </label>

                    <input type="radio" class="form-radio" name="status" value="0" <?php echo ($admin_status == '0') ? "checked" : " "  ?>>
                    <label class="form-check-label" for="radio1">Disable</label>
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                    <?php if($role == 'subscriber' && $action == 'edit') { ?>
                    <input type="hidden" name="subscriber_id" value="<?php echo $ids; ?>" />
                    <input type="submit"  id="on_submit" name="submit" value="Update Subscriber"  >
                    <?php } else if($action == 'edit'){ ?>
                        <input type="hidden" name="admin_id" value="<?php echo $ids; ?>" />
                        <input type="submit" id="on_submit" name="submit" value= "Update Admin" >
                    <?php } else if($action == 'add'&& $role =='subscriber'){ ?>
                        <input type="submit"  id="on_submit" name="submit" value="Add Subscriber" >
                    <?php } else { ?>
                        <input type="submit" id="on_submit" name="submit" value="Add Admin" >
                    <?php } ?>
                <div>
                <br>
            </form>
        </div>
    </div>
    <br>
    <br> 
</body>

<script type="text/javascript">
<?php if($action == 'edit') { ?>    
    action = 'edit';
<?php  } ?>
</script>
<?php 
include_once( 'templates/footer.php' );
?>