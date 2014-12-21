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
<div id="dialog-confirm" title="Confirm ticket details?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
	<div id="container">
		<form method="post" action="<?php echo $action; ?>" onsubmit="return confirm('Are you sure, you want to add this user details?');">
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
							<div class="span2">								
							</div>
							<div class="span8">
								<?php echo $message;?>
							</div>
							<div class="span2">								
							</div>
						</div>
						<div class="row-fluid">
							<div class="span6">
								<div class="span4">
									<label class="control-label">User Type: <span style="color:red;">*</span></label>
								</div>
								<div class="span6">
									<select autofocus name="UserType" id="UserType" >
										
										<option selected="selected">User</option>
										<option id="a">Admin</option>
										<option id="b">Engineer</option>										
									</select>
									<div style="color:red;" id="UserTypeError"></div>
								</div>
								<div class="span2">
								</div>
							</div>
							<div class="span6"></div>
						</div>
						<div class="row-fluid">
							<div class="span6">
								<div class="row-fluid">
									<div class="span4">
										<label class="control-label">EmployeeID: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="EmployeeID" class="text" value="<?php echo set_value('EmployeeID',$this->form_data->EmployeeID); ?>"/></td>
										<?php echo form_error('EmployeeID'); ?>
									</div>
									<div class="span2">
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<div class="span4">
										<label class="control-label">UserName: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="UserName" class="text" value="<?php echo set_value('UserName',$this->form_data->UserName); ?>"/>
										<?php echo form_error('UserName'); ?>
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
										<label class="control-label">FirstName: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="FirstName" class="text" value="<?php echo set_value('FirstName',$this->form_data->FirstName); ?>"/>
										<?php echo form_error('FirstName'); ?>
									</div>
									<div class="span2">
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<div class="span4">
										<label class="control-label">LastName: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="LastName" class="text" value="<?php echo set_value('LastName',$this->form_data->LastName); ?>"/>
										<?php echo form_error('LastName'); ?>
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
										<label class="control-label">Contact Number: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="ContactNumber" class="text" value="<?php echo set_value('ContactNumber',$this->form_data->ContactNumber); ?>"/>
										<?php echo form_error('ContactNumber'); ?>
									</div>
									<div class="span2">
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<div class="span4">
										<label class="control-label">Email: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="text" name="Email" class="text" value="<?php echo set_value('Email',$this->form_data->Email); ?>"/>
										<?php echo form_error('Email'); ?>
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
										<label class="control-label">Password: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="Password" name="Password" class="text" value="<?php echo set_value('Password',$this->form_data->Password); ?>"/>
										<?php echo form_error('Password'); ?>
									</div>
									<div class="span2">
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="row-fluid">
									<div class="span4">
										<label class="control-label">Conf Password: <span style="color:red;">*</span></label>
									</div>
									<div class="span6">
										<input type="Password" name="ConfirmPassword" class="text" value="<?php echo set_value('ConfirmPassword',$this->form_data->ConfirmPassword); ?>"/>
										<?php echo form_error('ConfirmPassword'); ?>
									</div>
									<div class="span2">
									</div>
								</div>	
							</div>
						</div>
						
						<div class="row-fluid">
							<div class="span4">
								
							</div>
							<div class="span4">
								<div class="row-fluid">
									<div class="span2">										
									</div>
									<div class="span4">
										<button class="btn btn-large btn-primary" id="submit" type="submit">Save</button>										
									</div>
									<div class="span4">
										<button class="btn btn-large btn" id="reset" type="reset">Reset</button>
									</div>
									<div class="span2">
									</div>
								</div>	
							</div>
							<div class="span4">
							</div>
						</div>
					</div>
				</div>
				<div class="span2">
				</div>
			</div>
		</form>
		<br />
		<div style="margin-left:40px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
		</form>
	</div>
		
		