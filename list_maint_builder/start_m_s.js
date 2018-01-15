			

var app = angular.module('start_maint_scr', ['app.common.config']);
app.controller('controller1', function($scope, $http) {

  $scope.myObj = {
    "background-color": "#e6e6e6"
  }
  $scope.myObj2 = {
    "background-color": "#ffffff"
  }

  
//gets loaded automatically in the <body> by ng-init
$scope.initialize = function(){
	$scope.getExisting();
}

//when click the "Create" button
$scope.createFunction = function(){
	$scope.sendData();
}

// sends the name of the app and table to create a new maintenance screen 
$scope.sendData = function(){

		  $http.post("/api/maintenance_scr/maint_scr_api", 
        {	
        	app_name:$scope.app_name,
        	table_name:$scope.table_name,
        	cal_login:cal_login
        }).
  then(function(data){
  	$scope.result = data['data'];
  	if($scope.result[0] == 0 && $scope.result[1]==1){
  		alert('The selected table name already exists in the DataBase!');
  	}else if($scope.result[0] == 1 && $scope.result[1]==1){
  		alert('The selected table name is already being used!');
  	}else if($scope.result[0] == 0 && $scope.result[1]==0){
  		window.location = 'http://websalescalene.fwwebbcorp.fwwebb.com/maintenance_scr_builder/maint_scr.php?tn='+$scope.table_name;
  	}

					});
}

//retrieves existing Maintenance Screens
$scope.getExisting = function(){
			  $http.post("/api/maintenance_scr/maint_scr_api", 
        {	
        	getExisting_Maint_Scr:true,cal_login:cal_login 	
        }).
  then(function(data){
  	$scope.existing_tables_data = data['data'][0];
  	$scope.department = data['data'][1];
  	if($scope.department == 'IT'){
  			$scope.disable_CRUD = false;
  	}else{
  		$scope.disable_CRUD = true;
  	}

  	


					});
}
//"Edit" Button
$scope.goEdit = function(param){
	window.location = 'http://websalescalene.fwwebbcorp.fwwebb.com/maintenance_scr_builder/maint_scr.php?tn='+param;
}

//delete the table plus the entry in the list_of_maint_screens table
$scope.deleteMaint_Screen = function(id, table){
	if(confirm("Are you sure you want to Delete Maintenance Screen?")){
	$http.post("/api/maintenance_scr/maint_scr_api", 
    {maint_scr_del:id, table_name:table});
	$scope.getExisting();
	}

}

//end controller
});