<?php
    
    include_once 'error.php';                            //for showing error;
    include_once 'db_connect.php';                      //connection of Databases;
    include_once 'ajax_pagination.php';

    function presenter_display() {
        global $conn;
        $sql = "SELECT * FROM presenter_details";
        $ans = mysqli_query($conn,$sql);
        if(mysqli_num_rows($ans) > 0) {
            return $ans;
        }
        else {
            echo "Presetner Details Not Present";
        }
    }

    function get_presenter_by_id($id) {
        global $conn;
        $sql = "SELECT * FROM presenter_details WHERE presenter_id = '$id'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1) {
            $ans = mysqli_fetch_assoc($result);
            return $ans;
        }
        else {
            echo "Invalid Presenter!";
        }
    }

    function select_presenter_name_id() {
        global $conn;
        $sql ="SELECT presenter_id,name FROM presenter_details";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            return $result;
        }
        else {
            echo "Emplty Presenter Details";
        }
        
    }



    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////Pagination Using AJAX///////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['action']) && $_POST['action'] == 'pagination') {
        $page = 1;
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_presenter_data($page);
    }

    function display_presenter_data($current_page){
        global  $conn, $table_data;

        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;

        $fetchData = "SELECT * FROM presenter_details ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1;
        while($row = mysqli_fetch_assoc($result)){
            $presenter_id = $row['presenter_id'];
            $name = $row['name'];
            $gender = $row['gender'];
            $status = $row['status']; 
            

    ?>
        <tr>
            <?php if($status == "1") { ?>
            <tr class="enable_color_change"> 	
                <td class="serial_width"><?php echo $count++ ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $gender ?></td>
                <td><!-- Edit Button -->
                    <a href="presenter_form.php?action=edit&id=<?php echo $presenter_id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                        Edit
                    </button></a>

                    <!-- Delete Button -->
                    <a href="db/presenter_write.php?action=delete&id=<?php echo $presenter_id?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                        Delete
                    </button></a>

                    <!-- Status Button -->
                    <a class='presenter_status_btn' data-sval='<?php echo $status ?>' data-id= <?php echo $presenter_id ?> data-title='click to disable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                    </a>
                </td>
            </tr>
            <?php } else if($status == "0") { ?>
                <tr class="disable_color_change"> 	
                <td class="serial_width"><?php echo $count++ ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $gender ?></td>
                <td><!-- Edit Button -->
                    <a href="presenter_form.php?action=edit&id=<?php echo $presenter_id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                        Edit
                    </button></a>

                    <!-- Delete Button -->
                    <a href="db/presenter_write.php?action=delete&id=<?php echo $presenter_id?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                        Delete
                    </button></a>

                    <!-- Status Button -->
                    <a class='presenter_status_btn' data-sval='<?php echo $status ?>' data-id= <?php echo $presenter_id ?> data-title='click to enable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tr>
<?php   }
        return $table_data;
    }
?>