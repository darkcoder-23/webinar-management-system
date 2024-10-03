
<?php 
$page_name = 'Webinar Form';
include_once( 'templates/header.php' );
?>

<?php
    include_once 'db/error.php';
    include_once 'db/db_connect.php';
    include_once 'db/category_read.php';
    include_once 'db/tags_read.php';
    include_once 'db/webinar_read.php';
    include_once 'db/presenter_read.php';
?>


<?php

    if(isset($_GET['action'])  && $_GET['action'] == 'edit') {
        //for Edit Form
        $action = 'edit';
        $ids = $_GET['id'];
        $res = select_webinar_by_id($ids);
        $row = mysqli_fetch_assoc($res);
        $web_name = $row['web_name'];
        $webinar_desc = $row['webinar_desc'];
        $poster = $row['poster'];
        $category_id = $row['category_id'];
        $select = presenter_id_by_webinar_id($ids);
        $select_presenter = array();
        while($xyz = mysqli_fetch_assoc($select)){
            $select_presenter[] = $xyz['presenter_id'];
        }
        $tags = tag_id_by_webinar_id($ids);
        $select_tags = array();
        while($xyz = mysqli_fetch_assoc($tags)){
            $select_tags[] = $xyz['tag_id'];
        }


    } else {
        //For add new
        $action = 'add';
        $web_name = '';
        $webinar_desc = '';


    }

?>
<body>
    <div class="container">
        <div class="col-md-12">
            <form id="webinarValidation" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="required" for="form-control">
                        Webinar Name
                    </label>
                    <input type="text" class="form-control" name="web_name" value="<?php echo $web_name?>"id="web_name">
                </div>
                <br>
                <div class="form-group">
                    <label for="required" class="form-contol">Webinar Description</label>
                    <textarea class="form-control" name="web_desc" id="web_desc" style="height: 150px;"><?php echo $webinar_desc?></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="required">Poster</label>
                    <?php if($action == 'edit') {  ?>
                        <input type="file" class="form-control" name="poster" id="poster">
                        <input type="hidden" name="image_url" value="<?php echo $poster?>">
                        <img src="db/images/<?php  echo $poster;?>" class="db_image">
                    <?php } else { ?>
                        <input type="file" class="form-control" name="poster" id="poster">

                    <?php }?>
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="presenter">Webinar Presenter</label> <br>
                    <ul class="list-inline form-control" id ="presentercheckbox">  
                        <?php
                            $presenter = select_presenter_name_id(); 
                            while($row = mysqli_fetch_assoc($presenter)) { 
                                $checked  = '';
                                if($action == 'edit') {
                                    if(is_array($select_presenter) &&  in_array($row['presenter_id'],$select_presenter)) {
                                        $checked = 'checked';
                                    }
                                }
                            ?>
                                <li>
                                    <input type="checkbox" class="presenter" name="presenter_id[]" value="<?php echo $row['presenter_id']?>"<?php echo $checked?>> <?php echo $row['name']?>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <br>
                <div class="form-group">
                <label for="required">Category</label><br>
                    <select class="form-select" name="category" aria-label="Default select example">
                    <option value="">--select--</option>
                    <?php
                        $temp_result =get_category_parent();
                        while($temp_row = mysqli_fetch_assoc($temp_result)) {
                            $selected = '';
                            if($category_id == $temp_row['cat_id']) {
                                $selected = 'selected';
                            } 
                        ?>
                        <option value="<?php echo $temp_row['cat_id'] ?>"<?php echo $selected; ?>><?php echo $temp_row['cat_name'] ?></option>
                        <?php
                            $parent_id = $temp_row['cat_id'];
                            $temp_result2 = get_category_by_parent_id($parent_id);
                    
                            while($temp_row2 = mysqli_fetch_assoc($temp_result2)) { 
                                $selected_child = '';
                                if($category_id == $temp_row2['cat_id']) {
                                    $selected_child = 'selected';
                                }
                                ?>
                                <option value="<?php echo $temp_row2['cat_id'] ?>"<?php echo $selected_child; ?>><?php echo "&emsp;"."---".$temp_row2['cat_name'] ?></option>

                            <?php } ?>
                    <?php } ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="tag">Tags</label> <br>
                    <ul class="list-inline form-control">
                    <?php
                        $select_tag = tags_display();
                        while($row3 = mysqli_fetch_assoc($select_tag)) { 
                            $checked  = '';
                                if($action == 'edit') {
                                    if(is_array($select_tags) &&  in_array($row3['tag_id'],$select_tags)) {
                                        $checked = 'checked';
                                    }
                                }
                            ?>
                        <li>
                            <input type="checkbox" class="tag" name="tagname[]" value="<?php echo $row3['tag_id']?>"<?php echo $checked?>> <?php echo $row3['tag_name']?>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                    <?php if($action == 'edit') { ?>
                        <input type="hidden" name="webinar_id" value="<?php echo $ids?>"/>
                        <input type="submit" name="submit" value="Update Webinar">
                        <?php } else { ?>
                        <input type="submit" name="submit" id="webinar_submit" value="Add Webinar" >
                    <?php } ?> 
                <div>
                <br>
            </form>
        </div>
    </div>
    <br>
    <div id="display_response"></div>

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