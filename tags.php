<?php 
	if(isset($_GET['call'])) {
		echo $_GET['call'];
	}
	$page_name = 'Tags';
	include_once 'templates/header.php';
	include_once 'db/error.php';
	include_once 'db/tags_read.php';
	include_once 'db/ajax_pagination.php';
	
	if(isset($_GET['action']) && $_GET['action'] == 'edit') {
		$action  = 'edit';
		$ids = $_GET['id'];
		$tag_result = get_tag_by_id($ids);
		$tag_name = $tag_result['tag_name'];
	}
	else {
		$action  = '';
		$tag_name = '';
	}
?>

<body>
<div class="container">
	<div class="row row-cols-2">
		<form id="tag_form">
			<div class="form-group">
				<div class="col">
					<label class="required" for="tags_name">
						Enter Tag Name
					</label>
					<input type="text" class="form-control" name="tags_name" id="tags_name" value="<?php echo $tag_name?>" placeholder="Enter Tag name">
				</div>
			</div>
			<br>
			<div class="form-group">
				<?php if($action == 'edit') { ?>
					<input type="hidden" name="tag_id" value="<?php echo $ids?>" style="background-color: aqua;">
					<input type="submit" name="submit" value="Update Tag" style="background-color: aqua;">
				<?php } else { ?>
				<input type="submit" name="submit" value="Add Tag" style="background-color: aqua;">
				<?php } ?>
			</div>

			<br>
			<div id ="display_response"></div>

		</form>
		
		<form>
			<div class="form-group">
				<div class="col-md-12">
					<br>
					<table class="table table-bordered border-primary">
						<thead class="table-dark">
						<tr>
							<th scope="col" class="serial_width">Sr.No.&emsp;</th>
							<th scope="col">Tag Name&emsp;</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody id="tbody" data-ajaxurl="tags_read.php">
							<?php display_tags_data($current_page) ?>
						</tbody>
					</table>
				</div>
				<br>
				<?php get_pagination_using_AJAX('tags')?>
			</div>
		</form>
	</div>
</div>
<br>
</body>
	
<?php 
include_once( 'templates/footer.php' );
?>
