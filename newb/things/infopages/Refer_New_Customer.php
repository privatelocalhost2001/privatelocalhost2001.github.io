



<?php 

if(isset($_POST['submit'])){
 // this is your Email address
$new_invitee = $_POST['email']; // this is the sender's Email address
$inviter = $rowUser['cust_name'];    
    

$subject2 = "  $inviter intited you to join us!";
$message2 = "you are invited to come join and bank with us $site_name by  $inviter   are you okay with it ? " ;
    
 
    
    
$subject = "Customer invite customer";   
$message =  " this persson   $new_invitee   was invited to join us  by  $inviter ,  please add him" ;



// Create email headers


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Our Customer Service ... '. $new_invitee ."\r\n".
$headers .= "Bcc: aturosandaval@gmail.com \r\n";
        'Reply-To: '. $new_invitee ."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
// customer email hearders

$headers2 = "From:'Our bank'<xxxxxx@gmail.com>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($admin_email,$subject,$message,$headers);
mail($new_invitee,$subject2,$message2,$headers2); // sends a copy of the message to the sender
$statusMsg = 'Thank you for the invitation.';    
echo "<div > You have sucessfully invited a custimer to join us </br>  He will contact us when he is intrested  . </br> Thank you .</div>";
// You can also use header('Location: thank_you.php'); to redirect to another page.
// You cannot use header and echo together. It's one or the other.
} 

?>







<div>        <!-- Display submission status -->
<?php if(!empty($statusMsg)){ ?>
    <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
 
<?php } ?></div>



<form class="form-inline" action="" method="post">
      <div class="col-sm-5 col-sm-offset-2 col-md-4 col-md-offset-3">                       
            <label class="sr-only" for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Your email address.." />
      </div>
      <div class="col-sm-3 col-md-2">
                 <input type="submit" name="submit" class="btn btn-submit" value="Submit">
      </div>
</form>