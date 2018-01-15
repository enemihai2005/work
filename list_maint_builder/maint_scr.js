			

var app = angular.module('maint_scr_builder', ['app.common.config']);
app.controller('controller1', function($scope, $http) {

// if(!($department == 'IT' || $is_allowed == 'true'|| $department =='General Managers')){
// 		//echo 'Send USER BACK!!!';
// 	echo '<script>window.location = "http://websalescalene.fwwebbcorp.fwwebb.com/dashboard.php"; </script>';
//     die();
// }


  $scope.myObj = {
    "background-color": "#e6e6e6"
  }
  $scope.myObj2 = {
    "background-color": "#ffffff"
  }


$scope.initializing = function(){
	console.log('initializing data');
	$scope.getData();
	$scope.table_name = table_name;
}


$scope.getData = function(){
		  $http.post("/api/maintenance_scr/maint_scr_api", 
        {	
        	getData:true, cal_login:cal_login, table_name:table_name 	
        }).
  then(function(data){
  	console.log('server information: ');
  	$scope.returned_data = data['data'];
  	$scope.table_data = $scope.returned_data[0];
  	console.log($scope.returned_data);
  	if($scope.table_data.length <1){
  		$('.if_data').hide();
  	}else{
  		$('.if_data').show();
  	}
  	$scope.table_data.length

  	$scope.new_cratedby = $scope.returned_data.fullName;
  	$scope.app_name = $scope.returned_data.app_name;
					});
}

function chunk(arr, size) {
	var newArr = [];
	for (var i=0; i<arr.length; i+=size) {
	newArr.push(arr.slice(i, i+size));
	}
	return newArr;
}
$scope.selectRow = function(fname,lname){
	console.log('clicked row: '+fname + ' '+lname);
	$scope.new_name_search = fname + ' '+lname;
	$scope.searchExistingPerson();
	$('#searchtableID').hide();
}
$scope.searchExistingPerson = function(){

	console.log($scope.new_name_search);
	var names = $scope.new_name_search;

	var res = names.split(" ");
	console.log('splitted: '+res);
	console.log('fname: '+res[0]);
	console.log('lname: '+res[1]);
	if(!$scope.new_name_search){
		console.log('search empty');
		$('#searchtableID').hide();
         	$scope.new_name = '';
         	$scope.new_email = '';
         	$scope.new_cal_login = '';

	}else{
		console.log('not empty');
		$('#searchtableID').show();
			$http.post("/api/maintenance_scr/maint_scr_api", {manager_fname:res[0], manager_lname:res[1]}).
  then(function(data){
		console.log('server information: ');

		$scope.arr_names=[];			

		for (var i = 0; i <data['data'].length; i++) {
			$scope.arr_names.push(data['data'][i]['cal_firstname']);
			$scope.arr_names.push(data['data'][i]['cal_lastname']);
		}
		$scope.chunkedData = chunk($scope.arr_names, 2);

		console.log(data['data']);
         if(data['data'][0]){
         	$scope.new_name = data['data'][0]['cal_firstname']+' '+data['data'][0]['cal_lastname'];
         	$scope.new_email = data['data'][0]['cal_email'];
         	$scope.new_cal_login = data['data'][0]['cal_login'];
         	$scope.new_department = data['data'][0]['ad_group'];
         	
         }

	});
	}
}







var date = new Date();
$scope.date_of_application = ('0' + (date.getMonth() + 1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) +'/' + date.getFullYear();

$scope.editField = function(id, param, field){
	 $http.post("/api/maintenance_scr/maint_scr_api", 
       {Edit_ID:id,param:param, field:field, table_name:$scope.table_name});
}

var ids_for_del = [];
$scope.checkboxFunction = function(id, value){
	console.log(id);
	console.log(value);


	if (value) {
		ids_for_del.push(id);
		
	}else{
		//var array = [2, 5, 9];
        var index = ids_for_del.indexOf(id);
        if (index > -1) {
    ids_for_del.splice(index, 1);
                         }
	}
	console.log(ids_for_del);

	function remove_duplicates_es6(arr) {
    let s = new Set(arr);
    let it = s.values();
    return Array.from(it);
}

$scope.send_ids = remove_duplicates_es6(ids_for_del);
console.log('after duplicates removal: '+$scope.send_ids);

// return send_ids;
}


$scope.delFunction = function(){
	if($scope.send_ids.length > 0){
		$http.post("/api/maintenance_scr/maint_scr_api", {del_ids:$scope.send_ids, table_name:$scope.table_name}).
	  then(function(data){
		$scope.getData();
		});
	}

}


$scope.saveFunction = function(){

	console.log($scope.new_name);
	console.log($scope.new_department);
	console.log($scope.new_email);

	if(!$scope.new_department){
	$scope.new_department = '';
	}

	  $http.post("/api/maintenance_scr/maint_scr_api", 
        {	Save_cal_login:$scope.new_cal_login,
        	Save_Name:$scope.new_name,
        	Save_department:$scope.new_department,
        	Save_email:$scope.new_email,
        	Save_date:$scope.date_of_application,
        	Save_created_by:$scope.new_cratedby,
        	table_name:$scope.table_name


        }).
  then(function(data){
  	console.log('server information: ');
  	console.log('name: '+data['data']['element']);
  	console.log('email: '+data['data']['existing_email'][0]);
  	var name = true;
  	var email = true;
  	// Testing for duplicates
  	if(data['data']['element']){
  		alert($scope.app_name+' with the same name already in the list');
  		var name = false;
  	}
  	if(!data['data']['existing_email'][0]){
  		alert('Email does not match records!');
  		var email = false;
  	}
  	  if(name == true &&  email == true){
  	$scope.new_name_search = '';
  	$scope.getData();
    }
					});

	


	  
	
}




});