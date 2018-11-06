<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit <?php echo $holiday_type['name']; ?></h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('holiday_types/edit/'.$holiday_type['id']); ?>" method="post">

                    <label class="col-xs-3 text-left">Company</label>
                    <div class="form-group">
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company">
                                <option value="<?php echo $holiday_type['company_id']; ?>"><?php echo $holiday_type['company_name']; ?></option>
                                <option value="">---</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                        </div>                        
                    </div>
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo $holiday_type['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $holiday_type['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
