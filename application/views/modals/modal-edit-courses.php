<form id="courseEdit" class="form-horizontal" action="<?php echo site_url('courses/edit/'.$course_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
            <label class="col-md-3 control-label">Degree</label>
            <div class="col-md-8">
                <select class="form-control select2" name="educational_attainment_id" id="educational_attainment_id">
                    <option value="<?php echo $courses[0]['educational_attainment_id']; ?>"><?php echo $courses[0]['degree']; ?></option>
                    <option value="">-- SELECT DEGREE --</option>
                    <?php foreach ($educational_attainments as $educational_attainment): ?>
                        <option value="<?php echo $educational_attainment['id']; ?>"><?php echo $educational_attainment['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <div class="validation_error"><?php echo form_error('educational_attainment_id'); ?></div> -->
            </div>
        </div>                  		
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Course</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" value="<?php echo $course['course']; ?>" name="course" id="course">
			</div>
			<!-- <div class="validation_error"><?php echo form_error('course'); ?></div> -->
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $course['description']; ?></textarea>
			</div>
			<!-- <div class="validation_error"><?php echo form_error('description'); ?></div> -->
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="save" value="save">
		<a class="btn btn-default" href="<?php echo site_url('courses/cancel'); ?>">Cancel</a>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>


<script type="text/javascript">
$(document).ready(function() {
    $('#courseEdit').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            course: {
                validators: {
                    notEmpty: {
                        message: 'Course is required'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Description is required'
                    }
                }
            }
        }
    });
});
</script>