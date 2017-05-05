<?php

if(isset ($_POST['btn-forget-password']))
{
    $email=$_POST['email'];
    
    
 $base_url = 'http://localhost:8080/hapservices/v1/forgetpassword';
$query_string = '';
$params = array (
'email' => $email
);
 

$query_string = http_build_query($params);
$url = $base_url . '?' . $query_string;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($ch);
curl_close($ch);
$result=  json_decode($response,true);
$mess=$result['message'];
}
 
?>



<?php include '../Interface/header.php' ?>    



<body style="margin-top: 100px ">

          
<div class="row">
    <div class="col-md-4 col-md-offset-4  ">
        <form class="form-horizontal well"  method="post" >
            <?php if(isset($mess)) 
   
            {echo $mess; } ?>
        <fieldset>
              
                  <legend>  Reset Password   </legend>
                  <legend>Enter Email to Reset your Password </legend>
                  <br/>
          <!-- Text input-->
          <div class="form-group ">
            <div class="col-sm-12">
              <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
            
            
          </div>

         
          
      


          <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" name="btn-forget-password">Submit  <span class="glyphicon glyphicon-ok"></span></button>
  </div>
</div>
          
          <div> 
              <ul class="pager">
                  <li><a href="../registration/registrationFrom.php">SignUp</a></li>
                  
                  <li><a href="../index.html">Main Page </a></li>
            </ul>
          </div>
          

        </fieldset>
      </form>
    </div>
</div>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script src="/bootstrap/js/jquery.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../Asserts/jquery.backstretch.min.js"></script>
    <script >
        $.backstretch("../Asserts/img/portal.png", {speed: 200});
    </script>
    
<?php include '../Interface/footer.php' ?>  