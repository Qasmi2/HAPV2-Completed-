<?php
session_start();
if(isset($_POST['btn-login-account']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

$base_url = 'http://localhost:8080/hapservices/v1/userlogin';
$query_string = '';
$params = array (
'email' => $email,
'password' => $password
);
$query_string = http_build_query($params);
$url = $base_url . '?' . $query_string;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$responce=curl_exec($ch);
  
$result= json_decode($responce,true);

if($result['message']=="ok"){
    if($result['role']=="volunteer")
    {
        $userid=$result['id']['volunteerID'];
    header("Location: http://localhost:8080/HAP/DashBoardVolunteer/volunteerDashBoard.php?id=$userid");
    
    }
    else if ($result['role']=="manager") {
        $userid=$result['id']['managerID'];
      header("Location:  http://localhost:8080/HAP/DashBoardManager/managerDashBoard.php?id=$userid");
    
}
}
else if($result['error']==true)
{
    $mess=  $result['message'];
    
   
}

curl_close($ch);
}




?>






<?php include '../Interface/header.php' ?>    



<body style="margin-top: 100px ">

          
<div class="row">
    <div class="col-md-4 col-md-offset-4  ">
        <form class="form-horizontal well"  method="post" >
             <?php if(isset($mess)) 
            {
            echo $mess;}  ?>
        <fieldset>
               <legend class="text-center">Login </legend>
          <!-- Form Name -->
                  <legend>login from</legend>

          <!-- Text input-->
          <div class="form-group ">
            <div class="col-sm-12">
              <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
            
            
          </div>

          <!-- Text input-->
          
      <div class="form-group ">
            
            <div class="col-sm-12">
              <input type="password" name="password" placeholder="password" class="form-control">
            </div>
          </div>


          <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" name="btn-login-account">Login Account  <span class="glyphicon glyphicon-ok"></span></button>
  </div>
</div>
          
          <div> 
              <ul class="pager">
                  <li><a href="../registration/registrationFrom.php">SignUp</a></li>
                  <li><a href="forgetPass.php">Forget your password</a></li>
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