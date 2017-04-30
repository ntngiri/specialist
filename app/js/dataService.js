specialist.factory('dataService', ['$http','$window','$state', function($http,$window,$state) {
    var signUpDocObj = {};
    var url = 'http://quickspecialist.com/specialistAPI/public/index.php';
    serviceObj = {
        getFullDoctorList: function() {
            showLoader();
            return $http.get(url+'/doctor/list').then(function(resp) {
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp.data;
                }
            });
        },
        checkUserExistance: function() {

        },
        signUpUser:function(obj){
            showLoader();
            return $http.post(url+'/patient/add',obj).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    serviceObj.setUserSession(resp.data);
                    return resp;
                }
            });
        },
        signUpDoctor: function(obj) {
            showLoader();
            return $http.post(url+'/doctor/add',obj).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    serviceObj.setSession(resp.data);
                    return resp;
                }
            });
        },
        updateDoctor: function(obj){
            showLoader();
            var docId = serviceObj.getSession();
            obj.id = docId;
            return $http.post(url+'/update/doctorProfile',obj).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp;
                } 
            });
        },
        loginDoctor:function(obj){
                return $http.post(url+'/doctor/login',obj).then(function(resp){
                    serviceObj.setSession(resp.data.id);
                    $state.go('doctorProfile.profile');
                    //return resp;
                })
        },
        setUserSession:function(obj){
            $window.sessionStorage.setItem('patient',JSON.stringify(obj));
        },
        getUserSession:function(){
           return JSON.parse($window.sessionStorage.getItem('patient'));
        },
        getCurrentDoctorData:function(){
            showLoader();
            var id = serviceObj.getSession();
            return $http.get(url+'/doctor/'+id).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp.data;
                }
            });
        },
        setSession:function(user){
            console.log(user);
            $window.sessionStorage.setItem('doc',JSON.stringify(user));
        },
        getSession:function(){
            var doctor = $window.sessionStorage.getItem('doc');
            // if(!doctor){
            //     $state.go('doctorPortal');
            // }else{
                return JSON.parse(doctor);
            //}
        },
        getDoctorData: function(id) {
            showLoader();
            return $http.get(url+'/doctor/'+id).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp.data;
                }
            });
        },
        checkUserName:function(uname){
            return $http.get(url+'/doctor/docUsername/'+uname).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp;
                }
            });
        },
        checkEmailId:function(emailId){
            return $http.get(url+'/doctor/docEmail/'+emailId).then(function(resp){
                if(resp.data.error){
                    msg;
                }else{
                    return resp;
                }
            });
        },
        uploadProfilePic:function(obj){
            showLoader();
            var myDoc = serviceObj.getSession();
            obj.docId = myDoc;
            return $http.post(url+'/upload/profilePic',obj).then(function(resp){
                hideLoader();
                if(resp.data.error){
                    msg;
                }else{
                    return resp;
                }
            });
        }
    };

    function showLoader(){
        document.getElementById('loader').style.display = "block";
    }
    function hideLoader(){
        document.getElementById('loader').style.display = "none";
    }


    return serviceObj;
}])
