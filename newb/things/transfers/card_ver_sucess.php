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
                
                
   
   
     
     
    <!--==========================
      Our Team Section
    ============================-->
   
                
     
                
                
             <style>.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}</style>   
                
         
                
                
      <div class="container"style="width:80%;">
  
    <div class="col-lg-12" style="margin-bottom:30px;">
                       
                         
                   
                    <h4>Identity Upload Status</h4>
                <div class="alert alert-warning errorInfo" style="color: purple; font-size: 20px;">Your Identification document have been submitted successfully !!</div>
    

<!-- Display contact form -->
<form method="post" action="" enctype="multipart/form-data">

 
    <div class="submit">
        <input  name="submit" class="btn" onclick="window.location.href = 'portal';" value="BACK">
    </div>
</form>
        
        
        
        
        
        
        
        
        
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
