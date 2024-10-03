
<?php 
	if(isset($_GET['call'])) {
		echo $_GET['call'];
	}
	$page_name = 'Webinar List Form';
	include_once 'templates/header.php';
	include_once 'db/error.php';
	include_once 'db/db_connect.php';
	include_once 'db/webinar_read.php';
	//include_once 'db/category_read.php';
	include_once 'db/ajax_pagination.php';
	
?>
<body>
	<div id ="display_response"></div>

	<div class="container-xl">
		<br>
		<a href="#">
			
			<a href="webinar_form.php?action=add"><button type="button" class="btn btn-primary btn-lg" onclick="window.location.href = 'webinar_form.php';"name="add" value="add">
				Add Webinar
			</button></a>
		</a>
		<div class="col-md-12" class="table_fixed_width">
			<br>
			<table class="table table-bordered border-primary">
				<thead class="table-dark">
				<tr>
					<th scope="col" class="serial_width">Sr.No.</th>
					<th scope="col">Webinar Name</th>
					<th scope="col">Category</th>
                    <th scope="col">Webinar Presenter</th>
                    <th scope="col" style="text-align: center">Action</th>
				</tr>
				</thead>
				<tbody id="tbody" data-ajaxurl="webinar_read.php">
				<?php display_webinar_data($current_page) ?>
				</tbody>
			</table>
		</div>
		<br>
		<?php get_pagination_using_AJAX('webinar_details')?>
	</div>
</body>
<?php 
include_once( 'templates/footer.php' );
?>
