<?php
$id="";
if(isset($_GET['userID']))
{
    $id=$userID=$_GET['userID'];
    
$base_url = 'http://localhost:8080/hapservices/v1/volunteer';


$url = $base_url . '/' . $userID;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responce=curl_exec($ch);
  
$result= json_decode($responce,true);
//$arrayCount=  count($result);
curl_close($ch);

}

 ?>
<?php include '../InterfaceManagerDashBoard/MasterPageFront.php' ?>         
            
<?php include '../InterfaceManagerDashBoard/MasterPageFrontMenu.php' ?>      
  

<div class="container">    
  <div class="row content"> 

          <?php include '../InterfaceManagerDashBoard/MasterSideBar.php' ?>   
      
   <div class="col-sm-8 text-left"> 
       <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> Volunteer Profile </legend>
        <table class="table table-striped ">
  
 
      <?php
      
                   
                    
                    echo "<tr><td> Name: </td><td>    "  .$result['userName']." </td></tr>";
                    echo "<tr><td> Address:  </td><td>    "  .$result['userAddress']." </td></tr>";
                    echo "<tr><td> AGe:    </td><td>  "  .$result['userAge']." </td></tr>";
                    echo "<tr><td> Gender:   </td><td>   "  .$result['userGender']." </td></tr>";
                    echo "<tr><td> Education:    </td><td>  "  .$result['userEducation']." </td></tr>";
                    echo "<tr><td> About:     </td><td> "  .$result['userAbout']." </td></tr>";
                     echo "<tr><td> Role:   </td><td>  "  .$result['userRole']." </td></tr>";
               
                     
              
              
 
                    

            ?>
 
</table>
                          
           </fieldset>
        </div>
        </div>
  </div>
</div>

  
<?php include '../InterfaceManagerDashBoard/MasterFooter.php' ?>    
