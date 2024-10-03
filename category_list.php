<?php 
	if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
	$page_name = 'Category List Form';
	include_once 'templates/header.php';
	include_once 'db/error.php';
	include_once 'db/category_read.php';
	include_once 'db/ajax_pagination.php';
?>

<body>
	<div class="container-xl">
		<br>
		<a href="#">
			<a href="category_form.php?action=add"><button type="button" class="btn btn-primary btn-lg" name="add" value="add">
				Add Category
			</button></a>
		</a>
		<div class="col-md-12" class="table_fixed_width"> 
		<br>
		<table class="table table-bordered border-primary">
			<thead class="table-dark">
			<tr>
				<th scope="col" class="serial_width" >Sr.No.</th>
				<th scope="col" >Category Name</th>
				<th scope="col" >Category Parent Name</th>
				<th scope="col" >Action</th>
			</tr>
			</thead>
			<tbody id="tbody" data-ajaxurl="category_read.php">
				<?php display_category_data($current_page) ?>
			</tbody>
		</table>
		</div>
		<br>
		<?php get_pagination_using_AJAX('category')?>
	</div>
</body>

<?php 
include_once( 'templates/footer.php' );
?>
