var app = angular.module('employeeApp', []);

app.run([function () {
	// code here...
}]);

app.config([function () {
	// code here...
}]);


//=======================
//=      CONTROLLERS    =
//=======================
app.controller('employeeController', employeeController);

employeeController.$inject = ['$scope', 'employeeService'];

function employeeController($scope, employeeService) {

	$scope.activateNextStep = function(stepNumber) {
		var data = {
			name:'kevin sagun',
			message:'the quick brown fox jumps over the lazy dog.'
		};

		employeeService.saveUserData(data).then(function(res) {
			console.log('res: ', res);
		});
	};
}

//=======================
//=      SERVICES	    =
//=======================
app.factory('employeeService', employeeService);

employeeService.$inject = ['$q', '$http'];

function employeeService($q, $http) {

	var baseURL = 'http://192.168.1.29/kawani/kawani_ci/employees/';
	var defer = $q.defer();

	var saveUserData = function (data) {
		var defer = $q.defer();

		$http({
			method  : 'POST',
			url 	: baseURL + 'save_user_data',
			data 	: data
		}).then(function mySuccess(response) {
			defer.resolve(response);
		});

		return defer.promise;
	};

	return {
		saveUserData: saveUserData
	};
}