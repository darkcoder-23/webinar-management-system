<?php
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'user_read.php';
    define('ENTITIES_PER_PAGE', 5);
    
    if(isset($_GET['action']) && $_GET['action'] == 'click') {
        $current_page = $_GET['page_no'];
    }
    else{
        $current_page = 1;
    }

    $count = ($current_page -1) * ENTITIES_PER_PAGE + 1;
    function  get_pagination($table,$page_link) {
        global $conn,$current_page;
        $where_clouse = '';
        if($table == 'admin') {
            $where_clouse = "WHERE role ='super_admin' OR role ='admin'";
            $table = 'user_details';
        }
        else if($table == 'subscriber') {
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
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?php if($current_page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $page_link ?>?action=click&page_no=<?php echo $current_page - 1?>">Previous</a>
                </li>
            <?php }?>
            <?php for($page = 1; $page <= $total_page; $page++) {
                if($page == $current_page)  {
                    $active = "active"; 
                }else {
                    $active = "";
                }
            ?>
                <li class="page-item <?php echo $active ?>">
                    <a class="page-link" href="<?php echo $page_link ?>?action=click&page_no=<?php echo $page?>"><?php echo $page?></a>
                </li>
            <?php }?>
            <?php if($total_page > $current_page ) {?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $page_link ?>?action=click&page_no=<?php echo $current_page + 1?>">Next</a>
                </li>
            <?php } ?>
            </ul>
        </nav>

    </div>
    <br>
<?php
    }

    function get_data_per_page($table) {
        global $conn,$current_page;


        $where_clouse = '';
        if($table == 'admin') {
            $where_clouse = "WHERE role = 'super_admin' OR role ='admin'";
            $table = 'user_details';
        }
        else if($table == 'subscriber') {
            $where_clouse = "WHERE role = 'subscriber'";
            $table = 'user_details';
    
        }

        $start_point = ($current_page -1) * ENTITIES_PER_PAGE;
        //$result = user_display();
        
        $sql = "SELECT * FROM $table $where_clouse ORDER BY 1 DESC  LIMIT {$start_point} , ". ENTITIES_PER_PAGE;
        $res = mysqli_query($conn,$sql);
        return $res;
    }
?>