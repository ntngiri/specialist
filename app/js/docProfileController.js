specialist.controller('docProfileCtrl', ['$scope', 'dataService', function($scope, dataService) {
    var doctorId = dataService.getSession();
    $scope.editProfile2 = false;
    $scope.editProfile = true;
    $scope.docJson;
    dataService.getDoctorData(doctorId).then(function(resp){
        $scope.docJson = resp[0];
        console.log('doctor data', $scope.docJson);
    });

    $scope.showEditForm = function(tabId){
        // if (tabId == '1'){
        //     $scope.editProfile2 = false;
        //     $scope.editProfile = true;
        //     document.getElementById("1").classList.add("active");
        //     document.getElementById("2").classList.remove("active");
        // } else if (tabId == '2') {
        //     $scope.editProfile2 = true;
        //     $scope.editProfile = false;
        //     document.getElementById("2").classList.add("active");
        //     document.getElementById("1").classList.remove("active");
        // }
        var inputs = document.getElementsByClassName('toggleDisable');
        for(var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
    }

    $scope.mode = 'week';
    $scope.eventSource = createRandomEvents();
    $scope.selected = 0;
    $scope.select = function(index) {
        $scope.selected = index;
    }
    $scope.navProfileList = [{ 'sref': 'dashboard', 'title': 'Dashboard' }, { 'sref': 'faq', 'title': 'FAQ' }, { 'sref': 'plans', 'title': 'Pricing Plans' }, { 'sref': 'profile', 'title': 'User Account' }];

    function createRandomEvents() {
        var events = [];
        for (var i = 0; i < 50; i += 1) {
            var date = new Date();
            var eventType = Math.floor(Math.random() * 2);
            var startDay = Math.floor(Math.random() * 90) - 45;
            var endDay = Math.floor(Math.random() * 2) + startDay;
            var startTime;
            var endTime;
            if (eventType === 0) {
                startTime = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate() + startDay));
                if (endDay === startDay) {
                    endDay += 1;
                }
                endTime = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate() + endDay));
                events.push({
                    title: 'All Day - ' + i,
                    startTime: startTime,
                    endTime: endTime,
                    allDay: true
                });
            } else {
                var startMinute = Math.floor(Math.random() * 24 * 60);
                var endMinute = Math.floor(Math.random() * 180) + startMinute;
                startTime = new Date(date.getFullYear(), date.getMonth(), date.getDate() + startDay, 0, date.getMinutes() + startMinute);
                endTime = new Date(date.getFullYear(), date.getMonth(), date.getDate() + endDay, 0, date.getMinutes() + endMinute);
                events.push({
                    title: i + 'Mr Nitin',
                    startTime: startTime,
                    endTime: endTime,
                    allDay: false
                });
            }
        }
        return events;
    }
}]);
