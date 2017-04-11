specialist.controller('docSignupCtrl', ['$scope','$state','dataService', function ($scope,$state,dataService) {
	$scope.secondForm = false;
	$scope.firstForm = true;
	$scope.email_err = false;
	$scope.pwd_err = false;
	$scope.err_msg = false;
	$scope.mobileRegEx = "/^[0-9]{10,10}$/;";
	$scope.pinCodeRegEx = "/^[0-9]{6,6}$/;";
	var signUpData = {};
	$scope.checkEmailPwdValidity = function(value){
		if(value == 'email'){
			if($scope.email !== $scope.confEmail){
				$scope.email_err = true;
				$scope.email_err_msg = 'Email did not match';
			}else{
				$scope.email_err = false;
				$scope.email_err_msg = '';
			}
		}else if(value =='pwd'){
			if($scope.pass !== $scope.confPass){
				$scope.pass_err = true;
			}else{
				$scope.pass_err = false;
			}
		}		
	};
	$scope.bringSecondForm = function(isValid){
		if(isValid){
			$scope.err_msg = false;
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
				$scope.secondForm = true;
				$scope.firstForm = false;
			}
		} else if(!isValid){
			$scope.err_msg = true;
		}
	};

	$scope.sendSignupDoc = function(isValid){
		if(isValid){
			$scope.err_msg = false;
			signUpData.address = $scope.address1 + ' ' + $scope.address2;
			signUpData.pin = $scope.pinCode;
			signUpData.city = $scope.city;
			signUpData.state = $scope.state;
			signUpData.mobile = $scope.mobileNo;
			signUpData.clinic_name = $scope.clinicName;
			signUpData.fee = $scope.clinicFee;
			signUpData.hv_fee = $scope.homeVisit;
			dataService.signUpDoctor(signUpData).then(function(resp){
				if(resp){
					$state.go('doctorProfile.dashboard');
				}
			});
		} else if(!isValid){
			$scope.err_msg = true;
		}
	};
}]);