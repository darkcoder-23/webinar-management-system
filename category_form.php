<?php 
$page_name = 'Category Page Form';
include_once( 'templates/header.php' );
?>

<?php
    include_once 'db/error.php';
    include_once 'db/category_read.php';
    if(isset($_GET['action'])  && $_GET['action'] == 'edit') {
        //for Edit Form
        $action = 'edit';
        $ids = $_GET['id'];
        $row = select_category_by_id($ids);
        $category_name = $row['cat_name'];
        $parent = $row['cat_parent_id'];
        $description = $row['cat_description'];
    }
    else {
        $action = 'add';
        $category_name = '';
        $parent = '';
        $description = '';
    }
?>

<?php 
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
?>

<body>
    <div id="display_response"></div>
    <div class="container">
        <div class="col-md-12">
            <form id="category_form">
                <div class="form-group">
                    <label class="required" for="category_name">
                        Category Name
                    </label>
                    <input type="text" class="form-control" name="category_name" value="<?php echo $category_name ?>">
                </div>
                <br> 
                <div class="form-group">
                    <label class="required" for="parent_name">Parent Name</label><br>
                        <select class="form-select" name="parent" aria-label="Default select example" >
                            <option value="">...select Parent Name...</option>
                            <option value="0" >__New Parent__</option>
                        <?php
                            $result = get_category_parent();
                            while($row = mysqli_fetch_assoc($result)) {
                                $selected = '';
                                if($parent === $row['cat_id']) {
                                    $selected = 'selected';
                                }
                        ?>
                            <option value="<?php echo $row['cat_id']?>" <?php echo $selected; ?>><?php echo $row['cat_name'] ?></option>
                        <?php } ?>
                        </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="required" class="form-contol">Category Description</label>
                    <textarea class="form-control" name="description"style="height: 150px;" "><?php echo $description?></textarea>
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                    <?php if($action === 'edit') { ?>
                        <input type="hidden" name="cat_id" value="<?php echo $ids?>" >
                        <input type="submit" name="submit" value="Update Category" >
                    <?php } else { ?>
                        <input type="submit" name="submit" value="Add Category" >
                    <?php }?>
                <div>
            </form>
        </div>
    </div>
    <br>
    <br>
</body>

<?php 
include_once( 'templates/footer.php' );
?>