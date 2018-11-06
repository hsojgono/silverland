<form method="post" action="<?php echo site_url($url); ?>">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<h4><?php echo $modal_message; ?></h4>
	</div>
	<div class="modal-footer">
		<?php if (isset($hidden_elements)): ?>
		<?php foreach ($hidden_elements as $element): ?>
		<input type="hidden" name="<?php echo $element['name']; ?>" value="<?php echo $element['value']; ?>">
		<?php endforeach; ?>
		<?php endif; ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-success">Yes</button>
	</div>

</form>
