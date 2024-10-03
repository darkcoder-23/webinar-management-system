<?php
    // if(isset($_GET['call'])) {
    //     echo $_GET['call'];
    // }
    include_once 'error.php';
    include_once 'db_connect.php';
    //include_once 'pagination.php';
    define('ENTITIES_PER_PAGE', 5);
    $current_page = 1;
    
    
    // if(isset($_GET['action']) && $_GET['action'] == 'click') {
    //     $current_page = $_GET['page_no'];
    // }
    // else{
    //     $current_page = 1;
    // }

    $count = ($current_page -1) * ENTITIES_PER_PAGE + 1;
    function  get_pagination_using_AJAX($table) {
        global $conn,$current_page;
        $where_clouse = '';
        $data_admin = '';
        if($table == 'admin') {
            $data_admin = 'admin';
            $where_clouse = "WHERE role ='super_admin' OR role ='admin'";
            $table = 'user_details';
        }
        else if($table == 'subscriber') {
            $data_admin = 'subscriber';
            $where_clouse = "WHERE role = 'subscriber'";
            $table = 'user_details';
    
        }
        $sql = "SELECT * FROM $table $where_clouse";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) > 0) {
            $total_record = mysqli_num_rows($res);
            $total_page = ceil($total_record/ENTITIES_PER_PAGE);
        }
?>
    <span id="last_page" style="display:none;"><?php echo $total_page?></span>
    <span id="curr_page" style="display:none;"><?php echo $current_page?></span>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" data-admin="<?php echo $data_admin?>">
                <li id="prev_link" class="page-item" style="display:none;">
                    <a href='' class="page-link" id="previous_link" data-page="Previous" >Previous</a>
                </li>
                <?php for($page = 1; $page <= $total_page; $page++) {
                    if($page == $current_page)  {
                        $active = "active"; 
                    }else {
                        $active = "";
                    }
                ?>
                    <li class="page-item <?php echo $active ?>" id="page_link_<?php echo $page?>">
                        <a href='' class="page-link" id="<?php echo $page?>" data-page="<?php echo $page?>" ><?php echo $page?></a>
                    </li>
                <?php }?>
                    <li id="next_link" class="page-item">
                        <a href='' class="page-link" id="next_link" data-page="Next">Next</a>
                    </li>
            </ul>
        </nav>

    </div>
    <br>
<?php 
    } 
?>
