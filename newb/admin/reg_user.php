<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
if(isset($_POST['action'])){
    
$generate_account_number = rand(100000000, 999999999);    
$gen_acct = "304645$generate_account_number";
 
$create_t =  $conn->query("create table if not exists curr_type (
                             curr_id int(11) NOT NULL auto_increment, 
							 accnt_nmb varchar(90) NOT NULL default '', 
							 curr_type varchar(90) NOT NULL default '',   
							 PRIMARY KEY(curr_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);
 
$create = $conn->query("insert into curr_type (curr_id, accnt_nmb, curr_type) values (NULL, '$gen_acct', '" . $_POST['cur_type'] . "')") or die($conn->error);
    


$fullname = $_POST['lname']. " " .$_POST['fname'];
    
    
    
$generate_account_username = rand(100, 999);   
$username = $_POST['lname']. "$generate_account_username";
    
    
$generate_account_password = rand(10000, 99999);    
$password = $_POST['fname']. "@$generate_account_password"; 
    
    
    
$day_birth = $_POST['year_birth'] . "-" . $_POST['mnth_birth'] . "-" . $_POST['day_birth'];
move_uploaded_file($_FILES['cust_photo']['tmp_name'], "../things/upload/". $_FILES['cust_photo']['name']);

$ins = $conn->query("insert into customer_info (customer_id, cust_name, email, phn_nmb, addrs, username, pass, day_birth, country, acct_nmb, zip_code, swift_code,  cust_photo, current_log_time, last_log_time, cust_trans_stat, access_lvl, otp_status, suspend_status) values (NULL, '$fullname', '" . $_POST['email'] . "', '" . $_POST['phn_nmb'] . "', '" . $_POST['addrs'] . "', '$username', '$password', '$day_birth', '" . $_POST['country'] . "', '$gen_acct', '" . $_POST['zip_code'] . "', '" . $_POST['swift_code'] . "', '" . $_FILES['cust_photo']['name'] . "', 'First login', '', 'On', '1', 'On', 'Active')") or die($conn->error);

if($ins){
$conLast = $conn->insert_id;

header("location:more_info.php?msg=New User  '$fullname'  have created successfully&id=". $conLast);
}
}


?>

<?php include 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
<div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Registered Users</li>
            </ul>
            <div class="tab-content no-padding">
              <div style="margin:20px 0px 0px 10px;">  
                   <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                          <form method="post" action="reg_user.php?lang=en" enctype="multipart/form-data">   
                                    
                                    <table width="100%" height="605" align="center" cellpadding="5" cellspacing="3">
                  
                                        
                    <tr>
                  <td width="26%" height="47"><span class="style9">Surname</span></td>
                  <td width="74%"><input type="text" name="lname" class="form-control" size="30" required/></td>
                  </tr><tr>
                  <td width="26%" height="47"><span class="style9">Name</span></td>
                  <td width="74%"><input type="text" name="fname" class="form-control" size="30" required/></td>
                  </tr>
                  <tr>
                  <td height="46"><span class="style9">Email ID</span></td>
                  <td><input type="email" name="email" class="form-control"  size="30" required /></td>
                  </tr>
                  <tr>
                  <td height="46"><span class="style9">Phone Number</span></td>
                  <td><input type="tel" name="phn_nmb" class="form-control" size="30" required /></td>
                  </tr>
                  <tr>
                  <td height="46"><span class="style9">Address</span></td>
                  <td><input type="text" name="addrs" size="30" class="form-control" required /></td>
                  </tr>
                  <tr> 
                
                  <td><input type="hidden" name="username" size="30" class="form-control" /></td>
                  </tr>
                  <tr>
                  
                  <td><input type="hidden" name="pass" size="30" class="form-control"  /></td>
                  </tr>
                  <tr>
                  <td height="47"><span class="style9">Country</span></td>
<td>
                                      <select name="country" class="form-control" required>
                                    <option value="">Country...</option>
                                    <option value="Afganistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bonaire">Bonaire</option>
                                    <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Canary Islands">Canary Islands</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Channel Islands">Channel Islands</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos Island">Cocos Island</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote DIvoire">Cote D'Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Curaco">Curacao</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="East Timor">East Timor</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands">Falkland Islands</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Ter">French Southern Ter</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Great Britain">Great Britain</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea North">Korea North</option>
                                    <option value="Korea Sout">Korea South</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Macedonia">Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Midway Islands">Midway Islands</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Nambia">Nambia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherland Antilles">Netherland Antilles</option>
                                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                    <option value="Nevis">Nevis</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau Island">Palau Island</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Phillipines">Philippines</option>
                                    <option value="Pitcairn Island">Pitcairn Island</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                                    <option value="Republic of Serbia">Republic of Serbia</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="St Barthelemy">St Barthelemy</option>
                                    <option value="St Eustatius">St Eustatius</option>
                                    <option value="St Helena">St Helena</option>
                                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                    <option value="St Lucia">St Lucia</option>
                                    <option value="St Maarten">St Maarten</option>
                                    <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                                    <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                                    <option value="Saipan">Saipan</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="Samoa American">Samoa American</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Tahiti">Tahiti</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States of America">United States of America</option>
                                    <option value="Uraguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City State">Vatican City State</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                    <option value="Wake Island">Wake Island</option>
                                    <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zaire">Zaire</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
									</select>                  </td>
                  </tr>
                                        
                                        
                  <tr>
                  <td><input type="hidden" name="acct_nmb" size="30" class="form-control"  required/></td>
                  </tr>
                                        
                                        
                   <tr>
                  <td height="46"><span class="style1">Currency type</span></td>
                  <td>
                   
                  <select name="cur_type" id="cur_type" class="form-control" required>
                      <option value="">Currency...</option>
                      <option value="Dollar">Dollar</option>
                      <option value="Pounds">Pounds</option>
                      <option value="Euro">Euro</option>
                      <option value="Polish zloty">Polish zloty</option>
                      <option value="Czech koruna">Czech koruna</option>
                      <option value="Malaysia Ringgit">Malaysia Ringgit</option>
                      <option value="Yen">Yen</option>
                      <option value="Rand">Rand</option>
                      <option value="ZAR">ZAR</option>
                      <option value="NGR">NGR</option>
                      <option value="Namibia Dollar">Namibia Dollar</option>

                        </select>
                  </td>
                  </tr>               
                                        
                  <tr>
                  <td height="47"><span class="style9">Date of Birth</span></td>
                  <td>
     <select name="day_birth" id="day_birth" class="form-control" style="width:120px; float:left" required>
      <option value="">Day</option>
      <?php
	  for($i=1; $i<=31; $i++){
	  ?>
      <option value="<?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?>"><?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?></option>
      <?php
	  }
	  ?>
      </select>
      -
      <select name="mnth_birth" id="mnth_birth" class="form-control" style="width:120px; float:left" required>
      <option value="">Month</option>
      <?php
	  for($i=1; $i<=12; $i++){
	  ?>
      <option value="<?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?>"><?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?></option>
      <?php
	  }
	  ?>
      </select>
      -
      <select name="year_birth" id="year_birth" class="form-control" style="width:120px; float:left" >
      <option value="">Year</option>
      <?php
	  for($i=date("Y"); $i>=1940; $i--){
	  ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php
	  }
	  ?>
      </select>      </td>
                  </tr>
                   <tr>
                  <td height="52"><span class="style9">Postal code</span></td>
                  <td><input type="text" name="zip_code" placeholder="Postal Code" class="form-control" size="30" required/></td>
                  </tr>
                  <tr>
                  <td height="46"><span class="style9">Swift/BIC</span></td>
                  <td><input type="text" name="swift_code" id="swift_code" value="FRTBUS33" class="form-control" Placeholder="Swift/BIC" size="30" required/></td>
                  </tr>
                  <tr>
                  <td height="52"><span class="style9">Upload Photo</span></td>
                  <td><input type="file" name="cust_photo" id="cust_photo"  required></td>
                  </tr>
                  <tr>
                  <td colspan="2">	<button class="btn btn-success" type="submit" name="action" value="register user">Register customer</button></td>
                  </tr>
                  
                  </table>
                </form>          
            </div>
              
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            
            
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <!-- /.box (chat box) -->
          <!-- TO DO List -->
          <!-- /.box -->
          <!-- quick email widget -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <!-- /.box -->
          <!-- Calendar -->
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include 'footer.php' ?>