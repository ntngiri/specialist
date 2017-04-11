specialist.factory('dataService', ['$http','$window', function($http,$window) {
	var signUpDocObj = {};
    return {
        getFullDoctorList: function() {
            return $http.get('http://0.0.0.0:8081/doctor/list').then(function(resp) {
                return resp.data;
            });
        },
        checkUserExistance: function() {

        },
        signUpDoctor: function(obj) {
            return $http.post('http://0.0.0.0:8081/doctor/add',obj).then(function(resp){
                setSession(resp);
            	return resp;
            })
            // var obj = {
            //     'sessionId': '23458863',
            //     'docData': { 'name': 'nitin', 'email': 'ntngiri@gmail.com', 'address': 'ksjdnv skvnj', 'city': 'Gurgaon', 'state': 'haryana', 'mob': '70412992873', 'clinic': 'ksjbd', 'fee': '699', 'hv_fee': '7365' }
            // };
            // signUpDocObj = obj;
            // console.log('dataService',signUpDocObj);
            //return signUpDocObj;
        },
        setSession:function(user){
            $window.sessionStorage.setItem('user',JSON.stringify(user));
        },
        getSession:function(){
            return $window.sessionStorage.getItem('user');
        },
        getDoctorData: function(id) {
            return $http.get('http://0.0.0.0:8081/doctor/'+id).then(function(resp){
            	return resp.data;
            });
        }
    };
}])
