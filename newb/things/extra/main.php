
<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
include('../sources/config.php');
?>
  <!-- /. NAV TOP  -->
        <!-- . SIDENAV  -->
    <?php include('../includes/head.php');?>
    <?php include('../includes/sidebar.php');?>

        <!-- /. SIDENAV  -->
    
      <?php
				 
				 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
				 $rowTrans = $selTrans->fetch_assoc();
				 ?> 
    
      
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                      <marquee behavior="scroll" direction="left" >
                            <h3 style="color:purple" class="page-title"> <span  class="greetings"></span>,  <?php echo $rowUser['cust_name']; ?>  Welcome to your safe online banking ...At <?php  echo "$site_name";?> we offer you the best. 
                       </h3></marquee>  
                    </div>
                </div>              
                 <!-- /. ROW  -->
               
         
                                                                  
     <?php
     $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc();
    ?>
                
                
                
                
        
                

                
                
                
      
           <div class="alert alert-danger">   
               
                 <?php 
					 $d_img=  "<img src='things/img/blank-profile-picture.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
					 $p_img=  "<img src='things/upload/". $rowUser['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					  ?>
    
             <?php echo $rowUser['cust_photo'] =="" ? $d_img : $p_img; ?>
                
                
 <div class="col-md-6"   style="font-weight: 900;font-size: 16px; color: BLACK;"> 
  <?php echo $rowUser['acct_nmb']; ?>------<?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>-----<?php echo $rowUser['cust_name']; ?>
</div>
     
        
    <h5 style="color:red"  class="pull-right">Last Login Time:  <span style="color: BLACK;"> <?php echo $rowUser['last_log_time']; ?> </span></h5>
          </div>
              
          
            
            
                     
                     
                     
                         <div class="row">
         
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="div-square" style=" background-color: green; red;color:white;">
                                            <div class="visual">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="details">
                                                <h3><div class="number" id=""><span class="counter" data-counter="counterup" > <?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit'], 2, '.', ','); ?></span></div></h3>
                                                <div class="desc"> Total Deposits </div>
                                            </div>
                                        </div>
                                    </div>
                    
                    
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                         <div class="div-square" style=" background-color: #ff3333;color:white;">
                                            <div class="visual">
                                                 <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="details">
                                                <h3><div class="number" id=""><?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalDebit'], 2, '.', ','); ?> </div></h3>
                                                <div class="desc"> Total Withdrawal </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                    
                             
                                   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="div-square">
                                       <div class="dashboard-stat white managerDetail"><div class="manager"><h4>Account Manager Details</h4><div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" photo="" image62=""><img src="things/img/RsmInforPicture" style="width:62px; height:55px; margin-left:13px;"></div><div class="col-lg-8" col-md-8="" col-sm-4="" col-xs-4=""><div class="row"> <div class="col-md-12 mleft10"><span class="email"><a href="mailto:"  style="color:blue;"><span id=""><?php echo "$admin_email" ; ?></span></a></span><br><span class="phone"><a href="tel:" style="color:blue;"><span id="my-phone-info"><?php echo "$admin_phone" ; ?></span></a></span><span class="branch"></span></div> </div></div></div>   </div> <span class="more" style="font-weight: 900;"><?php echo "$site_name" ; ?></span></div>
                                    </div>
                                </div>
                                      
                                </div>
                  
                
                
                    
               
                
            
                     
                 <div style="padding:9px;font-weight: 900;">I<span class="style7">tems shown from today's data are subject to confirmation and maybe reversed from your account.
                            </span><br>
</div>    
         
                                <div class="panel-heading">
                <h3 class="panel-title" style="font-weight: 900;">Mini Statement</h3>
            </div>  
                           
                           
                           
                 
                  <div id="grid-block" class="" style="">

                    <div id="ctl00_MainContent_ministatement" class="RadGrid RadGrid_MetroTouch table-responsive" style="width:100%;" tabindex="0">

<table class="" id="ctl00_MainContent_ministatement_ctl00" style="width:100%;table-layout:auto;empty-cells:show;">             
                
  
      
                <tr>
                <th height="33" bgcolor="#808080"><div align="left" class="style6 style1">Date</div></th>
                  <th bgcolor="#808080"><div align="left" class="style6 style1" style="padding-right: 50px">Transaction Date</div></th>
                   <th bgcolor="#808080"><div align="left" class="style6 style1" style="padding-right: 300px">Narration</div></th>
                     <th bgcolor="#808080"><div align="left" class="style6 style1"  style="padding-right: 90px">Credit</div></th>             
                     <th bgcolor="#808080"><div align="left" class="style6 style1" style="padding-right: 10px">Debits</div></th>      
                    </tr>
    
    
                            <?php
							$seldel = $conn->query("select * from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' order by dat_pay DESC") or die(mysql_error());
                            if(!$seldel->num_rows){
							?>
                            <tr>
                            <td height="27" colspan="5" bgcolor="#FFFFFF"><span class="style7">Sorry there is no transaction for this account </span></td>
                      </tr>
                            <?php
							}else{
								$i=0;
							while($rowDel= $seldel->fetch_array()){;
                             $i++;
							 $Tc = getCurrency($rowcurr['curr_type']). " " . number_format($rowDel['amt_cred'], 2, '.', ','); 
                            $Td = getCurrency($rowcurr['curr_type']). " " . number_format($rowDel['amt_dep'], 2, '.', ',');                                       
							?>
							<tr >
                            <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);">
                              <?php echo $i; ?></td>
                             <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $rowDel['dat_pay']; ?></td>
                            <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $rowDel['narratn']; ?></td> 
						     <td bgcolor="#FFFFFF"  style="border-bottom:1px solid rgba(0, 0, 0, 0.3); color: #1A9900;"> 
                               <?php echo $rowDel['trans_type']== "Transfer" ?  "" :  $rowDel['trans_type']== "Credit" ? "$Tc" : "" ; ?>
                                </td> 
                        	 <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3); color: red;"> 
                                <?php echo $rowDel['trans_type']== "Transfer" ?  "- $Td" :  $rowDel['trans_type']== "Debit" ? "- $Td" : "" ; ?>
                                </td>
                           <?php
						   }
						   }
						   ?>
                  </table>
                            
    
    
                

                
    
                  </div>
                      
                      
                      
                      
                      
                      
                      
                      
                    
                      
                      
                      
                      
              </div>
           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- . FOOTER  -->
        
        <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
 