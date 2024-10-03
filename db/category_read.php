<?php
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'ajax_pagination.php';

    function select_category() {
        global $conn;
        $sql ="SELECT * FROM category";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function select_category_by_id($id) {
        global $conn;
        $sql="SELECT * FROM category WHERE cat_id='$id'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)) {
            $ans = mysqli_fetch_assoc($result);
            return $ans;
        }
        else {
            echo "No Category Present!";
        }
        //return $ans;
    }

    function get_category_parent() {
        global $conn;
        $sql = "SELECT cat_id,cat_name FROM category WHERE cat_parent_id = '0'";
        $result = mysqli_query($conn,$sql);
        return $result; 
    }

    function get_category_by_parent_id($id) {
        global $conn;
        $sql = "SELECT cat_id,cat_name FROM category WHERE cat_parent_id = '$id'";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function select_category_name_by_id($id) {
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
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////Pagination Using AJAX///////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['action']) && $_POST['action'] == 'pagination') {
        $page = 1;
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_category_data($page);
    }

    function display_category_data($current_page){
        global  $conn, $table_data;
        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;
        $fetchData = "SELECT * FROM category ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1;
        while($row = mysqli_fetch_assoc($result)) { 
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            $cat_parent_id = $row['cat_parent_id'];
            $res= select_category_name_by_id($cat_parent_id);
            $parent_name = $res['cat_name'];
?>
            <tr>
                <th scope="row" class="serial_width"><?php echo $count++?></th>
                <td><?php echo $cat_name ?></td>
                <td><?php echo $parent_name ?></td>
                <td style="text-align:center;">
                    <!-- Edit Button -->
                    <a href="category_form.php?action=edit&id=<?php echo $cat_id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                        Edit
                    </button></a>
                    <!-- Delete Button -->
                    <a href="db/category_write.php?action=delete&id=<?php echo $cat_id?>"><button type="button" name="delete" value="delete" class="btn btn-warning">
                        Delete
                    </button></a>
                </td>
            </tr>
<?php   }
        return $table_data;
    } 
?>	