<form class="form-horizontal" action="<?php echo site_url('salary_grades/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Company</label>
            <div class="col-lg-8" >
                <select name="company_id" id="company_id" class="form-control" required="true">
                    <option value="<?php echo $company_id; ?>"><?php echo $company_name['name']; ?></option>
                    <option value="">-- Select Company --</option>
                    <?php foreach ($companies as $index => $company): ?>
                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach ?>
                </select>
                <div class="validation_error"><?php echo form_error('company_id'); ?></div>
            </div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Grade Code</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="grade_code" id="grade_code">
			</div>
		</div>        
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="description" id="description">
			</div>
		</div>	
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Minimum Salary</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="minimum_salary" id="minimum_salary">
			</div>
		</div>   
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Maximum Salary</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="maximum_salary" id="maximum_salary">
			</div>
		</div>   
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
