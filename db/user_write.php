<?php
    include_once 'error.php';       //for showing error
    include_once 'db_connect.php';
    include_once 'user_read.php';
    include_once '../templates/common.php';

    $name = sanitize_input($_POST['name'],'');
    $email=sanitize_input($_POST['email'], 'emails');
    $username=sanitize_input($_POST['username']);
    $password=sanitize_input($_POST['password']);
    $admin_role=sanitize_input($_POST['admin_role']);
    $admin_status = sanitize_input($_POST['status'],'int');
    //insert into Database

    function check_username($username, $dont_check_id) {
        global $conn;
        $username_query = "SELECT * FROM user_details WHERE username = '$username' and user_id != $dont_check_id";
        $run_username_query = mysqli_query($conn,$username_query);
        
        $username_count = mysqli_num_rows($run_username_query);
        return $username_count;

    }

    function insert_user() {
        global $name,$email,$username,$password,$admin_role,$admin_status,$conn;
        $sql = "INSERT INTO user_details(name,username,password,email,role,status) values ('$name' ,'$username','$password','$email','$admin_role','$admin_status')";
        if(check_username($username, 0) > 0) {
            $msg ='Username Already Exist!';
        }
        else {
            $result = mysqli_query($conn,$sql);
            if($result) {
                $msg ='User Profile Created!';
            }
            else {
                $msg ='User Profile Not Created!';
            }

        }
        echo $msg;
    }

    function insert_subscriber() {
        global $name,$email,$username,$password,$admin_role,$admin_status,$conn;
        $sql = "INSERT INTO user_details(name,username,password,email,role,status) values ('$name' ,'$username','$password','$email','$admin_role','$admin_status')";
        if(check_username($username, 0) > 0) {
            $msg ='Subscriber username Already Exist!';
        }
        else {
            $result = mysqli_query($conn,$sql);
            if($result) {
                $msg ='Subscriber Profile Created!';
            }
            else {
                $msg ='Subscriber Profile Not Created!';
            }

        }
        echo $msg;
    }

    // Update USer Details

    function update_user_by_id($idupdate) {
        global $name,$email,$username,$password,$admin_role,$admin_status,$conn;
        $sql = "UPDATE `user_details` SET `user_id`='$idupdate',`name`='$name',`username`='$username',`password`='$password',`email`='$email',`role`='$admin_role',`status` = '$admin_status' WHERE `user_id` ='$idupdate'";
        
        if(check_username($username, $idupdate) > 0 ) {
            $msg ='Username already exist!';
        }
        else {
            $result = mysqli_query($conn,$sql);
            if($result) {
                $msg ='User Profile Updated!';
            }
            else {
                $msg ='User Profile Not Updated!';
            }
        }
        echo $msg;
    }

    function update_subscriber_by_id($idupdate) {
        global $name,$email,$username,$password,$admin_role,$admin_status,$conn;
        $sql = "UPDATE `user_details` SET `user_id`='$idupdate',`name`='$name',`username`='$username',`password`='$password',`email`='$email',`role`='$admin_role',`status` = '$admin_status' WHERE `user_id` ='$idupdate'";
        if(check_username($username,$idupdate) > 0 ) {
            $msg ='Subscriber Username already exist!';
        }
        else {
            $result = mysqli_query($conn,$sql);
            if($result) {
                $msg ='Subscriber Profile Updated!';
            }
            else {
                $msg ='Subscriber Profile Not Updated!';
            }
        }
        echo $msg;
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        if(isset($_GET['role']) && $_GET['role'] == 'subscriber'){
            detele_user($_GET['id']);
            $msg ='<script> alert ("Subscriber Details Deleted!")</script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/subscriber_list.php?call=$msg");
        }
        else {
            detele_user($_GET['id']);
            $msg ='<script> alert ("User Details Deleted!")</script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_list.php?call=$msg");
        }
    }

    //Delete User Details
    function detele_user($id) {
        global $conn;
        $sql = "DELETE FROM user_details WHERE user_id = '$id'";
        $result = mysqli_query($conn,$sql);
    }


    if(isset($_POST['submit']) && $_POST['submit'] == 'Update Admin' ) {
        $admin_id = $_POST['admin_id'];
        update_user_by_id($admin_id);
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Update Subscriber') {
        $subs_id = $_POST['subscriber_id'];
        update_subscriber_by_id( $subs_id);
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Add Admin'){
        insert_user();
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Add Subscriber') {
        insert_subscriber();
    }


    //////////////////////////////// Condition to Check Status //////////////////////////////////////////////////

    if (isset($_POST["action"]) && $_POST["action"] == "change_status") {
        $value = $_POST["status"];
        $_id = $_POST["id"];
        update_user_status($value, $_id);
    }

    /////////////////// Update Status Funtion ////////////////////////////////////////////////////////////////////

    function update_user_status($value, $_id)
    {
        global $conn,$val;
        $sql = "SELECT status FROM user_details WHERE status = '{$value}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $val = $row["status"];
                if ($val == "0") {
                    $sql1 = "UPDATE user_details SET status = '1' WHERE user_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql1);
                }
                if ($val == "1") {
                    $sql2 = "UPDATE user_details SET status = '0' WHERE user_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql2);
                }
            }
        }
        echo $val;
    }
    
?>
