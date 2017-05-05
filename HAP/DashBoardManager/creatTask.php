<?php

$id="";
if(isset($_GET['eventID']))
{
    $id=$eventID=$_GET['eventID'];
    
}

    
if(isset($_POST['btn-create-task']))
{
   

    $name=$_POST['taskName']; 
     $address=$_POST['event_address']; 
     $city=$_POST['event_city']; 
    
     $detail= nl2br($_POST['event_description']);
      $status=$_POST['status'];  
     
     
 $base_url = 'http://localhost:8080/hapservices/v1//creatTask';
$query_string = '';
$params = array (
'name' => $name,
'address' => $address,
'city'=> $city,
'detail'=>$detail,
'taskprogress'=>$status,
'eventID'=>$id,
 
    
    
    
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
<?php include '../InterfaceManagerDashBoard/MasterPageFrontMenu.php' ?>         
  

<div class="container">    
  <div class="row content"> 

          <?php include '../InterfaceManagerDashBoard/MasterSideBar.php' ?>    
      
       <div class="col-sm-8 text-left"> 
             
            <!--  Form  -->    
                     <?php
                     if(isset($mess)) 
   
            {echo $mess; }?>
           <div>
           
                 <form class="well form-horizontal"  method="post"  id="event_form">
      
                                       
<!-- Form Name -->
<fieldset>
<legend>Create Task</legend>
<!-- Form Name -->






<div class="form-group">
  <label class="col-md-4 control-label">  Task Name</label>  
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="taskName" placeholder="Enter Task Name" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->
      


<!-- Text area -->
  
<div class="form-group">
  <label class="col-md-4 control-label"> Task Detail </label>
    <div class="col-md-5 col-xm-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="event_description" placeholder="Describe about Task "></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">  Address</label>  
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
  <label class="col-md-4 control-label">Task Working Status  </label>
    <div class="col-md-5 col-xm-4 selectContainer">
    <div class="input-group">
         <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="status" class="form-control selectpicker" >
      <option value=" " >Please Task Status</option>
      <option value="incomplete">Incomplete</option>
<option value="initiate">Task Initiate</option>



    </select>
  </div>
</div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" name="btn-create-task">Create Task <span class="glyphicon glyphicon-ok"></span></button>
  </div>
</div>

</fieldset>
        </form>
            
            
        </div>
          
            <!--End of Form  -->
        
       </div>
   </div>
</div>
  
<?php include '../InterfaceManagerDashBoard/MasterFooter.php' ?>     

