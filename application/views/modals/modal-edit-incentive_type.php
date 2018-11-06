<form class="form-horizontal" action="<?php echo site_url('incentive_types/edit/' . $incentive_type['id']); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Name</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="name" id="name" value="<?php echo $incentive_type['name']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="description" id="description" value="<?php echo $incentive_type['description']; ?>">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="id" value="<?php echo $incentive_type['id']; ?>">
		<input type="hidden" name="save" value="true">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>