<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Incident Management System!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/icon.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
		
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
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
<!--<link href="../assets/css/style.css" rel="stylesheet" type="text/css">-->
<script src="<?php echo base_url();?>assets/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" />
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>	
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css" />

<style type="text/css" title="currentStyle">
	@import "<?php echo base_url();?>assets/css/demo_page.css";
	@import "<?php echo base_url();?>assets/css/demo_table.css";
</style>
<script>
$(document).ready(function() {
    $('#tickets').dataTable( {
        "sPaginationType": "full_numbers"
    } );
} );
</script>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url();?>index.php/dashboard">Incident Management System</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link" style="color:white;"><?php echo $UserName; ?></a>
			  &nbsp;&nbsp; |&nbsp;&nbsp;  <a href="<?php echo base_url();?>index.php/login/logout">Logout</a>
			  
            </p>
            <ul class="nav">
				<?php if($MenuHighlight=="Ticket")
				{
					echo '<li><a href="'.base_url().'index.php/dashboard/">Home</a></li>';
					echo '<li class="active"><a href="'.base_url().'index.php/dashboard/ticket">Ticket</a></li>';
					//if($UserType=="Admin")
						//echo '<li><a href="'.base_url().'index.php/user/">Users</a></li>';
				}else
				if($MenuHighlight=="Users")
				{
					echo '<li><a href="'.base_url().'index.php/dashboard/">Home</a></li>';
					echo '<li><a href="'.base_url().'index.php/dashboard/ticket">Ticket</a></li>';
					echo '<li class="active"><a href="'.base_url().'index.php/User/">Users</a></li>';
				}else
				{
					echo '<li class="active"><a href="'.base_url().'index.php/dashboard/">Home</a></li>';
					echo '<li ><a href="'.base_url().'index.php/dashboard/ticket">Ticket</a></li>';
					if($UserType=="Admin")
						echo '<li><a href="'.base_url().'index.php/User/">Users</a></li>';
				}?>
			 
				
				<li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<!--<div class="page-header" style="background-color:black;">
	
	<img src="../assets/images/title.gif" border="0" title="Incident Management System">
</div>-->

<br/>
