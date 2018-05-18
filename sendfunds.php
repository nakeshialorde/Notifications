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
</style></head>
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

<div class="container spacer" style="">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  
<ul class="list-group">   
<li class="list-group-item list-card list-card-slim">
<label> Requesting Party </label>
<div class="theme-color-two"> <p><?php echo $_POST["thirdPartyEmailAddress"]; ?></p><p><?php echo $_POST["thirdPartyAccountNumber"]; ?></p> <span style="float:right"><?php echo $_POST["amount"]; ?></span></div>
</li>

<li class="list-group-item list-card list-card-slim">
<label>Charged Fees </label>
<br>
<div style="color:red"><span id="totalFees" class="requestDetails theme-color-two">$<script type ="text/javascript">document.write(totalFees);</script> </div><br>
<div> <input type="checkbox"> I will pay the charged fees </div>
</li>

<li class="list-group-item list-card list-card-slim">
<label> <p><?php echo $_POST["thirdPartyEmailAddress"]; ?></p><p><?php echo $_POST["thirdPartyAccountNumber"]; ?></p> will receive</label>
<p class="theme-color-two">$<span id="totalFees" class="requestDetails theme-color-two"><script type ="text/javascript">document.write(totalAmount);</script></span> </p>
</li>
					
<li class="list-group-item list-card list-card-slim">
<label>Your account will be debited</label>
<p style="color:red"> $1000.25 </p>
</li>
    
<li class="list-group-item list-card list-card-slim">
<label>Balance after transaction</label>
<p class="theme-color-two"></p>
</li>
					
</ul>
    
    
    
<form id="transferForm" action="transfer.php" method="POST">
		     

	

			
			

		
			
			

			
			


			
			
			<!--<div class="control" align="Left">
                  <div class="label"><h3 style="color:green;">Equivalent to:</h3></div>
                 <div class="control" align="left">
                    <div class="label"></div>
                    <table  width="100%" cellpadding="10" border="0">
					<tr bgcolor="#000000">
						<td style="text-align: left;" bgcolor="#ffffff"><h3 style="color:grey;">$1000.00</h3></td>
						<td style="text-align: right;" bgcolor="#ffffff">BDS</td>
					</tr>
			        <tr bgcolor="#000000">
						
						<td colspan="2" style="text-align: right;" bgcolor="#ffffff"><h3 style="color:grey;">Fee: $2.00BDS</h3></td>
					</tr>
					</table>
                </div>				
				
			</div>-->
			
			
    
    <div class="form-group">
        

					   	<div class="form-group">
                  <div class="label"></div>
                  <a href="javascript:Cancel()" class="btn btn-danger linkButton cancelButton">Cancel</a>
				  <a id="transferSubmit" href="javascript:SubmitForm()" class="btn btn-success linkButton enabled">Transfer</a>
            </div>
		</div></form>	  

</div>
</div>
</div>

<div class="footer">
        &nbsp;
</div>

</body></html>