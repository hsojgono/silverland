<form action="<?php echo site_url('users/assign_roles/'.$user_id); ?>" method="post">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo $modal_header; ?></h4>
	</div>
	<div class="modal-body">
		<h4><?php echo $modal_message; ?></h4>
		
		<table class="table table-stripped table-bordered table-hover">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Role Name</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($groups as $group): ?>
				<?php
					$group_id = $group['id'];
					$checked  = NULL;
					$item 	  = NULL;
					foreach($current_groups as $current_group)
					{
						if ($group_id == $current_group->id)
						{
							$checked = ' checked="checked"';
							break;
						}
					}
				?>
				<tr>
					<td class="text-center">
						<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked; ?>>
					</td>
					<td><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<!-- <ul id="sortable1" class="connectedSortable">
			<li class="ui-state-default">Item 1</li>
			<li class="ui-state-default">Item 2</li>
			<li class="ui-state-default">Item 3</li>
			<li class="ui-state-default">Item 4</li>
			<li class="ui-state-default">Item 5</li>
		</ul>

		<ul id="sortable2" class="connectedSortable">
			<li class="ui-state-highlight">Item 1</li>
			<li class="ui-state-highlight">Item 2</li>
			<li class="ui-state-highlight">Item 3</li>
			<li class="ui-state-highlight">Item 4</li>
			<li class="ui-state-highlight">Item 5</li>
		</ul> -->
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button type="submit" class="btn btn-success">Save</button>
	</div>

</form>
<script>
	
	$(function() {
		$("#sortable1, #sortable2").sortable({
			connectWith: ".connectedSortable",
			update: function(event, ui) {
				var info = $(this).sortable('serialize');
				console.log(info);

				$.ajax({
					data: info,
					type: 'POST',
					url: BASE_URL + '/users/test_ajax',
					dataType: 'json',
					success: function(res) {
					}
				});
				
			}
		}).disableSelection();
	});
</script>