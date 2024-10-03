<?php 
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once '../templates/common.php';
    

    $broadcast_web_name = sanitize_input($_POST['broadcast_web_name'],'int');
    $date_time= sanitize_input($_POST['date_time'],'');
    $availabe_seat= sanitize_input($_POST['availabe_seat'],'int');


    function insert_broadcast() {
        global $conn,$broadcast_web_name,$date_time,$availabe_seat;
        $sql = "INSERT INTO `broadcast`(`webinar_id`, `date_time`, `seat_available`) VALUES ('$broadcast_web_name','$date_time','$availabe_seat')";
        $res= mysqli_query($conn,$sql);
        if($res) {
            $msg ='Broasdcast Details Created Successfully!';
        }
        echo $msg;

    }

    function update_broadcast($id) {
        global $conn,$broadcast_web_name,$date_time,$availabe_seat;
        $sql= "UPDATE `broadcast` SET `webinar_id`='$broadcast_web_name',`date_time`='$date_time',`seat_available`='$availabe_seat' WHERE `broadcast_id` = '$id'";
        $res  = mysqli_query($conn,$sql);
        if($res) {
            $msg ='Broasdcast Updated Successfully!';
        }
        echo $msg;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        $ids= $_GET['id'];
        delete_broadcast($ids);
    }

    function delete_broadcast($id) {
        global $conn;
        $sql ="DELETE FROM `broadcast` WHERE `broadcast_id` = '$id'";
        $res= mysqli_query($conn,$sql);
        if($res) {
            $msg ='<script> alert(" Broasdcast Deleted! ")</script>';
            header("Location: ".$_SERVER['HTTP_ORIGIN']."/broadcast_list.php?call=$msg");

        }

    }

    if(isset($_POST['submit']) && $_POST['submit'] =='Add Broadcast') {
        insert_broadcast();
    }
    else if(isset($_POST['submit']) && $_POST['submit'] =='Update Broadcast') {
        $hidden_id = $_POST['broadcast_id'];
        update_broadcast($hidden_id);
    }


    //////////////////////////////// Condition to Check Status Through AJAX///////////////////////////////////////

    if (isset($_POST["action"]) && $_POST["action"] == "change_status") {
        $value = $_POST["status"];
        $_id = $_POST["id"];
        update_broadcast_status($value, $_id);
    }

    /////////////////// Update Status Funtion ////////////////////////////////////////////////////////////////////
    
    function update_broadcast_status($value, $_id)
    {
        global $conn;
        $sql = "SELECT status FROM broadcast WHERE status = '{$value}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $val = $row["status"];
                if ($val == "0") {
                    $sql1 = "UPDATE broadcast SET status = '1' WHERE broadcast_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql1);
                }
                if ($val == "1") {
                    $sql2 = "UPDATE broadcast SET status = '0' WHERE broadcast_id = '{$_id}'";
                    $result = mysqli_query($conn, $sql2);
                }
            }
        }
    }
?>