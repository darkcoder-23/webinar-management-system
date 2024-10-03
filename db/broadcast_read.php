<?php 
    
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'ajax_pagination.php';

    function select_all_braodcast() {
        global $conn;
        $sql = "SELECT * FROM broadcast";
        $res = mysqli_query($conn,$sql);
        return $res;
    }

    function select_broadcast_by_id($id) {
        global $conn;
        $sql = "SELECT * FROM broadcast WHERE broadcast_id = '$id'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) == 1) {
            return mysqli_fetch_assoc($res);
        }
    }

    function select_webinar_name_by_id($id) {
        global $conn;
        $sql = "SELECT web_name FROM webinar_details WHERE webinar_id = $id";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) == 1) {
            while($ans = mysqli_fetch_assoc($res)) {
                return $ans['web_name'];
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'pagination') {
        $page = 1;
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_broadcast_data($page);
    }


    function display_broadcast_data($current_page) {
        global $conn,$table_data;
        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;
        $fetchData = "SELECT * FROM broadcast ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1; 
        while($row = mysqli_fetch_assoc($result)) { 
            $ids = $row['broadcast_id'];
            $webinar_id = $row['webinar_id'];
            // $temp = 
            $webinar_name =  select_webinar_name_by_id($webinar_id);;
            $date_time  = $row['date_time'];
            $seat_available = $row['seat_available'];
            $status = $row['status'];

?>
            <tr>
                <?php if($status == "1"){?>
                <tr class="enable_color_change">
                    <th scope="row" class="serial_width"> <?php echo $count++ ?></th>
                    <td><?php echo $webinar_name ?></td>
                    <td><?php echo $date_time?></td>
                    <td><?php echo $seat_available?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="broadcast_form.php?action=edit&id=<?php echo $ids?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a href="db/broadcast_write.php?action=delete&id=<?php echo $ids?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                            Delete
                        </button></a>

                        <!-- Status Button -->
                        <a class='broadcast_status_btn' data-sval='<?php echo $status ?>' data-id= <?php echo $ids ?> data-title='Click to disable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                        </a>
                    </td>
                </tr>
                <?php } else if($status == "0") {?>
                    <tr class="disable_color_change">
                    <th scope="row" class="serial_width"> <?php echo $count++ ?></th>
                    <td><?php echo $webinar_name ?></td>
                    <td><?php echo $date_time?></td>
                    <td><?php echo $seat_available?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="broadcast_form.php?action=edit&id=<?php echo $ids?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a href="db/broadcast_write.php?action=delete&id=<?php echo $ids?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                            Delete
                        </button></a>

                        <!-- Status Button -->
                        <a class='broadcast_status_btn' data-sval='<?php echo $status ?>' data-id= <?php echo $ids ?> data-title='Click to enable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tr>
<?php
        }
        return $table_data;
    }
?>