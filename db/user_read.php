
<?php
    include_once 'error.php';
    include_once 'db_connect.php';
    include_once 'ajax_pagination.php';

    
    function select_user_by_role($role) {
        global $conn;
        $username_query = "SELECT * FROM user_details WHERE role = '$role'";
        $run_query  = mysqli_query($conn,$username_query);
        return $run_query;
    }
    
    function select_user_by_id($id) {
        global $conn;
        $username_query = "SELECT * FROM user_details WHERE user_id = '$id'";
        $run_query  = mysqli_query($conn,$username_query);
        return $run_query;
    }
    
    function select_user_profile($id) {
        global $conn;
        $sql = "SELECT name,email FROM user_details WHERE user_id = '$id'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) ) {
            $row = mysqli_fetch_assoc($res);
            return $row;
        }
        else {
            echo "User Details not Exit";
        }
    }
    
    //User Login
    function user_login( $username, $password ) {
        // print_r($_SERVER);
        // die;
        global $conn;
		$sql = "SELECT * FROM user_details WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
		$username_count = mysqli_num_rows($result);
		if($username_count) {
            $username_result_fetch = mysqli_fetch_assoc($result);
			$db_pass = $username_result_fetch['password'];
			if($password === $db_pass) {
                $msg_login = '<script> alert ("Login Succesful!")</script>';
                session_start();
                $_SESSION['name']= $username_result_fetch['name'];
                $_SESSION['user_id'] = $username_result_fetch['user_id'];
                header("Location:".$_SERVER['HTTP_ORIGIN']."/admin_profile.php?call=$msg_login");
			}
			else {
                $msg ='<script> alert ("Incorrect Password!")</script>';
                header("Location:".$_SERVER['HTTP_ORIGIN']."/index.php?call=$msg");
			}
		}
		else {
            $msg = '<script> alert("Invalid Username!") </script>';
            header("Location:".$_SERVER['HTTP_ORIGIN']."/index.php?call=$msg");
		}
    }
    
    if(isset($_POST['login']) && $_POST['login'] == 'login') {
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
			$password = $_POST['password'];
			user_login($username,$password);
		}
	}


    //Pagination Code Start from here. $POST['action'] === 'pagination are comes from custom.js' for send the value

    if(isset($_POST['action'])  &&  $_POST['action'] == 'pagination_admin') {
        $page = 1;
        if(isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_user_data($page,'admin');

    }
    else if(isset($_POST['action'])  &&  $_POST['action'] == 'pagination_subscriber') {
        $page = 1;
        if(isset($_POST['page'])) {
            $page = $_POST['page'];
        }
        display_user_data($page,'subscriber');

    }

    // if (isset($_POST['action'])) {
    //     $page = 1;
    //     if (isset($_POST['page'])) {
    //         $page = $_POST['page'];
    //         if($_POST['action'] === 'pagination_admin') {
    //             display_user_data($page,'admin');
    //         }
    //         else if($_POST['action'] === 'pagination_subscriber') {
    //             display_user_data($page,'subscriber');
    //         } 
    //     }
          
    // }

    function display_user_data($current_page,$user){
        global  $conn, $table_data;
        $where_clouse = '';
        if($user == 'admin') {
            $where_clouse = "WHERE role ='super_admin' OR role ='admin'";
        }
        else if($user == 'subscriber') {
            $where_clouse = "WHERE role = 'subscriber'";
        }
    
        $start_point = ($current_page - 1) * ENTITIES_PER_PAGE;
        $fetchData = "SELECT * FROM user_details $where_clouse ORDER BY 1 DESC LIMIT {$start_point},". ENTITIES_PER_PAGE;
        //echo $fetchData;
        $result = mysqli_query($conn, $fetchData) or die("Query failed");
        $count = (($current_page-1) * ENTITIES_PER_PAGE) +1;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['user_id'];
            $name = $row['name'];
            $email = $row['email'];
            $admin_status = $row['status'];
            if($admin_status == "1"){?>
                <tr class="enable_color_change">
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="admin_form.php?action=edit&role=<?php echo $user?>&id=<?php echo $id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a  href="db/user_write.php?action=delete&id=<?php echo $id?>"> <button type="button" name="delete" value="delete" id="delete"class="btn btn-warning" >
                            Delete
                        </button></a>
                        
                        <!-- Status Button -->

                        <a class='admin_status_btn' data-sval='<?php echo $admin_status ?>' data-id= <?php echo $id ?> data-title='Click to disable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                        </a>

                    </td>
                </tr>

                <?php } else if($admin_status == "0"){?>
                    <tr class="disable_color_change">
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="admin_form.php?action=edit&role=<?php echo $user?>&id=<?php echo $id?>"><button type="button" name="edit" value="edit" class="btn btn-success">
                            Edit
                        </button></a>

                        <!-- Delete Button -->
                        <a  href="db/user_write.php?action=delete&id=<?php echo $id?>"> <button type="button" name="delete" value="delete" id="delete"class="btn btn-warning" >
                            Delete
                        </button></a>
                        
                        <!-- Status Button -->

                        <a class='admin_status_btn' data-sval='<?php echo $admin_status ?>' data-id= <?php echo $id ?> data-title='Click to enable'>
                            <button type="button" class="btn btn-info">
                                Status
                            </button>
                        </a>

                    </td>
                </tr>
            <?php } 
        }
        return $table_data;
    }
?>