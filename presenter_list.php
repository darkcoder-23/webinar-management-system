<?php 
	if(isset($_GET['call'])) {
        echo $_GET['call'];
    }
	$page_name = 'Presenter List Form';
	include_once 'templates/header.php';
	include_once 'db/error.php';
	include_once 'db/presenter_read.php';
	include_once 'db/ajax_pagination.php';
?>


<body>
	<div id ="display_response"></div>

	<div class="container-xl">
		<br>
		<a href="#">
			<a href="presenter_form.php?action=add"><button type="button" class="btn btn-primary btn-lg" onclick="window.location.href = 'presenter_form.php';"name="add" value="add">
				Add Presenter
			</button></a>
		</a>
		<div class="col-md-12" class="table_fixed_width"> 
			<br>
			<table class="table table-bordered border-primary">			
				<thead class="table-dark">
				<tr>
					<th scope="col" class="serial_width">Sr.No.</th>
					<th scope="col" >Presenter Name</th>
					<th scope="col" >Gender</th>
                    <th scope="col" >Action</th>
					
				</tr>
				</thead>
				<tbody id="tbody" data-ajaxurl="presenter_read.php">
					<?php display_presenter_data($current_page) ?>
				</tbody>
			</table>
		</div>
		<br>
		<?php get_pagination_using_AJAX('presenter_details')?>
	</div>
</body>

<?php 
include_once( 'templates/footer.php' );
?>
