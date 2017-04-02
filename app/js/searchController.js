specialist.controller('SearchCtrl', ['$scope','$state','dataService', function ($scope,$state,dataService) {
	$scope.doctorId;
	dataService.getFullDoctorList().then(function(data){
		console.log(data);
		$scope.doctorList = data;
		$scope.doctorId = data.id;
	});
	$scope.doctorBook = function(id){
		$state.go('doctor');
	}
}])