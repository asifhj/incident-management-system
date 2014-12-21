		<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

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

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin-left: 40px;
		margin-right:40px;
		margin-top:10px;
		margin-bottom:10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
</style>
</head>
<body>
		
<div id="container">
	<div class="container-fluid">
		<legend><?php echo $title; ?>
		
		</legend>
		<div style="margin-left:20px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
		<div class="row-fluid">
			<div class="span2">
			</div>
			<div class="span8">
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">EmployeeID:</label>
							</div>
							<div class="span6">
								<input type="text" name="EmployeeID" disabled="disable" class="text" value="<?php echo $User->EmployeeID; ?>"/>
								<input type="hidden" id="EmployeeID" value="<?php echo $User->EmployeeID; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">UserName:</label>
							</div>
							<div class="span6">
								<input type="text" name="UserName" disabled="disable" class="text" value="<?php echo $User->UserName; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>	
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">FirstName:</label>
							</div>
							<div class="span6">
								<input type="text" name="FirstName" disabled="disable" class="text" value="<?php echo $User->FirstName; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">LastName:</label>
							</div>
							<div class="span6">
								<input type="text" name="LastName" disabled="disable" class="text" value="<?php echo $User->LastName; ?>"/></td>
								<input type="hidden" id="LastName" value="<?php echo $User->LastName; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>	
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Contact Number:</label>
							</div>
							<div class="span6">
								<input type="text" name="Contact Number" disabled="disable" class="text" value="<?php echo $User->ContactNumber; ?>"/></td>
								<input type="hidden" id="Contact Number" value="<?php echo $User->ContactNumber; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Email:</label>
							</div>
							<div class="span6">
								<input type="text" name="Email" disabled="disable" class="text" value="<?php echo $User->Email; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>	
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Created Date and Time:</label>
							</div>
							<div class="span6">
								<input type="text" name="CreatedDateTime" disabled="disable" class="text" value="<?php echo $User->CreatedDateTime; ?>"/></td>
								<input type="hidden" id="CreatedDateTime" value="<?php echo $User->CreatedDateTime; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Modified Date and Time:</label>
							</div>
							<div class="span6">
								<input type="text" name="ModifiedDateTime" disabled="disable" class="text" value="<?php echo $User->ModifiedDateTime; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="span2">
			</div>
		</div>
		<br />
		
	</div>
	<div style="margin-left:40px;margin-bottom:20px;">
		<?php echo $link_back; ?>
	</div>
</div>