
<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
$selStage = $conn->query("select * from bill_stage where stage_name = 1") or die($conn->error);
$rowStage = $selStage->fetch_assoc();
?>

  <!-- /. NAV TOP  -->
        <!-- . SIDENAV  -->
 <?php include('../includes/head.php');?>
    <?php include('../includes/sidebar.php');?>>
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
                
                
   
   
     
     
    <!--==========================
      Our Team Section
    ============================-->
    <section id="team">
      <div class="container"style="width:90%;">
                
        <div class="row">
      
            <div class="col-lg-9">
                        <div class="pInfo">
                         
                   <div class="transT">
                     
                 <h3><?php echo $rowStage['stage_n']; ?> Confirmation </h3>
                    <hr>
              <h5>Please enter your <?php echo $rowStage['stage_n']; ?> as given </h5>

               <div class="spinDiv">
  
                <div class="alert alert-danger errorInfo"></div>
                <form method="post" id="confirmCOde" class="confirmCOde" enctype="multipart/form-data">
                  <table width="70%" align="left" cellpadding="5" cellspacing="3">
                  <tr>
                  <td height="29"><span class="ap-common-fontSize12px ap-common-fontSize12px style6 style12"><strong>Transfer Code</strong></span></td>
                  <td><input name="code_id" type="text" class="form-control"  placeholder ="<?php echo $rowStage['stage_n']; ?>" required /></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <input name="trans_id" type="hidden" value="<?php echo $_GET['trans_id']; ?>">
                    <button type="submit" value="Start Transfer" class="btn btn-warning btnCod">Confirm Code</button></td>
                  </tr>
                  </table>
                  </form>
                </div>
                </div>       
                
                        </div>
                    
                    </div>
          </div>

        
         

      </div>


    
    
    
    
    
    
    
                



                  </div>
              </div>
           
    </div>
         
  <!-- . FOOTER  -->
        
        <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
  