<form method="post" action="<?php echo site_url($url); ?>">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<h4><?php echo $modal_message; ?></h4>
	</div>
	<div class="modal-footer">
		<?php if (isset($information_type)): ?>
		<input type="hidden" name="information_type" value="<?php echo $information_type; ?>">
		<?php endif; ?>
		<?php if (isset($mode)): ?>
		<input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<?php endif; ?>
		<?php if (isset($test_mode)): ?>
		<input type="hidden" name="test_mode" value="<?php echo $test_mode; ?>">
		<?php endif; ?>
		<?php if (isset($modal_title)): ?>
		<input type="hidden" name="modal_title" value="<?php echo $modal_title; ?>">
		<?php endif; ?>
		<?php if (isset($modal_file)): ?>
		<input type="hidden" name="modal_file" value="<?php echo $modal_file; ?>">
		<?php endif; ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-success">Yes</button>
	</div>

</form>
