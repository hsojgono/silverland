<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">File Official Business</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('official_businesses/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Account</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="account_id" id="account">
                                <option value="">-- Select Account --</option>
                                <?php foreach ($accounts as $account): ?>
                                    <option value="<?php echo $account['id']; ?>"><?php echo $account['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('account_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Client</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="contact_person_id" id="client">
                                <option value="">-- Select Client --</option>
                                <?php foreach ($contact_persons as $contact_person): ?>
                                    <option value="<?php echo $contact_person['id']; ?>"><?php echo $contact_person['full_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <div class="validation_error"><?php echo form_error('contact_person_id'); ?></div> -->
                        </div>
                        <div>
                            <!-- <a href="<?php echo site_url('official_businesses/add_client'); ?>" class="btn btn-box-tool"> -->
                            <a href="<?php echo site_url('official_businesses/load_form'); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#md-add-client">
                                <i class="fa fa-plus"></i> Add Client</a>                            
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Location</label>
                        <div class="col-md-6">
                            <input type="text" name="location" class="form-control" value="<?php echo set_value('location'); ?>">
                            <div class="validation_error"><?php echo form_error('location'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Agenda</label>
                        <div class="col-md-6">
                            <textarea name="agenda" class="form-control" rows="4" cols="40"><?php echo set_value('agenda'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('agenda'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">OB Date</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date" class="form-control pull-right datepicker" value="<?php echo date('m/d/Y'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date'); ?></div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="ob_date" class="control-label col-md-3">OB Date</label>
                        <div class="col-md-6">
                            <div class='input-group date' id="ob_date" >
                                <input type="text" class="form-control" name="ob_date" required="true">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label col-md-3">Time Start</label>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" name="time_start" class="form-control pull-right timepicker">
                                </div>
                                <div class="validation_error"><?php echo form_error('time_start'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Time End</label>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" name="time_end" class="form-control pull-right timepicker">
                                </div>
                                <div class="validation_error"><?php echo form_error('time_end'); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="input-group">
                        <input type="hidden" name="employee_id" value="<?php echo $ob_data['employee_id']; ?>">
                        <input type="hidden" name="approver_id" value="<?php echo $ob_data['approver_id']; ?>">
                    </div> -->

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="md-add-client">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
    </div>
</div>
