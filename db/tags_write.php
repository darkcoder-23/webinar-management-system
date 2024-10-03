<?php
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once '../templates/common.php';

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $tag_name = sanitize_input($_POST['tags_name'],'');

    function insert_tag() {
        global $conn, $tag_name;
        $sql = "INSERT INTO tags(tag_name) VALUES ('$tag_name')";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = 'New Tag Added';
            
        }
        echo $msg;
    }

    function update_tag($id) {
        global $conn,$tag_name;
        $sql = "UPDATE `tags` SET `tag_name`='$tag_name' WHERE `tag_id` = '$id'";
    
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = 'Tag Name Updated!';
        }
        echo $msg;

    }

    //delete tags
    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        delete_tag($_GET['id']);
    }

    function delete_tag($id) {
        global $conn;
        $sql = "DELETE FROM tags WHERE tag_id = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = '<script> alert("Tag Deleted")</script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/tags.php?call=$msg");
        }

    }

    if(isset($_POST['submit']) && $_POST['submit'] == 'Add Tag') {
        insert_tag();
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Update Tag') {
        $id_update = $_POST['tag_id'];
        update_tag($id_update);
    }
?>