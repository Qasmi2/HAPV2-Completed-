<?php
$key;
$base_url = 'http://localhost:8080/hapservices/v1/ongoingbloodappeal';

$url = $base_url;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_GET, true);

$response = curl_exec($ch);

$result=  json_decode($response,true);
$arrayCount=  count($result);

curl_close($ch);

?>

<?php include '../InterfaceVolunteerDashBoard/MasterPageFront.php' ?>         
             
<?php include '../InterfaceVolunteerDashBoard/MasterPageFrontMenu.php' ?>           
  

<div class="container">    
  <div class="row content"> 

          <?php include '../InterfaceVolunteerDashBoard/MastersideBar.php' ?>   
     
       <div class="col-sm-8 text-left"> 
           <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> Blood Appeals  </legend>                                                                                               
        <table class="table table-striped ">
<thead>
    <tr>
      <th>Blood Group</th>
      
      <th>require Quantity</th>
      <th>Address</th>
     
      <th>Detail</th>
      
      
      
    </tr>
  </thead>
  <tbody>

                    <?php 
                    



                    
                    for($i=0; $i<$arrayCount; $i++)
                    {
                        echo "<tr>";
                    
echo "<td>".$result[$i]['bloodGroup']."</td>";
echo "<td>".$result[$i]['bloodQuantity']."</td>";
echo "<td>".$result[$i]['hospitalAddress']." ".$result[$i]['city']."</td>";

echo "<td>".$result[$i]['appealDetail']." </td>";

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
<?php include '../InterfaceVolunteerDashBoard/MasterFooter.php' ?>      