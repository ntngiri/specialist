specialist.controller('MainCtrl', ['$scope','dataService','$state', function ($scope,dataService,$state) {
	$scope.email_err = false;
	$scope.pwd_err = false;
	$scope.loginStatusString = "login"
	$scope.showLgtBox = true;
	$scope.registrationLightBox = false;
	$scope.loginform = false;
	$scope.err_msg = false;
	$scope.userTestname = "sljdhfksjdb";
	$scope.mobileRegEx = "/^[0-9]{10,10}$/;";
	$scope.signUpData = {};
	

$scope.closeLightbox = function(){
	$scope.lgtStyle={display:'none'};
	$scope.showLgtBox = false;
	$scope.registrationLightBox = false;
	$scope.loginform = false;
}

	$scope.openLightbox = function(id){
		var user = dataService.getUserSession();
		if(!user){
		$scope.lgtStyle={display:'block'}
		$scope.showLgtBox = true;
		if(id == 'registrationLightBox'){
			$scope.registrationLightBox = true;
		}else{
		$scope.loginform = true;
		}
	}else{
		$scope.loginStatusString = user.name;
	}	
	}


	$scope.checkusername = function(){
		if(dataService.checkUserName($scope.username) == 1){
			$scope.usernameExist = true;
		}else{
		    $scope.usernameExist = false;
		}
	}
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
	$scope.sendSignupUser = function(){
			//$scope.err_msg = false;
			$scope.signUpData.mobile = $scope.mobileNo;
			$scope.signUpData.username = $scope.username;
			$scope.signUpData.firstname = $scope.firstname;
			$scope.signUpData.lastname = $scope.lastname;
			$scope.signUpData.pass = $scope.pass;
			$scope.signUpData.email = $scope.email;
			dataService.signUpUser($scope.signUpData).then(function(resp){
				if(resp){
					$state.go('/');
				}
			})
			//to be removed
			// dataService.signUpDoctor(signUpData).then(function(resp){
			// 	$state.go('doctorProfile.dashboard');
			// });
	
	};
}])