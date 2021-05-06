<div class="col-lg-3 col-md-6">
             <?php 
				$d_img=  "<img src='things/img/blank-profile-picture.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
				$p_img=  "<img src='things/upload/". $rowUser['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					  
		      ?>
    
    
    <?php
$selLTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "' ORDER BY dat_pay DESC LIMIT 1") or die($conn->error);
				 $rowLTrans = $selLTrans->fetch_assoc();
				 ?>
    
    
  
    
            <div class="sideBar" style="opacity:0.3">
             <div class="prof-mg">
             <?php echo $rowUser['cust_photo'] =="" ? $d_img : $p_img; ?>
             
            
             </div>
             <div class="acct-inf-st">
             <table width="100%" >
                             <tr style="border-bottom:1px solid #333333; padding:6px;">
                              <td height="34"><span class="tableHead">Name:</span></td>
                              <td>&nbsp;&nbsp;&nbsp;<?php echo $rowUser['cust_name']; ?></td>
                            </tr>
                             <tr style="border-bottom:1px solid #333333; padding:6px;">
                              <td height="34"><span class="tableHead">ACC/IBANNumber:</span></td>
                              <td>&nbsp;&nbsp;&nbsp;<?php echo $rowUser['acct_nmb']; ?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #333333; padding:6px;">
                              <td height="35"><span class="tableHead">BIC/SWIFT CODE:</span></td>
                              <td>&nbsp;&nbsp;&nbsp;<?php echo $rowUser['swift_code']; ?></td>
                            </tr>
                            <tr>
                              <td height="32"><span class="tableHead">Last transaction:</span></td>
                              <td>&nbsp;&nbsp;&nbsp; <?php echo @$rowLTrans['dat_pay'] ==""? "Not available":  date('d - m - Y', strtotime($rowLTrans['dat_pay'])); ?></td>
                            </tr>
                          </table>
             </div>
              </div>
          </div>