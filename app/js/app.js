var specialist = angular.module('specialist', ['ui.router'])
.config(['$stateProvider','$locationProvider','$urlRouterProvider', function ($stateProvider,$locationProvider,$urlRouterProvider) {
	$urlRouterProvider.otherwise('/');
	$stateProvider
	.state('home', {
		url:'/',
		templateUrl: './build/html/main.html',
		controller: 'mainController'
	})
	.state('search', {
		url:'/search',
		templateUrl: './build/html/search.html',
		controller: 'SearchCtrl'
	})
	.state('doctorPortal', {
		url:'/doctorPortal',
		templateUrl: './build/html/doctorPortal.html',
		controller: 'doctorPortalCtrl'
	})
	.state('ques', {
		url:'/ques',
		templateUrl: './build/html/quesans.html',
		//controller: 'QuesCtrl'
	})
	.state('docSignup', {
		url:'/docSignup',
		templateUrl: './build/html/docSignup.html',
		controller: 'docSignupCtrl'
	})
	.state('doctorProfile', {
		url:'/doctorProfile',
		templateUrl: './build/html/docProfile.html',
		controller: 'docProfileCtrl',
		abstract: true
	})
	.state('doctorProfile.dashboard', {
        url: '',
        templateUrl: './build/html/docprofileDashboard.html'
    })
    .state('doctorProfile.faq', {
        url: '/faq',
        templateUrl: './build/html/docFaq.html'
    })
    .state('doctorProfile.plans', {
        url: '/plans',
        templateUrl: './build/html/docPlans.html'
    })
    .state('doctorProfile.profile', {
        url: '/profile',
        templateUrl: './build/html/docUserProfile.html'
    })
    .state('doctor',{
    	url:'/doctor',
    	templateUrl:'./build/html/docBooking.html'
    })
	$locationProvider.html5Mode(true);
}]);