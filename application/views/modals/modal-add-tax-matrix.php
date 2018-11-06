<form class="form-horizontal" action="<?php echo site_url('tax_matrix/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Year Effective</label>
			<div class="col-lg-8">
				<select name="year_effective" id="year_effective" class="form-control" required="true">
					<option value="">-- Select Effective Year --</option>
					<?php foreach ($years as $index => $year): ?>
					<option value="<?php echo $year ?>"><?php echo $year ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Attachments</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="attachment" id="attachment">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>