<?php


$base_url = 'http://localhost:8080/hapservices/v1/volunteers';

$url = $base_url;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responce=curl_exec($ch);
  
$result= json_decode($responce,true);
$arrayCount=  count($result);
curl_close($ch);


?>
<?php include '../Interface/MasterPageFront.php'?>      
            
<?php include '../Interface/MasterPageFrontMenu.php' ?>       
  

<div class="container">    
  <div class="row content"> 

          <?php include '../Interface/MasterSideBar.php' ?>    
      
   <div class="col-sm-8  col-xs-12 text-left "> 
       
       <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase">  Volunteers  </legend>
        <table class="table table-striped">
  <thead>
    <tr>
      <th>Name</th>
      
      <th>Age</th>
      <th>Address</th>
     
      <th>Profile</th>
      
      
    </tr>
  </thead>
  <tbody>
      <?php
      
      
                    for($i=0; $i<$arrayCount; $i++)
                    {
                             $userID=$result[$i]['userID'];
                             echo "<tr>";
                              
                             echo "<td>" .$result[$i]['userName']."</td>";
                             echo "<td>" .$result[$i]['userAge']."</td>";
                             echo "<td>" .$result[$i]['userAddress']."</td>";
                              echo "<td> <a href='viewVolunteerProfile.php?userID=".$userID."' class='text-success'> View profile</a> </td>";
                            // echo "<td> <a href='viewVolunteerProfile.php' class='text-success'> View profile</a> </td>";
                           //  echo "<td> <a href='ViewProfile.php?userID=".$userID."' class='text-success'> View profile</a> </td>";
 
                    }

            ?>
  </tbody>
</table>
                                 
           </fieldset>
        </div>
        </div>
  </div>
</div>
  
<?php include '../Interface/MasterFooter.php' ?>       
