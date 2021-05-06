
                 <div class="section grey-bar" >
        <div class="col-md-3" >
        <label class="mtop9">ACCOUNT DETAIL:</label>
        </div>                                                              
     <?php
     $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc();
    ?>
               
      
                     
                     
           <div class="alert alert-info">             
        <div class="col-md-6"   style="font-weight: 900;font-size: 16px; color: BLACK;"> 
  <?php echo $rowUser['acct_nmb']; ?>------<?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>-----<?php echo $rowUser['cust_name']; ?>
			            </div>
     
                
        
       <h5 style="color:red; font-size: 13px;" >Last Login Time:  <span style="color: BLACK;font-size: 11px;"> <?php echo $rowUser['last_log_time']; ?>  </span></h5>
        
               </div>
        
            
            
             <div class="rcbSlide" style="z-index:6000;display:none;"><div id="ctl00_MainContent_AccountDropdown_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_MetroTouch "><div class="rcbScroll rcbWidth"><ul class="rcbList"><li class="rcbItem"><?php echo $rowBank['accnt_nmb']; ?>   -   <?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>  -  <?php echo $rowUser['cust_name']; ?></li></ul></div></div></div><input id="ctl00_MainContent_AccountDropdown_ClientState" name="ctl00_MainContent_AccountDropdown_ClientState" type="hidden" autocomplete="off">   
                     
                     
                    
       
    </div>  