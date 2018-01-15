<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS file link -->
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/includes/init.php';
print_header('', '', '');
include_once $_SERVER["DOCUMENT_ROOT"] . '/includes/classes/crm_sections.php';

?>

<?php
//geting cal_login
global $login;
$use_user = $login;
if (isset($_SESSION['pseudo_me']) && strlen($_SESSION['pseudo_me'])) {
    $use_user = $_SESSION['pseudo_me'];
}
echo '<script>var cal_login='.json_encode($use_user).' </script>';

  ?>


  
</head>
<body ng-app = "start_maint_scr" ng-controller="controller1" ng-init = "initialize()" ng-cloak>

<style>
	        table, th , td  {
          border: 1px solid grey;
          border-collapse: collapse;
          padding: 5px;
        }

</style>
<!-- BEGINING -->

<div class="container" style="min-height:500px">
        
<form name="form_name">
	<div class="row gray-bkg">
		<div class="col-sm-12">



			     
<div class="row">
<div class="col-sm-8 col-xs-12 col-sm-offset-1" > 
<h2>Existing Maintenance Screens</h2>
</div>
</div>

<div class="clear20"></div>	

	<div class="row"> 
	<div class="col-sm-8 col-xs-12 col-sm-offset-1">
                    <table class="small" style="width: 100%;">
  
                    <tr style="background-color: #005ce6;color: white ">
                      <td>App Name</td>
                      <td>Table Name</td>
                      <td>Created By</td>
                      <td style="width: 10%;">Edit</td>
                      <td style="width: 10%;">Delete</td>
                    </tr>

                    <tr ng-repeat=" (key,value) in existing_tables_data " ng-style="$even ? myObj:myObj2">
                    	<td>{{value.app_name}}</td>
                    	<td>{{value.associated_table}}</td>
                    	<td>{{value.created_by}}</td>

                    	<td><button type="button" class="w3-button w3-blue w3-round-medium" style="color:#33bbff" ng-click="goEdit(value.associated_table)" ng-disabled="disable_CRUD">Edit 
                        </button></td>
                        <td><button type="button" class="w3-button w3-blue w3-round-medium" style="color:#33bbff" ng-click="deleteMaint_Screen(value.ID,value.associated_table)" ng-disabled="disable_CRUD">Delete 
                        </button></td>

                    </tr>

                    </table>  
     </div> 
	</div>

<div class="row" style="margin-top: 35px;">
<div class="col-sm-8 col-xs-12 col-sm-offset-1" > 
<h2>Create New Maintenance Screen</h2>
</div>
</div>

<div class="clear20"></div>                    		        
					        
<div class="row">                 
	<div class="col-sm-4 col-xs-12 col-sm-offset-1" >
		<label class="control-label">Application Name</label>
		<input type = 'text' class='form-control'  ng-model='app_name'>   
	</div>
	<div class="col-sm-4 col-xs-12" >
		<label class="control-label">Table Name</label>
		<input type = 'text' class='form-control'  ng-model='table_name'>   
	</div>
</div>      
					          <hr class="form_divider">
					          <!-- End of element 1 -->

	<div class="row">
		<div class="col-xs-12  col-md-10 col-md-offset-1">
		<button id= "createID" type="button" class="w3-button w3-blue w3-round-medium" style="color:#33bbff" ng-click="createFunction()" ng-disabled="disable_CRUD">Create</button>
		</div>
	</div>


		<!-- div of the col number(12) -->
		</div>
	<!-- div of the gray container -->
	</div>	
</form>
<!--Div of the class="container" style="min-height:500px"  -->
</div>	


	<?php
//insert any extra scripts as the 4th element
//in our case the script.js file holds the date picker function and the SAVE function 
echo print_trailer(true, true, false, 
    '<script src="' . cachebuster('/maintenance_scr_builder/start_m_s.js') . '"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>', '');
?>
			
</body>
</html>          