<?php
	include "partials/header.php"; //include slideout menu
	include "partials/menu.php"; //include slideout menu
	include "partials/footer.php";//include footer
	include "notifications\FundsRequests_fetch.php"; //notifications
	include "notifications\FundsRequests_insert.php"; //notifications
	include "notifications\FundsRequests_comment.php"; //notifications
	include "notifications/link.js"; //notifications
	header (location: "notifications_index.php");
?>

<script type="text/javascript">
function getQueryStringValue (key) {
    return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

$(document).ready(function(){
  var thirdPartyEmailAddress = getQueryStringValue ('thirdPartyEmailAddress'); //Person who request is sent to
	var myAccountSelect = getQueryStringValue ('myAccountSelect'); //Person who request is sent to
	var RequesteeEmail = getQueryStringValue ('RequesteeEmail'); //recipient of request
	var RequesteeAccountNumber = getQueryStringValue ('RequesteeAccountNumber'); //recipient of request
  var myAccountSelect = getQueryStringValue ('myAccountSelect');
	var amount = getQueryStringValue ('amount');
	var recipientInfoType = getQueryStringValue ('recipientInfoType');
	var optional = getQueryStringValue ('optional');

  $('#thirdPartyEmailAddress').val(thirdPartyEmailAddress);
  $('#myAccountSelect').val(myAccountSelect);
	$('#myAccountControl').val(myAccountControl);
	$('RequesteeAccountNumber').val(RequesteeAccountNumber);
	$('#amount').val(amount);
  $('#recipientInfoType').val(recipientInfoType);
  $('#optional').val(optional);
});

var token = "<?php echo $_SESSION["token"]; ?>";

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
                                    .attr("href","http://cobadmin.azurewebsites.net/payment/payment-details.php?id="+data[i].id)/*need to adjust to the biller page
                                    .text(data[i].SourceAccount)
                            ),
                    $("<div></div>")
                            .addClass("BillerAccountNumber")
                            .text(data[i].BillerAccountNumber),
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
		$.ajax({
		        url:"http://desktop-8J8UQU0:998/api/FundsRequests",
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
		                    .addClass("FundsRequestID")
		                    .attr("FundsRequestID",data[i].id)
		                    .append(
		                        $("<div></div>")
		                            .addClass("RequesterUserID")
		                            .text(data[i].RequesterUserID),
		                        $("<div></div>")
		                            .addClass("RequesteeAccountNumber")
		                            .text(data[i].RequesteeAccountNumber),
																$("<div></div>")
																	 .addClass("RequesteeEmail")
																	 .text(data[i].RequesteeEmail),
															 $("<div></div>")
																	 .addClass("RequestedAmount")
																	 .text(data[i].RequestedAmount),
																	 $("<div></div>")
																			 .addClass("FundsRequestsStatusID")
																			 .text(data[i].FundsRequestsStatusID),
																	 $("<div></div>")
																			 .addClass("Created")
																			 .text(data[i].Created),
																			 $("<div></div>")
																					 .addClass("FundsRequestsChargeID")
																					 .text(data[i].FundsRequestsChargeID),
																			 $("<div></div>")
																					 .addClass("Updated")
																					 .text(data[i].Updated),
		                        $("<div></div>")
		                            .addClass("Notes")
		                            .text(data[i].Notes)
		                    )
		                    .appendTo("#FundsRequests");

		              var FundsRequestID = data[i];
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



<?php
include "partials/header.php";
 session_start();
    if(isset($_POST["ProcessPaymentDetails"])){
			header: ("location: transfersuccess.php");
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
                $("<RequestedAmount></RequestedAmount>")
                    .addClass("Account-SourceAccount")
                    .attr("Account-SourceAccount",data[i].id)
                    .append(
                        $("<RequestedAmount></RequestedAmount>")
                            .addClass("SourceAccount")
                            .append(
                                $("<a></a>")
                                    .attr("href","http://cobadmin.azurewebsites.net/payment/payment-details.php?id="+data[i].id)
                                    .text(data[i].SourceAccount)
                            ),
                        $("<RequestedAmount></RequestedAmount>")
                            .addClass("BillerAccountNumber")
                            .text(data[i].BillerAccountNumber),
			$("<RequestedAmount></RequestedAmount>")
                            .addClass("mobileCarrier")
                            .text(data[i].mobileCarrier),
			$("<RequestedAmount></RequestedAmount>")
                            .addClass("mobileAccount")
                            .text(data[i].mobileAccount),
                        $("<RequestedAmount></RequestedAmount>")
                            .addClass("PaymentAmount")
                            .text(data[i].PaymentAmount),
                        $("<RequestedAmount></RequestedAmount>")
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

	<html class="fa-events-icons-ready gr__e-solutionsgroup_com" style=""><head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,200" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://use.fontawesome.com/5db033aace.js"></script><link href="https://use.fontawesome.com/5db033aace.css" media="all" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
	</script>
	<script src="/js/transfer.js"></script>

	<!--STYLES FOR UI UPDATE -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" href="assets/css/modify-style.css">
	<link rel="stylesheet" href="assets/css/bs-custom-theme.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<!-- END UI UPDATE STYLES -->

<style id="__web-inspector-hide-shortcut-style__" type="text/css">
.__web-inspector-hide-shortcut__, .__web-inspector-hide-shortcut__ *, .__web-inspector-hidebefore-shortcut__::before, .__web-inspector-hideafter-shortcut__::after
{
    visibility: hidden !important;
}
</style>
</head>

<body data-gr-c-s-loaded="true">
<nav class="navbar navbar-default navbar-fixed-top" style="opacity: 1;">
	<div class="container">
		<ul class="nav navbar-nav">
			<li style="opacity: 1;"><a href="javascript:window.history.back()" style="opacity: 1;"><i class="glyphicon glyphicon-menu-left" style="opacity: 1;"></i> </a></li>
			<li style="opacity: 1;"><a href="javascript:preventDefault();" style="opacity: 1;"> Third Party Transfer </a></li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<!--<li><a href="javascript:location.reload();"><i class="fa fa-refresh theme-color-two"></i></a></li>-->
			<li style="opacity: 1;"><a href="home.php" style="opacity: 1;"><i class="fa fa-home"></i></a></li>
			<li style="opacity: 1;"><a href="menu.php" style="opacity: 1;"><i class="fa fa-bars"></i></a></li>

				<!-- NOTIFICATIONS -->
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item dropdown">
			<a class="nav-link" href="sendfunds.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-fw fa-bell-o"></i>

								<?php
                $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
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
              <div class="dropdown-RequestedAmountider"></div>
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

<form id="transferForm" action="transfer.php" method="POST">

<div class="container spacer" style="">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<ul class="list-group">
<li class="list-group-item list-card list-card-slim">
<label> Requesting Party: </label>
<div class="theme-color-two"> <p>
 <?php echo $_POST["RequesteeAccountNumber"]; ?></p>
</div>
</li>

<li class="list-group-item list-card list-card-slim">
												<label>Charged Fees<i><span class="small text-light-grey">&nbsp;(2% of request amount.)</i></span></label>
												<script>
												var Fees = 0.02;
												var RequestedAmount = document.getElementById("amount");
												var amt = RequestedAmount.textContent;
												var FundsRequestedChargeID = amt * Fees;
												FundsRequestedChargeID = FundsRequestedChargeID.toFixed(2);
												var totalAmount = amt - FundsRequestedChargeID;
												totalAmount = totalAmount.toFixed(2);
												</script>

												</br><span id="FundsRequestedChargeID"><h2 class="theme-color-two">$
												<script type ="text/javascript">document.write(FundsRequestedChargeID);</script></h2>
												</span>
												</li>


<li class="list-group-item list-card list-card-slim">
<label> <p><?php echo $_POST["RequesteeEmail"]; ?></p><p><?php echo $_POST["RequesteeAccountNumber"]; ?></p> will receive</label>
<p class="theme-color-two">$<span id="FundsRequestedChargeID" class="requestDetails theme-color-two"><script type ="text/javascript">document.write(totalAmount);</script></span> </p>
</li>

<li class="list-group-item list-card list-card-slim">
<label>Your account will be debited</label>
<p style="color:red"><script type ="text/javascript">document.write(RequestedAmount);</script>
</p>
</li>

<li class="list-group-item list-card list-card-slim">
<label>Balance after transaction</label>
<p class="theme-color-two"><span id="closingBalance" class="transDetails theme-color-two"></span></p>
</li>

</ul>
			<!--<RequestedAmount class="control" align="Left">
                  <RequestedAmount class="label"><h3 style="color:green;">Equivalent to:</h3></RequestedAmount>
                 <RequestedAmount class="control" align="left">
                    <RequestedAmount class="label"></RequestedAmount>
                    <table  width="100%" cellpadding="10" border="0">
					<tr bgcolor="#000000">
						<td style="text-align: left;" bgcolor="#ffffff"><h3 style="color:grey;">$1000.00</h3></td>
						<td style="text-align: right;" bgcolor="#ffffff">BDS</td>
					</tr>
			        <tr bgcolor="#000000">

						<td colspan="2" style="text-align: right;" bgcolor="#ffffff"><h3 style="color:grey;">Fee: $2.00BDS</h3></td>
					</tr>
					</table>
                </RequestedAmount>

			</RequestedAmount>-->

    <div class="form-group">
   	<div class="form-group">
    <div class="label"></div>
    <a href="javascript:Cancel()" class="btn btn-danger linkButton cancelButton">Cancel</a>
		<a id="transferSubmit" href="javascript:SubmitForm()" class="btn btn-success linkButton enabled">Transfer</a>
    </div>
		</div>
    </form>

    </div>
    </div>
    </div>

    <div class="footer">
            &nbsp;
    </div>

    </body>
    </html>

	<?php
	include "partials/header.php"; //include slideout menu
	include "partials/menu.php"; //include slideout menu
	include "partials/footer.php";//include footer
	include "notifications\FundsRequests_fetch.php"; //notifications
	include "notifications\FundsRequests_insert.php"; //notifications
	include "notifications\FundsRequests_comment.php"; //notifications
	include "notifications/link.js"; //notifications
?>
