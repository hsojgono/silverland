$(function(){
    $("#uploadLink").on('click', function(e){
        e.preventDefault();
        $("#uploadFile:hidden").trigger('click');

        multiply = (a, b) => a * b;

        var file_data = $('#uploadFile').prop('files')[0];
        var form_data = new FormData();
        var employee_id = $('#employeeID').val();
        form_data.append('uploadFile', file_data);
        $.ajax({
            url         : 'http://localhost/kawani/kawani_ci/employees/test_upload/', // point to server-side controller method
            type        : 'post',
            dataType    : 'text', // what to expect back from the server
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function (response) {
                $('#msg').html(response); // display success response from the server
            },
            error: function (response) {
                $('#msg').html(response); // display error response from the server
            }
        });
    });
});
