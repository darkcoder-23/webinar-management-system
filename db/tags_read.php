<?php
    //for showing error

   include_once 'error.php';
   include_once 'db_connect.php';
   include_once 'ajax_pagination.php';

    function tags_display() {
        global $conn;
        $sql = "SELECT * FROM tags";
        $ans = mysqli_query($conn,$sql);     
        if(mysqli_num_rows($ans) > 0) {
            return $ans;
        }
        else {
            echo "Tags are Empty!";
        }
         
    }

    function tag_id_by_webinar_id($id) {
        global $conn;
        $sql="SELECT tags.tag_id FROM tags INNER JOIN webinar_tag_realtionship ON tags.tag_id = webinar_tag_realtionship.tag_id WHERE webinar_tag_realtionship.webinar_id = $id";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function get_tag_by_id($id) {
        global $conn;
        $sql = "SELECT * FROM tags WHERE tag_id = $id";
        $res = mysqli_query($conn,$sql);
        if($res) {
            $ans = mysqli_fetch_assoc($res);
            return $ans;
            
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'pagination') {
        $page = 1;
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_tags_data($page);
    }
    function display_tags_data($current_page) {
        global $conn, $table_data;
        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;

        $fetchData = "SELECT * FROM tags ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1;
        while($row = mysqli_fetch_assoc($result)) {
            $id= $row['tag_id'];
            $name = $row['tag_name'];
?>
        <tr>
            <th scope="row" class="serial_width"><?php echo $count++?></th>
            <td><?php echo $name ?></td>
            <td style="text-align:center;">
                <a href="tags.php?action=edit&id=<?php echo $id ?>"><button type="button" name="edit" value="edit" class="btn btn-success">Edit</button></a>
                <a href="db/tags_write.php?action=delete&id=<?php echo $id ?>">
                    <button type="button" name="delete" value="delete" class="btn btn-warning">Delete</button>
                </a>
            </td>
        </tr>
<?php   }
        return $table_data;
    }
?>
