<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <form id="generate_payroll" action="<?php echo site_url('payroll_order/generate'); ?>" class="form-horizontal" method="post"> 

                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $action_header; ?></h4>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label for="date_start" class="control-label col-sm-4">Date Start:</label>
                        <div class="col-sm-7">
                            <div class='input-group date' id="date_start" >
                                <input type="text" class="form-control" name="date_start" required="true">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="date_end" class="control-label col-sm-4">Date End:</label>
                        <div class="col-sm-7">
                            <div class='input-group date' id="date_end" >
                                <input type="text" class="form-control" name="date_end" required="true">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="year" class="control-label col-sm-4">Year:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="year" value="<?php echo $current_year; ?>"required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="month" class="control-label col-sm-4">Month:</label>
                        <div class="col-sm-7">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="month" id="month" required="required">
                                <option value=""> -- Select Month -- </option>
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
                        <label for="cutoff" class="control-label col-sm-4">Cutoff:</label>
                        <div class="col-sm-7">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="cutoff" id="cutoff" required="required">
                                <option value=""> -- Select Period -- </option>
                                <option value="1">First Period</option>
                                <option value="2">Second Period</option>
                                <!-- <option value="3">13th Month</option> -->
                                <!-- <option value="4">Leave Conversion</option>
                                <option value="5">Casual</option>
                                <option value="6">Other Payout</option>
                                <option value="7">Annualization</option> -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_generate" type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>

        </div>    
    </div>

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Payroll Order</h3>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-payroll_order">
                    <thead>
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th class="text-left">PERIOD</th>
                            <th class="text-left">CUT OFF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($payroll_order)): ?>
                        <?php foreach ($payroll_order as $po): ?>
                        <tr>
                            <td class="text-center">
                                <a  href="<?php echo site_url('payroll_order/details/' . $po['id']); ?>">
                                    <?php echo $po['id']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo date('F d', strtotime($po['start_date'])); ?> - 
                                    <?php echo date('d, Y', strtotime($po['end_date'])); ?></td>
                            <td class="text-left"><?php echo $po['cut_off']; ?></td>	                            
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>


<script type="text/javascript">
    $(document).ready(function () {
        
        $('#datatables-payroll_order').DataTable({
            'order': [[0, 'desc']]
        });

        $.ajax({
            url:BASE_URL + 'payroll_order/getPrevDates',
            method: 'get',
            dataType:'json',
            success:function(res) {

                var _disableDate = res.dates;

                console.log(_disableDate);

                if(_disableDate == null)
                {
                    $('#date_start').datetimepicker({
                        format: 'MM/DD/YYYY'
                    });

                    $('#date_end').datetimepicker({
                        format: 'MM/DD/YYYY'
                    });
                }
                else
                {
                    $('#date_start').datetimepicker({
                        format: 'MM/DD/YYYY',
                        disabledDates: _disableDate
                    });

                    $('#date_end').datetimepicker({
                        format: 'MM/DD/YYYY',
                        disabledDates: _disableDate
                    });                
                }
            }
        });
    });
</script>

