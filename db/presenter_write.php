<?php
    //for showing error

    include_once 'error.php';
    include_once 'db_connect.php';
    include_once '../templates/common.php';

    //print in another page

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>Category Page Form";

    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>Category Page Form";



    $name = $_POST['name'];
    $gender = $_POST['Gender'];
    $bio = $_POST['presen_bio'];
    $profile = $_FILES['prof_image'];
    $filename = sanitize_input($profile['name'],'');
    $filepath = sanitize_input($profile['tmp_name'],'');
    $fileerror = sanitize_input($profile['error'],'int');

    
    //insert into Database

    function insert_presenter($name,$gender,$bio,$filename) {
        global $conn;
        $sql = "INSERT INTO presenter_details(name,gender,bio,profile_image) values ('$name' ,'$gender','$bio','$filename')";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = "Presenter Details Added";
        }
        else {
            $msg ="Presenter Details Not Added";
        }
        echo $msg;
        // return $result;
    }

    
    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        delete_presenter($_GET['id']);
        $msg = '<script> alert("Presenter Details Deleted")</script>';
        header("Location: ".$_SERVER['HTTP_ORIGIN']."/presenter_list.php?call=$msg");
    }
    function delete_presenter($id) {
        global $conn;
        $sql = "DELETE FROM presenter_details WHERE presenter_id = '$id'";
        $result =  mysqli_query($conn,$sql);
    }

    function update_presenter_by_id($id){
        global $name,$gender,$bio,$conn;
        $sql ="UPDATE `presenter_details` SET `presenter_id`='$id',`name`='$name',`gender`='$gender',`bio`='$bio' WHERE `presenter_id` = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg =" Presenter Details Updated";
        }
        else {
            $msg = " Presenter Details Not Updated";

        }
        echo $msg;

    }

    function upload_file() {
        global $filename,$filepath,$fileerror;
        if($fileerror == 0) {
            $destfile ="/images/".$filename;
            move_uploaded_file($filepath,__DIR__.$destfile);
            $msg = "File Uploded Succesfully. ";
        }
        else {
            $msg= "File Not Supported. ";
        }
        
        echo $msg;
    }
    function update_presenter_poster($id,$path) {
        global $conn;
        $sql ="UPDATE `presenter_details` SET `profile_image`='$path' WHERE `presenter_id` = '$id'";
        $res = mysqli_query($conn,$sql);
        if($res) {
            $msg = "File path updated.";
        }
        echo $msg;

    }
    
    if(isset($_POST['submit']) && $_POST['submit'] == 'Update Presenter') {
        global $conn;
        $update_id = $_POST['presenter_id'];
        //upload_file();
        if(!empty($filename)) {
            unlink("images" ."/".$_POST['image_url']);
            upload_file();
            update_presenter_poster($update_id,$filename);
        }
        update_presenter_by_id($update_id);
        
        
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Add Presenter') {
            upload_file();
            insert_presenter($name,$gender,$bio,$filename);
    }



    //////////////////////////////// Condition to Check Status //////////////////////////////////////////////////

    if (isset($_POST["action"]) && $_POST["action"] == "change_status") {
        $value = $_POST["status"];
        $_id = $_POST["id"];
        update_presenter_status($value, $_id);
    }

    /////////////////// Update Status Funtion ////////////////////////////////////////////////////////////////////

    function update_presenter_status($value, $_id)
    {
        global $conn;
        $sql = "SELECT status FROM presenter_details WHERE status = '{$value}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $val = $row["status"];
                if ($val == "0") {
                    $sql1 = "UPDATE presenter_details SET status = '1' WHERE presenter_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql1);
                }
                if ($val == "1") {
                    $sql2 = "UPDATE presenter_details SET status = '0' WHERE presenter_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql2);
                }
            }
        }
    }
?>
