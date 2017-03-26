specialist.controller('docSignupCtrl', ['$scope', function ($scope) {
	$scope.secForm = false;
	$scope.firstForm = true;
	var signUpData = {};
	$scope.checkEmailValidity = function(){
		if($scope.email !== $scope.confEmail){
			$scope.email_err = true;
			$scope.email_err_msg = 'Email did not match';
		}else{
			
		}
	};
	$scope.bringSecondForm = function(){
		signUpData.name = $scope.fname +" "+ $scope.lname;
		if($scope.email == $scope.confEmail){
			signUpData.email = $scope.email;

		}else{
			$scope.email_err = true;
		}
		if($scope.pass == $scope.confPass){
			signUpData.password = $scope.pass;
		}else{
			$scope.pass_err = true;
		}
		if(!$scope.pass_err && !$scope.email_err){
			$scope.secForm = true;
			$scope.firstForm = false;
		}
	};
}])