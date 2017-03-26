angular.module('droopeDemo',['naukri.droope','naukri.listing'])
.controller('demoController', function($scope) {
	$scope.onClickFunc = function(obj1) {
            console.log('tag func ',obj1)
           var newTag = {id:obj1.id,name:obj1.name}
          $scope.tags.push(newTag);
        }
	$scope.options = {
		multiselect:false,
		maxHeight: 250,
	};
		$scope.data = json;
        $scope.selectedId = selectedIDs;
        $scope.tags= [];
           
    });