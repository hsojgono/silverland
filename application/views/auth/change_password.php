<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-pencil-square-o"></i> <h3 class="box-title"><?php echo lang('change_password_heading');?></h3>
			</div>
			<div class="box-body">
				<?php echo form_open("auth/change_password", 'class="form-horizontal"');?>
					<div class="form-group">
						<label class="col-md-3 control-label">Old Password</label>
						<div class="col-md-6">
							<?php echo form_input($old_password);?>
							<div class="text-red"><?php echo form_error('old'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">New Password</label>
						<div class="col-md-6">
							<?php echo form_input($new_password);?>
							<div class="text-red"><?php echo form_error('new'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm New Password</label>
						<div class="col-md-6">
							<?php echo form_input($new_password_confirm);?>
							<div class="text-red"><?php echo form_error('new_confirm'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-6">
							<?php echo form_input($user_id);?>
							<button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
						</div>
					</div>

				<?php echo form_close();?>
				
			</div>
		</div>
	</div>
</div>

