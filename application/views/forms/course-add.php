<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Course</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('courses/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 text-left">Degree</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="educational_attainment_id" id="account">
                                <option value="">-- SELECT DEGREE --</option>
                                <option value=""> -- </option>
                                <?php foreach ($educational_attainments as $educational_attainment): ?>
                                    <option value="<?php echo $educational_attainment['id']; ?>"><?php echo $educational_attainment['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('educational_attainment_id'); ?></div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-3 text-left">Course</label>
                        <div class="col-md-6">
                            <input type="text" name="course" class="form-control" value="<?php echo set_value('course'); ?>">
                            <div class="validation_error"><?php echo form_error('course'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
