
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Incident Management System!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
	<script src="<?php echo base_url();?>assets/js/jquery-1.9.1.js"></script>
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	</style>
	 <script type="text/javascript" language="javascript">
	
	 /* $(document).ready(function() {
		 /* $("#submit").click(function(event){
				var username = $("#UserName").val();
				var password = $("#Password").val();
				if(username=="")
				{
					$('#msg').html("Cant be empty");
					//alert('hi');
					return false;
				}
				else
				if(password=="")
				{
					$('#msg').html("Cant be empty password");
					return false;
				}
				$.post( 
						"Login/login",
						{ UserName: username,Password: password, },
						function(data) 
						{
							if(data=='Player')
							{
								window.location = "./dashboard/index"
								
							}
							else
							{
								$('#msg').html(data);
							}
							//alert(data);
						}
					);
		  });
	   });*/
	   </script>
</head>


  <body>
	
	<div class="container">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<form class="form-signin" method="post" name="login" action="http://localhost/incident_management_system_new/index.php/login/check">
						<h2 class="form-signin-heading">Please sign in</h2>
						
						<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <?php echo $msg; ?>.
						</div>
						<label>User Name: </label><input type="text" id="UserName" name="UserName" class="input-block-level" placeholder="Email address"/>
						<label>Password: </label><input type="password" id="Password" name="Password" class="input-block-level" placeholder="Password"/>
						<button id="submit" class="btn btn-large btn-primary" type="submit">Sign in</button>
						<input type="reset" id="reset" class="btn btn-large btn-primary" name="reset"/>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- /container -->
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
