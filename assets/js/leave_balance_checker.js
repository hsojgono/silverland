$(document).ready(function() {

    var $_leaveType = $('#leave');
    var $_dateStart = $('#dateStart');
    var $_dateEnd   = $('#dateEnd');


    $('.datepicker').datepicker().on('changeDate', function(e) {
        $('#dateStart').change();
    });

    $_leaveType.change(_ajax_check_leave_balance);
    $_dateStart.change(_ajax_check_leave_balance);
    $_dateEnd.change(_ajax_check_leave_balance);

    function _ajax_check_leave_balance() {

        var data = {};

        data.leave_type = $_leaveType.val();
        data.date_start = $_dateStart.val();
        data.date_end   = $_dateEnd.val();

        $.ajax({
            url : BASE_URL + 'attendance_leaves/ajax_check_leave_balance',
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function(response) {
                console.log('response: ', response);

                if (! response.have_balance) {
                    toastr.warning(response.message)
                }
            }
        });
    }

});