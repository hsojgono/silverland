<div class="row">
    <div class="col-md-12">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success alert-dismissable" id="alert-message">
                <button id="close-alert" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success! </h4>
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissable" id="alert-success">
                <button id="close-alert" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning alert-dismissable" id="alert-message">
                <button id="close-alert" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Warning! </h4>
                <?php echo $this->session->flashdata('warning'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('failed')): ?>
            <div class="alert alert-danger alert-dismissable" id="alert-failed">
                <button id="close-alert" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                <?php echo $this->session->flashdata('failed'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
