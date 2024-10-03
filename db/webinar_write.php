<?php
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'webinar_read.php';
    include_once '../templates/common.php';
    //Print the Post Value When Sumit
    // echo "<pre>";
    //print_r($_POST);
    // echo "</pre>";

    //Print the Image Details when updaod
    // echo "<pre>";
    //print_r($_FILES);
    // echo "</pre>";
    

    //Value of Input value by User
    $web_name = sanitize_input($_POST['web_name'],'');
    $web_desc = sanitize_input($_POST['web_desc'],'');
    //print_r($_POST['presenter_id']);
    $presenter_id = $_POST['presenter_id'];  // $presenter_id store array;
    $file = $_FILES['poster'];
    $category = sanitize_input($_POST['category'],'int');
    $tagname = $_POST['tagname'];            //$tagname store an array value;

    $filename = sanitize_input($file['name'],'');
    $filepath = sanitize_input($file['tmp_name'],'');
    $filerror = sanitize_input($file['error'],'int');

    //Insert Webinar Details into DataBase
    function insert_webinar($web_name,$web_desc,$poster,$category_id) {
        global $conn , $presenter_id,$tagname;
        $sql="INSERT INTO webinar_details(web_name,webinar_desc,poster,category_id)  VALUES('{$web_name}' ,'{$web_desc}','{$poster}',$category_id)";
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        $temp_id = mysqli_insert_id($conn);
        if($result){
            insert_webinar_presenter_relation($temp_id, $presenter_id);
            insert_webinar_tag_relation($temp_id,$tagname);
            $msg = " Webinar Details Inserted!";
        }
        echo $msg;
    }
    //Insert Webiar Presenter into relationship table Details through webinar -id
    function insert_webinar_presenter_relation($id, $presenter_id){
        global $conn;
        //print_r($presenter_id);
        foreach($presenter_id as $value){
            
            $sql = "INSERT INTO webinar_presenter_relationship(webinar_id, presenter_id) VALUES ('$id','$value')";
            $result1 = mysqli_query($conn,$sql);
        }
    }
    //Insert Webiar Tag Details into realationship table through webinar -id
    function insert_webinar_tag_relation($id,$tag_id) {
        global $conn;
        foreach($tag_id as $value) {
            $sql = "INSERT INTO webinar_tag_realtionship(webinar_id,tag_id) VALUES ('$id','$value')";
            $result = mysqli_query($conn,$sql);
        }
    }

    
    //Update Webinar master table Data...
    function update_webinar($webinar_id,$web_name,$web_desc,$category_id) {
        global $conn;
        $sql = "UPDATE `webinar_details` SET `web_name`='$web_name',`webinar_desc`='$web_desc',`category_id`='$category_id' WHERE `webinar_id` = '$webinar_id'";
        //echo $sql;
        $res = mysqli_query($conn,$sql);
        if($res) {
            $msg = " Webinar Details Updated";
        }
        echo $msg;
    }
    function update_webinar_poster($id,$poster) {
        global $conn;
        $sql = "UPDATE `webinar_details` SET `poster`='$poster' WHERE `webinar_id` = '$id'";
        $res= mysqli_query($conn,$sql);
        if($res) {
            $msg = " File Path Updated.";
        }
        echo $msg;
    }

    //Update Presenter relationship table data by webinar Id
    function update_webinar_presenter_tag_realtion($webinar_id) {
        global $conn,$presenter_id,$tagname;
        $db_presenter = select_presenter_by_webinar_id($webinar_id);
        $db_tag = select_tag_by_webinar_id($webinar_id); 
        foreach($db_presenter as $val) {
            if(!(in_array($val,$presenter_id))) {
                $sql = "DELETE FROM `webinar_presenter_relationship` WHERE presenter_id = '$val'";
                $res = mysqli_query($conn,$sql);
            }
        }

        foreach($presenter_id as $val) {
            if(!(in_array($val,$db_presenter))) {
                $sql = "INSERT INTO `webinar_presenter_relationship`(`webinar_id`, `presenter_id`) VALUES ('$webinar_id','$val')";
                $res = mysqli_query($conn,$sql);
                if($res){
                    //echo"";
                }
            }
        }

        foreach($db_tag as $val) {
            if(!(in_array($val,$tagname))) {
                $sql = "DELETE FROM `webinar_tag_realtionship` WHERE tag_id = $val";
                $res = mysqli_query($conn,$sql);
            }
        }

        foreach($tagname as $val) {
            if(!(in_array($val,$db_tag))) {
                $sql = "INSERT INTO `webinar_tag_realtionship`(`webinar_id`, `tag_id`) VALUES ('$webinar_id','$val')";
                $res = mysqli_query($conn,$sql);
            }
        }
    }

    //Delete Presetner in realtioinship table by webiar_id 
    function delete_presenter_realation($id) {
        global $conn;
        $sql = "DELETE FROM `webinar_presenter_relationship` WHERE `webinar_id`  = '$id'";
        $res = mysqli_query($conn,$sql);
    }
        
    //Delete Tag in realtioinship table by webiar_id 
    function delete_tag_relation($id) {
        global $conn;
        $sql = "DELETE FROM `webinar_tag_realtionship` WHERE `webinar_id` = '$id'";
        $res = mysqli_query($conn,$sql);

    }

    function webinar_file_upload() {
        global $filename,$filepath,$fileerror;
        if($fileerror == 0) {
            $destfile ="/images/".$filename;
            move_uploaded_file($filepath,__DIR__.$destfile);
            $msg = " File Uploded Succesfully. ";
        }
        else {
            $msg= "File Not Supported. ";
        }
        echo $msg;
    }


    function delete_all_webinar_details($id) {
        global $conn;
        $sql = "DELETE FROM `webinar_details` WHERE `webinar_id` = '$id'";
        $res = mysqli_query($conn,$sql);
        
    }

    if(isset($_GET['action']) && $_GET['action'] =='delete') {
        $id_delete = $_GET['id'];
        delete_presenter_realation($id_delete);
        delete_tag_relation($id_delete);
        delete_all_webinar_details($id_delete);
        $msg = '<script> alert("webinar details deleted") </script>';
        header("Location:".$_SERVER['HTTP_ORIGIN']."/webinar_list.php?call=$msg");
    }

    if(isset($_POST['submit']) && $_POST['submit'] =='Add Webinar') {
        webinar_file_upload();
        insert_webinar($web_name,$web_desc,$filename,$category);
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Update Webinar') {
        $id_update = $_POST['webinar_id'];
        if(!empty($filename)) {
            unlink("images" ."/".$_POST['image_url']);

            webinar_file_upload();
            update_webinar_poster($id_update,$filename);
        }
        update_webinar_presenter_tag_realtion($id_update);
        update_webinar($id_update,$web_name,$web_desc,$category);
    }
    // else {
    //     echo "Please Enter Submit Button!";
    // }

    ////////////////////////////////Condition to Check Status //////////////////////////////////////////////////

    if (isset($_POST["action"]) && $_POST["action"] == "change_status") {
        $value = $_POST["status"];
        $_id = $_POST["id"];
        update_webinar_status($value, $_id);
    }

    ///////////////////Update Status Funtion ////////////////////////////////////////////////////////////////////
    
    function update_webinar_status($value, $_id)
    {
        global $conn,$val;
        $sql = "SELECT status FROM webinar_details WHERE status = '{$value}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $val = $row["status"];
                if ($val == "0") {
                    $sql1 = "UPDATE webinar_details SET status = '1' WHERE webinar_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql1);
                }
                if ($val == "1") {
                    $sql2 = "UPDATE webinar_details SET status = '0' WHERE webinar_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql2);
                }
            }
        }
        echo  $val;
    }
?>