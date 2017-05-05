

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
                           
      </button>
        <a class="navbar-brand" href="../DashBoardManager/managerDashBoard.php">Manager Cpanel</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li class="active"><a href="../DashBoardManager/managerDashBoard.php">Home</a></li>
          <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Events
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
               
            <li><a href="../DashBoardManager/createEvent.php">Create Event  </a></li>
            
            <li><a href="../DashBoardManager/others.php">Create Other Event </a></li>
            <li><a href="../DashBoardManager/view Onging Events.php">View on Going Events </a></li>
            <li><a href="../DashBoardManager/viewOngoingTask.php">View on Going Task </a></li>
          
         
        </ul>
      </li>
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Appeal 
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
               
            <li><a href="../DashBoardManager/bloodappeal.php">Blood Appeal  </a></li>
            
           
            <li><a href="../DashBoardManager/otherappeal.php">other Appeal  </a></li>
            <li><a href="../DashBoardManager/viewBloodAppeal.php">View Blood Appeal  </a></li>
          
         
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">User Management  
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="../DashBoardManager/newRegisterUser.php">New Registered Users </a></li>
            <li><a href="../DashBoardManager/ViewVolunteers.php">View Volunteers Profiles</a></li>
            <li><a href="../DashBoardManager/ViewManagers.php">View Managers Profiles  </a></li>
         
        </ul>
      </li>
      
      
      
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="../DashBoardManager/managerLogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>