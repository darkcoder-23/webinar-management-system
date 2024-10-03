<?php 
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'user_read.php';

    session_start();
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    function update_profile($id) {
        global $conn,$display_name,$email;
        $sql = "UPDATE `user_details` SET `name`='$display_name',`email`='$email' WHERE `user_id` ='$id'";
        $result = mysqli_query($conn,$sql); 
        if($result){
            $_SESSION['name'] = $display_name;
        }
    }


    function update_profile_password($id) {
        global $conn,$password;
        $sql = "UPDATE `user_details` SET  `password`='$password' WHERE `user_id` ='$id'";
        $res = mysqli_query($conn,$sql);
        return $res;
        
    }


    if(isset($_POST['submit']) && $_POST['submit'] == 'Update Password') {
        $password = $_POST['new_pass'];
        $update_id = $_POST['update_password'];
        $select_user = select_user_by_id($update_id);
        $temp = mysqli_fetch_assoc($select_user);
        $old_pass = $temp['password'];
        $current_pass = $_POST['curr_pass'];
        $re_type_pass = $_POST['retype_pass'];
        if(isset($current_pass) && !empty($current_pass) && isset($re_type_pass) && !empty($re_type_pass)) {
            if($current_pass == $old_pass && $re_type_pass == $old_pass) {
                update_profile_password($update_id);
                echo '<script> alert("Password Updated")</script>';
                header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_profile.php");

            }
            else {
                echo '<script> alert("Password not mached")</script>';
                header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_profile.php");

            }
        }
        else {
            echo '<script> alert("Enter Current & Re-enter Password ")</script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_profile.php");

        }
    }

    else if(isset($_POST['submit']) && $_POST['submit'] == 'Update Profile') {
        $display_name = $_POST['name'];
        $email = $_POST['email'];
        $temp_id = $_POST['profile_id'];
        
        if(isset($temp_id)) {
            update_profile($temp_id);
            
            echo '<script> alert("User Profile Updated")</script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_profile.php");
        }
        else {
            echo '<script> alert("User Profile Not Updated")</script>';

        }
    }


?>