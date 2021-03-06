<?php

if(isset($_POST['btn-create-event']))
{
   

    $type=$_POST['event_type']; 
    $address=$_POST['event_address']; 
    $city=$_POST['event_city']; 
     

    
    $opt_res=$_POST['optional_Resource'];
    
    $opt_quan=$_POST['optional_Quantity'];
       
      $arrayResources=  json_encode($opt_res);
      $arrayQuantities= json_encode($opt_quan);
     $detail= nl2br($_POST['event_description']);
     
     
     
 $base_url = 'http://localhost:8080/hapservices/v1/otherappeal';
$query_string = '';
$params = array (
'appealName' => $type,
'appealAddress' => $address,
'appealCity'=> $city,
    
    'resources'=>$arrayResources,
    'quantity'=>$arrayQuantities,
    'detail'=>$detail,
    
    
);

$query_string = http_build_query($params);
$url = $base_url . '?' . $query_string;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($ch);

$result=  json_decode($response,true);

$mess=$result['message'];

curl_close($ch);
}
?>






<?php include '../InterfaceManagerDashBoard/MasterPageFront.php' ?>         
            
<?php include '../InterfaceManagerDashBoard/MasterPageFrontMenu.php' ?>   
  

<div class="container">    
  <div class="row content"> 

         <?php include '../InterfaceManagerDashBoard/MasterSideBar.php' ?>    
      
        <div class="col-sm-8 text-left"> 
       
        <div>
           
           
         <form class="well form-horizontal"  method="post"  id="event_form">
      
                    <?php
                           
                          
                         if(isset($mess)) 
   
            {echo $mess; }
    ?>
<!-- Form Name -->
<fieldset>
<legend>Appeal  Details</legend>


<div class="form-group">
  <label class="col-md-4 control-label" >Enter Appeal  </label> 
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <input name="event_type" placeholder="Need Water , Medicain etc " class="form-control"  type="text">
    </div>
  </div>
</div>

<!--<div class="form-group">
  <label class="col-md-4 control-label">Appeal Description</label>
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="event_description" placeholder="Project Description"></textarea>
  </div>
  </div>
</div>-->
<!-- Text area -->

<!-- Text input-->
      
<div class="form-group">
  <label class="col-md-4 control-label"> Address</label>  
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="event_address" placeholder="Address" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->
 
<div class="form-group">
  <label class="col-md-4 control-label">City</label>  
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="event_city" placeholder="city" class="form-control"  type="text">
    </div>
  </div>
</div>
  
<div class="form-group"> 
  <label class="col-md-4 control-label">Select Resources & Quantity </label>
    <div class="col-md-3 col-xm-3 selectContainer">
    <div class="input-group">
     
        
        <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="field-name">Field Name</label>
                        <input type="text" class="form-control" name="optional_Resource[]" id="field-name" placeholder="Resources">
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <label class="sr-only" for="field-value">Field Value</label>
                        <input type="text" class="form-control" name="optional_Quantity[]" id="field-value" placeholder="Quantities ">
                    </div>
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>  <!-- /div.form-inline -->
            </div>  <!-- /div[data-role="dynamic-fields"] -->
        </div>  <!-- /div.col-md-12 -->
    </div>  <!-- /div.row -->
</div>
        
        
   </div>
</div>
</div>

<!-- Text area -->
  
<div class="form-group">
  <label class="col-md-4 control-label">Appeal Description</label>
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="event_description" placeholder="Project Description"></textarea>
  </div>
  </div>
</div>

<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Successfully Create Event .</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" name="btn-create-event">Create Appeal <span class="glyphicon glyphicon-ok"></span></button>
  </div>
</div>

</fieldset>
        </form>
      </div>
        
        
         </div>

      </div>
</div>
  
<?php include '../InterfaceManagerDashBoard/MasterFooter.php' ?>     