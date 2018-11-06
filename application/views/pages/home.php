<style>

	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map {
		height: 400px;
        width: 100%;
	}

	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<nav class="nav" role="navigation">
		<?php // echo admin_side_menu($menu); ?>
		</nav>
	</div>
</div>

<script>
	$(function() {
		$.ajax({
			url: "http://192.168.33.11/api/1.0/index.php/api/example/users",
			method: "GET",
			success: function(response) {
				console.log(response);
			}
		});
	});
</script>