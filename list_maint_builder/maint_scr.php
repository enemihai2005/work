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
<?php

//geting cal_login
global $login;
$use_user = $login;
if (isset($_SESSION['pseudo_me']) && strlen($_SESSION['pseudo_me'])) {
    $use_user = $_SESSION['pseudo_me'];
}
echo '<script>var cal_login='.json_encode($use_user).' </script>';
?>

<?php
//get table name
if(isset($_GET['tn']) && strlen($_GET['tn'])){
	$table_name = $_GET['tn'];
	echo '<script>var table_name='.json_encode($table_name).' </script>';
}else{
	echo '<script>var table_name = null </script>';
}

?>
<title>Maintenance Screen Builder</title>

  
</head>
<body ng-app = "maint_scr_builder" ng-controller="controller1" ng-init = "initializing()" ng-cloak>
        <style>

       table, th , td  {
          border: 1px solid grey;
          border-collapse: collapse;
          padding: 5px;
        }

              #idSave{
              background-color: #005c99;
             
              color: white;
              padding: 5px 130.5px;
              width: 263px;
              height: 50px;
              margin: 0 auto;
              padding: 0;
              display: table-cell;
              vertical-align: middle;
              margin-top:18px; 
              text-decoration: none;
             width: 100%;
              font-size: 16px;
              
              cursor: pointer;
             
             
                      }

              #idDelete{
              background-color: #005c99;
             
              color: white;
              padding: 5px 130.5px;
              width: 263px;
              height: 50px;
              margin: 0 auto;
              padding: 0;
              display: table-cell;
              vertical-align: middle;
              margin-top:18px; 
              text-decoration: none;
              width: 100%;
              font-size: 16px;
              
              cursor: pointer;
             
             
                      }
              #searchtableID tr{
            cursor: pointer;
                              } 

            #idDelete:hover{
               background-color: #034F66;
            }
            #idSave:hover {
              background-color: #034F66;
            }                         
        </style>

<!-- BEGINING -->

	<div class="container" style="min-height:500px">
  
			  <form name="form_name">
			    <div class="row gray-bkg">
			      <div class="col-sm-12">     
				    <div class="clear10"></div>		     
			        <!-- ROW 1 -->
<div class="if_data">				        
	<div class="row">                 
		<div class="form-group">
              <div class="col-xs-12  col-md-10 col-md-offset-1">
                  <div class="table-responsive">
                    <table class="small" style="width:100%;"  >
  
                    <tr style="background-color: #005c99;color: white ">
                      <th>ID</th>
                  	  <th>Name</th>
                  	  <th>Login Username</th>
                  	  <th>Department</th>
                  	  <th>Email</th>
                  	  <th>Date created</th>
                  	  <th>Created By</th>
                  	  <th>Delete</th>
                    </tr>

					<tbody ng-repeat="(key, value) in table_data track by $index">

						<tr ng-style="$even ? myObj:myObj2">
							<td>
							{{value.ID}}
							</td>

							<td>
					<input type="text" 					
 					class="form-control" 
 					ng-model="name.value.ID" 
 					ng-model-options="{debounce:100}"
 					ng-change = "editField(value.ID, name.value.ID,'name')"
 					ng-init= "name.value.ID=value.name">
							</td>

							<td>
					<input type="text" 					
 					class="form-control" 
 					ng-model="cal_login.value.ID" 
 					ng-model-options="{debounce:100}"
 					ng-change = "editField(value.ID, cal_login.value.ID, 'cal_login')"
 					ng-init= "cal_login.value.ID=value.cal_login">		
							</td>

							<td>
					<input type="text" 					
 					class="form-control" 
 					ng-model="department.value.ID" 
 					ng-model-options="{debounce:100}"
 					ng-change = "editField(value.ID, department.value.ID, 'department')"
 					ng-init= "department.value.ID=value.department">
							</td>

							<td>	
					<input type="text" 					
 					class="form-control" 
 					ng-model="email.value.ID" 
 					ng-model-options="{debounce:100}"
 					ng-change = "editField(value.ID, email.value.ID, 'email')"
 					ng-init= "email.value.ID=value.email">							
							</td>	

							<td>
							
					<input type="text" 					
 					class="form-control" 
 					ng-model="date_created.value.ID" 
 					ng-init= "date_created.value.ID=value.date_created">							
							</td>	

							<td>
					<input type="text" 					
 					class="form-control" 
 					ng-model="created_by.value.ID" 
 					ng-init= "created_by.value.ID=value.created_by"							
							</td>

							<td>
				  <input type="checkbox"
            	  ng-model ="box.value.ID"
            	  ng-click = "checkboxFunction(value.ID, box.value.ID)"
                  />
							</td>																												
						</tr>


					</tbody>
                    </table>

                  </div>
			  </div>
		</div>   
	</div>
</div>
	<div class="if_data">
	<div class="row">
		<div class="col-xs-12  col-md-10 col-md-offset-1">
		<button id= "idDelete" ng-click="delFunction()">Delete Checked</button>
		</div>
	</div>
	</div> 

<hr class="form_divider">
	 <div class="clear10"></div>
	 	<div class="row">                 
		 <div class="form-group">
              <div class="col-xs-12  col-md-10 col-md-offset-1">
              <label>Search for a name.If there is any information the fields will be populated </label>
               <input type="text" 					
 					class="form-control" 
 					ng-model="new_name_search" 
 					ng-model-options="{debounce:500}"
 					ng-change = "searchExistingPerson()"> 

 				<table id="searchtableID" style="display: none; width: 100%;">
       <tr>

         <th>First Name</th>
         <th>Last Name</th>
       </tr>

            <tr ng-repeat="value in chunkedData "
                ng-click ="selectRow(value[0],value[1])"
                ng-mouseenter="hoverActive=true"
                ng-mouseleave="hoverActive=false"
                ng-style="hoverActive ? {'background-color':'#4875B4', 'color':'white'} : {}">

         <td>{{value[0]}}</td>
         <td>{{value[1]}}</td>
       </tr>

        </table>


              </div>
         </div>
        </div>

<hr class="form_divider">
	 <div class="clear10"></div>
	 	<div class="row">                 
		 <div class="form-group">
              <div class="col-xs-12  col-md-10 col-md-offset-1">
              <label ><h1 style="color: red;"><strong>Add new {{app_name}}</strong></h1>
              </div>
         </div>
        </div>

	 	<div class="row">                 
		<div class="form-group">
              <div class="col-xs-12  col-md-10 col-md-offset-1">

                  <div class="table-responsive">
                    <table class="small" style="width:100%;"  >
  
                    <tr style="background-color: #005c99;color: white ">
                      <td>Name</td>
                   	  <td>Login Username</td>
                  	  <td>Department</td>
                  	  <td>Email</td>
                  	  <td>Date created</td>
                  	  <td>Created By</td>


                    </tr>

                    <tr>
                    	<td>
          <input type="text" class="form-control" name="new_name" ng-model="new_name" placeholder ="Username"> 
                    	</td>

                    	<td>
         <input type="text" name="new_name" placeholder ="Login Username" class="form-control" ng-model="new_cal_login">
                    	</td>

                    	<td>
         <input type="text" name="new_department" placeholder ="Department" class="form-control" ng-model="new_department">
                    	</td>

                    	<td>
         <input type="text" name="new_email" placeholder ="Manager Email" class="form-control" ng-model="new_email">
                    	</td>

                    	<td>
         <input type="text" name="new_date"  class="form-control" ng-model="date_of_application">           		
                    	</td>



                    	<td>
                    	<input type="text" 
                    	name="new_cratedby"  
                    	class="form-control" 
                    	ng-model="new_cratedby"> 		
                    	</td>
                    </tr>

                    </table>
                    </div>



              </div>
         </div>
         </div>

     <div class="row">
		<div class="col-xs-12  col-md-10 col-md-offset-1">
		<button id= "idSave" ng-click="saveFunction()">Save New {{app_name}}</button>
		</div>
	</div> 


					          <!-- <hr class="form_divider"> -->
					         




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
    '<script src="' . cachebuster('/maintenance_scr_builder/maint_scr.js') . '"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>', '');
?>
			
</body>
</html>          