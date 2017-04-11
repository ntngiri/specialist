specialist.factory('dataService', ['$http', function($http) {
    var signUpDocObj = {};
    function setSession(user){
        sessionStorage.userId = user;
    }
    return {
        getFullDoctorList: function() {
            return $http.get('http://0.0.0.0:8081/doctor/list').then(function(resp) {
                return resp.data;
            });
        },
        checkUserExistance: function() {

        },
        getSession:function(){
            return sessionStorage.userId;
        },
        signUpDoctor: function(obj) {
            return $http.post('http://0.0.0.0:8081/doctor/add',obj).then(function(resp){
                setSession(resp.data);
                return resp;
            });
            // var obj = {
            //     'sessionId': '23458863',
            //     'docData': { 'name': 'nitin', 'email': 'ntngiri@gmail.com', 'address': 'ksjdnv skvnj', 'city': 'Gurgaon', 'state': 'haryana', 'mob': '70412992873', 'clinic': 'ksjbd', 'fee': '699', 'hv_fee': '7365' }
            // };
            // signUpDocObj = obj;
            // console.log('dataService',signUpDocObj);
            //return signUpDocObj;
        },
        
        getDoctorData: function(id) {
            return $http.get('http://0.0.0.0:8081/doctor/'+id).then(function(resp){
                return resp.data;
            });
        }
    };
}])
