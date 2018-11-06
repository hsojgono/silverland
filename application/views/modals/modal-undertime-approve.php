<form method="post" action=" <?php echo site_url($url); ?> ">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<h4><?php echo $modal_message; ?></h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-success">Yes</button>
	</div>

</form>