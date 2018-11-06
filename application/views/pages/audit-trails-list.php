<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">Audit Trails</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-default">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Action Mode</th>
                            <th class="text-center">Timestamp</th>
                            <th class="text-center">IP Address</th>
                            <th class="text-center">Record ID</th>
                            <th class="text-center">Field Name</th>
                            <th class="text-center">Old Value</th>
                            <th class="text-center">New Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($audit_trails)): ?>
                        <?php foreach ($audit_trails as $audit_trail): ?>
                        <tr>
                            <td class="text-right"><?php echo $audit_trail['id']; ?></td>
                            <td class="text-left"><?php echo $audit_trail['mode_label']; ?></td>
                            <td class="text-right"><?php echo $audit_trail['timestamp']; ?></td>
                            <td class="text-right"><?php echo $audit_trail['ip_address']; ?></td>
                            <td class="text-right"><?php echo $audit_trail['record_id']; ?></td>
                            <td class="text-left"><?php echo $audit_trail['field_name']; ?></td>
                            <td class="text-left"><?php echo $audit_trail['old_value']; ?></td>
                            <td class="text-left"><?php echo $audit_trail['new_value']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
