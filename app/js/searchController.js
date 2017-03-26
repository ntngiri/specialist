specialist.controller('SearchCtrl', ['$scope','dataService', function ($scope,dataService) {
	dataService.getFullDoctorList().then(function(data){
		console.log(data);
		$scope.doctorList = data;
	});
}])