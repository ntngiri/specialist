specialist.controller('docLoginCtrl', ['$scope','dataService','$state', function ($scope,dataService,$state) {
	if(dataService.getSession()){
		$state.go('doctorProfile.profile');
	}
	$scope.loginDoc = function(valid,e){
		e.preventDefault();
		var loginObj = {};
		loginObj.email = $scope.email;
		loginObj.password = $scope.pass;
		if(valid){
			dataService.loginDoctor(loginObj).then(function(resp){
				console.log(resp);
			})
		}
	}
}])