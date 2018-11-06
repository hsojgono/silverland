<form class="form-horizontal" action="<?php echo site_url('salaries/edit/'.$salary_id); ?>" method="post">
<div class="modal-header">
    <h4 class="modal-title"><?php echo $modal_title; ?></h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Salary Matrix</label>
        <div class="col-lg-8">
            <select name="salary_matrix_id" id="salary_matrix_id" class="form-control" required="true">
                <option value="<?php echo $salary['id']; ?>"><?php echo $salary['salary_matrix_desc']; ?></option>
                <option value="">-- Select Matrix --</option>
                <?php foreach ($salary_matrices as $index => $salary_matrix): ?>
                <option value="<?php echo $salary_matrix['id']; ?>"><?php echo $salary_matrix['description']; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Monthly Salary</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="monthly_salary" id="monthly_salary" value="<?php echo $salary['monthly_salary']; ?>">
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="hidden" name="save" value="save">
    <a class="btn btn-default" href="<?php echo site_url('salaries/cancel'); ?>">Cancel</a>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>