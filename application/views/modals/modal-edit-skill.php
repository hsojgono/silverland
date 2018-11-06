<form class="form-horizontal" action="<?php echo site_url('skills/edit/'.$skill_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Name</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" value="<?php echo $skill['name']; ?>" name="name" id="name">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $skill['description']; ?></textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="save" value="save">
		<a class="btn btn-default" href="<?php echo site_url('skills/cancel'); ?>">Cancel</a>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>