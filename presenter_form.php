<?php 
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
    $page_name = 'Webinar Presenter Form';
    include_once( 'templates/header.php' );
?>

<?php
    include_once 'db/error.php';
    include_once 'db/presenter_read.php';

    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
        $action = 'edit';
        $ids = $_GET['id'];
        $res = get_presenter_by_id($ids);
        $presenter_name = $res['name'];
        $gender = $res['gender'];
        $presenter_bio = $res['bio'];
        $profile = $res['profile_image'];

    }
    else {
        $action = 'add';
        $presenter_name = '';
        $gender = '';
        $presenter_bio = '';
        $profile = '';
    }

?>
<body>
    <div id="display_response"></div>
    <div class="container">
        <div class="col-md-12">
            <form id="presenterValidation" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="required" for="en_name">
                        Presenter Name
                    </label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $presenter_name ?>">
                </div>
                <br>

                <div class="form-group" id="gender_id">
                    <label class="required" for="admin_role"><strong> Gender :&nbsp;</strong></label>
                    <input type="radio" name="Gender" value="Male" <?php echo ($gender ==="Male") ? "checked" : " " ?>>
                    <label for="Male">Male</label>&emsp;
                    <input type="radio"  name="Gender" value="Female"<?php echo ($gender ==="Female") ? "checked" : " " ?>>
                    <label for="Female">Female</label>&emsp;
                    <input type="radio"  name="Gender" value="Other" <?php echo ($gender ==="Other") ? "checked" : " " ?>>
                    <label for="Other">Other</label>
                </div>
                <br>
                <div class="form-group">
                    <label for="required">Presenter Bio</label>
                    <textarea class="form-control" name="presen_bio" id="presen_bio" rows="3" ><?php echo $presenter_bio ?></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="required">
                        Profile Image
                    </label>
                    <?php if($action == 'edit') { ?>
                        
                        <input type="file" class="form-control" name="prof_image" id="prof_image">
                        <input type="hidden" name="image_url" value="<?php echo $profile?>">
                        <img src="db/images/<?php echo $profile;?>" class="db_image">

                    <?php } else { ?>
                        <input type="file" class="form-control" name="prof_image" id="prof_image">
                    <?php  }?>
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                    <?php if($action == 'edit') { ?>
                        <input type="hidden" name="presenter_id" value="<?php echo $ids?>">
                        <input type="submit" name="submit" value="Update Presenter">
                    <?php } else { ?>
                        <input type="submit" name="submit" value="Add Presenter">
                    <?php } ?>
                <div>
            </form>
        </div>
    </div>
    <br>
    <br>
</body>


<script type="text/javascript">
    var action = '';
<?php if($action == 'edit') { ?>    
        action = 'edit';
<?php  } ?>
</script>

<?php 
    include_once( 'templates/footer.php' );
?>