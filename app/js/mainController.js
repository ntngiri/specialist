specialist.controller('mainController', ['$scope', function ($scope) {
	var json = [{'name':'Delhi'},{'name':'Noida'},{'name':'Gurgaon'}]
	$scope.options = {};
	$scope.options = {
		data:json,
		multiselect:true,
		maxHeight: 250
	};
		$scope.data = [{'name':'Delhi'},{'name':'Noida'},{'name':'Gurgaon'}]
        $scope.selectedId = [];
        $scope.onClickFunc = function(obj1) {
            //$scope.cbObj = obj;
          console.log(obj1);
        }
        $scope.api = {};

     $scope.$parent.doctorPatient = 'For Doctor';
	$scope.$parent.doctorPatientUrl ='doctorPortal';
}])