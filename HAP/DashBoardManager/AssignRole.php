
<?php

if(isset($_GET['userID']))
{
    $userID=$_GET['userID'];
    
$base_url = 'http://localhost:8080/hapservices/v1/assignrole';
$url = $base_url . '/' . $userID;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responce=curl_exec($ch);
  
$result= json_decode($responce,true);
$mess=$result['message'];
curl_close($ch);

}

 ?>
<?php include '../InterfaceManagerDashBoard/MasterPageFront.php' ?>         
            
<?php include '../InterfaceManagerDashBoard/MasterPageFrontMenu.php' ?>       
  

<div class="container">    
  <div class="row content"> 

           <?php include '../InterfaceManagerDashBoard/MasterSideBar.php' ?>  
      
   <div class="col-sm-8 text-left"> 
       <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> Assign Role  </legend>
        
  
 
      <?php
                      if(isset($mess)) 
            {
            echo $mess;} 
      
            ?>
 

        
           </fieldset>
        </div>
        </div>
  </div>
</div>
  
<?php include '../InterfaceManagerDashBoard/MasterFooter.php' ?>    
