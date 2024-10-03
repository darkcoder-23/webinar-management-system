<?php 

    $page_name = 'Broadcast Form';
    include_once 'templates/header.php';
    include_once 'templates/common.php';
    include_once 'db/webinar_read.php';
    include_once 'db/broadcast_read.php';
    include_once 'db/error.php';

    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
        //for Edit Form
        $action = 'edit';
        $ids = $_GET['id'];
        $res = select_broadcast_by_id($ids);
        $webinar_id = $res['webinar_id'];
        $date_time = $res['date_time'];
        $seat_available = $res['seat_available'];


    } else {
        //For add new
        $action = 'add';
        $date_time = '';
        $seat_available ='';

    }

?>

<body>
    <div id ="display_response_broadcast"></div>

    <div class="container">
        <div class="col-md-12">
            <form id="broadcast_validation" name="">
                <div class="form-group">
                    <label for="required">Webinar Name</label><br>
                    <select class="form-select" name="broadcast_web_name" required aria-label="Default select example">
                    <option value="" >--Please Select Webinar--</option>
                    <?php 
                        $result  = select_webinar_name_id();
                        while($row = mysqli_fetch_assoc($result)) {
                            $selected = '';
                            if($webinar_id == $row['webinar_id']) {
                                $selected = 'selected';
                            }       
                        ?>
                        <option value="<?php echo $row['webinar_id']?>" <?php echo $selected?>><?php echo $row['web_name']?></option>
                    <?php } ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="required">Broadcast Data & Time</label><br>
                    <input type="datetime-local" class="form-control" name="date_time" id="date_box"  value="<?php echo $date_time ?>"/>
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="availabe_seat">
                        Max-Seat Available
                    </label>
                    <input type="number" class="form-control" name="availabe_seat" value="<?php echo $seat_available?>" id="availabe_seat">
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                    <?php if($action == 'edit') { ?>
                        <input type="hidden" name="broadcast_id" value="<?php echo $ids?>"/>
                        <input type="submit" name="submit" value="Update Broadcast">
                        <?php } else { ?>
                        <input type="submit" name="submit" value="Add Broadcast" >
                    <?php } ?>
                </div>
                <br>
            </form>
        </div>
    </div>
</body>



<?php 
include_once( 'templates/footer.php' );
?>

