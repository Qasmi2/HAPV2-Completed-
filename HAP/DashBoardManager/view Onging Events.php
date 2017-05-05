<?php
$key;
$base_url = 'http://localhost:8080/hapservices/v1/ongoingevents';

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

<?php include '../InterfaceManagerDashBoard/MasterPageFront.php' ?>         
            
<?php include '../InterfaceManagerDashBoard/MasterPageFrontMenu.php' ?>         
  

<div class="container">    
  <div class="row content"> 

          <?php include '../InterfaceManagerDashBoard/MasterSideBar.php' ?>    
      
       <div class="col-sm-8 text-left"> 
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
                    



                    
                    for($i=0; $i<$arrayCount; $i++)
                    {
                        echo "<tr>";
                     $eventID=$result[$i]['eventID'];
echo "<td>".$result[$i]['eventID']."</td>";
echo "<td>".$result[$i]['eventName']."</td>";
echo "<td>".$result[$i]['eventAddress']." ".$result[$i]['eventCity']."</td>";

echo "<td>".$result[$i]['eventResources']." ".$result[$i]['eventQuantities']."</td>";

 echo "<td> <a href='creatTask.php?eventID=".$eventID."' class='text-success'> Create Task</a> </td></tr>";



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
<?php include '../InterfaceManagerDashBoard/MasterFooter.php' ?>     

