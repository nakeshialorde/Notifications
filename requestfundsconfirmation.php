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
</script>

<!DOCTYPE html>
<html class="fa-events-icons-ready">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <script src="https://use.fontawesome.com/5db033aace.js"></script>
    <link href="https://use.fontawesome.com/5db033aace.css" media="all" rel="stylesheet">
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- END UI UPDATE STYLES -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="javascript:window.history.back()"><i class="glyphicon glyphicon-menu-left"></i> </a></li>
                <li><a>Confirm Request </a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="javascript:location.reload();"><i class="fa fa-refresh theme-color-two"></i></a></li>-->
                <li><a href="home.php"><i class="fa fa-home"></i></a></li>
                <li><a><i class="fa fa-bars" id="toggle-menu"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="container spacer" style="">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="list-group">


<form id="requestForm" action="requestsuccessful.php" method="POST">

<input type="hidden" name="thirdPartyEmailAddress" value="<?php echo $_POST[" thirdPartyEmailAddress"]; ?>" />
<input type="hidden" name="thirdPartyAccountNumber" value="<?php echo $_POST[" thirdPartyAccountNumber"]; ?>" />
<input type="hidden" name="RequesteeAccountNumber" value="<?php echo $_POST[" RequesteeAccountNumber"]; ?>" />
<input type="hidden" name="amount" value="<?php echo $_POST[" amount"]; ?>" />
<input type="hidden" name="optional" value="optional" readonly>
<input type="hidden" name="requestsuccess" value="true" readonly>

											</div>

											<li class="list-group-item list-card list-card-slim">
											<label>Recipient </label>
											<p><?php echo $_POST["thirdPartyEmailAddress"]; ?></p>
											<p><?php echo $_POST["thirdPartyAccountNumber"]; ?></p>
											</li>

											<li class="list-group-item list-card list-card-slim">
											<label>Requesting Party by Account# </label>
											<p><?php echo $_POST["RequesteeAccountNumber"]; ?></p>


											<div class="form-group">
												<li class="list-group-item list-card list-card-slim">
													<label> Amount Requested*</label>
													<h2 class="theme-color-two" id ="amount" value = "amount">
													<?php echo $_POST["amount"]; ?></h2></p>
												</li>

												<li class="list-group-item list-card list-card-slim">
													<label>Charged Fees<i><span class="small text-light-grey">&nbsp;(2% of request amount.)</i></span></label>

												<script>
												var Fees = 0.02;
												var RequestedAmount = document.getElementById("amount");
												var amt = RequestedAmount.textContent;
												var totalFees = amt * Fees;
												totalFees = totalFees.toFixed(2);
												var totalAmount = amt - totalFees;
												totalAmount = totalAmount.toFixed(2);
												</script>

												</br><span id="totalFees"><h2 class="theme-color-two">$
												<script type ="text/javascript">document.write(totalFees);</script></h2>
												</span>

								</li>

                                <li class="list-group-item list-card list-card-slim">
                                    <label>Notes </label>
                                    <p><i><?php echo $_POST["optional"]; ?></i></p>
                                </li>

                                <li class="list-group-item list-card list-card-slim">
                                    <h6 class="theme-color-two">Request Summary **<?php echo $jsonResult->Description . " : " . $jsonResult->Description3; ?></h6>
                                    <div class="requestDetailRow">Request Amount: <span id="requestAmount" class="requestDetails theme-color-two">$<?php echo number_format($_POST["amount"], 2, '.', ''); ?></span></div>
                                    <div class="requestDetailRow">Request Fee: <span id="totalFees" class="requestDetails theme-color-two">$<script type ="text/javascript">document.write(totalFees);</script></span>
                                    <div class="requestDetailRow">You will receive: <span id="totalFees" class="requestDetails theme-color-two">$<script type ="text/javascript">document.write(totalAmount);</script></span>
                                </li>
								</br>
								<p class="description-sm">* The funds sent in response to this request will be deposited to your default account set in E-PAY. </p>
								<p class="description-sm">** This request is conditional on the third party accepting and processing the request.  </p>

                                <div id="scriptErrors"></div>

                                <div class="form-group">
                                    <?php
                                    if(isset($message)){
                                    echo "<div class='error'>" . $message . "</div>";
                                    }
                                    ?>
                                </div>
                </ul>

                <div class="form-group">
                    <div class="label"></div>
                    <a href="javascript:Cancel()" class="btn btn-danger linkButton cancelButton">Cancel</a>
                   <a id="requestSubmit" href="javascript:SubmitForm()" class="btn btn-success linkButton enabled">Request Funds</a>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <div class="footer"> &nbsp; </div>

<script>
$(document).ready(function(){
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"notifications/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.requestForm').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }

 load_unseen_notification();

 $('#requestform').on('submit', SubmitForm(){
  event.preventDefault();
  if($('#requestSubmit').val() != '' && $('#SubmitForm()').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#requestform')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("A notification will be sent to recipient!");
  }
 });

 $(document).on('click', '.requestForm', SubmitForm(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(SubmitForm(){
  load_unseen_notification();;
 }, 5000);

});
</script>


<script src="https://use.fontawesome.com/5db033aace.js"></script>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous">
 </script>

</body>
</html>
