

<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap/3.3.7/css/bootstrap.css'); ?>">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<h1 class="pull-left">list of countries</h1>
				</div>
				<div class="col-lg-6">
					<div class="pull-right">
						<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalAdd">ADD NEW COUNTRY</button>
						<div class="modal fade" id="modalAdd">
							<div class="modal-dialog">
								<div class="modal-content">
									<form class="form-horizontal" action="<?php echo site_url('countries/save_data'); ?>" method="post">
										<div class="modal-header"><h3 class="modal-title">Modal Add</h3></div>
										<div class="modal-body">
											
											<table class="table table-striped">
												<tr>
													<td>NAME: </td>
													<td><input type="text" class="form-control" placeholder="name" name="name"></td>
												</tr>
												<tr>
													<td>ISO</td>
													<td><input type="text" class="form-control" placeholder="iso" name="iso"></td>
												</tr>
												<tr>
													<td>ISO3</td>
													<td><input type="text" class="form-control" placeholder="iso3" name="iso3"></td>
												</tr>
												<tr>
													<td>NUMBER CODE</td>
													<td><input type="text" class="form-control" placeholder="number code" name="number_code"></td>
												</tr>
												<tr>
													<td>PHONE CODE</td>
													<td><input type="text" class="form-control" placeholder="phone code" name="phone_code"></td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button class="btn btn-default">CANCEL</button>
											<button class="btn btn-primary" type="submit">SUBMIT</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>NAME</th>
								<th>ISO</th>
								<th>ISO3</th>
								<th>NUMBER CODE</th>
								<th>PHONE CODE</th>
							</tr>
						</thead>
						<tbody>
						<?php if ( ! empty($countries)): ?>
						<?php for($index = 0; $index < count($countries); $index++) { ?>
						<tr>
							<td><?php echo $index + 1; ?></td>
							<td><?php echo $countries[$index]['name']; ?></td>
							<td><?php echo $countries[$index]['iso']; ?></td>
							<td><?php echo $countries[$index]['iso3']; ?></td>
							<td><?php echo $countries[$index]['number_code']; ?></td>
							<td><?php echo $countries[$index]['phone_code']; ?></td>
						</tr>
						<?php } ?>
						<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo site_url('assets/libs/jquery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/libs/bootstrap/3.3.7/js/bootstrap.js'); ?>"></script>