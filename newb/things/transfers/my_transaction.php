<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
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
    
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                       
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
                
            
                
                
            
                
            
                <?php include('../includes/account_info.php');?> 
                       
            <div class="section"> 
                
                
   
   
     
      
     
     
            
                            
                            
                              <div class="section panel panel-default-grid">
   <?php
				 
				 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
				 $rowTrans = $selTrans->fetch_assoc();
				 ?> 
                
  <div class="col-lg-12">
                        <div class="pInfo">
                       <div role="application" style="font-size:14px;">
    <span id="accordion-bottom-ariaLabel" alt="expanded" class="hide"></span>
    <h2>Account Summary</h2>


    
									<br>


<strong></strong>
                           <table width="100%" height="98" cellpadding="7" cellspacing="0" class="baltable">
                           <tr>
                           <th height="35" bgcolor="#f5f6fa"><div align="left" class="style1 style3 style1">Account Holder</div></th>
                           <th bgcolor="#f5f6fa"><div align="left" class="style5 style1">Account Number</div></th>
                           <th bgcolor="#f5f6fa"><div align="left" class="style5 style1">Swift code/BIC</div></th>             
                           <th bgcolor="#f5f6fa"><div align="left" class="style5 style1">Balance</div></th>             
                           <th bgcolor="#f5f6fa"><div align="left" class="style5 style1">Available</div></th>             
                            </tr>
                            <?php
							$selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' group by accnt_nmb") or die(mysql_error());

                            if(!$selBank->num_rows){
							?>
                            <tr>
                            <td height="25" colspan="5" bgcolor="#FFFFFF"><span class="style7">Sorry there is no transaction for this account </span></td>
                            </tr>
                            <?php
							}else{
							$rowBank = $selBank->fetch_assoc();
                                
                                
                            $Sum_Tc = getCurrency($rowcurr['curr_type']). " " . number_format ($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ',');    
                                
                            ?>
							<tr>
                            <td bgcolor="#FFFFFF"><?php echo $rowBank['cust_name']; ?></td>
                            <td bgcolor="#FFFFFF"><?php echo $rowBank['accnt_nmb']; ?></td> 
						     <td bgcolor="#FFFFFF"><?php echo $rowUser['swift_code']; ?></td> 
                        	 <td bgcolor="#FFFFFF"><span class="balinfo"><?php echo $Sum_Tc ; ?></span></td>
                             <td bgcolor="#FFFFFF"><span class="balinfo"><?php echo getCurrency($rowcurr['curr_type']); echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?></span></td>
                           </tr>
                           <?php
						   }
						   ?>
                            </table>
                                    
              <div style="margin:5px 0px 0px 10px; color:#333333;" ><h3 class="style7">Minin statment</h3> 
                  </div>
                            <div style="margin:5px 0px 0px 10px; color:#333333;" ><span class="style7"></span>
                              <hr /> </div>
        
                           
                           <h2 style="font-size: 16px; font-family: Montserrat, -apple-system,  BlinkMacSystemFont,;">Items shown from today's data are subject to confirmation and maybe reversed from your account.</h2>
                  
                            <div id="grid-block" class="" style="">

                    <div id="ctl00_MainContent_ministatement" class="RadGrid RadGrid_MetroTouch table-responsive" style="width:100%;" tabindex="0">
                           
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">             

<tr>
                  
                  <th bgcolor="#007EB6"><div align="left" class="style6 style1" style="padding-right: 50px">Date</div></th>
                   <th bgcolor="#007EB6"><div align="left" class="style6 style1" style="padding-right: 300px">Narration</div></th>
                     <th bgcolor="#007EB6"><div align="left" class="style6 style1"  style="padding-right: 100px">Credit</div></th>             
                     <th bgcolor="#007EB6"><div align="left" class="style6 style1" style="padding-left: px">Debits</div></th>           
                    </tr>
                            <?php
							$seldel = $conn->query("select * from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' order by transact_id DESC") or die(mysql_error());
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
                           
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $rowDel['dat_pay']; ?></td>
                             <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $rowDel['narratn']; ?></td> 
						     <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $Tc; ?></td> 
                        	 <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><?php echo $Td; ?></td>
                                
                            
                      </tr>
                      
                           <?php
						   }
						   }
						   ?>
                      
                      
                      <tr><td>.</td></tr>
                      
                      <tr>
                      <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"></td>
                      <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;" ><strong>Total Available Balance</strong></td>
                      <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"></td>
                      <td bgcolor="#FFFFFF" style="border-bottom:1px solid rgba(0, 0, 0, 0.3);;"><strong><?php echo $Sum_Tc ?></strong></td>      
                          </tr>
                  </table>
                      
                            
                                   
            </div>
                                
 

            
            
                  
      
            <center>
            
 

   
                       
                                
                                
                                
                                
                                
                                
                                
                                
                        </div>
                           </div>
                        </div>
                    
                    </div>
  </div>
          </div>
         

      </div>
    </section><!-- #team -->

  </main>

                 

 </div> </div> </div>


   <!-- . FOOTER  -->
        
       <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
 