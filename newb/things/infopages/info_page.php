
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


                
                
                
                
                
                
                
                

            <!-- ############################## BASICALLY THIS IS WHERE YOU START PUTTING YOUR CONTENTS ################ -->

  <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                       
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
                
            
                
                
            
                
            
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
  <?php echo $rowBank['accnt_nmb']; ?>------<?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>-----<?php echo $rowUser['cust_name']; ?>
			            </div>
     
                
        
      <h5 style="color:red" >Current Date and time:  <span style="color: BLACK;"> <?php echo date(" h:i a M,d,Y") . "\n"; ?> </span></h5>
        
               </div>
        
            
            
             <div class="rcbSlide" style="z-index:6000;display:none;"><div id="ctl00_MainContent_AccountDropdown_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_MetroTouch "><div class="rcbScroll rcbWidth"><ul class="rcbList"><li class="rcbItem"><?php echo $rowBank['accnt_nmb']; ?>   -   <?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>  -  <?php echo $rowUser['cust_name']; ?></li></ul></div></div></div><input id="ctl00_MainContent_AccountDropdown_ClientState" name="ctl00_MainContent_AccountDropdown_ClientState" type="hidden" autocomplete="off">   
                     
                     
                    
       
    </div>   
                       
            <div class="section"> 
                
                
   
   
     
     
    <!--==========================
      Our Team Section
    ============================-->
    <section id="team">
      <div class="container"style="width:90%;">
                
        <div class="section-header">
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="col-lg-12">
                        <div class="pInfo">
                         
                  
                            
                            
                             <?php
                
                if($_GET['pages'] == 'My-Standing-Instructions'){
                     require  'My_Standing_Instructions.php';
                    }
                else if ($_GET['pages'] == 'Refer-New-Customer') {
                    require  'Refer_New_Customer.php';
                    } 
                else if ($_GET['pages'] == 'CONSUMER-LOAN') {
                     require  'Consumer_Loan.php';
                     }
                else if ($_GET['pages'] == 'Block-Verve-Card') {
                    require  'Block_Verve_Card.php';
                    }
                else if ($_GET['pages'] == 'Card-Request') {
                     require  'Card_Request.php';
                     }
                else if ($_GET['pages'] == 'Increase-Transaction-Limits') {
                     require  'Increase_Transaction_Limits.php';
                     }
                else if ($_GET['pages'] == 'Freeze-Accounts') {
                    require  'Freeze_Accounts.php';
                    } 
                else if ($_GET['pages'] == 'Security-Question') {
                     require  'Security_Question.php';
                     } 
                else if ($_GET['pages'] == 'page3') {
                     require  'page3.php';
                     }
                else if ($_GET['pages'] == 'page2') {
                    require  'page2.php';
                    }
                else if ($_GET['pages'] == 'page3') {
                     require  '../infopages/page3.php';
             }else{
            require '../infopages/Nothing -To-Show.php';
                }

            ?>  
                
                            
                            
                
                        </div>
                    
                    </div>
          </div>

         

         

      </div>
    </section><!-- #team -->

  </main>

 
                 


                  </div>
              </div>
           
    </div>
         


    
    
    <?php include('../includes/footer.php');?>
  
    


