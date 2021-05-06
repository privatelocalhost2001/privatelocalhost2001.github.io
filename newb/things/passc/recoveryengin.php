<?php
//start session
session_start();

//load and initialize user class
include 'recov_auth.php';
include '../sources/config.php';
$user = new User();

if(isset($_POST['forgotSubmit'])){
    //check whether email is empty
    if(!empty($_POST['username'])){
        if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('username'=>$_POST['username']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            
             //check whether user exists in the database
        $prevCon['where'] = array('email'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            //generat unique string
            $uniqidStr = (uniqid(mt_rand()));;
            
            //update data with forgot pass code
            $conditions = array(
                'email' => $_POST['email']
            );
            $data = array(
                'forgot_pass_identity' => $uniqidStr
            );
            $update = $user->update($data, $conditions);
            
            if($update){
                $resetPassLink = ''.$site_url.'/NewPasswordSubmit?fp_code='.$uniqidStr;
                
                //get user details
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);
                
                //send reset password email
                $to = $userDetails['email'];
                $subject = "Password Update Request";
                $mailContent = '<p>&nbsp;</p>
<blockquote>
<div dir="auto">
<div class="gmail_quote"><br />
<div>
<table id="m_1216816781061957889globalbg-color" style="background-color: #b2b2b2;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tbody>
<tr style="height: 606px;">
<td style="height: 606px;" valign="top">
<table id="m_1216816781061957889data-mainwrap" style="border: 2px solid #5c2784;" border="0" width="764" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" width="762">
<table id="m_1216816781061957889invite-content" style="width: 768px;" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tbody>
<tr id="m_1216816781061957889header-color" bgcolor="#ffffff">
<td style="width: 104px;" align="left" height="5"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="5" /></td>
<td style="width: 642.828px;" valign="top" height="5"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="750" height="5" /></td>
<td id="m_1216816781061957889invite-rightside" style="width: 10.1719px;" valign="top" height="5"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="5" /></td>
</tr>
<tr>
<td style="width: 757px;" colspan="3">
<table border="0" width="760" cellspacing="0" cellpadding="0">
<tbody>
<tr id="m_1216816781061957889header-color" bgcolor="#ffffff">
<td width="5"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="41" /></td>
<td id="m_1216816781061957889logobox" align="topleft" width="750"><span><img id="m_1216816781061957889logo" src="'.$site_url.'/things/img/logo.png" width="110" height="110" /></span></td>
<td width="5"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="41" /></td>
</tr>
<tr>
<td colspan="3" height="20"><img src="'.$site_url.'/things/img/login-long-lebbel.jpg" width="750" height="20" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="width: 104px;" align="left" height="320"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="320" /></td>
<td id="m_1216816781061957889body-wrap" style="text-align: left; width: 642.828px;" align="left" valign="top">
<p id="m_1216816781061957889s-fbk-invite-COMM_BODY_143638_603" style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal;"><br /><span style="font-size: 14.0px;">Dear</span>&nbsp;<span>'.$userDetails['fullname'].'</span><span style="font-size: 14.0px;">,<br /><br /></span></p>
<div style="text-align: left;"><span style="font-size: 11pt;">&nbsp; &nbsp;<span style="font-size: 12pt;"> Recently a request was submitted to reset a password for your&nbsp;<strong style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;">'.$site_name.'</strong> online Banking login</span></span><br /><span style="font-size: 12pt;">If this was not you, your account has been compromised.</span></div>
<div style="text-align: left;"><span style="font-size: 12pt;">To reset your password, visit the following link:</span></div>
<div style="text-align: left;">&nbsp;</div>
<table style="height: 44px; width: 220px; border-collapse: collapse; background-color: #8d0ff5; margin-left: auto; margin-right: auto;" border="1">
<tbody>
<tr style="height: 30px;">
<td style="width: 216px; height: 30px;"><span>&nbsp; &nbsp; &nbsp;<span style="font-size: 11pt;"> &nbsp;<span style="color: #ffff99;"><a style="color: #ffff99;" href="'.$resetPassLink.'">Click to reset password</a></span></span></span></td>
</tr>
</tbody>
</table>
<p style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal;">&nbsp;</p>
<p style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal; text-align: center;"><span style="font-size: 11pt;">If you cannot click on the link, please copy and paste the link below into your browser window.</span></p>
<table style="width: 93.125%; height: 25px;" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 25px;">
<th style="width: 100%; height: 25px;" bgcolor="#FFFFFF"><span style="font-size: 10pt;"><a href="'.$resetPassLink.'">'.$resetPassLink.'</a></span></th>
</tr>
</tbody>
</table>
<p style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal;">&nbsp;</p>
<p style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal;">&nbsp;</p>
<p style="color: #5c2784; font-family: Arial; font-size: 18px; font-style: normal;">&nbsp;</p>
<p><span style="font-size: 14.0px;"><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;">Your feedback is important as this helps us serve you better&nbsp; </span></span></span></p>
<p><span style="font-size: 14px;"><strong><span style="color: #5c2784; font-family: Arial;">Kindly click to rate your experience with This Bank</span></strong></span></p>
<table style="width: 342px; height: 86px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px;">
<table border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><a href="'.$site_url.'/things/rate-us/alart-rate-us" target="_blank" rel="noopener noreferrer" data-=""><img id="m_9042310621428311941x_ymail_ctr_id_-94339-49" class="CToWUd" style="display: block; margin-left: auto; margin-right: auto;" src="'.$site_url.'/things/img/Good.png" width="50" /></a>
<p style="text-align: center;">Good</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 120px; text-align: center;">
<table border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 92.6562px;">
<td style="height: 92.6562px;"><a href="'.$site_url.'/things/rate-us/bulb/alart-rate-us" target="_blank" rel="noopener noreferrer"><img id="m_9042310621428311941x_ymail_ctr_id_-307610-50" class="CToWUd" src="'.$site_url.'/things/img/skeptical.png" width="50" /></a>
<p>Fair</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 120px; text-align: center;">
<table border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><a href="'.$site_url.'/things/rate-us/alart-rate-us" target="_blank" rel="noopener noreferrer"><img id="m_9042310621428311941x_ymail_ctr_id_-717384-51" class="CToWUd" src="'.$site_url.'/things/img/Bad.png" width="50" /></a>
<p>Bad</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
<p><span style="font-size: 14.0px;"><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;"><span>If you have not requested this change, please call our support center as soon as possible. If you require immediate assistance, please contact our support center</span><span>&nbsp;</span><a href="mailto:' .$admin_email. '">' .$admin_email. '</a><span>&nbsp;.</span> </span></span></span></p>
<p><span style="font-size: 14.0px;"><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;">Thank you for choosing&nbsp;</span></span><span style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;"><strong style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;">'.$site_name.' </strong><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;"><strong>&hellip;</strong></span></span><strong style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;">..</strong></span><br /><br /><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;">Yours sincerely,</span></span><br /><span style="color: #5c2784; font-family: Arial;"><span style="font-size: 14px;">For:</span></span> <span style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;">'.$site_name.'</span><br /><br /><strong style="color: #5c2784; font-family: Arial; font-size: 14px; font-style: normal;">Group Head, Account Team&nbsp; Management</strong><br /><br /><span style="color: #4b0082;"><span style="color: #4b0082; font-family: Arial; font-size: 14px; font-style: normal;"><strong>Please beware of fraudulent calls, emails, and sms asking for personal information.</strong></span> <span style="color: #4b0082; font-family: Arial; font-size: 14px; font-style: normal; font-weight: bold;">'.$site_name.'</span><span style="color: #4b0082; font-family: Arial; font-size: 14px; font-style: normal;"><strong> will NEVER call or text to ask for your login User ID&nbsp; or bank account details.&nbsp; &nbsp;If you have any request contact your personal accounting officer </strong></span><span style="color: #4b0082; font-family: Arial;"><span style="font-size: 14px;"><strong>assigned</strong></span></span><span style="color: #4b0082; font-family: Arial; font-size: 14px; font-style: normal;"><strong>&nbsp;to you the bank during account creation , Thank you.<br /></strong></span></span></span></p>
</td>
<td style="width: 10.1719px;" height="320"><img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="5" height="320" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 5px;">
<td style="height: 5px;">&nbsp;</td>
</tr>
<tr style="height: 138.656px;">
<td id="m_1216816781061957889border-bgcolor-bot" style="height: 138.656px;" align="center" valign="top" bgcolor="#5c2784">
<table width="90%">
<tbody>
<tr>
<td id="m_1216816781061957889invite-disclaimer" style="padding: 20px 0px; color: #fbb800; font-size: 11px; font-family: Arial; text-align: left;" align="left">
<p style="padding: 0px 10px;"><span style="color: #ffd700;"><br />Survey is conducted on behalf of <strong><span>'.$site_name.'&nbsp;</span></strong>&nbsp;|&nbsp;Terms &amp; Conditions<br />The information collected from this survey is confidential and&nbsp; <strong><span>'.$site_name.'&nbsp;</span></strong> will only use this data to improve our products and services.</span></p>
<p style="padding: 0px 10px; text-align: center;"><span style="color: #ffd700;">&nbsp;&nbsp;<span>Copyright &copy; 2020 <a href="'.$site_url.'">'.$site_name.'</a> , All Rights Reserved.</span></span></p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<img src="./?_task=mail&amp;_id=12393491315fabe0ca3cece&amp;_action=display-attachment&amp;_file=rcmfile73281605099722082217400" width="1" height="1" /></div>
</div>
</blockquote>
<p>&nbsp;</p>
<div id="_rc_sig">&nbsp;</div>';
                
                
                
                
                
                
                
                
                
                //set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                $headers .= 'From: '.$site_name.'<sender@'.$domain.'>' . "\r\n";
                //send email
                mail($to,$subject,$mailContent,$headers);
                
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Please check your e-mail, we have sent a password reset link to your registered email.';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Some problem occurred, please try again.';
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Given email is not associated with any account.'; 
        }
             }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Given username is not associated with any account. Please check'; 
        }
        
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email to create a new password for your account.'; 
    }
         }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Username of your account  must be enterned  to create a new password.';
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the forgot pasword page
    header("Location:forgetPasswordEmail");
}elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['passwrd']) && !empty($_POST['confirm_passwrd']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];
        //password and confirm password comparison
        if($_POST['passwrd'] !== $_POST['confirm_passwrd']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
        }else{
            //check whether identity code exists in the database
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
                //update data with new password
                $conditions = array(
                    'forgot_pass_identity' => $fp_code
                );
                $data = array(
                    'pass' => ($_POST['passwrd'])
                );
                $update = $user->update($data, $conditions);
                if($update){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.
                       <a href="./">Login</a>';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'You does not authorized to reset new password of this account.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
   $redirectURL = ($sessData['status']['type'] == 'success')?'NewPasswordSubmit':'NewPasswordSubmit?fp_code='.$fp_code;
    //redirect to the login/reset pasword page
    header("Location:".$redirectURL);
}