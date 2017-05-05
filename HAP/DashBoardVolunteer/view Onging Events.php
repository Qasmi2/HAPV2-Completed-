<?php
$key;
$base_url = 'http://localhost:8080/hapservices/v1/ongoingevents';


$url = $base_url;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$response = curl_exec($ch);

$result=  json_decode($response,true);
$arrayCount=  count($result);

curl_close($ch);

?>

<?php include '../InterfaceVolunteerDashBoard/MasterPageFront.php' ?>         
             
<?php include '../InterfaceVolunteerDashBoard/MasterPageFrontMenu.php' ?>     
  

<div class="container">    
  <div class="row content"> 

            <?php include '../InterfaceVolunteerDashBoard/MastersideBar.php' ?>   
      
       <div class="col-sm-8 text-left col-xs-15"> 
           <div class="well">
           <fieldset>
                <legend class="text-center text-uppercase"> On Going Events </legend>                                                                                               
        <table class="table table-striped ">
<thead>
    <tr>
      <th>Event ID</th>
      
      <th>Event Name</th>
      <th>Address</th>
     
      <th>Resources</th>
      <th>  </th>
      
      
    </tr>
  </thead>
  <tbody>

                    <?php 
                    

//$eventsnumber = $result['eventQuantities'];
//$eventsres = $result['eventResources'];

                    
                    for($i=0; $i<$arrayCount; $i++)
                    {
                        echo "<tr>";
                     $eventID=$result[$i]['eventID'];
echo "<td>".$result[$i]['eventID']."</td>";
echo "<td>".$result[$i]['eventName']."</td>";
echo "<td>".$result[$i]['eventAddress']." ".$result[$i]['eventCity']."</td>";
//echo "<tr><td> EventCity</td><td>".$result[$i]['eventCity']."</td></tr><br>";
echo "<td>".$result[$i]['eventResources']." ".$result[$i]['eventQuantities']."</td>";
//echo "<tr><td> Requrie </td><td>".$result[$i]['eventQuantities']."</td></tr><br>";
//echo "<tr><td> EventID</td><td>".$result[$i]['eventDetail']."</td></tr><br>";
//echo "<tr><td> EventID</td><td>".$result[$i]['managerID']."</td></tr><br>";
 echo "<td> <a href='selectevent.php?eventID=".$eventID."' class='text-success'>Select Event</a> </td></tr>";



//echo $result[$i]['eventID']."<br>";
//echo $result[$i]['eventName']."<br>";
//echo $result[$i]['eventCity']."<br>";
//echo $result[$i]['eventState']."<br>";


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
<?php include '../InterfaceVolunteerDashBoard/MasterFooter.php' ?>     

