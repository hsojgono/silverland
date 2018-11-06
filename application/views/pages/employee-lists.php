
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title">List of Employees</h3>
				<div class="box-tools">

					<div class="form-group">
						<label class="col-xs-2 text-left">Company</label>
						<div class="col-xs-6">
							<select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company_id">
								<option value="">-- Select Company --</option>
								<?php foreach ($companies as $company) : ?>
									<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						
						<a href="<?php echo site_url('employees/load'); ?>" class="btn btn-success">
							<span>View</span>
						</a>

						<a href="<?php echo site_url('employees/add'); ?>" class="btn btn-box-tool text-blue">
							<i class="fa fa-plus"></i>
							<span>Add New Employee</span>
						</a>
					</div>
					
				</div>

			
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="datatables-employees">
					<thead>
						<tr>
							<th style="width: 10px;">&nbsp;</th>
							<th class="text-left">Company Name</th>
							<th class="text-center">Employee Code</th>
							<th class="text-left">Full Name</th>
							<th class="text-left">Position</th>
							<th class="text-left">Department</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( ! empty($employees)): ?>
						<?php foreach ($employees as $employee): ?>
						<tr>
							<td>
								<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $employee['employee_id']); ?>">
									  <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
								</a>
								<!-- <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employees/edit/' . $employee['employee_id']); ?>">
									<i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
								</a> -->
							</td>
							<td class="text-left"><?php echo $employee['company_name']; ?></td>
							<td class="text-center"><?php echo $employee['employee_code']; ?></td>
							<td class="text-left"><?php echo $employee['full_name']; ?></td>
							<td class="text-left"><?php echo $employee['position_name']; ?></td>
							<td class="text-left"><?php echo $employee['department_name']; ?></td>
							<td class="text-center"><?php echo $employee['label_status']; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
