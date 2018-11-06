<form class="form-horizontal" action="<?php echo site_url('salary_grades/edit/'.$salary_id); ?>" method="post">
<div class="modal-header">
    <h4 class="modal-title"><?php echo $modal_title; ?></h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Company</label>
        <div class="col-lg-8">
            <select name="company_id" id="company_id" class="form-control" required="true">
                <option value="<?php echo $salary_grade['id']; ?>"><?php echo $salary_grade['salary_matrix_desc']; ?></option>
                <option value="">-- Select Company --</option>
                <?php foreach ($companies as $index => $company): ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Grade Code</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="grade_code" id="grade_code" value="<?php echo $salary_grade['grade_code']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Description</label>
        <div class="col-lg-8">
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $salary_grade['description']; ?></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="hidden" name="save" value="save">
    <a class="btn btn-default" href="<?php echo site_url('salary_grades/cancel'); ?>">Cancel</a>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>
