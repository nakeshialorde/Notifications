<?php
/*include "partials/header.php";

   session_start();


    if(isset($_POST["ProcessPaymentDetails"])){
			header: ("location: index.php");
        $data=array(
            "thirdPartyEmailAddress"=>$_POST['SourceAccount'],
						"thirdPartyAccountNumber"=>$_SESSION['biller-account-num'],
            "amount"=> $_POST['orderNumber'],
						"amount"=> $_POST['orderNumber'],
						"amount"=> $_POST['orderNumber'],
						"amount"=> $_POST['orderNumber'],
           //"Notes"=>$_POST['Notes'] // TO be checked not in API
        );
        $jsonData = json_encode($data);

        $ch = curl_init('https://e-solutionsgroup.com:8010/api/BillPayment/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Bearer ' . $_SESSION["token"])
        );

        PHP_Timer::start();
        $postResult = curl_exec($ch);
        $time = PHP_Timer::stop();

        $jsonPostResult = json_decode($postResult);
        if($jsonPostResult->Successful){
            $_SESSION["BillPaymentMessage"] = $jsonPostResult->Message;
            $_SESSION["tempTransactionID"] = $jsonPostResult->TransactionID;
            $_SESSION["temporderNumber"] = $_POST["orderNumber"];
            header("Location: paymentsuccess.php");
        }
       else{
          $message = $jsonPostResult->Message;
         // $message = "The was an error processing this payment";
       }


        //Testiing CODE - neeeds to be updated removed once above section is uncommented and moved to server
        function randomNumber($length) {
            $result = '';

            for($i = 0; $i < $length; $i++) {
                $result .= mt_rand(0, 9);
            }

            return $result;
        }
    }*/
?>

<script type="text/javascript">
/*function getQueryStringValue (key)
{
    return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

$(document).ready(function(){
    var user_id = getQueryStringValue ('user_id');
    var notification_id = getQueryStringValue ('notification_id');

  	$('#user_id').val(user_id);
  	$('#notification_id').val(notification_id);
});

var token = "<?php //echo $_SESSION["token"]; ?>";

$.ajax({
        url:"https://e-solutionsgroup.com:8010/api/SourceAccounts",
        crossDomain:true,
        dataType:'json',
        cache:false,
        contentType:"application/json; charset=utf-8",
        beforeSend:function(xhr){
            xhr.setRequestHeader("Authorization","Bearer "+token);
        },
        success:function(data){
            for(i=0;i<data.length;i++){
                $("<div></div>")
                    .addClass("Account-SourceAccount")
                    .attr("Account-SourceAccount",data[i].id)
                    .append(
                        $("<div></div>")
                            .addClass("SourceAccount")
                            .append(
                                $("<a></a>")
                                    .attr("href","http://cobadmin.azurewebsites.net/payment/payment-details.php?id="+data[i].id)
                                    .text(data[i].SourceAccount)
                            ),
                        $("<div></div>")
                            .addClass("BillerAccountNumber")
                            .text(data[i].BillerAccountNumber),
			$("<div></div>")
                            .addClass("mobileCarrier")
                            .text(data[i].mobileCarrier),
			$("<div></div>")
                            .addClass("mobileAccount")
                            .text(data[i].mobileAccount),
                        $("<div></div>")
                            .addClass("PaymentAmount")
                            .text(data[i].PaymentAmount),
                        $("<div></div>")
                            .addClass("Notes")
                            .text(data[i].Notes)
                    )
                    .appendTo("#payment-details");

                var sourceAccount = data[i];
                //build HTML output for source Account list

                sourceAccountHTML = $([
                '<option value="'+sourceAccount.AssociatedAccountID+'">',
                ' '+sourceAccount.Description3+' ',
                '</option>'
                ].join(""));

                $('#source-account-options').append(sourceAccountHTML);//Add the source accounts to drop down
                sourceAccountHTML= ''; //clear HTML output var
            }
        }
    });*/
</script>

<!DOCTYPE html>
<html class="fa-events-icons-ready">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<script src="https://use.fontawesome.com/5db033aace.js"></script><link href="https://use.fontawesome.com/5db033aace.css" media="all" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
	</script>
	<script src="/js/request.js"></script>
	<!--STYLES FOR UI UPDATE -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" href="assets/css/modify-style.css">
	<link rel="stylesheet" href="assets/css/bs-custom-theme.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<!-- END UI UPDATE STYLES -->
<link href="https://unpkg.com/ionicons@4.0.0/dist/css/ionicons.min.css"rel="stylesheet"/>

<link rel="stylesheet" id="coToolbarStyle" href="chrome-extension://cjabmdjcfcfdmffimndhafhblfmpjdpe/toolbar/styles/placeholder.css" type="text/css"><script type="text/javascript" id="cosymantecbfw_removeToolbar">(function () {				var toolbarElement = {},					parent = {},					interval = 0,					retryCount = 0,					isRemoved = false;				if (window.location.protocol === 'file:') {					interval = window.setInterval(function () {						toolbarElement = document.getElementById('coFrameDiv');						if (toolbarElement) {							parent = toolbarElement.parentNode;							if (parent) {								parent.removeChild(toolbarElement);								isRemoved = true;								if (document.body && document.body.style) {									document.body.style.setProperty('margin-top', '0px', 'important');								}							}						}						retryCount += 1;						if (retryCount > 10 || isRemoved) {							window.clearInterval(interval);						}					}, 10);				}			})();</script>

<style>
.navbar-nav mr-auto
{
  list-style: none;
}
</style>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="javascript:window.history.back()"><i class="glyphicon glyphicon-menu-left"></i> </a></li>
			<li><a>Notifications</a></li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<!--<li><a href="javascript:location.reload();"><i class="fa fa-refresh theme-color-two"></i></a></li>-->
			<li><a href="home.php"><i class="fa fa-home"></i></a></li>
          		<li><a><i class="fa fa-bars" id="toggle-menu"></i></a></li>

					<!-- NOTIFICATIONS -->
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item dropdown">
   			<a class="nav-link" href="notifications_index.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	   			<i class="fa fa-fw fa-bell-o"></i>

				<?php
                $query = "SELECT * from `FundsRequests` where `status` = 'unread' order by `date` DESC";
                if(count(fetchAll($query))
                ?>
                <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
              <?php
                }
                    ?>
              </a>

		<div class="dropdown-menu" aria-labelledby="dropdown01">
                <?php
                $query = "SELECT * from `notifications` order by `date` DESC";
                 if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
                ?>
              <a style ="
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" href="view.php?id=<?php echo $i['id'] ?>">
                <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php

                if($i['type']=='comment'){
                    echo "Someone commented on your post.";
                }else if($i['type']=='like'){
                    echo ucfirst($i['name'])." liked your post.";
                }

                  ?>
                </a>
              <div class="dropdown-divider"></div>
                <?php
                     }
                 }else{
                     echo "No Records yet.";
                 }
                     ?>
            </div>
          </li>
        </ul>

<!-- END OF NOTIFICATIONS -->
		</ul>
	</div>
</nav>

<div class="container spacer">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="row" style="margin-top:20px;">
	            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	                    <ul id="notifications" class="list-group">
	                        <!--Notification List loads here -->
	                    <li class="list-group-item list-card unread personal">    <p style="display:inline-block; width:85%" class="status-dot single-line">       <i class="fa fa-exclamation-circle" aria-hidden="true"></i> COB Monthly Update to all members and staff </p>       <a href="readnotification.php?message_id=43901940319414">           <p style="width:5%; display:inline-block; float:right;"><span class="pull-right" style="cursor:pointer;"><i class="glyphicon glyphicon-menu-right theme-color-two"></i></span>           </p>       </a>    <p class="text-light-grey"> 60 Days ago</p></li><li class="list-group-item list-card unread personal">    <p style="display:inline-block; width:85%" class="status-dot single-line">       <i class="fa fa-exclamation-circle" aria-hidden="true"></i> COB Customer Appreciation Day </p>       <a href="readnotification.php?message_id=4390194523223">           <p style="width:5%; display:inline-block; float:right;"><span class="pull-right" style="cursor:pointer;"><i class="glyphicon glyphicon-menu-right theme-color-two"></i></span>           </p>       </a>    <p class="text-light-grey"> 32 Days ago</p></li><li class="list-group-item list-card read personal">    <p style="display:inline-block; width:85%" class="status-dot single-line">       <i class="fa fa-circle" aria-hidden="true"></i> Funds Request From John Doe </p>       <a href="readnotification.php?message_id=43903419414">           <p style="width:5%; display:inline-block; float:right;"><span class="pull-right" style="cursor:pointer;"><i class="glyphicon glyphicon-menu-right theme-color-two"></i></span>           </p>       </a>    <p class="text-light-grey"> 53 Days ago</p></li><li class="list-group-item list-card read general">    <p style="display:inline-block; width:85%" class="status-dot single-line">       <i class="fa fa-circle" aria-hidden="true"></i> Funds Request From Joe Bloggs  </p>       <a href="readnotification.php?message_id=4397856585876567">           <p style="width:5%; display:inline-block; float:right;"><span class="pull-right" style="cursor:pointer;"><i class="glyphicon glyphicon-menu-right theme-color-two"></i></span>           </p>       </a>    <p class="text-light-grey"> 56 Days ago</p></li><li class="list-group-item list-card read general">    <p style="display:inline-block; width:85%" class="status-dot single-line">       <i class="fa fa-circle" aria-hidden="true"></i> Funds Request From George Pile </p>       <a href="readnotification.php?message_id=42131312319414">           <p style="width:5%; display:inline-block; float:right;"><span class="pull-right" style="cursor:pointer;"><i class="glyphicon glyphicon-menu-right theme-color-two"></i></span>           </p>       </a>    <p class="text-light-grey"> 23 Days ago</p></li></ul>
	            </div>
	        </div>
	    </div>


	    <div id="notification-filter" style="" class="row">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                    <div class="btn-group btn-group-justified secondary-link">
	                            <div class="btn-group"><button id="all" class="btn btn-sm btn-link focused"> All</button></div>
	                            <div class="btn-group"><button id="filter-personal" class="btn btn-sm btn-link"> Personal </button></div>
	                            <div class="btn-group"><button id="filter-general" class="btn btn-sm btn-link"> General </button></div>
	                            <div class="btn-group"><button id="filter-unread" class="btn btn-sm btn-link"> Unread</button></div>
	                    </div>
	            </div>
	    </div>


   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

<?php
	include "partials/header.php";
	include "partials/menu.php"; //include slideout menu
	include "partials/footer.php";//include footer
	include "notifications\FundsRequests_fetch.php"; //notifications
	include "notifications\FundsRequests_insert.php"; //notifications
	include "notifications\FundsRequests_comment.php"; //notifications
	include "notifications/link.js"; //notifications
?>

<script type="text/javascript">
		function getQueryStringValue (key) {
    return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

$(document).ready(function(){
  var Created = getQueryStringValue ('Created');
  var Updated = getQueryStringValue ('Updated');
	var FundsRequestsStatusID = getQueryStringValue ('FundsRequestsStatusID');
	var FundsRequestID = getQueryStringValue ('FundsRequestID');
	var RequesterUserID = getQueryStringValue ('RequesterUserID');
  var RequesteeEmail = getQueryStringValue ('RequesteeEmail');
	var RequesteeAccountNumber = getQueryStringValue ('RequesteeAccountNumber');
	var RequestedAmount = getQueryStringValue ('RequestedAmount');
	var FundsRequestsChargeID = getQueryStringValue ('FundsRequestsChargeID');
	var optional = getQueryStringValue ('optional');

  $('#Created').val(Created);
  $('#Updated').val(Updated);
  $('#FundsRequestsStatusID').val(FundsRequestsStatusID);
  $('#FundsRequestID').val(FundsRequestID);
  $('#RequesterUserID').val(RequesterUserID);
	$('#RequesteeEmail').val(RequesteeEmail);
  $('#RequesteeAccountNumber').val(RequesteeAccountNumber);
  $('#amount').val(amount);
  $('#RequestedAmount').val(RequestedAmount);
	$('#FundsRequestsChargeID').val(FundsRequestsChargeID);
  $('#optional').val(optional);
});

var token = "<?php echo $_SESSION["token"]; ?>";

$.ajax({
        url:"http://desktop-2ofkvje:998/api/FundsRequests",
        crossDomain:true,
        dataType:'json',
        cache:false,
        contentType:"application/json; charset=utf-8",
        beforeSend:function(xhr){
            xhr.setRequestHeader("Authorization","Bearer "+token);
        },
        success:function(data){
            for(i=0;i<data.length;i++){
                $("<div></div>")
                    .addClass("RequesterUserID")
                    .attr("RequesterUserID",data[i].id)
                    .append(``
                        $("<div></div>")
                            .addClass("SourceAccount")
                            .append(
                                $("<a></a>")
                                    .attr("href","http://cobadmin.azurewebsites.net/payment/payment-details.php?id="+data[i].id)
																		.text(data[i].SourceAccount)
                            ),
                    $("<div></div>")
                            .addClass("BillerAccountNumber")
                            .text(data[i].BillerAccountNumber),
                        $("<div></div>")
                            .addClass("RequestedAmount")
                            .text(data[i].RequestedAmount),
                        $("<div></div>")
                            .addClass("optional")
                            .text(data[i].optional)
                    )
                    .appendTo("#notifications");

              var sourceAccount = data[i];
                //build HTML output for source Account list

                sourceAccountHTML = $([
                '<option value="'+sourceAccount.AssociatedAccountID+'">',
                ' '+sourceAccount.Description3+' ',
                '</option>'
                ].join(""));

                $('#source-account-options').append(sourceAccountHTML);//Add the source accounts to drop down
                sourceAccountHTML= ''; //clear HTML output var
            }
        }
    });
</script>
