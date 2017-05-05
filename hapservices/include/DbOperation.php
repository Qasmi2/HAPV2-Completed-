<?php

class DbOperation
{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
       
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    
    /* Start  Admin Login method */
    
    public function adminLogin($email,$pass){
         
         
         try
		{
			$stmt = $this->con->prepare("SELECT * FROM tbl_admin WHERE adminEmail=:email_id");
                        $stmt->bindparam(":email_id",$email);
                        $stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['adminPass']== $pass)
					{
						$_SESSION['userSession'] = $userRow['adminEmail'];
						return 0;
					}
					else
					{

                                            // Wrong Password:
                                                return 1;
					}
			}
			else
			{
                            return 2;  // wrong detali
                            
                            
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
         
         
     }
    
    
    /* END Admin Login Method */
    
    
    
    //Method to register a new User
    public function createUser($name, $email, $password,$age,$gender,$education,$phone,$address,$city,$country,$role,$aboutyou){
        try
		{
        if (!$this->isUserExists($email)) {
            $password = md5($password);
            $code = $this->generateCode();
            $stmt = $this->con->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,userAge,userGender,userEducation,userPhone,userAddress,userCity,userCountry,userRole,userAbout,tokenCode) "
                    . "values(:name,:email,:pass,:age,:gender,:education,:phone,:address,:city,:country,:role,:aboutyou,:code)");
                        $stmt->bindparam(":name",$name);
			$stmt->bindparam(":email",$email);
                        $stmt->bindparam(":pass",$password);
                        $stmt->bindparam(":age",$age);
                        $stmt->bindparam(":gender",$gender);
                        $stmt->bindparam(":education",$education);
                        $stmt->bindparam(":phone",$phone);
                        $stmt->bindparam(":address",$address);
                        $stmt->bindparam(":city",$city);
                        $stmt->bindparam(":country",$country);
                        $stmt->bindparam(":role",$role);
                        $stmt->bindparam(":aboutyou",$aboutyou);
                        $stmt->bindparam(":code",$code);
          
            $result = $stmt->execute();
            
            if ($result) {
               
                
                // Email wil be send when this Portaion will be exceute 
                //---------------------------------------------------------------------------------
                         
                        $id = $this->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $name,
						<br /><br />
						Welcome to HAP!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://localhost:8080/hapservices/v1/varify?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$this->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
                //----------------------------------------------------------------------------------
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        }
        else {
            return 2;
        }
    }
    
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
    }

    // method to register Event 
  //-----------------------------------------------------------------------------------------
      
        public function selectEvent($eventID,$volunteerID=3)
        {
            $stmt = $this->con->prepare("UPDATE tbl_volunteer SET eventID=:id  WHERE volunteerID=:vid");
                        $stmt->bindparam(":id",$eventID);
			$stmt->bindparam(":vid",$volunteerID);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
    
    
    
    
    //method Assign Role to User
    public function assignRole($userID)
        {  
        
            try
		{
            
                        $stmt = $this->con->prepare("SELECT * FROM tbl_users WHERE userID=:user_id");
                        $stmt->bindparam(":user_id",$userID);
                        $stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                         
                        if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userVarify']=="N")
					{
					
                                                $role= $userRow['userRole'];
                                                if($role=="manager")
                                                {
                                                     $stmt = $this->con->prepare("INSERT INTO tbl_manager(userID) values(:id)");
                                                     $stmt->bindparam(":id",$userID);
                                                     $result = $stmt->execute();
                                                     if($result)
                                                     {
                                                         
                                                      $varify = "Y";
                                                      $stmt = $this->con->prepare("UPDATE tbl_users SET userVarify=:status WHERE userID=:id");
			                              $stmt->bindparam(":status",$varify);
			                              $stmt->bindparam(":id",$userID);
			                              $stmt->execute();
                                                      return 4; // Role Assigned Manager 
                                                     }
                                                     else
                                                     {
                                                         return 5;// Something wrong to excution qury 
                                                     }
                                                     
			
                                                }else if($role=="volunteer")
                                                {
                                                    
                                                    $stmt = $this->con->prepare("INSERT INTO tbl_volunteer(userID) values(:id)");
                                                     $stmt->bindparam(":id",$userID);
                                                     $result = $stmt->execute();
                                                     if($result)
                                                     {
                                                         
                                                          $varify = "Y";
                                                      $stmt = $this->con->prepare("UPDATE tbl_users SET userVarify=:status WHERE userID=:id");
			                              $stmt->bindparam(":status",$varify);
			                              $stmt->bindparam(":id",$userID);
			                              $stmt->execute();
                                                      return 4; // Role Assigned Volunteers 
                                                     }
                                                     else
                                                     {
                                                         return 5;// Something wrong to excution qury 
                                                     }
                                                }
                                                
					}
					else
					{

                                            // Already Varify and Assign Role 
                                                return 1;
					}
				}
				else
				{

                                    //No User Email is not varified :
                                    return 2;
				}	
			}
			else
			{

                            // email is not register in the database
                             return 3;
			}		
            
            
                }
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
        } 
   
   // Method to let the user varify
    public function userVarify($id,$code)
    {
        
        //----------------------------------
        
        $id = base64_decode($id);
	
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $this->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $this->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
//			$msg = "
//		           <div class='alert alert-success'>
//				   <button class='close' data-dismiss='alert'>&times;</button>
//					  <strong>WoW !</strong>  Your Account is Now Activated : <a href='AsignIn.php'>Login here</a>
//			       </div>
//			       ";
                        return 0;
		}
		else
		{
//			$msg = "
//		           <div class='alert alert-error'>
//				   <button class='close' data-dismiss='alert'>&times;</button>
//					  <strong>sorry !</strong>  Your Account is allready Activated : <a href='AsignIn.php'>Login here</a>
//			       </div>
//			       ";
                return 1;
		}
	}
	else
	{
//		$msg = "
//		       <div class='alert alert-error'>
//			   <button class='close' data-dismiss='alert'>&times;</button>
//			   <strong>sorry !</strong>  No Account Found : <a href='Asignup.php'>Signup here</a>
//			   </div>
//			   ";
            return 2;
	}	
        
        //-----------------------------------
  }
//
//     public function userLogin($email,$pass){
//         
//         
//         try
//		{
//			$stmt = $this->con->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
//                        $stmt->bindparam(":email_id",$email);
//                        $stmt->execute();
//			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
//			
//			if($stmt->rowCount() == 1)
//			{
//				if($userRow['userStatus']=="Y")
//				{
//                                    
//                                    if($userRow['userVarify']=="Y")
//                                    {
//                                        
//					if($userRow['userPass']==md5($pass))
//					{
//                                               $out['role']=$userRow['userRole'];
//                                               $id=$userRow['userID'];
//                                               
//						if($out['role']=="manager")
//                                                {
//                                                       $stmt = $this->con->prepare("select tbl_manager.managerID FROM tbl_manager INNER JOIN tbl_users ON tbl_manager.userID=tbl_users.userID AND tbl_manager.userID=:id");
//                                                       $stmt->bindparam(":id",$id);
//                                                       $stmt->execute();
//			                               $out['id']=$stmt->fetch(PDO::FETCH_ASSOC);
//                                                       
//                                                }
//                                                if($out['role']=="volunteer")
//                                                {
//                                                       $stmt = $this->con->prepare("select tbl_volunteer.volunteerID FROM tbl_volunteer INNER JOIN tbl_users ON tbl_volunteer.userID=tbl_users.userID AND tbl_volunteer.userID=:id");
//                                                       $stmt->bindparam(":id",$id);
//                                                       $stmt->execute();
//			                               $out['id']=$stmt->fetch(PDO::FETCH_ASSOC);
//                                                       
//                                                }
//						return $out;
//					}
//					else
//					{
//
//                                            // Wrong Password:
//                                                return 1;
//					}
//                                    }  else {
//                                        
//                                        return 4; // user Role is not varifyed by Admin 
//                                    }
//				}
//				else
//				{
//
//                                    //Account is inactive :
//                                    return 2;
//				}	
//			}
//			else
//			{
//
//                            // email is not register in the database
//                             return 3;
//			}		
//		}
//		catch(PDOException $ex)
//		{
//			echo $ex->getMessage();
//		}
//         
//         
//     }
    
   // method to manager Login
      public function userLogin($email,$pass){
         
         
         try
		{
			$stmt = $this->con->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
                        $stmt->bindparam(":email_id",$email);
                        $stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
                                    
                                    if($userRow['userVarify']=="Y")
                                    {
                                       
                                        
					            if($userRow['userPass']==md5($pass)) {
                                                                                      
//                                                        $id=$userRow['userID'];
//                                                        $_SESSION['userSession'] = $userRow['userID'];
//                                                        return ;
                                                        
                                                        
                                                        
                                               $out['role']=$userRow['userRole'];
                                               $id=$userRow['userID'];
                                               
						if($out['role']=="manager")
                                                {
                                                       $stmt = $this->con->prepare("select tbl_manager.managerID FROM tbl_manager INNER JOIN tbl_users ON tbl_manager.userID=tbl_users.userID AND tbl_manager.userID=:id");
                                                       $stmt->bindparam(":id",$id);
                                                       $stmt->execute();
			                              $id= $out['id']=$stmt->fetch(PDO::FETCH_ASSOC);
                                                         $_SESSION['userSession'] = $id;
                                                       
                                                }
                                                if($out['role']=="volunteer")
                                                {
                                                       $stmt = $this->con->prepare("select tbl_volunteer.volunteerID FROM tbl_volunteer INNER JOIN tbl_users ON tbl_volunteer.userID=tbl_users.userID AND tbl_volunteer.userID=:id");
                                                       $stmt->bindparam(":id",$id);
                                                       $stmt->execute();
			                               $id=$out['id']=$stmt->fetch(PDO::FETCH_ASSOC);
                                                        $_SESSION['userSession'] = $id;
                                                }
						return $out;
                                                     }
                                                    else
                                                    {

                                                        // Wrong Password:
                                                     return 1;
                                                    }
                                        
                                                     
//                                           
                                         
                                        
                                    }  else {
                                        
                                        return 4; // user Role is not varifyed by Admin 
                                    }
				}
				else
				{

                                    //Account is inactive :
                                    return 2;
				}	
			}
			else
			{

                            // email is not register in the database
                             return 3;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
         
         
     }
     
     public function forgetPassword($email)
     {
         
        $stmt = $this->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = $this->generateCode();
		
		$stmt = $this->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hello , $email
				   <br /><br />
				   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
				   <br /><br />
				   Click Following Link To Reset Your Password 
				   <br /><br />
				   <a href='http://localhost:8080/HAP/registration/resetPassword.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you :)
				   ";
		$subject = "Password Reset";
		
		$this->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
			  	</div>";
                return 0;
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  this email not found. 
			    </div>";
                return 1;
	}
         
         
         
     }
     
     
     
     
  public function reSetPassword($id,$code,$pass,$repass)
   {
         $id = base64_decode($id);
         
         $stmt = $this->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		
			
			
			if($repass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
                                return 1;
			}
			else
			{
				$password = md5($repass);
				$stmt = $this->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed.
						</div>";
				//header("refresh:5;AsignIn.php");
                                return 0;
			}
			
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
				</div>";
				return 2;
	}
    }
     
     
   // method to register Event 
  //-----------------------------------------------------------------------------------------
      
        public function createEvent($eventName,$eventAddress,$eventCity,$eventState,$eventResources,$eventQuantities,$eventDetail,$manager=5)
        {
            $code = $this->generateCode();
            $stmt = $this->con->prepare("INSERT INTO tbl_event(eventName,eventAddress,eventCity,eventState,eventResources,eventQuantities,eventDetail,managerID,tokenCode) "
                    . "values(:name,:address,:city,:state,:resources,:quantity,:detail,:managerID,:code)");
                        $stmt->bindparam(":name",$eventName);
			$stmt->bindparam(":address",$eventAddress);
                        $stmt->bindparam(":city",$eventCity);
                        $stmt->bindparam(":state",$eventState);
                        $stmt->bindparam(":resources",$eventResources);
                        $stmt->bindparam(":quantity",$eventQuantities);
                        $stmt->bindparam(":detail",$eventDetail);
                        $stmt->bindparam(":managerID",$manager);
                        $stmt->bindparam(":code",$code);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
    
        
        
        // method To Create Task
        
         public function createTask($Name,$Address,$City,$detail,$progress,$eventID)
        {
            
            $stmt = $this->con->prepare("INSERT INTO task(taskName,taskAddress,taskCity,taskDetail,taskProgreess,eventID) "
                    . "values(:name,:address,:city,:detail,:progress,:eventid)");
                        $stmt->bindparam(":name",$Name);
			$stmt->bindparam(":address",$Address);
                        $stmt->bindparam(":city",$City);
                        
                        $stmt->bindparam(":detail",$detail);
                         $stmt->bindparam(":progress",$progress);
                        $stmt->bindparam(":eventid",$eventID);
                       
                        
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        //method to progress Task
        
         public function progress($progress,$taskID)
     {
            $code = $this->generateCode();
            $stmt = $this->con->prepare("UPDATE task SET taskProgreess=:progress WHERE taskID=:id");
            $stmt->bindparam(":progress",$progress);
	    $stmt->bindparam(":id",$taskID);	
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        
        //method to TaskStatus Task
        
         public function SelectTask($status,$taskID)
        {
            
            $stmt = $this->con->prepare("UPDATE task SET taskStatus=:status  WHERE taskID=:taskID");
            $stmt->bindparam(":status",$status);
            $stmt->bindparam(":taskID",$taskID);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        
        
        //method to TaskStatus Task
        
         public function taskWorkVarify ($status,$taskID)
        {
            
            $stmt = $this->con->prepare("UPDATE task SET taskVarify=:status  WHERE taskID=:taskID");
            $stmt->bindparam(":status",$status);
            $stmt->bindparam(":taskID",$taskID);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        
        //method to TaskStatus Task
        
         public function taskRating ($rate,$taskID)
        {
            
            $stmt = $this->con->prepare("UPDATE task SET rating=:rate  WHERE taskID=:taskID");
            $stmt->bindparam(":rate",$rate);
            $stmt->bindparam(":taskID",$taskID);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        //method task Status 
        

        // method to create Blood Appeal 
  //-----------------------------------------------------------------------------------------
      
        public function bloodAppeal($bloodgroup,$bloodquantity,$hospitaladdress,$city,$country,$appealDetail)
        {
            $code = $this->generateCode();
            $stmt = $this->con->prepare("INSERT INTO bloodAppeal(bloodGroup,bloodQuantity,hospitalAddress,city,country,appealDetail,tokenCode) "
                    . "values(:group,:quantity,:addres,:city,:country,:detail,:code)");
                        $stmt->bindparam(":group",$bloodgroup);
			$stmt->bindparam(":quantity",$bloodquantity);
                        $stmt->bindparam(":addres",$hospitaladdress);
                        $stmt->bindparam(":city",$city);
                        $stmt->bindparam(":country",$country);
                        $stmt->bindparam(":detail",$appealDetail);
                        $stmt->bindparam(":code",$code);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        
        // method to create donation Appeal 
  //-----------------------------------------------------------------------------------------
      
        public function donationAppeal($amount,$accountNo)
        {
            $code = $this->generateCode();
            $stmt = $this->con->prepare("INSERT INTO donationappeal(donationAmount,accountNumber,tokenCode) "
                    . "values(:amount,:quantity,:code)");
                        $stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":quantity",$accountNo);
                        
                        $stmt->bindparam(":code",$code);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
        
        
       
        
        // method to create other Appeal 
  //-----------------------------------------------------------------------------------------
      
        public function otherAppeal($appealName,$address,$city,$resources,$quantity,$detail)
        {
            $code = $this->generateCode();
            $stmt = $this->con->prepare("INSERT INTO otherAppeal(appealName,appealAddress,appealCity ,appealResources,appealQuantity,appealDetail,tokenCode) "
                    . "values(:name,:address,:city,:resources,:quantity,:detail,:code)");
                        $stmt->bindparam(":name",$appealName);
                        $stmt->bindparam(":address",$address);
                        $stmt->bindparam(":city",$city);
			$stmt->bindparam(":resources",$resources);
                        $stmt->bindparam(":quantity",$quantity);
                        $stmt->bindparam(":detail",$detail);
                        $stmt->bindparam(":code",$code);
          
            $result = $stmt->execute();
            
            if ($result) {
                $stmt=null;
                return 0;
            } else {
                return 1;
            }
        } 
  //-----------------------------------------------------------------------------------------

    //Method to create a new assignment
//    public function createAssignment($name,$detail,$facultyid,$studentid){
//        $stmt = $this->con->prepare("INSERT INTO assignments (name,details,faculties_id,students_id) VALUES (?,?,?,?)");
//        $stmt->bind_param("ssii",$name,$detail,$facultyid,$studentid);
//        $result = $stmt->execute();
//        $stmt->close();
//        if($result){
//            return true;
//        }
//        return false;
//    }

    //Method to update assignment status
//    public function updateAssignment($id){
//        $stmt = $this->con->prepare("UPDATE assignments SET completed = 1 WHERE id=?");
//        $stmt->bind_param("i",$id);
//        $result = $stmt->execute();
//        $stmt->close();
//        if($result){
//            return true;
//        }
//        return false;
//    }

    //Method to get all the assignments of a particular student
//    public function getAssignments($studentid){
//        $stmt = $this->con->prepare("SELECT * FROM assignments WHERE students_id=?");
//        $stmt->bind_param("i",$studentid);
//        $stmt->execute();
//        $assignments = $stmt->get_result();
//        $stmt->close();
//        return $assignments;
//    }

    //Method to get student details
    public function getUser($userID){
        $stmt = $this->con->prepare("SELECT * FROM tbl_users WHERE userID=:userID");
       // $stmt->bind_param("s",$username);
        $stmt->bindparam(":userID",$userID);
        $stmt->execute();
        $user=  $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    //Method to fetch  Mamanger row from database
    public function getManagers($userID){
        $stmt = $this->con->prepare("select tbl_users.*, tbl_manager.managerID FROM tbl_manager INNER JOIN tbl_users ON tbl_manager.userID=tbl_users.userID AND tbl_manager.userID=:userID");
         $stmt->bindparam(":userID",$userID);
        $stmt->execute();
        //$students = $stmt->get_result();
        $user=  $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    //Method to fetch  Volunteer row from database
    public function getVolunteer($userID){
        $stmt = $this->con->prepare("select tbl_users.*, tbl_volunteer.volunteerID FROM tbl_volunteer INNER JOIN tbl_users ON tbl_volunteer.userID=tbl_users.userID AND tbl_volunteer.userID=:userID");
         $stmt->bindparam(":userID",$userID);
        $stmt->execute();
        //$students = $stmt->get_result();
        $user=  $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }

     //Method to get event details
    public function getEvent($id){
        $stmt = $this->con->prepare("SELECT * FROM tbl_event WHERE eventID=:id");
      
        $stmt->bindparam(":id",$id);
        $stmt->execute();
       
        $event=  $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt=null;
        return $event;
    }
    
    // method to get volunteer name of event 
    public function EventSelectedVol($eventID){
        $stmt = $this->con->prepare("SELECT * FROM tbl_volunteer INNER JOIN tbl_users ON tbl_volunteer.userID=tbl_users.userID");
        $stmt->bindparam(":id",$eventID);
        $stmt->execute();
        
        $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    //Method to fetch all new varify user from database
    public function getAllNewUsers(){
        $stmt = $this->con->prepare("SELECT * FROM tbl_users");
        $stmt->execute();
        
        $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    
    //Method to fetch all Mamangers user from database
    public function getAllManagers(){
        $stmt = $this->con->prepare("SELECT * FROM tbl_manager INNER JOIN tbl_users ON tbl_manager.userID=tbl_users.userID");
        $stmt->execute();
       
        $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    
    public function getAllVolunteer(){
        $stmt = $this->con->prepare("SELECT * FROM tbl_volunteer INNER JOIN tbl_users ON tbl_volunteer.userID=tbl_users.userID");
        $stmt->execute();
        
        $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
    
    
    //Method to fetch all students from database
    public function getAllVarifyUser(){
        $stmt = $this->con->prepare("SELECT * FROM tbl_varify_user");
        $stmt->execute();
        
        $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        return $user;
    }
          
     //Method to fetch all events from database
    public function getAllEvent(){
        $stmt = $this->con->prepare("SELECT * FROM tbl_event");
        $stmt->execute();
       
       $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
       
        $stmt=null;
        return $row;
    }
    
    //method to fetch all task 
    //Method to fetch all events from database



   //method to fetch all task
     //Method to fetch all events from database
    public function getAllTask(){
        $stmt = $this->con->prepare("SELECT * FROM task");
        $stmt->execute();
       
       $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
       
        $stmt=null;
        return $row;
    }

    
    
    
    public function getAllbloodappeal(){
        $stmt = $this->con->prepare("SELECT * FROM bloodappeal");
        $stmt->execute();
       
       $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
       
        $stmt=null;
        return $row;
    }
    //Method to get faculty name by id
//    public function getFacultyName($id){
//        $stmt = $this->con->prepare("SELECT name FROM faculties WHERE id=?");
//        $stmt->bind_param("i",$id);
//        $stmt->execute();
//        $faculty = $stmt->get_result()->fetch_assoc();
//        $stmt->close();
//        return $faculty['name'];
//    }

    //Method to check the User Email already exist or not
    private function isUserExists($email) {
        $stmt = $this->con->prepare("SELECT userID from tbl_users WHERE userEmail =:email");
        //$stmt->bind_param(":user_name", $username);
         $stmt->bindparam(":email",$email);
        $stmt->execute();

        $stmt->fetch(PDO::FETCH_ASSOC);
        $num_rows = $stmt->rowCount();
        $stmt=null;
        return $num_rows>0; 
    }

    


    //Checking the student is valid or not by api key
    public function isValidUser($code) {
        $stmt = $this->con->prepare("SELECT userID from tbl_users WHERE tokenCode = :code");
        //$stmt->bind_param("s", $api_key);
        $stmt->bindparam(":code",$code);
        $stmt->execute();
       // $stmt->store_result();
        //$num_rows = $stmt->num_rows;
        //$stmt->close();
         $stmt->fetch(PDO::FETCH_ASSOC);
        $num_rows = $stmt->rowCount();
        $stmt=null;
        return $num_rows>0; 
    }

    

    //Method to generate a unique api key every time
    private function generateCode(){
        return md5(uniqid(rand(), true));
    }
    
    
    public function runQuery($sql)                      //  argument take as an argument 
	{
		$stmt = $this->con->prepare($sql);         // query execution 
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->con->lastInsertId();
		return $stmt;
	}
    
        
        public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
                
          
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "tls";            
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 587;             
		$mail->AddAddress($email); 
		$mail->Username="nadeemqasmi40@gmail.com    ";
		$mail->Password="lwqwnxltktcnnqum";          
		$mail->SetFrom('nadeemqasmi40@gmail.com','HAP');
		$mail->AddReplyTo("nadeemqasmi40@gmail.com","HAP");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
        
    
}