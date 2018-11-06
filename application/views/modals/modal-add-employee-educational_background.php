<div class="modal-header">
    <h3 class="modal-title">Add Educational Background</h3>
</div>
<div class="modal-body">
    <form action="<?php echo site_url('employees/add_employee_educational_background/' . $employee_id); ?>" class="form-horizontal" id="form-add-parent" method="post">

        <div class="form-group">
            <label for="relationship_id" class="col-sm-3 control-label">Level:</label>
            <div class="col-sm-8">
                <?php foreach ($educational_attainments as $educational_attainment) : ?>
                <label class="radio-inline">
                    <input type="radio" name="educational_attainment_id" id="educational_attainment_id" value="<?php echo $educational_attainment['id']; ?>"> <?php echo $educational_attainment['name']; ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="course_id" class="col-sm-3 control-label">Course:</label>
            <div class="col-sm-8">
                <?php foreach ($courses as $course) : ?>
                <label class="radio-inline">
                    <input type="radio" name="course_id" id="course_id" value="<?php echo $course['id']; ?>"> <?php echo $course['name']; ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="school" class="col-sm-3 control-label">School:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="school" name="school">
            </div>
        </div>

        <div class="form-group">
            <label for="year_started" class="col-sm-3 control-label">Year Started:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="year_started" name="year_started">
            </div>
        </div>

        <div class="form-group">
            <label for="year_ended" class="col-sm-3 control-label">Year Ended:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="year_ended" name="year_ended">
            </div>
        </div>

        <div class="form-group">
            <label for="certification" class="col-sm-3 control-label">Certification:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="certification" name="certification">
            </div>
        </div>
        
        <div class="form-group">
            <label for="awards" class="col-sm-3 control-label">Awards:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="awards" name="awards">
            </div>
        </div>
        
        <div class="form-group">
            <label for="gpa" class="col-sm-3 control-label">GPA:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="gpa" name="gpa">
            </div>
        </div>
        
        <div class="form-group">
            <label for="major_gpa" class="col-sm-3 control-label">Major GPA:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="major_gpa" name="major_gpa">
            </div>
        </div>


        <!-- <div class="form-group">
            <div class="col-sm-offset-3 col-sm-4">
                <label>Location:</label>
                <input type="text" class="form-control" id="location_id" name="location_id">
            </div>

            <div class="col-sm-4">
                <label>Country:</label>
                <input type="text" class="form-control" id="country_id" name="country_id">
            </div>
        </div> -->

        <div>
            <input type="hidden" name="mode" value="add">
            <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <button class="btn btn-primary btn-block" id="btn-submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait...">Submit</button>
            </div>
        </div>

    </form>
</div>
<script src="<?php echo site_url('assets/libs/jquery-validation/1.16.0/lib/jquery-1.11.1.js'); ?>"></script>
<script src="<?php echo site_url('assets/libs/jquery-validation/1.16.0/dist/jquery.validate.js'); ?>"></script>
<script>
$.validator.setDefaults( {
    submitHandler: function (form) {
        $(form).submit();
    }
});
$(document).ready(function() {
    $('#form-add-parent').validate({
        rules: {
            educational_attainment_id: {
                required: false
            },
            school: {
                required: true
            },
            year_started: {
                required: false
            },
            year_ended: {
                required: true
            },
            certification: {
                required: false
            },
            awards: {
                required: false
            },
            
            gpa: {
                required: false
            },

            major_gpa: {
                required: false
            },
            
            course_id: {
                required: false
            },
            
            
            
        },
        messages: {
            educational_attainment_id: {
                required: "Please enter your educational_attainment_id.",
            },
            school: {
                required: "Please enter your school.",
            },
            year_started: {
                required: "Please enter your year_started.",
            },
            year_ended: {
                required: "Please enter your year_ended.",
            },
            certification: {
                required: "Please enter your certification.",
            },
            awards: {
                required: "Please enter your awards.",
            },
            gpa: {
                required: "Please enter your gpa.",
            },
            major_gpa: {
                required: "Please enter your major_gpa.",
            },
            course_id: {
                required: "Please enter your course_id.",
            },
            floor_number: {
                required: "Please enter your floor_number.",
            },
            building_number: {
                required: "Please enter your building_number.",
            },
            building_name: {
                required: "Please enter your building_name.",
            },
            street: {
                required: "Please enter your street.",
            },
            location_id: {
                required: "Please enter your location_id.",
            },
            country_id: {
                required: "Please enter your country_id.",
            }
        },
        errorElement: 'em',
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-sm-4" ).addClass( "has-feedback" );
            element.parents( ".col-sm-8" ).addClass( "has-feedback" );

            // if ( element.prop( "type" ) === "radio" ) {
            //     error.insertAfter( element.parent( "label" ) );
            // } else {
            //     error.insertAfter( element );
            // }

            error.insertAfter( element );

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='fa fa-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='fa fa-check form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-4" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).parents( ".col-sm-8" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).next( "span" ).addClass( "fa-remove" ).removeClass( "fa-check" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-4" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).parents( ".col-sm-8" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).next( "span" ).addClass( "fa-check" ).removeClass( "fa-remove" );
        }
    });
});
</script>