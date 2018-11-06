$(function() {
	var form = $("#example-advanced-form").show();

	form.steps({
		headerTag: "h5",
		bodyTag: "fieldset",
		transitionEffect: "slideLeft",
		onStepChanging: function (event, currentIndex, newIndex)
		{
			console.log('onStepChanging');
			// Allways allow previous action even if the current form is not valid!
			if (currentIndex > newIndex)
			{
				return true;
			}
			// Needed in some cases if the user went back (clean up)
			if (currentIndex < newIndex)
			{
				// To remove error styles
				form.find(".body:eq(" + newIndex + ") label.error").remove();
				form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
			}
			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
		},
		onStepChanged: function (event, currentIndex, priorIndex)
		{
			console.log('onStepChanged');

			var personalInformation = {
				first_name	: $('#piFirstname').val(),
				middle_name	: $('#piMiddlename').val(),
				last_name	: $('#piLastname').val(),
			};

			// Used to skip the "Warning" step if the user is old enough and wants to the previous step.
			if (currentIndex === 2 && priorIndex === 3)
			{
				form.steps("previous");
			}

			var employee = new Employee(personalInformation);
			employee.saveEmployeeInformation();
		},
		onFinishing: function (event, currentIndex)
		{
			console.log('onFinishing');
			form.validate().settings.ignore = ":disabled";
			return form.valid();
		},
		onFinished: function (event, currentIndex)
		{
			console.log('onFinished');
			main();
			alert("Submitted!");
		}
		}).validate({
		errorPlacement: function errorPlacement(error, element) { element.before(error); },
		rules: {
			confirm: {
				equalTo: "#password-2"
			}
		}
	});

	function main()
	{
		var data = {
			first_name: 'Cristhian Kevin',
			middle_name: 'Demeza',
			last_name: 'Sagun'
		};

		var employee = new Employee(data);
	}

});
