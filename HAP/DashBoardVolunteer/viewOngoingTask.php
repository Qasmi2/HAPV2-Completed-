<?php
$key;
$base_url = 'http://localhost:8080/hapservices/v1/ongoingtask';

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
<?php include '../InterfaceVolunteerDashBoard/MasterPageFrontMenu.php' ?>          
  

<div class="container">    
  <div class="row content"> 

          <?php include '../InterfaceVolunteerDashBoard/MastersideBar.php' ?>       
      
       <div class="col-sm-8 text-left"> 
           <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> On Going Task </legend>                                                                                               
        <table class="table table-striped ">
<thead>
    <tr>
      <th>Task ID</th>
      
      <th>Task Name</th>
      <th>Task Address</th>
     
      <th>Task Progress</th>
      <th>  </th>
      
      
    </tr>
  </thead>
  <tbody>

                    <?php 
                    



                    
                    for($i=0; $i<$arrayCount; $i++)
                    {
                        echo "<tr>";
                     $taskID=$result[$i]['taskID'];
echo "<td>".$result[$i]['taskID']."</td>";
echo "<td>".$result[$i]['taskName']."</td>";
echo "<td>".$result[$i]['taskAddress']." ".$result[$i]['taskCity']."</td>";

echo "<td>".$result[$i]['taskProgreess']."</td>";

 echo "<td> <a href='selectTask.php?taskID=".$taskID."' class='text-success'> Select Task</a> </td>";
// echo "<td> <a href='updataTask.php?taskID=".$taskID."' class='text-success'> Updata Progress </a> </td></tr>";





                    }
//foreach($result as $n)
//{
//echo $n;
//}
//foreach($result as $i)
//{
//echo $i;
//}
//foreach($eventsres as $j)
//{
//echo $j."<br>";
//}
//echo "<br>";
//foreach($eventsnumber as $s)
//{
//echo $s."<br>";
//}
//                        
                    //echo $response;
//                    foreach ($result as $temp)
//                    {    
//                        echo $temp[0]['eventID']."<br>";
//                        echo $temp[0]['eventName']."<br>";
//                        echo  $temp[0]['eventAddress']."<br>";
//                        echo $temp[0]['eventCity']."<br>";
//                        
//                    }
                       
                    ?>
                   </tbody>
                 </table>
                          
           </fieldset>
            
         </div>
       </div>
   </div>
</div>
  
<?php include '../InterfaceVolunteerDashBoard/MasterFooter.php' ?>        

