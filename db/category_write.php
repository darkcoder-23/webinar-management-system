<?php
    
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once '../templates/common.php';

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    
    $category_name = sanitize_input($_POST['category_name'],'');
    $parent_id = sanitize_input($_POST['parent'],'int');
    $description = sanitize_input($_POST['description'],'');
    
    //insert Which Means Add New Category
    function cat_insert() {
        global $category_name, $parent_id , $description,$conn;
        $sql = "INSERT INTO category(cat_name,cat_parent_id	,cat_description) values('$category_name','$parent_id','$description')";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = 'Category Details Inserted!';
        }
        echo $msg;
    }

    //Update Category Which Means Upadte the Categories Details 
    function update_category($id) {
        global $category_name, $parent_id , $description,$conn;
        $sql = "UPDATE `category` SET `cat_id`='$id',`cat_name`='$category_name',`cat_parent_id`='$parent_id',`cat_description`='$description' WHERE `cat_id`='$id'";
        $result =  mysqli_query($conn,$sql);
        if($result) {
            $msg = 'Category Details Updated!';
        }
        echo $msg;

    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        delete_category($_GET['id']);
    }
    function delete_category($id) {
        global $conn;
        $sql ="DELETE FROM category WHERE cat_id = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result) {
            $msg = '<script> alert("Category Data Deleted")</script>';
            header("Location: ".$_SERVER['HTTP_ORIGIN']."/category_list.php?call=$msg");
        }
        else {
            $msg = '<script> alert("Data is NOT Deleted")</script>';
            header("Location: ".$_SERVER['HTTP_ORIGIN']."/category_form.php?call=$msg");
        }
    }





    if(isset($_POST['submit']) && $_POST['submit'] == 'Update Category') {
        $update_id = $_POST['cat_id'];
        update_category($update_id);
        
    }
    else if(isset($_POST['submit']) && $_POST['submit'] == 'Add Category') {
        cat_insert();
        

    }
?>