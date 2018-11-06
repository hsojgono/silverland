<form class="form-horizontal" action="<?php echo site_url('sss_contribution_matrix/edit/'.$sss_matrix['id']); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Year Effective</label>
			<div class="col-lg-8">
				<select name="year_effective" id="year_effective" class="form-control" required="true">
					<option value="<?php echo $sss_matrix['year_effective']; ?>"><?php echo $sss_matrix['year_effective']; ?></option>
					<option value="">-- Select Effective Year --</option>
					<?php foreach ($years as $index => $year): ?>
					<?php if ($sss_matrix['year_effective'] == $year): ?>
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
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $sss_matrix['description']; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Attachments</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" value="<?php echo $sss_matrix['attachment']; ?>" name="attachment" id="attachment">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="save" value="save">
		<a class="btn btn-default" href="<?php echo site_url('sss_contribution_matrix/cancel'); ?>">Cancel</a>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>