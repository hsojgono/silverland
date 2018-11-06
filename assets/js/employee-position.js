$(function() {
		$('#date_started').datepicker({
			format:'yyyy-mm-dd',
		});

        var employeeID = $('#employee_id');
        var positionID = $('#position_id');
        var btnProceed = $('#btn-proceed');
        var confirmationModal = $('#confirmation-modal');
        
        var salary   = $('#test_salary');
        var position = $('#test_position_id');

        // BIND EVENTS
        positionID.on('change', checkEmployeeCompensationPackage);
        

        function checkEmployeeCompensationPackage(){

            var dataParam = {
                employee_id: employeeID.val(),
                position_id: positionID.val()
            };

            var _pCompensation = {};

            //ajax call :)
            var employeeCompensationAjxReq = $.ajax({
                url: BASE_URL + 'employees/check_employee_compensation_package',
                method: 'POST',
                data: dataParam,
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    _pCompensation['old'] = response.position.compensation.old;
                    _pCompensation['new'] = response.position.compensation.new;

                    if (response.confirmation_message == true) {
                        confirmationModal.find('#modal-message').html(response.message);
                        confirmationModal.modal();

                        btnProceed.on('click', function (){
                            var $this = $(this);
                            $this.button('loading');
                            setTimeout(function() {
                                $this.button('reset');

                                salary.val(_pCompensation.old.monthly_salary);
                                position.val(_pCompensation.new.cp_position_id);
                                positionID.val(_pCompensation.new.cp_position_id);

                                confirmationModal.modal('hide');
                            }, 500);
                        });
                    }
                }
            });

            employeeCompensationAjxReq.fail(function (jqXHR, textStatus){
                console.log("Request failed: " + textStatus);
                console.log(jqXHR);
            });

        }
	});