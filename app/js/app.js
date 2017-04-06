var specialist = angular.module('specialist', ['ui.router'])
.config(['$stateProvider','$locationProvider','$urlRouterProvider', function ($stateProvider,$locationProvider,$urlRouterProvider) {
	$urlRouterProvider.otherwise('/');
	$stateProvider
	.state('home', {
		url:'/',
		templateUrl: './specialist/build/html/main.html',
		controller: 'mainController'
	})
	.state('search', {
		url:'/search',
		templateUrl: './specialist/build/html/search.html',
		controller: 'SearchCtrl'
	})
	.state('doctorPortal', {
		url:'/doctorPortal',
		templateUrl: './specialist/build/html/doctorPortal.html',
		controller: 'doctorPortalCtrl'
	})
	.state('ques', {
		url:'/ques',
		templateUrl: './specialist/build/html/quesans.html',
		//controller: 'QuesCtrl'
	})
	.state('docSignup', {
		url:'/docSignup',
		templateUrl: './specialist/build/html/docSignup.html',
		controller: 'docSignupCtrl'
	})
	.state('doctorProfile', {
		url:'/doctorProfile',
		templateUrl: './specialist/build/html/docProfile.html',
		controller: 'docProfileCtrl',
		abstract: true
	})
	.state('doctorProfile.dashboard', {
        url: '',
        templateUrl: './specialist/build/html/docprofileDashboard.html'
    })
    .state('doctorProfile.faq', {
        url: '/faq',
        templateUrl: './specialist/build/html/docFaq.html'
    })
    .state('doctorProfile.plans', {
        url: '/plans',
        templateUrl: './specialist/build/html/docPlans.html'
    })
    .state('doctorProfile.profile', {
        url: '/profile',
        templateUrl: './specialist/build/html/docUserProfile.html',
		controller: 'docProfileCtrl'
    })
    .state('doctor',{
    	url:'/doctor',
    	templateUrl:'./specialist/build/html/docBooking.html'
    })
	$locationProvider.html5Mode(true);
}]);