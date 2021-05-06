
<script src="things/js/bank/jquery.1.8.3.min.js"></script>
<script src="things/js/bootstrap.min.js"></script>


<link href="things/css/livechat.css" rel="stylesheet" id="bootstrap-css">
<link href="things/css/Uchat.css" rel="stylesheet" id="bootstrap-css">












<style>
 .openChat {
      display: none;
      position: center;
      z-index: 9;
   }
    
.card {
    position: fixed; 
    bottom: 0; 
    right: 0; width: 300px;
    margin: 40px; margin-bottom: 0;
    font-size: 13px;}   

@media screen and (max-width: 735px) {
  .messages {
    max-height: calc(100% - 105px);
  }
}
.messages::-webkit-scrollbar {
  width: 8px;
  background: transparent;
}
.messages::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
}
.messages ul li {
  display: inline-block;
  clear: both;
  float: left;
  margin: 15px 15px 5px 15px;
  width: calc(100% - 25px);
  font-size: 0.9em;
}
.messages ul li:nth-last-child(1) {
  margin-bottom: 20px;
}
.messages ul li.sent img {
  margin: 6px 8px 0 0;
}
.messages ul li.sent p {
  background: #435f7a;
  color: #f5f5f5;
}
.messages ul li.replies img {
  float: right;
  margin: 6px 0 0 8px;
}
.messages ul li.replies p {
  background: #f5f5f5;
  float: right;
}
.messages ul li img {
  width: 22px;
  border-radius: 50%;
  float: left;
}
.messages ul li p {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 20px;
  max-width: 205px;
  line-height: 130%;
}
@media screen and (min-width: 735px) {
  .messages ul li p {
    max-width: 300px;
  }
}
    
 .wrap img {
  width: 50px;
  border-radius: 50%;
  padding: 3px;
  border: 2px solid #e74c3c;
  height: auto;
  float: left;
  cursor: pointer;
  -moz-transition: 0.3s border ease;
  -o-transition: 0.3s border ease;
  -webkit-transition: 0.3s border ease;
  transition: 0.3s border ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap img {
    width: 40px;
    margin-left: 4px;
  }
}
.wrap img.online {
  border: 2px solid #2ecc71;
}
.wrap img.away {
  border: 2px solid #f1c40f;
}
.wrap img.busy {
  border: 2px solid #e74c3c;
}
 .wrap img.offline {
  border: 2px solid #95a5a6;
}
.wrap p {
  float: left;
  margin-left: 15px;
}
@media screen and (max-width: 735px) {
.wrap p {
    display: none;
  }
}    
</style> 






                                    
<div id="chatApp" >
<div class="chatBox openChat " id="chatBox" >
  <div class="card">

     <?php 
       $MY_ID = $rowUser['customer_id'];
       $admin = "0";
      if(isset($MY_ID)) { ?> 
     <?php
					include ('../sources/Uchateng.php');
					$chat = new Chat();
					$loggedUser = $chat->getUserDetails($MY_ID);
                    $currentSession = $admin;
					
					?>
      
<header class="card-header header-title" @click="toggleChat()">   
  <p class="card-header-title" >
      <?php
					echo '<ul>';
					$chatUsers = $chat->chatUsers($MY_ID);
					foreach ($chatUsers as $user) {
						$status = 'offline';						
						if($user['online']) {
							$status = 'online';
						}
						$activeUser = '';
						if($user['customer_id'] == $currentSession) {
							$activeUser = "active";
						}
						echo '<li id="'.$user['customer_id'].'" class="contact '.$activeUser.'" data-touserid="'.$user['customer_id'].'" data-tousername="'.$user['username'].'">';
						echo '<div class="wrap">';
						echo '<span id="status_'.$user['customer_id'].'" class="contact-status '.$status.'"></span>';
						echo '<img src="things/upload/'.$user['cust_photo'].'" alt="" style="border: 2px solid #2ecc71;" />';
						echo '<div class="meta">';
						echo '<p class="name">'.$user['cust_name'].'<span id="unread_'.$user['customer_id'].'" class="unread">'.$chat->getUnreadMessageCount($user['customer_id'], $MY_ID).'</span></p>';
						echo '<p class="preview"><span id="isTyping_'.$user['customer_id'].'" class="isTyping"></span></p>';
						echo '</div>';
						echo '</div>';
						echo '</li>';  
					}
					echo '</ul>';
					?>
    </p> 
    
<i class="glyphicon glyphicon-remove expand-button" aria-hidden="true" type="button" class="btn close"  onclick="closeForm()" style="float: right; margin: 15px"></i>

     <div id="profile">   </div>
    <p id="contacts" >     </p>
</header>
    
      
<div id="chatbox-area" style="background-color: antiquewhite;">
  <div class="card-content chat-content">
    <div class="content">
    <div class="messages here" id="conversation">		
					<?php
					echo $chat->getUserChat($MY_ID, $currentSession);						
					?>
    </div>
    </div>     
 </div>
</div> 
      
    
      
  
      
      
      
         <div style="width: 100%">
      	<div class="message-input" id="replySection">				
						<div class="message-input" id="replyContainer">
							<div class="wrap">
								<input type="text" class="chatMessage" id="mess" placeholder="Write your message..."  style="width: 100%" />
								<button   class="zip"   id="chatButton<?php echo $currentSession; ?>"><i class="glyphicon glyphicon-send" aria-hidden="true"></i> Send</button>
                                    <i class="forminfo"></i>
                                <i class="glyphicon glyphicon-chevron-up expand-button" aria-hidden="true" type="button" class="btn close"  onclick="closeForm()"  style="float: right; margin: 15px"></i>   
							</div>
						</div>
					</div>
             </div>
	<?php } else { ?>
		<br>
		<br>
			
	<?php } ?>
	<br>
      
</div>
</div>
</div>




  <script src="things/js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){  
    setInterval(function(){
      $(".here").load(" .here > *");
}, 3000);
    
$(".messages").animate({ 
		scrollTop: $(document).height() 
	}, "fast");    
    
$(document).on("click", '.zip', function(event) { 
    var frmdata = $(this).serialize();
    var account = $('#mess').val();
      $('#mess').val('');
    var toto = "0";
    if (account == '' ) {
		 $('.forminfo').fadeIn().html('<span style="background-color: #b2ff4f; color:red; font-size: 11px; padding: 5px; text-align: center; width: 100%;"> YOU MUST TYPE MESSAGE..</span>');
         $('.forminfo').delay(5000).fadeOut('slow');
	                   }
else{
    $.ajax({
		url:"things/sources/Uchat_S.php",
		method:"POST",
		data:{to_user_id:toto, chat_message:account, action:'insert_chat'},
		dataType: "json",
		success:function(response) {
			var resp = $.parseJSON(response);			
			$('#conversation').html(resp.conversation);				
			$(".messages").animate({ scrollTop: $('.messages').height() }, "fast");
		}
	});
  }
return false;
})
 
$(document).on('focus', '.message-input', function(){
		var is_type = 'yes';
		$.ajax({
			url:"things/sources/Uchat_S.php",
			method:"POST",
			data:{is_type:is_type, action:'update_typing_status'},
			success:function(){
			}
		}); 
	}); 
	$(document).on('blur', '.message-input', function(){
		var is_type = 'no';
		$.ajax({
			url:"things/sources/Uchat_S.php",
			method:"POST",
			data:{is_type:is_type, action:'update_typing_status'},
			success:function() {
			}
		});
	});  
    
    
   function showTypingStatus() {
	$('li.contact.active').each(function(){
		var to_user_id = $(this).attr('data-touserid');
		$.ajax({
			url:"things/sources/Uchat_S.php",
			method:"POST",
			data:{to_user_id:to_user_id, action:'show_typing_status'},
			dataType: "json",
			success:function(response){				
				$('#isTyping_'+to_user_id).html(response.message);			
			}
		});
	});
}
    

    
function updateUserList() {
	$.ajax({
		url:"chat_act.php",
		method:"POST",
		dataType: "json",
		data:{action:'update_user_list'},
		success:function(response){		
			var obj = response.profileHTML;
			Object.keys(obj).forEach(function(key) {
				// update user online/offline status
				if($("#"+obj[key].userid).length) {
					if(obj[key].online == 1 && !$("#status_"+obj[key].userid).hasClass('online')) {
						$("#status_"+obj[key].userid).addClass('online');
					} else if(obj[key].online == 0){
						$("#status_"+obj[key].userid).removeClass('online');
					}
				}				
			});			
		}
	});
}    
    
    
})
</script>
   