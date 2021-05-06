
<?php


$whoto = $_POST['USER-ID'];

$seLInfo = $conn->query("select * from customer_info where customer_id = '" . $whoto . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
				          $custPass = $conn->query("select * from user_table where cust_id = '" . $whoto . "'") or die($conn->error);
						   $rowP = $custPass->fetch_assoc();


// Trasction Reminder
$transaction_reminder = '<div style="border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 6px; box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.6); padding: 10px;">
<div style="padding: 9px;">
<table style="height: 1258px; background-color: #e4f2ec; width: 675px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 953px;">
<td style="height: 888px; width: 671px;" valign="top" bgcolor="#FEFEFE">
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td bgcolor="#FFFFFF"><img src="'.$site_url.'/things/img/Onboarding.png" width="640" height="400" border="0" /></td>
</tr>
<tr>
<td>&nbsp;</td>
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
<p><span style="font-size: 12pt;">and we advice you to make effect to complete your transaction, and Enjoy the&nbsp;</span></p>
<p><span style="font-size: 12pt;">&nbsp;special investment offer of the&nbsp;<strong><em>'.$site_name.'</em></strong></span></p>
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
<td style="height: 91px; width: 671px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 114px; width: 671px;" valign="top">
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
<td style="height: 139px; width: 671px;" valign="top">
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on '.$admin_phone.'</span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>';


?>