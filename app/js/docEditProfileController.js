specialist.controller('docEditProfileCtrl', ['$scope', 'dataService', '$http', function($scope, dataService, $http) {
	var doctorUpdatedData = {};
    console.log($scope.docJson);
    $scope.docData = {};
	angular.extend($scope.docData, $scope.docJson);
	$scope.saveDoctorData = function(){
        dataService.updateDoctor($scope.docData).then(function(resp){
            if(resp){
            	$scope.$parent.docJson = $scope.docData;
                $state.go('doctorProfile.dashboard');
            }
        });
    };
    $scope.selId = [];
    $scope.options = {
        'multiselect':'true',
        fieldAttr:{
        'multiselect':true,
        'placeholder':'Enter your state'
    }
    }

    $scope.speciality = [
    {
        'name':'Neck Specialist',
        'id':'123'
    },
    {
        'name':'Back Specialist',
        'id':'124'
    },
    {
        'name':'Shoulder Specialist',
        'id':'125'
    },{
        'name':'Elbow Specialist',
        'id':'126'
    },{
        'name':'Wrist Specialist',
        'id':'127'
    },{
        'name':'Hip Specialist',
        'id':'128'
    },{
        'name':'Knee Specialist',
        'id':'129'
    },{
        'name':'Ankle Specialist',
        'id':'130'
    },{
        'name':'Paralysis Specialist',
        'id':'126'
    },{
        'name':'Post Fracture Specialist',
        'id':'126'
    },{
        'name':'Post Surgical Specialist',
        'id':'126'
    }];

}]);