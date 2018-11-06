<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $leave_type['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('leave_types/details/' . $leave_type['account_id']); ?>">
                        <?php echo $leave_type['name']; ?>
                    </a>
                </p>
              <!--   <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Company</b><br>
                        <?php echo $leave_type['company_name']; ?>
                    </li>
                </ul> -->
                <a href="<?php echo site_url('leave_typees/edit/' . $leave_type['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">TAB 1</a>
                </li>
                <li class="">
                    <a href="#tab2" data-toggle="tab">TAB 2</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
