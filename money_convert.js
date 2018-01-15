			

var app = angular.module('money_convert_tool', ['app.common.config']);
app.controller('controller1', function($scope, $http) {


//money functions
$scope.amountChange = function(param){
  $scope[param] = accounting.formatMoney($scope[param],[symbol = ""]);
}

// view
$scope.clickedAmount = function(param){
  //console.log($scope.amount);
  if($scope[param] == 0.00){
    //console.log('need to clear');
    $scope[param]= '';
  }
}

//converts a number to the user-format: 1,234,567
function user_format_convert(param){
  var formatted ='';
//console.log('user_format_param: '+ param);
  if(param){
    var raw_number = param;
    formatted = raw_number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //console.log("user_format_formatted: "+formatted);
    return formatted; 
  }

}
// returns a number only ex: 1,23a4,567 --> 1234567
// view
$scope.number_convert = function(param){
  var formatted ='';
  if(param){
    var raw_number = param;
      //console.log('raw number_convert: '+param);
      for (var i = 0; i < raw_number.length; i++) {

        if (isNaN(raw_number[i]) && raw_number[i]!= '.'){
          raw_number.replace(raw_number[i], "");
        }else{
          formatted += raw_number[i];
        }    
      }
	  var parts = formatted.split(".");
	  var end = parts.pop();
	  if(end == "00"){
	  	formatted = parts[0];
	  }
  }else{
    formatted =0;
  }

  return formatted;
}                     

//takes a number and strips it of non-numeric characters then converts it 
//into the "user friendly" format 
//ex: 12xh34abc--> 1234--> 1,234.00

// view
$scope.money_convert = function(param){
	var justnum='';
	var usr_format ='';
    //console.log('the param= '+param);
    justnum = $scope.number_convert($scope[param]);
    $scope[param] = justnum;
    //console.log('justnum: '+justnum);
    usr_format = user_format_convert(justnum);
    $scope[param] = usr_format;
}

//end money functions


//test amount cleaning before inserting into DB 
$scope.testSubmit = function(){
	console.log('test submit');

	console.log('amount unformated: '+ $scope.amount);
	console.log('amount2 unformated: '+ $scope.amount2);
	console.log('amount formated for saving: '+ $scope.number_convert($scope.amount));
	console.log('amount2 formated for saving: '+ $scope.number_convert($scope.amount2));
}

//when editing and we get the amount from ex: DB 
	var saved_amout = 1000;
    $scope.amount = user_format_convert(saved_amout);
    $scope.amountChange('amount');

});