<div class="tab-pane fade" id="tab-employee-skills">
	<div class="row">
		<div class="col-lg-12">	
				<h3 class="box-title">List of Skills </h3>
				
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-employee-skills" href="<?php echo site_url('employees/confirmation/add/employee_skills/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Skill</a>
				<div class="modal fade" id="confirmation-add-employee-skills">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered table-striped" id="datatables-employees">
				<thead>

					<tr>
						<th class="text-center" >Action</th>
						<th>Skill</th>
						<th>Proficiency Level</th>
                        <th>Company</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_skills as $index => $employee_skill): ?>
					<tr>
						<td class="text-center">
							<a href="<?php echo site_url('employees/confirmation/edit/'.$employee_skill['skill_name']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-skill-<?php echo $index; ?>">Edit</a>							

                        <td><?php echo $employee_skill['skill_name']; ?></td>
                        <td><?php echo $employee_skill['proficiency_level']; ?></td>
						<td><?php echo $employee_skill['company_name']; ?></td>
					</tr>

                         <div class="modal fade" id="confirmation-edit-employee-skill-<?php echo $index; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div> 
                        </div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
