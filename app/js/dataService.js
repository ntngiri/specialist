specialist.factory('dataService', ['$http','$window', function($http,$window) {
	var signUpDocObj = {};
	var url = 'http://quickspecialist.com/specialist/specialistAPI/public/index.php';
    return {
        getFullDoctorList: function() {
            return $http.get(url+'/doctor/list').then(function(resp) {
                return resp.data;
            });
        },
        checkUserExistance: function() {

        },
        signUpDoctor: function(obj) {
            return $http.post(url+'/doctor/add',obj).then(function(resp){
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
            return $http.get(url+'/doctor/'+id).then(function(resp){
            	return resp.data;
            });
        },
        checkUserName:function(uname){
             return $http.get(url+'/doctor/docUsername/'+uname).then(function(resp){
                return resp;
            });
        },
        uploadProfilePic:function(obj){
            return $http.post(url+'/doctor/profilePic',obj).then(function(resp){
                return resp;
            })
        }
    };
}])
