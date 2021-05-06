<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/ipb.php');
if(isset($_POST['action'])){


$day_birth = $_POST['year_birth'] . "-" . $_POST['mnth_birth'] . "-" . $_POST['day_birth'];    
    
$ins = $conn->query("update customer_info set
 cust_name = '" . $_POST['cust_name'] . "', 
 email = '" . $_POST['email'] . "', 
 phn_nmb = '" . $_POST['phn_nmb'] . "', 
 addrs = '" . $_POST['addrs'] . "', 
 username = '" . $_POST['username'] . "',
 pass = '" . $_POST['pass'] . "',
 day_birth = '" . $_POST['day_birth'] . "',
 country = '" . $_POST['country'] . "',
 swift_code = '" . $_POST['swift_code'] . "', 
 zip_code = '" . $_POST['zip_code'] . "' where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
        
  
    

header("location:more_info_edit.php?msg=User profile has updatated successfully&id=". $_GET['id']);
}

 if(isset($_POST['action2'])){  
$size = $_FILES['profile_img']['size'];
$file = $_FILES['profile_img']['name'];
$type = $_FILES['profile_img']['type'];        
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], "../things/upload/". $file )){
$updateImg = $conn->query("update customer_info set 
cust_photo = '$file' where customer_id = '" . $_POST['customer_id'] . "'") or die($conn->error);
echo 1;
}else{
echo "Could not upload file";
}
header("location:more_info_edit.php?msg=User photo has updatated successfully&id=". $_GET['id']);     
     }



//OTP CONTROAL

    if(isset($_POST['actionOnOtp'])){  
$stat = "On";
$ins = $conn->query("update user_table set otp_status = '$stat' where cust_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg=Otp is successfully set as ON for this user&id=". $_GET['id']);
    }


     if(isset($_POST['actionOffOtp'])){           
$stat = "Off";
$ins = $conn->query("update user_table set otp_status = '$stat' where cust_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg=Otp is  successfully set as OFF for this user&id=". $_GET['id']);
        } 
         


//SUSPEND USER

   if(isset($_POST['actionSuspended'])){  
$stat = "Suspended";
$ins = $conn->query("update user_table set suspend_status = '$stat' where cust_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg1=This user has been successfully Suspended&id=". $_GET['id']);
    }

  if(isset($_POST['actionActive'])){           
$stat = "Active";
$ins = $conn->query("update user_table set suspend_status = '$stat' where cust_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg1=This user has been successfully Activated&id=". $_GET['id']);
        } 
    

//TRANSACTION CODE FOR USER

 if(isset($_POST['actionOnCode'])){  
$stat = "On";
$ins = $conn->query("update customer_info set cust_trans_stat = '$stat' where customer_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg2=Transfer code request is successfully set as ON for this user&id=". $_GET['id']);
    }

  if(isset($_POST['actionOffCode'])){           
$stat = "Off";
$ins = $conn->query("update customer_info set cust_trans_stat = '$stat' where customer_id = '" . $_POST['cust_id']. "'") or die($conn->error);
header("location:more_info_edit.php?msg2=Transfer code request is successfully set as Off for this user&id=". $_GET['id']);
    } 






//CHANGE CURRENCY

if(isset($_POST['changeCurrency'])){
$create_t =  $conn->query("create table if not exists curr_type (
                             curr_id int(11) NOT NULL auto_increment, 
							 accnt_nmb varchar(90) NOT NULL default '', 
							 curr_type varchar(90) NOT NULL default '',   
							 PRIMARY KEY(curr_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);
$selCur = $conn->query("select * from curr_type where accnt_nmb = '" . $_POST['accnt_nmb'] . "' ") or die($conn->error);
if(!$selCur->num_rows){  
$create = $conn->query("insert into curr_type (curr_id, accnt_nmb, curr_type) values (NULL, '" . $_POST['accnt_nmb'] . "', '" . $_POST['cur_type'] . "')") or die($conn->error);
}else{
$update = $conn->query("update curr_type set 
 curr_type = '" . $_POST['cur_type'] . "' where accnt_nmb = '" . $_POST['accnt_nmb'] . "'") or die($conn->error);
}
header("location:more_info_edit.php?msg3=Currency has been changed to " . $_POST['cur_type'] . "&id=". $_GET['id']);
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
						 $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
				     
						 ?> 
                  
                  
                   <?php 
					 $d_img=  "<img src='../things/img/blank-profile-picture.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
					 $p_img=  "<img src='../things/upload/". $rowInfo['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					  ?>
         
                  
                       <form method="post" action=""  id="formUpload" enctype="multipart/form-data" >
                           
                         <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>   
                           
                           <?php
						  if(isset($_GET['msg1'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg1']. "</div>";
						  }
						  ?>
                           
                            <?php
						  if(isset($_GET['msg2'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg2']. "</div>";
						  }
						  ?>
                            <?php
						  if(isset($_GET['msg3'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg3']. "</div>";
						  }
						  ?>
                           
                           
                   <div class="col-md-12" id="uploadForm"> 
                   <div class="col-md-5 col-xs-offset-3">
                   <div id="img_data">
                   <?php echo $rowInfo['cust_photo']== "" ? $d_img : $p_img; ?>
                   </div>
                   <img id="output_image"/>
                    </div>
                 </div>
                  <div class="col-md-12 subBox">
                   <div class="col-md-5 col-xs-offset-3">
                   <div id="wrapper">
                <input type="file" name="profile_img" accept="image/*" id="up_img" onChange="preview_image(event)">
                  <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $rowInfo['customer_id']; ?>">
                    </div>
                       </div>
                   </div>
                  <div class="col-md-12 subBox">
                   <div class="col-md-5 col-xs-offset-2">
                   <button type="submit"  name="action2" class="btn btn-info col-xs-10 btn-lg btnUpload">Upload</button>
                   </div>
                   </div>
                  
                   </form>
                  
          
                  
                  
                 <form method="post" action="" enctype="multipart/form-data">   
                                   
                 <table width="100%" height="396" align="center" cellpadding="5" cellspacing="3">
    
                     <tr>
                  <td><span class="style9">Accout Number</span></td>
                  <td><input type="text" name="acct_nmb" size="30" class="form-control" value="<?php echo $rowInfo['acct_nmb']; ?>" readonly="readonly" /></td>
                  </tr>                    
           
                                        
                  <tr>
                  <td><span class="style9">Customer full name</span></td>
                  <td><input type="text" name="cust_name" size="30" class="form-control" value="<?php echo $rowInfo['cust_name']; ?>" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Email ID</span></td>
                  <td><input type="email" name="email" size="30" class="form-control" value="<?php echo $rowInfo['email']; ?>"  /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Phone Number</span></td>
                  <td><input type="tel" name="phn_nmb" size="30" class="form-control" value="<?php echo $rowInfo['phn_nmb']; ?>"  /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Address</span></td>
                  <td><input type="text" name="addrs" size="30" class="form-control" value="<?php echo $rowInfo['addrs']; ?>"  /></td>
                  </tr>
                  <tr> 
                  <td><span class="style9">Username</span></td>
                  <td><input type="text" name="username" size="30" class="form-control" value="<?php echo $rowInfo['username']; ?>"  /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Password</span></td>
                  <td><input type="text" name="pass" size="30" class="form-control" value="<?php echo $rowInfo['pass']; ?>"  /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Country</span></td>
<td>
                                      <select name="country" class="form-control">
                                    <option value="<?php echo $rowInfo['country']; ?>"><?php echo $rowInfo['country']; ?></option>
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
                  <td><span class="style9">Date of Birth</span></td>
                      
                      
                    <td>
<input  class="form-control"  type="text" name="day_birth" value="<?php echo $rowInfo['day_birth']; ?>" style="width:100px; float:left" /> 
     

                      </td> 

                                        
                    </tr>      
       
                  <tr>
                  <td><span class="style9">Zip code</span></td>
                  <td><input type="text" name="zip_code" size="30" class="form-control" value="<?php echo $rowInfo['zip_code']; ?>" /></td>
                  </tr> 
                      <tr>
                  <td><span class="style9">Swift Code</span></td>
                  <td><input type="text" name="swift_code" size="30" class="form-control" value="<?php echo $rowInfo['swift_code']; ?>"  /></td>
                  </tr>
                     

                                        
                     <tr>
                  <td><span class="style9">Last Login</span></td>
                  <td><input readonly="readonly"  type="text" name="last_log_time" size="30" class="form-control" value="<?php echo $rowInfo['last_log_time']; ?>"  /></td>
                  </tr>                    
                                        
                     <tr>
                  <td height="9" colspan="2"   lass="col-md-5 col-xs-offset-2">
                      <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowUser['customer_id']; ?>" size="30" />
                  <button type="submit" name="action" class="btn btn-info col-xs-10 btn-lg ">SAVE</button></td>
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
                Advance Settings
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 430px; width: 100%;">
                
                  
                  
                  
                  
             
                
                
                 <!-- OTP CONTROL -->
                 <form method="post" action="#" enctype="multipart/form-data">
                  <table>
                    <span>
        <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='twelve columns red-grad2'>" . $_GET['msg']. "</div>";
						  }
						  ?></span>
                          <tr>
                  <td height="9" colspan="2">
                  
                  <span type="submit" class="btn btn-warning"  class="btn btn-green col-lg-11"> OTP Verification is <?php echo $rowInfo['otp_status']; ?></span></td>
                  </tr>
                          <tr>
                  <td height="9" colspan="7">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['cust_id']; ?>" size="30" />
                  <button type="submit" id="onbutton"  <?php if($rowInfo['otp_status']== "On") {?> disabled="disabled" <?php } ?>  name="actionOnOtp"  class="btn btn-warning-on" onclick="return changepassword()" class="btn btn-green col-lg-11">On</button></td>
                  
                  <td height="9" colspan="2">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['cust_id']; ?>" size="30" />
                  <button type="submit" id="offbutton" <?php if($rowInfo['otp_status']== "Off") {?> disabled="disabled" <?php } ?> name="actionOffOtp"  class="btn btn-warning-off" onclick="return changepassword()" class="btn btn-green col-lg-11">Off</button></td>
                  </tr>

                  </table>
                  </form>
                  
                  
                  
                  
                  <P>.</P>
                  <P>.</P>
                  
                  
                  
                  <!-- SUSPENSION CONTROL -->
                   <form method="post" action="#" enctype="multipart/form-data">
                <table>
                          <span>
        <?php
						  if(isset($_GET['msg1'])){
						  echo "<div class='twelve columns red-grad2'>" . $_GET['msg1']. "</div>";
						  }
						  ?></span>
                          <tr>
                  <td height="9" colspan="2">
                  
                  <span type="submit" class="btn btn-warning"  class="btn btn-green col-lg-11">User is <?php echo $rowInfo['suspend_status']; ?></span></td>
                  </tr>
     
                          <tr>
                  <td height="9" colspan="7">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['cust_id']; ?>" size="30" />
                  <button type="submit" id="onbutton"  <?php if($rowInfo['suspend_status']== "Active") {?> disabled="disabled" <?php } ?>  name="actionActive"  class="btn btn-warning-on" onclick="return changepassword()" class="btn btn-green col-lg-11">Active</button></td>
                  
                  <td height="9" colspan="2">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['cust_id']; ?>" size="30" />
                  <button type="submit" id="offbutton" <?php if($rowInfo['suspend_status']== "Suspended") {?> disabled="disabled" <?php } ?> name="actionSuspended"  class="btn btn-warning-off" onclick="return changepassword()" class="btn btn-green col-lg-11">Suspended</button></td>
                  </tr>

                  </table>
                  </form>
                  
                  
                  
                  
                   <P>.</P>
                  <P>.</P>
                  
                  
                  
                  <!-- TRASACTION CODING CONTROL -->
                   <form method="post" action="#" enctype="multipart/form-data">
                <table>
                          <span>
        <?php
						  if(isset($_GET['msg2'])){
						  echo "<div class='twelve columns red-grad2'>" . $_GET['msg2']. "</div>";
						  }
						  ?></span>
                          <tr>
                  <td height="9" colspan="2">
                  
                  <span type="submit" class="btn btn-warning"  class="btn btn-green col-lg-11">User Transaction Code is <?php echo $rowInfo['cust_trans_stat']; ?></span></td>
                  </tr>
     
                
                          <tr>
                  <td height="9" colspan="7">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['customer_id']; ?>" size="30" />
                  <button type="submit" id="onbutton"  <?php if($rowInfo['cust_trans_stat']== "On") {?> disabled="disabled" <?php } ?>  name="actionOnCode"  class="btn btn-warning-on" onclick="return changepassword()" class="btn btn-green col-lg-11">On</button></td>
                  
                  <td height="9" colspan="2">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowInfo['customer_id']; ?>" size="30" />
                  <button type="submit" id="offbutton" <?php if($rowInfo['cust_trans_stat']== "Off") {?> disabled="disabled" <?php } ?> name="actionOffCode"  class="btn btn-warning-off" onclick="return changepassword()" class="btn btn-green col-lg-11">Off</button></td>
                  </tr>

                  </table>
                  </form>
                  
                  
                        
            
                  
                  
                  
                  <!-- CHANGE CURRENCY -->
                  
                  
                  <?php
				$selCur = $conn->query("select * from curr_type where accnt_nmb = '" . $rowInfo['acct_nmb'] . "' ") or die($conn->error);
                $rowCur = $selCur->fetch_array();
				   ?> 
                  
                    <div style="margin:20px 0px 0px 0px;" class="col-lg-10">   
               
                          <?php
						  if(isset($_GET['msg3'])){
						  echo "<div class='twelve columns red-grad2'>" . $_GET['msg3']. "</div>";
						  }
						  ?>
                          <form method="post" action="#" enctype="multipart/form-data">   
                                    
            <table width="100%" align="center" cellpadding="5" cellspacing="2">
                  <tr>
                  <td height="26"><span class="style1"><strong>Currency type</strong></span></td>
                  </tr>
                <tr>
                  <td>
                  <input type="hidden" name="accnt_nmb" value="<?php echo $rowInfo['acct_nmb']; ?>"/ > 
                  <select name="cur_type" id="cur_type" class="form-control" required >
                      <option value="" style="opacity: 0.3; ">Default =><?php echo $rowCur['curr_type']; ?></option>
                      <option value="Dollar">Dollar</option>
                      <option value="Pounds">Pounds</option>
                      <option value="Euro">Euro</option>
                      <option value="Swiss franc">Switzerland Franc</option>
                      <option value="Polish zloty">Polish zloty</option>
                      <option value="Czech koruna">Czech koruna</option>
                      <option value="Malaysia Ringgit">Malaysia Ringgit</option>
                      <option value="Yen">Japanese Yen</option>
                      <option value="Rand">South African Rand</option>
                      <option value="ZAR">ZAR</option>
                      <option value="NGR">Nigerian Naira</option>
                      <option value="Namibia Dollar">Namibian Dollar</option>

                        </select>
                  </td>
                     <td height="60" colspan="2">	<button  aria-label="Next" type="submit" name="changeCurrency"  class="btn btn-info col-lg-12">Change Currency</button></td>
                  </tr>
        
            </table>
                          </form>          
            </div>
                
                
                
                </div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">#</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label"><a href="credit_this_user.php?&acct_nmb=<?php echo $rowInfo['acct_nmb']; ?>">Credit This user Account</a></div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label"><a href="more_info.php?id=<?php echo $rowInfo['customer_id']; ?>">Back to Info</a></div>
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
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://adminlte.io"><?php echo $site_name ; ?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
