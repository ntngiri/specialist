specialist.factory('dataService', ['$http',function ($http) {
	return {
		getFullDoctorList:function(){
			return $http.get('http://0.0.0.0:8080/doctor/list').then(function(resp){
				return resp.data;
			});
		},
		checkUserExistance:function(){
			
		}
	};
}])