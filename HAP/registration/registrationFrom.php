<?php


if(isset($_POST['btn-create-account']))
{
//  $name="";$email="";$password="";$age="";$gender="";$phone="";$education="";$aboutyou="";$address="";$city="";$country="";

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$education=$_POST['education'];
$aboutyou=nl2br($_POST['aboutyou']);
$address=$_POST['address'];
$city=$_POST['city'];
$country=$_POST['country'];
$role=$_POST['role'];



$base_url = 'http://localhost:8080/hapservices/v1/createuser';
$query_string = '';
$params = array (
'name' => $name,
'email' => $email,
'password'=> $password,
 'age'=>$age,
 'gender'=>$gender,
 'phone'=>$phone,
 'education'=>$education,
    
    'address'=>$address,
    'city'=>$city,
    'country'=>$country,
    'role'=>$role,
    'aboutyou'=>$aboutyou
);

$query_string = http_build_query($params);
$url = $base_url . '?' . $query_string;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($ch);

$result=  json_decode($response,true);
 $mess=$result['message'];

curl_close($ch);
}
?>




<?php include '../Interface/header.php' ?>         


<body >
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form class="form-horizontal well"  method="post" >
            <?php if(isset($mess)) 
   
            {echo $mess; } ?>
        <fieldset>
               <legend class="text-center">Registration</legend>
          <!-- Form Name -->
          <legend>Personal Information Details</legend>

          <!-- Text input-->
          <div class="form-group ">
            <div class="col-sm-12">
              <input type="text" name="name" placeholder="Full Name" class="form-control">
            </div>
            
            
          </div>

          <!-- Text input-->
          
           <!-- Text input-->
          <div class="form-group ">
            <div class="col-sm-6">
              <input type="email" name="email" placeholder="Enter your Email" class="form-control">
            </div>
            
            <div class="col-sm-6">
              <input type="password" name="password" placeholder="Enter Password" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          
          
          <div class="form-group">
            <div class="col-sm-6">
              <input type="number" name="age" placeholder="Age e.g. 20" class="form-control">
            </div>
              
              
              <div class="col-sm-6">
              <select  name="gender" placeholder="Gender" class="form-control">
                <option value="female">Female</option>
                <option value="male">Male</option>
              </select>
            </div>
          </div>
          

          <!-- Text input-->
          <!-- Text input-->
          <div class="form-group ">
            <div class="col-sm-6">
              <input type="text" name="education" placeholder="Education " class="form-control">
            </div>
            
            <div class="col-sm-6">
              <input type="text" name="phone" placeholder="Phone NO. e.g. +92333xxxxxxx" class="form-control">
            </div>
          </div>

         

<!-- Address Section -->
          <!-- Form Name  <legend>Address Details</legend> -->
          
          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" name="address" placeholder="Address Line 1" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-4">
              <input type="text" name="city" placeholder="City" class="form-control">
            </div>
              
             
              
            <div class="col-sm-4">
                <!-- Country Selection -->
<select name="country" class="form-control selectpicker" >
<option value=" " >Please select Country</option>
<option value="AF">Afghanistan</option>
<option value="AX">Ã…Land Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua And Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia And Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, The Democratic Republic Of The</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote D'Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value=" Gg">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island And Mcdonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic Of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle Of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People'S Republic Of</option>
<option value="KR">Korea, Republic Of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People'S Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libyan Arab Jamahiriya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
<option value="MK">Macedonia, The Former Yugoslav Republic Of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States Of</option>
<option value="MD">Moldova, Republic Of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="SH">Saint Helena</option>
<option value="KN">Saint Kitts And Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="PM">Saint Pierre And Miquelon</option>
<option value="VC">Saint Vincent And The Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome And Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="CS">Serbia And Montenegro</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia And The South Sandwich Islands</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard And Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province Of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic Of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad And Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks And Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis And Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
    </select>
                <!-- End Selection -->
            </div>
               <div class="col-sm-4">
                  <select name="role" class="form-control selectpicker">
                      <option value=" " >Please select Role</option>
                       <option value="manager">Manager</option>
                       <option value="volunteer">Volunteer</option>
                  </select>
            </div>
               </div>
               <!-- Text input-->
          
        <div class="form-group">
           <div class="col-sm-12 ">
               
         <textarea class="form-control" name="aboutyou" placeholder="Description About yourself"></textarea>
           </div>
        </div>
          
            
         


          <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" name="btn-create-account">Create Account  <span class="glyphicon glyphicon-ok"></span></button>
  </div>
</div>
          
          
           <div> 
              <ul class="pager">
                  <li><a href="loginVolunteer.php"> Login </a></li>
                  
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