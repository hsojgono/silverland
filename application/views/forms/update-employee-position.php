<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Fill Up The Fields</h4>
            </div>
            <div class="box-body">
                <form action="<?php echo site_url('employees/change_designation/' . $employee_id); ?>" method="post" class="form-horizontal">
                    <table class="table table-striped">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="position_id" class="col-lg-3 control-label">Current Position</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="current_position" value="<?php echo '['.$current_position['position_id'].'] '.$current_position['position']; ?>" disabled="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="position_id" class="col-lg-3 control-label">Position</label>
                                    <div class="col-lg-6">
                                        <?php $key = array_search($current_position['position_id'], array_column($positions, 'id')); ?>
                                        <?php unset($positions[$key]); ?>
                                        <select name="position_id" id="position_id" class="form-control" required="true">
                                            <option value="">-- SELECT POSITION --</option>
                                            <?php foreach ($positions as $index => $position): ?>
                                            <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="date_started" class="col-lg-3 control-label">Date Started</label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="" name="date_started" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="remarks" class="col-lg-3 control-label">Remarks</label>
                                    <div class="col-lg-6">
                                        <textarea rows="10" cols="10" class="form-control" id="remarks" name="remarks" style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <input type="text" class="form-control" name="test_salary" id="test_salary">
                                        <input type="text" class="form-control" name="test_position_id" id="test_position_id">
                                    </div>
                                </div>
                            </td>
                        </tr>       
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <?php if (isset($hidden_elements)): ?>
                                        <?php foreach ($hidden_elements as $element): ?>
                                        <input type="hidden" name="<?php echo $element['name']; ?>" id="<?php echo $element['name']; ?>" value="<?php echo $element['value']; ?>">
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmation-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">Confirmation Message</h4></div>
            <div class="modal-body"><p id="modal-message"></p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-proceed" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait...">PROCEED</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo site_url('assets/js/employee-position.js'); ?>"></script>