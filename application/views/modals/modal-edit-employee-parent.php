<form action="<?php echo site_url('employees/edit_employee_parent/' . $employee_id); ?>" class="form-horizontal" id="form-edit-parent" method="post">
    <div class="form-group">
        <label for="relationship_id" class="col-sm-3 control-label">Relationship:</label>
        <div class="col-sm-8">
            <?php foreach ($relationships as $relationship) : ?>
            <label class="radio-inline">
                <input type="radio" name="relationship_id" id="relationship_id" value="<?php echo $relationship['id']; ?>" <?php echo ($parent_record['relationship_id'] == $relationship['id']) ? 'checked':''; ?>> <?php echo $relationship['name']; ?>
            </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="first_name" class="col-sm-3 control-label">First Name:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $parent_record['first_name'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="middle_name" class="col-sm-3 control-label">Middle Name:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $parent_record['middle_name'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="last_name" class="col-sm-3 control-label">Last Name:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $parent_record['last_name'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="occupation" class="col-sm-3 control-label">Occupation:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $parent_record['occupation'];?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <label>Birth Place:</label>
            <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $parent_record['birthplace'];?>">
        </div>
        <div class="col-sm-4">
            <label>Birth Date:</label>
            <input type="date" class="form-control datepicker" id="birthdate" name="birthdate" value="<?php echo $parent_record['birthdate'];?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <label>Blk #:</label>
            <input type="text" class="form-control" id="block_number" name="block_number" value="<?php echo $parent_record['block_number'];?>">
        </div>
        <div class="col-sm-4">
            <label>Lot #:</label>
            <input type="text" class="form-control" id="lot_number" name="lot_number" value="<?php echo $parent_record['lot_number'];?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <label>Floor #:</label>
            <input type="text" class="form-control" id="floor_number" name="floor_number" value="<?php echo $parent_record['floor_number'];?>">
        </div>

        <div class="col-sm-4">
            <label>Bldg. #:</label>
            <input type="text" class="form-control" id="building_number" name="building_number" value="<?php echo $parent_record['building_number'];?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <label>Bldg. Name:</label>
            <input type="text" class="form-control" id="building_name" name="building_name" value="<?php echo $parent_record['building_name'];?>">
        </div>

        <div class="col-sm-4">
            <label>Street:</label>
            <input type="text" class="form-control" id="street" name="street" value="<?php echo $parent_record['street'];?>">
        </div>
    </div>

    <!-- <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <label>Location:</label>
            <input type="text" class="form-control" id="location_id" name="location_id" value="<?php echo $parent_record['location_id'];?>">
        </div>

        <div class="col-sm-4">
            <label>Country:</label>
            <input type="text" class="form-control" id="country_id" name="country_id" value="<?php echo $parent_record['country_id'];?>">
        </div>
    </div> -->

    <div>
        <input type="hidden" name="mode" value="edit">
        <input type="hidden" name="employee_id" value="<?php echo $parent_record['employee_id'];?>">
        <input type="hidden" name="parent_id" value="<?php echo $parent_record['id'];?>">
    </div>

    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button class="btn btn-primary btn-block" id="btn-submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait...">Submit</button>
        </div>
    </div>

</form>

<script>

    $('#form-edit-parent').validate({
        rules: {
            relationship_id: {
                required: false
            },
            first_name: {
                required: true
            },
            middle_name: {
                required: false
            },
            last_name: {
                required: true
            },
            occupation: {
                required: false
            },
            birthplace: {
                required: false
            },
            birthdate: {
                required: false
            },
            block_number: {
                required: false,
                number: true
            },
            lot_number: {
                required: false,
                number: true
            },
            floor_number: {
                required: false,
                number: true
            },
            building_number: {
                required: false,
                number: true
            },
            building_name: {
                required: false
            },
            street: {
                required: false
            },
            location_id: {
                required: false
            },
            country_id: {
                required: false
            }
        },
        messages: {
            relationship_id: {
                required: "Please enter your relationship_id.",
            },
            first_name: {
                required: "Please enter your first_name.",
            },
            middle_name: {
                required: "Please enter your middle_name.",
            },
            last_name: {
                required: "Please enter your last_name.",
            },
            occupation: {
                required: "Please enter your occupation.",
            },
            birthplace: {
                required: "Please enter your birthplace.",
            },
            birthdate: {
                required: "Please enter your birthdate.",
            },
            block_number: {
                required: "Please enter your block_number.",
            },
            lot_number: {
                required: "Please enter your lot_number.",
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
</script>