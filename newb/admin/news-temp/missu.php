
<?php


include('../../things/sources/config.php');
?>




<html><body>
Dear [NAME],<br>
<p>We Have Missed You!</p>
<p>All items will be going at a 20% discount, so grab it while stocks last!</p>
</body>


    
       

 <p id="my-site-name"  onfocus="myBodyFunction()">cc </p>
  <p id="my-email-info" onfocusin="myBodyFunction()" >dd </p>    
 
    
    
   <script >
 function myBodyFunction() {
      var mysitename = "<?php  include('../../things/sources/config.php'); echo   "$site_name" ; ?>";
      var myemailinfo = "<?php  include('../../things/sources/config.php'); echo   "$admin_email" ; ?>";
    document.getElementById("my-site-name").innerHTML = mysitename;
      document.getElementById("my-email-info").innerHTML = myemailinfo;
       }
</script>
    
    
    
    
    <p id="demo" onclick="myFunction()">Click me to change my HTML content (innerHTML).</p>

<script>
function myFunction() {
  document.getElementById("demo").innerHTML = "Paragraph changed!";
}
</script>
    
    
    
    
    
   
    <p id="myS">This is a p element.</p>
    <div id="myN">This is a div element.</div>

<script>
   
document.getElementById("myS").innerHTML = "<?php  include('../../things/sources/config.php'); echo   "$site_name" ; ?>";
document.getElementById("myN").innerHTML = "<?php  include('../../things/sources/config.php'); echo   "$admin_email" ; ?>";
</script>



<tbody><?php  include('../../things/sources/config.php'); echo   "$admin_email" ; ?>
   <tr  align="center">
    <td valign="top" possition="center" width="50%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" ><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
      <p>&nbsp;</p>
      <p></p>
   </tr>
<tr>
    <td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7 contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><span style="color: #5c068c;"><span>  Whatsapp on  <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" >'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"></span><span style="color: #9297a3;"> Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br></td>
</tr>
    <div><span id="myfoot-info"></span></div>
<tr align="center">
    <td>
    <p><span align="center" style="font-size: 10pt; color: #363636;" > Copyright  2021.
        <?php  include('../../things/sources/config.php'); echo   "$site_name" ; ?>
        </span></p> </td>
    </tr>
      

</tbody>


     


</html>