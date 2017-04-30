specialist.controller('SearchCtrl', ['$scope','$state','dataService', function ($scope,$state,dataService) {
	$scope.doctorId;
	$scope.showFilterDropDown = false;
	dataService.getFullDoctorList().then(function(data){
		console.log(data);
		$scope.doctorList = data;
		$scope.doctorId = data.id;
	});
	
	$scope.data = [
	{
		'name':'Neck Specialist',
		'id':'123'
	},
	{
		'name':'Back Specialist',
		'id':'124'
	},
	{
		'name':'Shoulder Specialist',
		'id':'125'
	},{
		'name':'Elbow Specialist',
		'id':'126'
	},{
		'name':'Wrist Specialist',
		'id':'127'
	},{
		'name':'Hip Specialist',
		'id':'128'
	},{
		'name':'Knee Specialist',
		'id':'129'
	},{
		'name':'Ankle Specialist',
		'id':'130'
	},{
		'name':'Paralysis Specialist',
		'id':'126'
	},{
		'name':'Post Fracture Specialist',
		'id':'126'
	},{
		'name':'Post Surgical Specialist',
		'id':'126'
	}];
	$scope.locationData = [
	{
		'name':'Delhi',
		'id':'123'
	},
	{
		'name':'Noida',
		'id':'124'
	},
	{
		'name':'Gurgaon',
		'id':'123'
	}];
	$scope.subLocation = [
	{
		'name':'Akshardham',
		'id':'123'
	},
	{
		'name':'Ashok Nagar',
		'id':'123'
	},
	{
		'name':'Shahdara',
		'id':'123'
	},
	{
		'name':'Dilshad Garden',
		'id':'123'
	},
	{
		'name':'South Extension',
		'id':'123'
	},
	{
		'name':'Sarojini Nagar',
		'id':'123'
	},
	{
		'name':'Preet Vihar',
		'id':'123'
	},
	{
		'name':'Nirman Vihar',
		'id':'124'
	},
	{
		'name':'Mayur Vihar',
		'id':'123'
	}];
	$scope.options = {
		fieldAttr:{
		'multiselect':false,
		'placeholder':'Enter your state'
	}
	}
	$scope.optionsSpec = {
		fieldAttr:{
		'multiselect':false,
		'placeholder':'Specialist you need'
	}
	}
	$scope.api ={

	}
	$scope.onClickFunc = function(obj){
		if(obj !== undefined){
			document.getElementById("searchFilters").classList.remove("filterOpen");
			document.getElementById("searchFilters").classList.add("filterOpen");
			$scope.showFilterDropDown = true;
		}
	};
	$scope.onFocusLose = function(){
		$scope.showFilterDropDown = false;
	}
	$scope.doctorBook = function(id){
		$state.go('doctor({id:})');
	}
}])