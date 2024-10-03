<?php 
	$page_name = 'Subscriber Request List Form';
	include_once( 'templates/header.php' );
?>

<body>
	<div class="container-xl">
		<br>
		
		<div class="col-md-12"> 
			<br>
			<table class="table table-bordered border-primary">
				<thead class="table-dark">
				<tr>
					<th scope="col" style="text-align:center;">Sr.No.</th>
					<th scope="col" style="text-align:center;">Subscriber Name</th>
					<th scope="col" style="text-align:center;">Emial</th>
                    <th scope="col" style="text-align:center;">Action</th>
					
				</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">
							1
						</th>
						<td>
							
						</td>
						<td>
							
						</td>

						<td style="text-align:center;">
							<!-- Edit Button -->
							<button type="button" name="Accept" value="Accept">
								Accept
							</button>
		
							<!-- Delete Button -->
							<button type="button" name="Decline" value="Decline">
                                Decline
							</button>
						</td>
					</tr>
					<tr>
						<th scope="row">
							2
						</th>
						<td>
							
						</td>
						<td>
							
						</td>
						<td style="text-align:center;">
							<!-- Edit Button -->
							<button type="button" name="Accept" value="Accept">
								Accept
							</button>
		
							<!-- Delete Button -->
							<button type="button" name="Decline" value="Decline">
                                Decline
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>

<?php 
include_once( 'templates/footer.php' );
?>
