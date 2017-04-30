specialist.controller('docBookingCtrl', ['$scope','$stateParams','dataService', function ($scope,$stateParams,dataService) {
	var id = $stateParams.id;
	$scope.bookDoctor;
	dataService.getDoctorData(id).then(function(resp){
		$scope.bookDoctor = resp[0];
	})
}])