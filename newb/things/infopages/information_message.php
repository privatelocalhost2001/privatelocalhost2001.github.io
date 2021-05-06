

 <?php
session_start();
include ('../sources/conn_auth.php');

if(isset($_GET['action'])){

$delinfo = $conn->query("delete from send_info where info_id = '" . $_GET['DELINFOID'] . "'") or die($conn->error);
header("location: portal");
}

$selLTrans = $conn->query("SELECT * FROM send_info WHERE info_id = '" . $_GET['INFO'] . "'") or die($conn->error);
				 $row = $selLTrans->fetch_assoc();
 ?>






 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php echo $row["info_sbj"] ?></title>
      <!-- Favicons -->
 <link href="things/img/favicon/favicon.png" class="fa fa-envelope" rel="apple-touch-icon">
 <link href="things/img/favicon/favicon.png" rel="icon">



<style>
    .sp_message_container {
        all: initial;
        font-family: inherit;

        * {
            line-height: initial !important;
            all: unset;
        }
    }

    .sp_veil {
        display: block;
        position: fixed;
        z-index: 10000;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        height: 100%;
        width: 100%;
        max-width: 100%;
        max-height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .sp_message_container {
        all: initial;
        font-family: inherit;

        * {
            line-height: initial !important;
            all: unset;
        }
    }

    .sp_message_container {
        position: relative;
        margin: auto;
        width: 100%;
        z-index: 10000;
        display: none;
    }

    .sp_message {
        margin: auto;
    }

    .sp_message .sp_message_content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .sp_message_container .sp_message_title {
        padding: 30px 30px 15px 30px;
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #606060;
        background-color: transparent;
    }

    .sp_message_container .sp_message_text {
        padding: 10px 30px 10px 30px;
        margin: 0;
        font-size: 14px;
        max-width: 800px;
        line-height: initial;
        color: #303030;
        overflow: auto;
    }

    .sp_message_container .sp_message_text p {
        margin: 0;
        padding: 0 0 8px;
    }

    .sp_message_body {
        background-color: transparent;
        padding: 0 0 20px;
        flex-grow: 1;
    }

    .sp_message .sp_message_panel {
        display: block;
        border: 1px solid #DDDDDD;
    }

    .sp_message .sp_message_frame {
        overflow: auto;
        padding: 10px;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#26000000', GradientType=1);
        /* IE6-9 fallback on horizontal gradient */
        background-color: #EEE
    }

    .sp_message_container .clearfix {
        clear: both;
    }

    .sp_message_row {
        display: flex;
        position: relative;
        background-color: #F4F4F4;
        width: 100%;
    }

    .sp_message_row::after {
        clear: both;
        content: "";
        display: block;
    }

    .sp_message button {
        border: 0 none;
        background-color: #3B7BB3;
        color: #FFF;
        font-size: 14px;
        padding: 8px 25px;
        float: right;
        margin: 0 15px 0 0;
    }

    .sp_message button:hover {
        background-color: #27669D;
        color: #FFF;
    }

    .sp_side_image {
        display: none;
        width: 50%;
        max-width: 212px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .sp_image_logo {
        display: block;
        margin: 0 auto 10px;
    }

    .sp_message .sp_choices {
        display: flex;
        padding: 10px;
        flex-direction: row;
        align-items: center;
        padding: 0px 30px 30px 30px;
    }

    .sp_message .sp_choices>iframe {
        border: 0 none;
        background: transparent;
        flex-grow: 1;
    }

    .sp_message .sp_choices>button {
        flex-grow: 0;
        font-weight: bold;
    }

    .sp_message .sp_message_dismiss {
        display: none;
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
        z-index: 1500;
        color: #666666;
        font-family: Verdana;
        font-size: 15px;
        font-weight: normal;
        font-style: normal;
        height: 22px;
        line-height: 20px;
        overflow: hidden;
        width: 22px;
        text-decoration: none;
        border: 0 none;
        outline: none;
        background: transparent;
        padding: 0;
    }

    .sp_message .sp_message_dismiss:hover {
        background-color: inherit;
    }

    .sp_message .sp_message_dismiss:outline {
        outline: none;
    }

    .sp_iframe_container {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 10000;
    }

    .sp_iframe_container iframe {
        width: 100%;
        height: 100%;
        border: 0 none;
    }

    .sp_message .sp_message_dismiss {
        display: block;
    }

    .sp_message_container,
    .sp_message {
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        position: fixed;
    }

    .sp_message {
        width: 50%;
        height: 50%;
        max-width: 650px;
        max-height: 300px;
    }

    @media screen and (max-width: 979px)

    /* Tablet */
        {
        .sp_message {
            width: 75%;
            height: 75%;
        }
    }

    @media screen and (max-width: 500px)

    /* Mobile */
        {
        .sp_message {
            width: 95%;
            height: 95%;
        }
    }

    .sp_veil {}

    .sp_message_container {
        border: 2px;
    }
</style>

<div class="sp_veil" style="display: block"></div>
<div id="sp_message_id" class="sp_message_container" style="display: block;">
    <div class="sp_message">
        <div id="sp_message_panel_id" class="sp_message_panel">
            <div class="sp_message_frame">
                <div class="sp_message_row"><button class="sp_message_dismiss" onclick="goBack()" >x</button>
                    <div class="sp_side_image sp_left_image sp_message_column"></div>
                    <div class="sp_message_column sp_message_content">
                        <div class="sp_message_body" id="sp_message_body_id">
                            <small><em><?php echo $row["info_date"] ?></em></small>
                            <div class="sp_message_title"><?php echo $row["info_sbj"] ?></div>
                            <div class="sp_message_text">

  <div><?php echo  $row["info_msg"] ?></div> 

               </div>
                        </div>
                        <div class="sp_choices">
                <script>document.write('<a href="' + document.referrer + '"><= Go Back</a>');</script>
                             </div>
                            <div >
    <li> <a class="position: right" bgcolor="#007EB6" style="color: red;" href="IMessage?action=delte info&DELINFOID=<?php echo $row['info_id']; ?>">delete message </a></li>
                            </div>
                       
                    </div>
                    <div class="sp_side_image sp_right_image sp_message_column"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

  



                    <script>
function goBack() {
  window.history.back();
}
</script>

  


