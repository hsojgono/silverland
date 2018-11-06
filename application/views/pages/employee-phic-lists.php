
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <i class="fa fa-list"></i> <h3 class="box-title">List of Employee Taxes</h3> -->
                <form class="form-inline" action="<?php echo site_url('employee_phic/load'); ?>" method="post">
                    <!-- <div class="pull-left">
                        <i class="fa fa-list"></i> <h3 class="box-title">List of Employee Taxes</h3>
                    </div> -->
                    <div class="pull-right">
                        <label for="startdate">Year</label>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <input id="year" type="text" name="year" value="<?php echo $year; ?>" class="form-control" style="text-align:right;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 text-left">Month</label>
                            <div class="col-xs-6">
                                <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="month" id="month">
                                    <option value="0">-- Select Month --</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 text-left">Company</label>
                            <div class="col-xs-6">
                                <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company_id">
                                    <option value="">-- Select Company --</option>
                                    <?php foreach ($companies as $company): ?>
                                        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input type="submit" name="myButton" value="View" class="btn btn-primary">
                        </div> 
                        <div class="input-group">
                            <input type="submit" name="myButton" value="Export" class="btn btn-primary">
                        </div> 
                    </div>
                </form>
            </div>
            
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-employee-phics">
                    <thead>
                        <tr>
                            <!-- <th style="width: 250px;">&nbsp;</th> -->
                            <th class="text-left">Company</th>
                            <th class="text-left">Employee</th>
                            <th class="text-left">PHIC Number</th>
                            <th class="text-left">Month/Year</th>
                            <th class="text-left">Employee Share</th>
                            <th class="text-left">Employer Share</th>
                            <th class="text-left">Total Contribution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($phics)): ?>
                            <?php foreach ($phics as $phic): ?>
                                <tr>
                                    <td class="text-left"><?php echo $phic['company_name']; ?></td>
                                    <td class="text-left"><?php echo $phic['full_name']; ?></td>
                                    <td class="text-right"><?php echo $phic['phic']; ?></td>
                                    <td class="text-left"><?php echo $current_month . ' ' . $current_year; ?></td>
                                    <td class="text-right"><?php echo $phic['phic_employee']; ?></td>
                                    <td class="text-right"><?php echo $phic['phic_employer']; ?></td>
                                    <td class="text-right"><?php echo $phic['phic_amount']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-phic-status-<?php echo md5($phic['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-phic-<?php echo md5($phic['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>