<form class="form-horizontal" action="<?php echo site_url('phic_contribution_matrix/edit/'.$phic_matrix_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Year Effective</label>
			<div class="col-lg-8">
				<select name="effectivity_date" id="effectivity_date" class="form-control" required="true">
					<option value="<?php echo $phic_matrix['effectivity_date']; ?>"><?php echo $phic_matrix['effectivity_date']; ?></option>
					<option value="">-- Select Effective Year --</option>
					<?php foreach ($years as $index => $year): ?>
					<?php if ($phic_matrix['effectivity_date'] == $year): ?>
					<?php unset($year); ?>
					<?php else: ?>
					<option value="<?php echo $year ?>"><?php echo $year ?></option>
					<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $phic_matrix['description']; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Attachments</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" value="<?php echo $phic_matrix['attachment']; ?>" name="attachment" id="attachment">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="save" value="save">
		<a class="btn btn-default" href="<?php echo site_url('phic_contribution_matrix/cancel'); ?>">Cancel</a>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>