


<?php


$whoto = $_POST['USER-ID'];

$seLInfo = $conn->query("select * from customer_info where customer_id = '" . $whoto . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
				       
						







// Message New Account 
$new_account_message = '<div style="padding: 9px;">
<table style="height: 1035px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 700px;">
<td style="height: 716px; width: 654px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
<td style="height: 192px; width: 650px;" valign="top"><img style="display: block;" src="'.$site_url.'/things/img/Bottom_Mortgage.jpg" alt="We are social" width="650" height="270" /></td>
</tr>
<tr style="height: 12px;">
<td style="height: 12px; width: 650px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="height: 483px; width: 576px;" border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 522px;">
<td style="height: 483px; width: 639px;" valign="top">
<p><span style="font-size: 18pt; color: #800080;">Hello '.$rowInfo['cust_name'] . ',</span></p>
<p>&nbsp;</p>
<p><span style="font-size: 12pt;">We&nbsp;have&nbsp;successfully&nbsp;registered and credited an account in</span><br /><span style="font-size: 12pt;">our&nbsp;</span><span style="font-size: 12pt;">data base,</span></p>
<p><span style="font-size: 12pt;">in order for you to&nbsp;complete&nbsp;the&nbsp;transfer&nbsp;into&nbsp;your&nbsp;own</span><br /><span style="font-size: 12pt;">personal&nbsp;bank&nbsp;account.&nbsp;&nbsp;Kindly&nbsp;note&nbsp;that&nbsp;a&nbsp;default&nbsp;username&nbsp;and</span><br /><span style="font-size: 12pt;">password&nbsp;&nbsp;</span><span style="font-size: 12pt;">has&nbsp;been&nbsp;created&nbsp;for&nbsp;you&nbsp;which&nbsp;can&nbsp;be&nbsp;changed&nbsp;in&nbsp;your&nbsp;personal</span><br /><span style="font-size: 12pt;">interest&nbsp;</span><span style="font-size: 12pt;">should&nbsp;you&nbsp;desire&nbsp;to.&nbsp;</span><span style="font-size: 12pt;">You&nbsp;can&nbsp;now&nbsp;processed&nbsp;with&nbsp;transfer&nbsp;activation.</span></p>
<p><span style="font-size: 12pt;">&nbsp; You&nbsp;are&nbsp;advice&nbsp;to&nbsp;use&nbsp;a&nbsp;PC&nbsp;or&nbsp;laptop&nbsp;computer&nbsp;&nbsp;to&nbsp;logon&nbsp;to&nbsp;our</span><br /><span style="font-size: 12pt;">portal&nbsp;</span><span style="font-size: 12pt;">for&nbsp;a&nbsp;better&nbsp;and&nbsp;swift&nbsp;browsing&nbsp;experience.&nbsp;&nbsp;</span></p>
<p><span style="font-size: 12pt;">kindly click on the</span><span style="font-size: 12pt;">link</span><span style="font-size: 12pt;"> link below to logon to  Life '.$site_name.' Online portal to complete your transfer </span></p>
<p>&nbsp;</p>
<p><span style="font-size: 14pt; color: #800080;">User&nbsp;ID: ' .$rowInfo['username'] . '</span><br /><span style="font-size: 14pt; color: #800080;">Password: '.$rowInfo['pass'] . '</span><br /><span style="font-size: 10pt; color: #333333;">Transfer&nbsp;Link:&nbsp;<a href="'.$site_url.'" >'.$site_url.'</a></span></p>
<p style="text-align: center;"><em><span>Please note that '.$site_name.' will</span></em><span>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span>for&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 91px; width: 654px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 89px; width: 654px;" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="31%">&nbsp;</td>
<td valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></td>
<td valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 654px;" valign="top">
<table style="width: 635px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank">'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';









// Trasction Reminder
$transaction_reminder = '<div style="padding: 9px;">
<table style="height: 998px; background-color: #e4f2ec; width: 675px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 700px;">
<td style="height: 719px; width: 671px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 182px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 167px;">
<td style="height: 167px; width: 646px;" bgcolor="#FFFFFF"><img src="'.$site_url.'/things/img/subHead_businessMan.jpg" width="680" height="180" border="0" /></td>
</tr>
<tr style="height: 15px;">
<td style="height: 15px; width: 646px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top" width="580">
<p><span style="font-size: 18pt; color: #800080;">Hello '.$rowInfo['cust_name'] . ',</span></p>
<p>&nbsp;</p>
<p><span style="font-size: 12pt;">Trust You are fine,</span></p>
<p><span style="font-size: 12pt;">This is to remined you that you still have a pending transaction with our bank&nbsp;</span></p>
<p><span style="font-size: 12pt;">and we advice you to make effect to complete your transaction, and Enjoy the&nbsp;</span><span style="font-size: 12pt;">special investment offer of the&nbsp;<strong><em>'.$site_name.'</em></strong></span></p>
<br />
<p><span style="font-size: 12pt;">Alternatively, you can chat with us via Whatsapp on&nbsp; '.$admin_phone.'&nbsp; &nbsp;or send an email to&nbsp;'.$admin_email.'</span></p>
<br />
<p><span style="font-size: 12pt;">Thank you for choosing '.$site_name.'.</span></p>
<br />
<p><em><span>Please note that '.$site_name.' will</span></em><span>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span>for&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 66px; width: 671px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 74px; width: 671px;" valign="top">
<table style="height: 54px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 54px;">
<td style="height: 54px; width: 31%;" valign="top" width="31%">&nbsp;</td>
<td style="height: 54px; width: 8%;" valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td style="height: 54px; width: 33.4903%;" valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank"><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
<td style="height: 54px; width: 27.5097%;" valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 671px;" valign="top">
<table style="height: 129px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 129px;">
<td style="height: 129px; width: 646px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank">'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';





// Mantainance
$system_maintenance = '<p>&nbsp;</p>
<div dir="auto">
<div>
<div class="gmail_quote"><br />
<div>
<div style="display: none; font-size: 0; line-height: 0;">&nbsp;</div>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 24px;" align="left">
<div style="line-height: 8px;">&zwnj;</div>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 8px;" width="127">
<p style="color: #888888; font-size: 12px; margin: 0;"><img src=" '.$site_url.'/things/img/logo.png" alt=" '.$site_name.' Logo" /></p>
</td>
<td style="padding: 0 8px;" align="right" width="421"><span style="color: #a5388d;"><a style="color: #5e2785; font-size: 12px; text-decoration: none;" href="'.$site_url.' " target="_blank" rel="noopener noreferrer"><strong style="color: #d10056; font-size: 13px;">WEBSITE</strong></a> </span> <a style="color: #5e2785; font-size: 12px; text-decoration: none;" href="'.$site_url.'" target="_blank" rel="noopener noreferrer"><strong> &nbsp;&nbsp; </strong></a> <strong><a style="color: #d10056;" href="'.$site_url.' " target="_blank" rel="noopener noreferrer">ONLINE BANKING</a></strong> <a style="color: #5e2785; font-size: 12px; text-decoration: none;" href="./#NOP"><strong> &nbsp;&nbsp; </strong></a> <span style="color: #f93386;"> <strong><a style="color: #d10056;" href=" '.$site_url.'/about-us/contact.php" target="_blank" rel="noopener noreferrer">CONTACT US</a></strong> </span></td>
</tr>
</tbody>
</table>
<div style="line-height: 8px;">&zwnj;</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 274.656px;">
<td style="background: linear-gradient(to left, #5e2785, #a5388d); height: 274.656px;" align="center" bgcolor="#A5388D">
<table style="width: 665px;" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 217.656px;">
<td style="height: 217.656px; width: 661px;">
<div style="line-height: 10px;">&nbsp;</div>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 135.656px;">
<td style="padding: 0px 20px; height: 235.656px;" align="center">
<h2 style="color: #ffffff; font-size: 52px; font-weight: 400; line-height: 100%; margin: 0;"><span style="color: #5e2785; font-family: Corbel; font-weight: bold; vertical-align: top; font-size: 30px; text-align: left; line-height: 40px; text-transform: none;"><img style="border-radius: 10px;" src="'.$site_url.'/things/img/system-maintenance-1-638.png" alt="System Maintenance" width="640" /></span></h2>
</td>
</tr>
</tbody>
</table>
<div style="line-height: 10px;">&nbsp;</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="640" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 24px;" align="left" bgcolor="#FFFFFF" width="638">
<table width="92%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 8px;" width="50">
<p style="color: #000000; font-size: 18px; font-weight: bold; margin: 0;">&nbsp;</p>
</td>
<td style="padding: 0 8px;" width="538">
<p><span style="color: #5e2785; font-size: 18px; font-weight: bold; margin: 0;">Dear '.$rowInfo['cust_name'] . ' ,</span></p>
<p style="margin-right: 0cm; margin-left: 0cm;"><span style="font-size: 11pt;"><span style="line-height: 16.5pt;"><span style="font-family: Calibri,sans-serif;"><span style="font-size: 12.0pt;"><span>To improve your experience on our electronic banking channels, please be informed that we will be running system maintenance Imidiately <strong></strong></span></span><span style="font-size: 12.0pt;"><span><span style="color: black;"><strong></strong></span></span></span><span style="font-size: 12.0pt;"><span>&nbsp;on <strong></strong>.</span></span></span></span></span></p>
<p style="margin-right: 0cm; margin-left: 0cm;"><span style="font-size: 11pt;"><span style="line-height: 16.5pt;"><span style="font-family: Calibri,sans-serif;"><span style="font-size: 12.0pt;">During this period, you will be unable to complete money transfers on our digital channels <strong>.</strong></span><span style="font-size: 12.0pt;"><span>&nbsp;However, you <span style="color: #000000;">can </span>carry out all other non-transfer transactions.</span></span></span></span></span></p>
<p style="margin-right: 0cm; margin-left: 0cm;"><span style="font-size: 11pt;"><span style="line-height: 16.5pt;"><span style="font-family: Calibri,sans-serif;"><span style="font-size: 12.0pt;"><span style="font-family: Calibri, sans-serif;"><span style="font-size: 12pt;">We sincerely </span><span style="font-size: 16px;">apologies</span><span style="font-size: 12pt;">&nbsp;for any inconvenience this may cause.</span></span></span></span></span></span></p>
<p style="margin-right: 0cm; margin-left: 0cm;"><span style="font-size: 11pt;"><span style="line-height: 16.5pt;"><span style="font-family: Calibri,sans-serif;"><span style="font-size: 12.0pt;"><span>Should you require assistance during this period, please call our 24/7 Contact Centre on '.$admin_phone.'; send an email to&nbsp;<u><a style="color: #0563c1; text-decoration: underline;" href="mailto:'.$admin_email.' "><span style="color: #5e2785;">'.$admin_email.'</span></a></u>&nbsp;or chat with us on WhatsApp via <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank">'.$admin_phone.'</a> .</span></span></span></span></span></p>
<p style="margin: 0cm; margin-right: 0cm; margin-left: 0cm;"><span style="font-size: 11pt;"><span style="font-family: Calibri,sans-serif;"><span style="font-size: 12.0pt;"><span>Thank you for choosing&nbsp; '.$site_name.'.</span></span></span></span></p>
</td>
</tr>
<tr>
<td style="padding: 0 8px;">&nbsp;</td>
<td style="padding: 0 8px;">&nbsp;</td>
</tr>
</tbody>
</table>
<div style="line-height: 24px;">&zwnj;</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 381.656px;">
<td style="height: 381.656px;">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="190">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE" height="22">&nbsp;</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="640" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 78px;">
<td style="padding: 0px 24px; height: 78px;" align="center" bgcolor="#FFFFFF"><span style="font-family: Corbel; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;"><span style="color: #3a3a3a;">If you have reason to suspect any unauthorised activity on your account<br style="font-family: Corbel;" />please contact us by sending an email to </span> <span style="font-family: Corbel; color: #ffb81c;">&nbsp;</span> '.$admin_email.'<br /><br /><span style="color: #5c068c;"><span style="color: #3a3a3a;">For more information on our products and services, please call our 24/7<br />contact centre on </span> <span style="color: #5c068c;"> '.$admin_phone.'</span> or&nbsp;<span style="color: #3a3a3a;">&nbsp;chat with us via<br />Whatsapp on <span style="color: #5c068c;"> <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank">'.$admin_phone.'</a></span>&nbsp;.<br /><span style="color: #3a3a3a;">Alternatively send an email to '.$admin_email.'</span>&nbsp;<span style="color: #5c068c;"><a style="color: #622387; text-decoration: underline;" href="mailto: '.$admin_email.' "><img width="1" height="1" /></a> </span> . </span></span></span><br />&nbsp;</td>
</tr>
<tr style="height: 62.6562px;">
<td style="padding: 0px 24px; height: 62.6562px;" align="center" bgcolor="#FFFFFF">
<table border="0" width="100%" cellspacing="5" cellpadding="5">
<tbody>
<tr>
<td style="color: #3a3a3a;" align="center"><a href="https://facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a> <a href="https://twitter.com/explore" target="_blank" rel="noopener noreferrer"> <img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a> <a href="https://linkedin.com/" target="_blank" rel="noopener noreferrer"> <img src=" '.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a> <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"> <img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" border="0" /></a> <a target="_blank"  href="https://wa.me/'.$admin_whatsapp.'" rel="noopener noreferrer"> <img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" border="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">&nbsp;</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">&nbsp;</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="640" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="left" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" bgcolor="#EEEEEE">
<table width="640" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 24px;" align="left" bgcolor="#FFFFFF">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0 8px;" align="right" width="120" height="44">
<p style="color: #888888;">&nbsp;</p>
</td>
<td style="padding: 0 8px;" align="center" width="324"><br /><span style="color: #888888; margin: 0;"><span style="font-family: Corbel; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;"><span style="color: #3a3a3a;">Copyright &copy; 2020. '.$site_name.'</span></span></span></td>
<td style="padding: 0 8px;" align="right" width="104">&nbsp;</td>
</tr>
</tbody>
</table>
<div style="line-height: 48px;">&zwnj;</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br />
<div>
<p style="font-size: 12px; line-height: normal; font-family: arial; text-align: center;">--<br /><a href="'.$site_url.'/contact-us/index.html">Click Here</a> to unsubscribe from this newsletter.<br /><br /></p>
</div>
<img src="'.$site_url.'/about-us/contact.php" border="0" /></div>
</div>
</div>
</div>
<div id="_rc_sig">&nbsp;</div>';










$birthday_wish_message = '<div style="padding: 9px;">
<table style="height: 1035px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 600px;">
<td style="height: 716px; width: 654px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
    <p><span style="font-size: 18pt; color: gray;">Hello '.$rowInfo['cust_name'] . ',</span></p>
    <p>&nbsp;</p>
<td style="height: 192px; width: 650px;" valign="top"><img style="display: block;" src="things/img/birthdaypics.jpg" alt="Birthday" width="800" height="568" /></td>
</tr>
<tr  align="center">
    <td valign="top" possition="center" width="50%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" ><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
      <p>&nbsp;</p>
      <p></p>
</tr>
    <td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7 contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><span style="color: #5c068c;"><span>  Whatsapp on  <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" >'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"></span><span style="color: #9297a3;"> Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span></td>
    
    <tr  align="center">
        <p></p>
             <td align="center"> <span  > Copyright &copy; 2020. '.$site_name.' </span></td>
    </tr>
</tbody>
</table>
</tr>
  </tbody>
</table>  
<p>&nbsp;</p>
<p></p>';
































// COMPOSE FOOT
$compose_head ='<div style="padding: 9px;">
<table style="height: 1035px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 600px;">
<td style="height: 716px; width: 654px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
<td style="height: 192px; width: 650px;" valign="top"><img style="display: block;" src="'.$site_url.'/things/img/subHead_map.jpg" alt="We are social" width="650" height="200" /></td>
</tr>
<tr style="height: 12px;">
<td style="height: 12px; width: 650px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="height: 483px; width: 576px;" border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 522px;">
<td style="height: 483px; width: 639px;" valign="top">
<p><span style="font-size: 18pt; color: #800080;">Hello '.$rowInfo['cust_name'] . ',</span></p>
<p>&nbsp;</p>
<p></p>';





$compose_foot ='<p style="text-align: center;"><em><span>Please note that '.$site_name.' will</span></em><span>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span>for&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 91px; width: 654px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 89px; width: 654px;" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="31%">&nbsp;</td>
<td valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" ><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
<td valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 654px;" valign="top">
<table style="width: 635px;" border="0" width="650" cellspacing="0" cellpadding="0" >
<tbody>
<tr>
<td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on  <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" >'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';


// MySQL Database Password

?>



