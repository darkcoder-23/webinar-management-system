<?php
    include_once 'error.php';
    include_once 'db_connect.php';
    // include_once 'category_read.php';
    include_once 'ajax_pagination.php';
    // include_once '../templates/common.php';

    function select_category_name_by_id_in_webinar_list($id) {
        global $conn;
        if($id ==='0') {
            $arr['cat_name']="No Parent";
            return $arr;
        }
        else{
            $sql="SELECT cat_name FROM category WHERE cat_id='$id'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)) {
                $ans = mysqli_fetch_assoc($result);
                return $ans;
            }
            
        }
        //return $ans;
    }

    function select_webinar_name($id) {
        global $conn;
        $sql ="SELECT web_name FROM webinar_details WHERE webinar_id = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                echo  $row['web_name'];
            }
        }

    }
    function select_webinar_desc($id) {
        global $conn;
        $sql ="SELECT webinar_desc FROM webinar_details WHERE webinar_id = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                echo  $row['webinar_desc'];
            }
        }

    }

    
    function presenter_by_webinar_id($id) {
        global $conn;
        $sql="SELECT presenter_details.name FROM presenter_details INNER JOIN webinar_presenter_relationship ON presenter_details.presenter_id = webinar_presenter_relationship.presenter_id WHERE webinar_presenter_relationship.webinar_id = $id";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function presenter_id_name_by_webinar_id($id) {
        global $conn;
        $sql="SELECT presenter_details.name,presenter_details.presenter_id FROM presenter_details INNER JOIN webinar_presenter_relationship ON presenter_details.presenter_id = webinar_presenter_relationship.presenter_id WHERE webinar_presenter_relationship.webinar_id = $id";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function select_webinar_by_id($id) {
        global $conn;
        $sql ="SELECT * FROM webinar_details WHERE webinar_id = '$id'";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function select_webinar() {
        global $conn;
        $sql = "SELECT * FROM webinar_details";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function presenter_id_by_webinar_id($id) {
        global $conn;
        $sql="SELECT presenter_details.presenter_id FROM presenter_details INNER JOIN webinar_presenter_relationship ON presenter_details.presenter_id = webinar_presenter_relationship.presenter_id WHERE webinar_presenter_relationship.webinar_id = $id";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function select_presenter_by_webinar_id($id) {
        global $conn;
        $sql = "SELECT presenter_id FROM webinar_presenter_relationship WHERE webinar_id = '$id'";
        $res = mysqli_query($conn,$sql);
        if($res) {
            $selected_presenter = array();
            while($row = mysqli_fetch_assoc($res)) {
                $selected_presenter[] = $row['presenter_id'];
            }
            return $selected_presenter;
        }
    }

    function select_tag_by_webinar_id($id) {
        global $conn;
        $sql = "SELECT `tag_id` FROM `webinar_tag_realtionship` WHERE webinar_id = '$id'";
        $res = mysqli_query($conn,$sql);
        if($res) {
            $selected_tag = array();
            while($row = mysqli_fetch_assoc($res)) {
                $selected_tag[] = $row['tag_id'];
            }
            return $selected_tag;
        }
    }

    function select_webinar_name_id() {
        global $conn;
        $sql = "SELECT webinar_id, web_name FROM webinar_details";
        $res = mysqli_query($conn,$sql);
        return $res;
    }



    ////////////////////////////////////////////////////////
    ////////////// Pagination start from here //////////////
    ////////////////////////////////////////////////////////
    if (isset($_POST['action']) && $_POST['action'] == 'pagination') {
        $page = 1;
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_webinar_data($page);
    }

    function display_webinar_data($current_page){
        global  $conn, $table_data;

        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;

        $fetchData = "SELECT * FROM webinar_details ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['webinar_id'];
            $status = $row['status'];
?>
            <tr>
                <?php if($status == "1"){?>
                <tr class="enable_color_change">
                    <th scope="row" class="serial_width"><?php echo $count++ ?></th>
                    <td><?php echo $row['web_name']?></td>
                    <td><?php
                            $tempresult = select_category_name_by_id_in_webinar_list($row['category_id']);
                            echo $tempresult['cat_name']
                        ?>
                    </td>
                    <td>
                        <?php								
                            $temp = presenter_by_webinar_id($row['webinar_id']);
                            $temp_result=array();
                            while($row = mysqli_fetch_assoc($temp)) {
                                $temp_result[] = $row['name'];
                            }
                            $ans = implode(", ",$temp_result);
                            if($ans) {
                                echo $ans;
                            }
                        ?>
                    </td>
                    <td style="text-align:center;">
                        <!-- Edit Button -->
                        <a href="webinar_form.php?action=edit&id=<?php echo $id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a href="db/webinar_write.php?action=delete&id=<?php echo $id?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                            Delete
                        </button></a>

                        <!-- Status Button -->
                        <a class='webinar_status_btn' data-sval='<?php echo $status?>' data-id= <?php echo $id ?> data-title='Click to disable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                        </a>
                    </td>
                </tr>

                <?php } else if($status == "0") { ?>
                    <tr class="disable_color_change">
                    <th scope="row" class="serial_width"><?php echo $count++ ?></th>
                    <td><?php echo $row['web_name']?></td>
                    <td><?php
                            $tempresult = select_category_name_by_id_in_webinar_list($row['category_id']);
                            echo $tempresult['cat_name']
                        ?>
                    </td>
                    <td>
                        <?php								
                            $temp = presenter_by_webinar_id($row['webinar_id']);
                            $temp_result=array();
                            while($row = mysqli_fetch_assoc($temp)) {
                                $temp_result[] = $row['name'];
                            }
                            $ans = implode(", ",$temp_result);
                            if($ans) {
                                echo $ans;
                            }
                        ?>
                    </td>
                    <td style="text-align:center;">
                        <!-- Edit Button -->
                        <a href="webinar_form.php?action=edit&id=<?php echo $id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a href="db/webinar_write.php?action=delete&id=<?php echo $id?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                            Delete
                        </button></a>

                        <!-- Status Button -->
                        <a class='webinar_status_btn' data-sval='<?php echo $status ?>' data-id= <?php echo $id ?> data-title='click to enable'>
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