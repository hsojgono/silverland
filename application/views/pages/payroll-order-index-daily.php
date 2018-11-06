
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Daily Payroll Order</h3>
                <div class="pull-right">
                    <a href="<?php echo site_url('payroll_order_daily/load_form_generate'); ?>" class="btn btn-primary" data-toggle="modal" data-target="#modal-payroll-daily-order"> 
                        Generate Payroll 
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-daily-payroll-order">
                    <thead>
                        <tr>
                            <!-- <th class="text-left">Name</th>
                            <th class="text-left">Amount</th> -->
                            <th style="width: 25px;">ID</th>
                            <th class="text-left">START DATE</th>
                            <th class="text-left">END DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($daily_payroll)): ?>
                            <?php foreach ($daily_payroll as $daily): ?>
                                <tr>
                                    <!-- <td class="text-left"><?php //echo $daily_salary['full_name']; ?></td>
                                    <td class="text-right"><?php //echo number_format($daily_salary['current_net_pay'], 2, '.', ','); ?></td> -->
                                    <td class="text-center">
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('payroll_order_daily/details/' . $daily['id']); ?>">
                                            <?php echo $daily['id']; ?>
                                        </a>
                                    </td>
                                    <td class="text-left"><?php echo $daily['start_date']; ?></td>
                                    <td class="text-left"><?php echo $daily['end_date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <!-- <tr>
                                    <td class="text-right"><strong>TOTAL :</strong></td>
                                    <td class="text-right"><strong><?php echo number_format($salary_sum, 2, '.', ','); ?></strong></td>
                                </tr> -->
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade in" id="modal-payroll-daily-order">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables-daily-payroll-order').DataTable();
    });
</script>
