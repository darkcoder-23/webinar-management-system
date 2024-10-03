
<?php 
	if(isset($_GET['call'])) {
		echo $_GET['call'];
	}
	$page_name = 'Subscriber List Form';
	include_once( 'templates/header.php' );
	include_once 'db/error.php';
	include_once 'db/user_read.php';
	include_once 'db/ajax_pagination.php';
	$user = "subscriber";
?>
<body>
	<div id ="display_response"></div>

	<div class="container-xl">
		<br>
		<a href="#">
			<a href="admin_form.php?action=add&role=subscriber"><button type="button" class="btn btn-primary btn-lg" name="add" value="add">
				Add Subscriber
			</button></a>
		</a>
		<div class="col-md-12" class="table_fixed_width"> 
			<br>
			<table class="table table-bordered border-primary">
				<thead class="table-dark">
					<tr>
					<th scope="col" class="serial_width">Sr.No.</th>
					<th scope="col" style="text-align:center;">Subscriber Name</th>
					<th scope="col" style="text-align:center;">Email</th>
                    <th scope="col" style="text-align:center;">Action</th>	
				</tr>
				</thead>
				<tbody id="tbody" data-ajaxurl="user_read.php">
					<?php display_user_data($current_page,$user) ?>
				</tbody>
			</table>
		</div>
		<br>
		<?php get_pagination_using_AJAX('subscriber')?>
	</div>
</body>

<?php 
include_once( 'templates/footer.php' );
?>
