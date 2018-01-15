<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS file link -->
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/includes/init.php';
print_header('', '', '');
include_once $_SERVER["DOCUMENT_ROOT"] . '/includes/classes/crm_sections.php';

?>

<title>Search Box</title>

  
</head>
<body ng-app = "money_convert_tool" ng-controller="controller1">


<!-- BEGINING -->

<div class="container" style="min-height:500px">
        
<form name="form_name">
	<div class="row gray-bkg">
		<div class="col-sm-12">
					        
<div class="row">  

	<div class="col-sm-4 col-xs-12 col-md-4 ">
		<label class="control-label" for="amount">Amount</label>
		<div class="form-group form-inline">
			<div class="input-group" style="width: 100%;">
			<div class="input-group-addon">$</div>
			<input type="text" class="form-control" 
			name = "amount" 
			ng-model="amount" 
			ng-change = "money_convert('amount')" 
			ng-blur="amountChange('amount')" 
			ng-click="clickedAmount('amount')" 
			>
			</div>
		</div>
	</div>

</div> 

<div class="row">  

	<div class="col-sm-4 col-xs-12 col-md-4 ">
		<label class="control-label" for="amount">Amount2</label>
		<div class="form-group form-inline">
			<div class="input-group" style="width: 100%;">
			<div class="input-group-addon">$</div>
			<input type="text" class="form-control" 
			name = "amount2" 
			ng-model="amount2" 
			ng-change = "money_convert('amount2')" 
			ng-blur="amountChange('amount2')" 
			ng-click="clickedAmount('amount2')" 
			>
			</div>
		</div>
	</div>

</div>


<div class="row">  
<button ng-click='testSubmit()'>Test Submit</button>
</div>      
					         
<!-- End of element 1 -->




		<!-- div of the col number(12) -->
		</div>
	<!-- div of the gray container -->
	</div>	
</form>
<!--Div of the class="container" style="min-height:500px"  -->
</div>	


<?php
echo print_trailer(true, true, false, 
    '<script src="' . cachebuster('/tool_money_convert/money_convert.js') . '"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>', '');
//allows usage of acounting tools 
echo ' <script src="/js/dist/accounting.min.js"></script>';
?>
			
</body>
</html>          