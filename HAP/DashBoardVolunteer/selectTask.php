<?php

if(isset($_GET['taskID']))
{
    $eventID=$_GET['taskID'];
    $v="Y";
    
$base_url = 'http://localhost:8080/hapservices/v1/taskstatus';
$query_string = '';
$params = array (
'taskStatus' => $v,
'taskID'=>$eventID
);
$query_string = http_build_query($params);
$url = $base_url . '?' . $query_string;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responce=curl_exec($ch);
  
$result= json_decode($responce,true);

$mess=$result['message'];
curl_close($ch);

}
?>

<?php include '../InterfaceVolunteerDashBoard/MasterPageFront.php' ?>         
             
<?php include '../InterfaceVolunteerDashBoard/MasterPageFrontMenu.php' ?>     
  

<div class="container">    
  <div class="row content"> 

            <?php include '../InterfaceVolunteerDashBoard/MastersideBar.php' ?>   
      
       <div class="col-sm-8 text-left col-xs-12"> 
           <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> Select Task</legend>                                                                                               
                <form>


                    <?php 
                      if(isset($mess)) 
            {
            echo $mess;
            echo "<br> Start your work !!!";
            } ?>
                   
        
              </form>    
           </fieldset>

            
         </div>
       </div>
   </div>
</div>
  
<?php include '../InterfaceVolunteerDashBoard/MasterFooter.php' ?>     

