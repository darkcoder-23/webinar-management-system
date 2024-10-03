<?php
	if(isset($_GET['call'])) {
		echo $_GET['call'];
	}
	$page_name = 'Broadcast List Page';
	include_once 'templates/header.php';
	include_once 'db/webinar_read.php';
	include_once 'db/broadcast_read.php';
	include_once 'db/ajax_pagination.php';
?>

<body>
	<div id ="display_response"></div>

	<div class="container-xl">
		<br>
		<a href="#">
			<a href="broadcast_form.php?action=add"><button type="button" class="btn btn-primary btn-lg" name="add" value="add">
				Add Broadcast
			</button></a>
		</a>
		<div class="col-md-12" class="table_fixed_width">
			<br>
			<table class="table table-bordered border-primary">
				<thead class="table-dark">
				<tr>
					<th scope="col" class="serial_width">Sr.No.</th>
					<th scope="col">Webinar Name</th>
					<th scope="col">Date&Time</th>
					<th scope="col">Attendees</th>
					<th scope="col">Action</th>
				</tr>
				</thead>
				<tbody id="tbody" data-ajaxurl="broadcast_read.php">
				<?php display_broadcast_data($current_page) ?>
				</tbody>
			</table>
		</div>
		<br>
		<?php get_pagination_using_AJAX('broadcast')?>
	</div>
</body>

<?php 
include_once( 'templates/footer.php' );
?>
