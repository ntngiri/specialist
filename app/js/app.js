var specialist = angular.module('specialist', ['ngRoute','specialist.droope'])
.config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
	$routeProvider.when('/', {
		templateUrl: './build/html/main.html',
		controller: 'mainController'
	})
	.when('/search', {
		templateUrl: './build/html/search.html',
		controller: 'SearchCtrl'
	})
	.when('/doctorPortal', {
		templateUrl: './build/html/doctorPortal.html',
		controller: 'doctorPortalCtrl'
	})
	.when('/ques', {
		templateUrl: './build/html/quesans.html',
		//controller: 'QuesCtrl'
	})
	.when('/docSignup', {
		templateUrl: './build/html/docSignup.html',
		controller: 'docSignupCtrl'
	})


	$locationProvider.html5Mode(true);
}]);