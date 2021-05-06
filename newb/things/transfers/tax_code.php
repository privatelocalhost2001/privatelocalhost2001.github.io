<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
$selStage = $conn->query("select * from bill_stage where stage_name = 2") or die($conn->error);
$rowStage = $selStage->fetch_assoc();
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
                
                
   
   
     

     
    <section id="team">
      <div class="container" style="width:90%;">
        <div class="section-header">
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="col-lg-12">
                        <div class="pInfo">
                         
                   <div class="transT">
                  
               <h3 class="style10"><?php echo $rowStage['stage_n']; ?> Confirmation </h3>
               <hr>
                         <h5>Please enter your <?php echo $rowStage['stage_n']; ?> as given </h5>

               <div class="spinDiv">
  
                <div class="alert alert-danger errorInfo"></div>
                <form method="post" id="confirmTax" class="confirmTax" enctype="multipart/form-data">
                  <table width="70%" cellpadding="5" cellspacing="3">
                  <tr>
                  <td height="29"><span class="ap-common-fontSize12px ap-common-fontSize12px style6 style12"><strong><?php echo $rowStage['stage_n']; ?></strong></span></td>
                  <td><input name="tax_nmb" type="text" class="form-control"  placeholder ="<?php echo $rowStage['stage_n']; ?>" required /></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <input name="trans_id" type="hidden" value="<?php echo $_GET['trans_id']; ?>">
                    <button type="submit" value="Start Transfer" class="btn btn-warning btnTax">Confirm Code</button></td>
                  </tr>
                  </table>
                  </form>
                </div>
                </div>       
                
                        </div>
                    
                    </div>
          </div>

         

         

      </div>
    </section><!-- #team -->

  </main>

                 



                  </div>
              </div>
           
    </div>
    <!-- . FOOTER  -->
        
         <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
          
  