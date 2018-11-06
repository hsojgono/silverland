function Employee(args)
{
    this.args = args;

    this.getFullname = function()
    {
        return this.args.last_name + ', ' + this.args.first_name + ' ' + this.args.middle_name;
    }

    this.saveEmployeeInformation = function()
    {
        console.log('Saving employee information please wait....');

        $.ajax({
            url: BASE_URL + 'employees/ajax/addEmployee',
            type: 'POST',
            data: this.args,
            dataType: 'json',
            success: function(response) {
                console.log('Response: ', response);
            }
        });

    }
}
