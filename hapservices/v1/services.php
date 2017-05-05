<?php

//including the required files
require_once '../include/DbOperation.php';
require '.././libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


/* *
 * 
 * URL: http://localhost:8080/hapservices/
 * Parameters: NO parameters 
 * Method: GET
 * */

$app->get('/', function () use ($app) {
    
    $app->redirect('http://localhost:8080/hapservices/v1/templates/FrontEnd/index.html');
    
});

/* *
 * 
 * URL: http://localhost:8080/hapservices/adminlogin
 * Parameters: name, email,
 * Method: POST
 * */
/*    start   admin login Service    */

$app->get('/adminlogin', function () use ($app) {
    verifyRequiredParams(array('email', 'password'));
    $email = $app->request->get('email');
    $password = $app->request->get('password');
    $db = new DbOperation();
    $response = array();
    $res=$db->adminLogin($email, $password);
    if ($res==0) {
   
      
     $response["error"] = false;
     $response["message"]="ok";
      echoResponse(303, $response);
    } else if ($res==1) {
    
        
        $response["error"] = true;
        $response["message"] = "Oops! Wrong Password!";
        echoResponse(200, $response);
    }
    
     else {
        
        $response['error'] = true;
        $response['message'] = "Oops! Wrong Details! ";
        echoResponse(200, $response);
        
    }
    
});

/*    END   admin login Service    */

/*    Start logout service    */

$app->get("/logout",function() use ($app)
        {
          session_destroy();
          $_SESSION['userSession'] = false;
         $response['error'] = false;
        $response['message'] = "Successfull Logout ";
        echoResponse(300, $response);      
        
        });

/*    End logout service    */


/* *
 * URL: http://localhost:8080/hapservices/v1/createuser
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,role,
 * Method: POST
 * */
$app->get('/createuser', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('name', 'email', 'password','age','gender','education','phone','address','city','country','role','aboutyou'));
    $response = array();
    $name = $app->request->get('name');
    $email = $app->request->get('email');
    $password = $app->request->get('password');
    $age = $app->request->get('age');
    $gender = $app->request->get('gender');
    $education = $app->request->get('education');
    $phone = $app->request->get('phone');
    $address = $app->request->get('address');
    $city = $app->request->get('city');
    $country = $app->request->get('country');
    $role=$app->request->get('role');
    $aboutyou = $app->request->get('aboutyou');
    $db = new DbOperation();
    $res = $db->createUser($name, $email, $password,$age,$gender,$education,$phone,$address,$city,$country,$role,$aboutyou);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully registered,  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account.";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while registereing";
        echoResponse(200, $response);
    } else if ($res == 2) {
        $response["error"] = true;
        $response["message"] = "Sorry, this Email is already existed please Try again with different Email";
        echoResponse(200, $response);
    }
});


$app->get('/assignrole/:id', function ($userID) use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    
    $db = new DbOperation();
    $res = $db->assignRole($userID);
    if ($res == 4) {
        $response["error"] = false;
        $response["message"] = "Role Asssigned ";
        echoResponse(201, $response);
    } else if ($res == 5) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Assigning Role";
        echoResponse(200, $response);
    } 
     else if ($res == 2) {
        $response["error"] = true;
        $response["message"] = "Oops! Your Email is Not Varified";
        echoResponse(200, $response);
    } 
     else if ($res == 3) {
        $response["error"] = true;
        $response["message"] = "Email is not Found ";
        echoResponse(200, $response);
    } 
     else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Already Verify and Assign Role";
        echoResponse(200, $response);
    } 
    
});

/* *
 * URL: http://localhost/serverEndModule1/v1/event
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,managerID,
 * Method: POST
 * */
$app->post('/event', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('eventName', 'eventAddress', 'eventCity','eventState','eventResources','eventQuantities','eventDetail'));
    $response = array();
    $eventName = $app->request->post('eventName');
    $eventAddress = $app->request->post('eventAddress');
    $eventCity = $app->request->post('eventCity');
    $eventState = $app->request->post('eventState');
      $arrayResources=$app->request->post('eventResources');
      $arrayQuantites=$app->request->post('eventQuantities');
      $eventDetail = $app->request->post('eventDetail');
      //$manager = $app->request->post('managerID');

    
    $db = new DbOperation();
    $res = $db->createEvent($eventName,$eventAddress,$eventCity,$eventState,$arrayResources,$arrayQuantites,$eventDetail);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Event Created ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Creating Event";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost/serverEndModule1/v1/creatTask
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,managerID,
 * Method: POST
 * */
$app->post('/creatTask', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('name', 'address', 'city','detail','taskprogress','eventID'));
    $response = array();
    $Name = $app->request->post('name');
    $Address = $app->request->post('address');
    
    $City = $app->request->post('city');
    $detail=$app->request->post('detail');
    $progress = $app->request->post('taskprogress');
    
    $eventID=$app->request->post('eventID');
    

    
    $db = new DbOperation();
    $res = $db->createTask($Name,$Address,$City,$detail,$progress,$eventID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Task Created ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Creating Task";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost:8080/hapservices/v1/taskstatus
 * Parameters: eventID
 * Method: POST
 * */
$app->get('/taskstatus', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('taskStatus','taskID'));
    $response = array();
    $status = $app->request->get('taskStatus');
    $taskID= $app->request->get('taskID');
    
    $db = new DbOperation();
    $res = $db->SelectTask($status,$taskID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully selected Task ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while selecting Task";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost:8080/hapservices/v1/selectEvent
 * Parameters: eventID
 * Method: POST
 * */

$app->get('/sevent', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('eventID'));
    $response = array();
    $eventID = $app->request->get('eventID');
    
    
    $db = new DbOperation();
    $res = $db->selectEvent($eventID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Selected Event ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Selecting Event";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost:8080/hapservices/v1/progress
 * Parameters: Progress
 * Method: POST
 * */

$app->post('/progress', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('taskprogress','taskID'));
    $response = array();
    $progress = $app->request->post('taskprogress');
    $taskID = $app->request->post('taskID');
    
    $db = new DbOperation();
    $res = $db->progress($progress,$taskID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully progress Updata ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while updata progress";
        echoResponse(200, $response);
    } 
});






/* *
 * URL: http://localhost:8080/hapservices/v1/taskWorkVarify
 * Parameters: eventID
 * Method: POST
 * */
$app->post('/taskworkVarify', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('Status','taskID'));
    $response = array();
    $status = $app->request->post('Status');
    $taskID= $app->request->post('taskID');
    
    $db = new DbOperation();
    $res = $db->taskWorkVarify($status,$taskID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Task Work VARIFY Task ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Task Work VARIFY Task";
        echoResponse(200, $response);
    } 
});



/* *
 * URL: http://localhost:8080/hapservices/v1/taskRating
 * Parameters: eventID
 * Method: POST
 * */
$app->post('/taskrating', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('rate','taskID'));
    $response = array();
    $rate = $app->request->post('rate');
    $taskID= $app->request->post('taskID');
    
    $db = new DbOperation();
    $res = $db->taskRating($rate,$taskID);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Rating Task ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Rating Task";
        echoResponse(200, $response);
    } 
});






$app->post('/reSetPasssword', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('id','code','pass','Repass'));
    $response = array();
    
    $id = $app->request->post('id');
    $code = $app->request->post('code');
    $pass = $app->request->post('pass');
    $repass = $app->request->post('Repass');
    $db = new DbOperation();
    $res = $db->reSetPassword( $id,$code,$pass,$repass);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Password Changed";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oop! Password and RePassword doesn't Match! ";
        echoResponse(200, $response);
    } 
    else if ($res == 2) {
        $response["error"] = true;
        $response["message"] = "Record is not found! ";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost/serverEndModule1/v1/bloodappeal
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,
 * Method: POST
 * */



$app->post('/bloodappeal', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('bloodgroup', 'bloodquantity', 'hospitaladdress','city','country','appealDetail'));
    $response = array();
    $bloodgroup = $app->request->post('bloodgroup');
    $bloodquantity = $app->request->post('bloodquantity');
    $hospitaladdress = $app->request->post('hospitaladdress');
    $city = $app->request->post('city');
    $country = $app->request->post('country');
    $appealDetail = $app->request->post('appealDetail');

    $db = new DbOperation();
    $res = $db->bloodAppeal($bloodgroup,$bloodquantity,$hospitaladdress,$city,$country,$appealDetail);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Blood Appeal Created ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Creating Blood Appeal";
        echoResponse(200, $response);
    } 
});



/* *
 * URL: http://localhost/serverEndModule1/v1/bloodappeal
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,
 * Method: POST
 * */



$app->post('/donationappeal', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('amount', 'accountno'));
    $response = array();
    $amount = $app->request->post('amount');
    $accountNo = $app->request->post('accountno');
   

    $db = new DbOperation();
    $res = $db->donationAppeal($amount,$accountNo);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Donation Appeal Created ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Creating Donation Appeal";
        echoResponse(200, $response);
    } 
});


/* *
 * URL: http://localhost/serverEndModule1/v1/bloodappeal
 * Parameters: name, email, password ,DOB,gender,education ,phone, aboutyourself,address,city,country,
 * Method: POST
 * */



$app->post('/otherappeal', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('appealName','appealAddress','appealCity', 'resources','quantity','detail'));
    $response = array();
    $appealName = $app->request->post('appealName');
    $appealAddress = $app->request->post('appealAddress');
    $appealCity = $app->request->post('appealCity');
    $resources = $app->request->post('resources');
    $quantity = $app->request->post('quantity');
    $detail = $app->request->post('detail');

    $db = new DbOperation();
    $res = $db->otherAppeal($appealName,$appealAddress,$appealCity,$resources,$quantity,$detail);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "Successfully Appeal Created ";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while Creating  Appeal";
        echoResponse(200, $response);
    } 
});

/* *
 * URL: http://localhost:8080/hapservices/v1/varify
 * Parameters: http://localhost:8080/serverEndModule1/v1/varify?id=$id$code=$code
 * Method: GET
 * */

$app->get('/varify',  function() use ($app){
    
    
     $req = $app->request();
    $id = $req->get('id');
    $code = $req->get('code');
    
    
     $db = new DbOperation();
    $response = array();
   $res= $db->userVarify($id, $code);
   if($res==0)
   {
       $response["error"] = false;
        $response["message"] = " Your Account is Now Activated ";
        echoResponse(201, $response);
   }else if ($res==1) {
        
       $response["error"] = true;
        $response["message"] = " Your Account Already  Activated ";
        echoResponse(201, $response);
       
    }  else if ($res==2) {
         $response["error"] = true;
        $response["message"] = " No Account Found ";
        echoResponse(201, $response);
         
    }
    
    
    
});
/* *
 * URL: http://localhost:8080/serverSideAdmin/v1/forgetpassword
 * Parameters: email
 * Method: POST
 * */

$app->post('/forgetpassword', function () use ($app) {      // use just include responce and request parameters into routers your can explitly can use
    // verifyRequiredParams function take as array , 
    verifyRequiredParams(array('email'));
    $response = array();
    
    $email = $app->request->post('email');
    
    $db = new DbOperation();
    $res = $db->forgetPassword( $email);
    if ($res == 0) {
        $response["error"] = false;
        $response["message"] = "We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password";
        echoResponse(201, $response);
    } else if ($res == 1) {
        $response["error"] = true;
        $response["message"] = "Oops! this ".$email."is not found ";
        echoResponse(200, $response);
    } 
});

$app->get('/userLogin', function () use ($app) {
    verifyRequiredParams(array('email', 'password'));
    $email = $app->request->get('email');
    $password = $app->request->post('password');
    $db = new DbOperation();
    $response = array();
    $res=$db->userLogin($email, $password);
    if ($res==true) {
      
        $response["error"] = false;
        $response["message"]="ok";
        
        echoResponse(201, $response);
        
    } else if ($res==1) {
    
        
        $response["error"] = true;
        $response["message"] = "Oops! Wrong Password!";
        echoResponse(200, $response);
    }
    
   
    else if ($res==2) {
        $response['error'] = true;
        $response['message'] = "!inactive Account , Plese Go to your given Email indox and acitive your account by click on given link ";
        echoResponse(200, $response);
       
        
    }  else if($res==4) {
        
        $response['error'] = true;
        $response['message'] = "NOT YET VARIFIED BY ADMIN ! ";
        echoResponse(200, $response);
        
    }
 else {
        
        $response['error'] = true;
        $response['message'] = "No RECORD FOUND   ! ";
        echoResponse(200, $response);
    }
    
});


/* *
 * URL: http://localhost:8080/serverEndModule1/v1/userlogin
 * Parameters: email,password
 * Method: POST
 * */

$app->get('/userlogin', function () use ($app) {
    verifyRequiredParams(array('email', 'password'));
    $email = $app->request->get('email');
    $password = $app->request->get('password');
    $db = new DbOperation();
    $response = array();
    $res=$db->userLogin($email, $password);
    if ($res['role']=="manager" || $res['role']=="volunteer") {
      
        $response["error"] = false;
        $response["message"]="ok";
        $response["role"]=$res['role'];
        $response["id"]=$res['id'];
        echoResponse(201, $response);
        
    } else if ($res==1) {
    
        
        $response["error"] = true;
        $response["message"] = "Oops! Wrong Password!";
        echoResponse(200, $response);
    }
    
   
    else if ($res==2) {
        $response['error'] = true;
        $response['message'] = "!inactive Account , Plese Go to your given Email indox and acitive your account by click on given link ";
        echoResponse(200, $response);
       
        
    }  else if($res==4) {
        
        $response['error'] = true;
        $response['message'] = "NOT YET VARIFIED BY ADMIN ! ";
        echoResponse(200, $response);
        
    }
 else {
        
        $response['error'] = true;
        $response['message'] = "No RECORD FOUND   ! ";
        echoResponse(200, $response);
    }
    
});



/* *
 * URL: http://localhost:8080/serverEndModule1/v1/managerlogin
 * Parameters: email,password
 * Method: POST
 * */
$app->get('/managerlogin', function () use ($app) {
    verifyRequiredParams(array('email', 'password'));
    $email = $app->request->get('email');
    $password = $app->request->get('password');
    $db = new DbOperation();
    $response = array();
    $res=$db->managerLogin($email, $password);
    if ($res) {
      
        $response["error"] = false;
        $response["message"]="ok";
        $response["role"]=$res;
        echoResponse(201, $response);
        
    } else if ($res==1) {
    
        
        $response["error"] = true;
        $response["message"] = "Oops! Wrong Password!";
        echoResponse(200, $response);
    }
    
   
    else if ($res==2) {
        $response['error'] = true;
        $response['message'] = "!inactive Account , Plese Go to your given Email indox and acitive your account by click on given link ";
        echoResponse(200, $response);
       
        
    }  else if($res==4) {
        
        $response['error'] = true;
        $response['message'] = "NOT YET VARIFIED BY ADMIN ! ";
        echoResponse(200, $response);
        
    }
 else {
        
        $response['error'] = true;
        $response['message'] = "No RECORD FOUND   ! ";
        echoResponse(200, $response);
    }
    
});


/* *
 * URL: http:
 * Parameters: none
 * Authorization: Put API Key in Request Header
 * Method: GET
 * */
$app->get('/ongoingevents', function() use ($app){
    $db = new DbOperation();
    $row = $db->getAllEvent();
  
    
    echoResponse(200,$row);
});

/* *
 * URL: http:
 * Parameters: none
 * Authorization: Put API Key in Request Header
 * Method: GET
 * */
$app->get('/ongoingtask', function() use ($app){
    $db = new DbOperation();
    $row = $db->getAllTask();
  
    
    echoResponse(200,$row);
});




/* *
 * URL: http:
 * Parameters: none
 * Authorization: Put API Key in Request Header
 * Method: GET
 * */
$app->get('/ongoingbloodappeal', function() use ($app){
    $db = new DbOperation();
    $row = $db->getAllbloodappeal();
  
    
    echoResponse(200,$row);
});

/* *
 * URL: http://localhost:8080/hapservices/v1/newregisteruser
 * Parameters: NO parameter 
 * Method: GET
 * */
$app->get('/newregisterusers', function() use ($app){
    $db = new DbOperation();
    $response = $db->getAllNewUsers();
  
    
    echoResponse(200,$response);
});


/* *
 * URL: http://localhost:8080/hapservices/v1/newregisteruser/1
 * Parameters: URL with userID parameters 
 * Method: GET
 * */

$app->get('/newregisteruser/:id', function($userID) use ($app){
    $db = new DbOperation();
    $response = $db->getUser($userID);
    
   
    echoResponse(200,$response);
});

/* *
 * URL: http://localhost:8080/hapservices/v1/manager/id
 * Parameters: userID
 * Method: GET
 * */
$app->get('/manager/:id', function($userID) use ($app){
    $db = new DbOperation();
    $response = $db->getManagers($userID);
    
   
    echoResponse(200,$response);
});
/* *
 * URL: http://localhost:8080/hapservices/v1/manager/id
 * Parameters: userID
 * Method: GET
 * */
$app->get('/volunteer/:id', function($userID) use ($app){
    $db = new DbOperation();
    $response = $db->getVolunteer($userID);
    
   
    echoResponse(200,$response);
});

/* *
 * URL: http://localhost:8080/hapservices/v1/manager/id
 * Parameters: userID
 * Method: GET
 * */
$app->get('/event/:id', function($eventID) use ($app){
    $db = new DbOperation();
    $response = $db->getevent($eventID);
    
   
    echoResponse(200,$response);
});


/* *
 * URL: http://localhost:8080/hapservices/v1/managers
 * Parameters: NO parameter 
 * Method: GET
 * */
$app->get('/managers', function() use ($app){
    $db = new DbOperation();
    $response = $db->getAllManagers();
  
    
    echoResponse(200,$response);
});


/* *
 * URL: http://localhost:8080/hapservices/v1/volunteers
 * Parameters: NO parameter 
 * Method: GET
 * */
$app->get('/vol/:id', function($eventID) use ($app){
    $db = new DbOperation();
    $response = $db->EventSelectedVol($eventID);
  
    
    echoResponse(200,$response);
});




/* *
 * URL: http://localhost:8080/hapservices/v1/volunteers
 * Parameters: NO parameter 
 * Method: GET
 * */
$app->get('/volunteers', function() use ($app){
    $db = new DbOperation();
    $response = $db->getAllVolunteer();
  
    
    echoResponse(200,$response);
});


/* *
 * URL: http://localhost:8080/serverEndModule1/v1/varifyuser
 * Parameters: 
 * Method: GET
 * */
$app->get('/varifyuser', function() use ($app){
    $db = new DbOperation();
    $response = $db->getAllVarifyUser();
  
    echoResponse(200,$response);
});

function echoResponse($status_code, $response)
{
    $app = \Slim\Slim::getInstance();
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response);
}





function verifyRequiredParams($required_fields)
{
    $error = false;
    $error_fields = "";
    $request_params = $_REQUEST;

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $response);
        $app->stop();
    }
}

function authenticateuser(\Slim\Route $route)
{
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    if (isset($headers['Authorization'])) {
        $db = new DbOperation();
        $code = $headers['Authorization'];
        if (!$db->isValidUser($code)) {
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid token Code";
            echoResponse(401, $response);
            $app->stop();
        }
    } else {
        $response["error"] = true;
        $response["message"] = "toaken code  is misssing";
        echoResponse(400, $response);
        $app->stop();
    }
}


function authenticateFaculty(\Slim\Route $route)
{
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
    if (isset($headers['Authorization'])) {
        $db = new DbOperation();
        $api_key = $headers['Authorization'];
        if (!$db->isValidFaculty($api_key)) {
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key";
            echoResponse(401, $response);
            $app->stop();
        }
    } else {
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoResponse(400, $response);
        $app->stop();
    }
}

$app->run();

/* *
 * URL: http://localhost:8080/serverEndModule1/v1/newResiterUser
 * Parameters: email,password
 * Method: POST
 * */
//$app->get('/newregisterusers',  function() use ($app){
//    $db = new DbOperation();
//    $response = $db->getAllNewUsers();
//    $response = array();
//    $response['error'] = false;
//    $response['students'] = array();
//
//    while($row = $result->fetch_assoc()){
//        $temp = array();
//        $temp['id'] = $row['id'];
//        $temp['name'] = $row['name'];
//        $temp['username'] = $row['username'];
//        array_push($response['students'],$temp);
////    }
//
//    echoResponse(200,$response);
//});


//----------------------------------------------------------------------------------------------

                // Demo  Functions  will be used later ,,,,
//..............................................................................................


/* *
 * URL: http://localhost/StudentApp/v1/createfaculty
 * Parameters: name, username, password, subject
 * Method: POST
 * */
//$app->post('/createfaculty', function () use ($app) {
//    verifyRequiredParams(array('name', 'username', 'password', 'subject'));
//    $name = $app->request->post('name');
//    $username = $app->request->post('username');
//    $password = $app->request->post('password');
//    $subject = $app->request->post('subject');
//
//    $db = new DbOperation();
//    $response = array();
//
//    $res = $db->createFaculty($name, $username, $password, $subject);
//    if ($res == 0) {
//        $response["error"] = false;
//        $response["message"] = "You are successfully registered";
//        echoResponse(201, $response);
//    } else if ($res == 1) {
//        $response["error"] = true;
//        $response["message"] = "Oops! An error occurred while registereing";
//        echoResponse(200, $response);
//    } else if ($res == 2) {
//        $response["error"] = true;
//        $response["message"] = "Sorry, this faculty already existed";
//        echoResponse(200, $response);
//    }
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/facultylogin
// * Parameters: username, password
// * Method: POST
// * */
//
//$app->post('/facultylogin', function() use ($app){
//    verifyRequiredParams(array('username','password'));
//    $username = $app->request->post('username');
//    $password = $app->request->post('password');
//
//    $db = new DbOperation();
//
//    $response = array();
//
//    if($db->facultyLogin($username,$password)){
//        $faculty = $db->getFaculty($username);
//        $response['error'] = false;
//        $response['id'] = $faculty['id'];
//        $response['name'] = $faculty['name'];
//        $response['username'] = $faculty['username'];
//        $response['subject'] = $faculty['subject'];
//        $response['apikey'] = $faculty['api_key'];
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Invalid username or password";
//    }
//
//    echoResponse(200,$response);
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/createassignment
// * Parameters: name, details, facultyid, studentid
// * Method: POST
// * */
//$app->post('/createassignment',function() use ($app){
//    verifyRequiredParams(array('name','details','facultyid','studentid'));
//
//    $name = $app->request->post('name');
//    $details = $app->request->post('details');
//    $facultyid = $app->request->post('facultyid');
//    $studentid = $app->request->post('studentid');
//
//    $db = new DbOperation();
//
//    $response = array();
//
//    if($db->createAssignment($name,$details,$facultyid,$studentid)){
//        $response['error'] = false;
//        $response['message'] = "Assignment created successfully";
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Could not create assignment";
//    }
//
//    echoResponse(200,$response);
//
//});
//
///* *
// * URL: http://localhost/StudentApp/v1/assignments/<student_id>
// * Parameters: none
// * Authorization: Put API Key in Request Header
// * Method: GET
// * */
//$app->get('/assignments/:id', 'authenticateStudent', function($student_id) use ($app){
//    $db = new DbOperation();
//    $result = $db->getAssignments($student_id);
//    $response = array();
//    $response['error'] = false;
//    $response['assignments'] = array();
//    while($row = $result->fetch_assoc()){
//        $temp = array();
//        $temp['id']=$row['id'];
//        $temp['name'] = $row['name'];
//        $temp['details'] = $row['details'];
//        $temp['completed'] = $row['completed'];
//        $temp['faculty']= $db->getFacultyName($row['faculties_id']);
//        array_push($response['assignments'],$temp);
//    }
//    echoResponse(200,$response);
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/submitassignment/<assignment_id>
// * Parameters: none
// * Authorization: Put API Key in Request Header
// * Method: PUT
// * */
//
//$app->put('/submitassignment/:id', 'authenticateFaculty', function($assignment_id) use ($app){
//    $db = new DbOperation();
//    $result = $db->updateAssignment($assignment_id);
//    $response = array();
//    if($result){
//        $response['error'] = false;
//        $response['message'] = "Assignment submitted successfully";
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Could not submit assignment";
//    }
//    echoResponse(200,$response);
//});

/* *
 * URL: http://localhost/SserverEndModule1/v1/userlogin
 * Parameters: email, password
 * Method: POST
 * */
//$app->post('/userlogin', function () use ($app) {
//    verifyRequiredParams(array('email', 'password'));
//    $email = $app->request->post('email');
//    $password = $app->request->post('password');
//    $db = new DbOperation();
//    $response = array();
//    if ($db->userLogin($email, $password)) {
//        $user = $db->getUser($email);
//        $response['error'] = false;
//        $response['id'] = $user['userID'];
//        $response['name'] = $user['userName'];
//        $response['username'] = $user['userEmail'];
//    } else {
//        $response['error'] = true;
//        $response['message'] = "Invalid username or password";
//    }
//    echoResponse(200, $response);
//});



/* *
 * URL: http://localhost/StudentApp/v1/createfaculty
 * Parameters: name, username, password, subject
 * Method: POST
 * */
//$app->post('/createfaculty', function () use ($app) {
//    verifyRequiredParams(array('name', 'username', 'password', 'subject'));
//    $name = $app->request->post('name');
//    $username = $app->request->post('username');
//    $password = $app->request->post('password');
//    $subject = $app->request->post('subject');
//
//    $db = new DbOperation();
//    $response = array();
//
//    $res = $db->createFaculty($name, $username, $password, $subject);
//    if ($res == 0) {
//        $response["error"] = false;
//        $response["message"] = "You are successfully registered";
//        echoResponse(201, $response);
//    } else if ($res == 1) {
//        $response["error"] = true;
//        $response["message"] = "Oops! An error occurred while registereing";
//        echoResponse(200, $response);
//    } else if ($res == 2) {
//        $response["error"] = true;
//        $response["message"] = "Sorry, this faculty already existed";
//        echoResponse(200, $response);
//    }
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/facultylogin
// * Parameters: username, password
// * Method: POST
// * */
//
//$app->post('/facultylogin', function() use ($app){
//    verifyRequiredParams(array('username','password'));
//    $username = $app->request->post('username');
//    $password = $app->request->post('password');
//
//    $db = new DbOperation();
//
//    $response = array();
//
//    if($db->facultyLogin($username,$password)){
//        $faculty = $db->getFaculty($username);
//        $response['error'] = false;
//        $response['id'] = $faculty['id'];
//        $response['name'] = $faculty['name'];
//        $response['username'] = $faculty['username'];
//        $response['subject'] = $faculty['subject'];
//        $response['apikey'] = $faculty['api_key'];
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Invalid username or password";
//    }
//
//    echoResponse(200,$response);
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/createassignment
// * Parameters: name, details, facultyid, studentid
// * Method: POST
// * */
//$app->post('/createassignment',function() use ($app){
//    verifyRequiredParams(array('name','details','facultyid','studentid'));
//
//    $name = $app->request->post('name');
//    $details = $app->request->post('details');
//    $facultyid = $app->request->post('facultyid');
//    $studentid = $app->request->post('studentid');
//
//    $db = new DbOperation();
//
//    $response = array();
//
//    if($db->createAssignment($name,$details,$facultyid,$studentid)){
//        $response['error'] = false;
//        $response['message'] = "Assignment created successfully";
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Could not create assignment";
//    }
//
//    echoResponse(200,$response);
//
//});
//
///* *
// * URL: http://localhost/StudentApp/v1/assignments/<student_id>
// * Parameters: none
// * Authorization: Put API Key in Request Header
// * Method: GET
// * */
//$app->get('/assignments/:id', 'authenticateStudent', function($student_id) use ($app){
//    $db = new DbOperation();
//    $result = $db->getAssignments($student_id);
//    $response = array();
//    $response['error'] = false;
//    $response['assignments'] = array();
//    while($row = $result->fetch_assoc()){
//        $temp = array();
//        $temp['id']=$row['id'];
//        $temp['name'] = $row['name'];
//        $temp['details'] = $row['details'];
//        $temp['completed'] = $row['completed'];
//        $temp['faculty']= $db->getFacultyName($row['faculties_id']);
//        array_push($response['assignments'],$temp);
//    }
//    echoResponse(200,$response);
//});
//
//
///* *
// * URL: http://localhost/StudentApp/v1/submitassignment/<assignment_id>
// * Parameters: none
// * Authorization: Put API Key in Request Header
// * Method: PUT
// * */
//
//$app->put('/submitassignment/:id', 'authenticateFaculty', function($assignment_id) use ($app){
//    $db = new DbOperation();
//    $result = $db->updateAssignment($assignment_id);
//    $response = array();
//    if($result){
//        $response['error'] = false;
//        $response['message'] = "Assignment submitted successfully";
//    }else{
//        $response['error'] = true;
//        $response['message'] = "Could not submit assignment";
//    }
//    echoResponse(200,$response);
//});

//$app->get('/students', 'authenticateFaculty', function() use ($app){
//    $db = new DbOperation();
//    $result = $db->getAllStudents();
//    $response = array();
//    $response['error'] = false;
//    $response['students'] = array();
//
//    while($row = $result->fetch_assoc()){
//        $temp = array();
//        $temp['id'] = $row['id'];
//        $temp['name'] = $row['name'];
//        $temp['username'] = $row['username'];
//        array_push($response['students'],$temp);
//    }
//
//    echoResponse(200,$response);
//});

?>