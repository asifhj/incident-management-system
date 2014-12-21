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
	
<div id="container" style="margin-left:10%;margin-right:13%;">

	<div class="container-fluid">
		<legend><?php echo $title; ?>
				
		</legend>
		<div style="margin-left:20px;margin-bottom:20px;">
		<?php echo $link_back; ?></div>
		<div class="row-fluid">
			<div class="span1"></div>
			<div class="span1">
				<?php if($Ticket->ApprovalStatus=="ExceptionalApproved")
						echo "<h4>Approved with exception!</h4>";
					else
					if($Ticket->ApprovalStatus=="Approved")
						echo "<h4>Approved!</h4>";
					else
					if($Ticket->ApprovalStatus=="Pending")
						echo "<h4>Pending!</h4>";
					else
					if($Ticket->ApprovalStatus=="Rejected")
						echo "<h4>Rejected!</h4>";
						?>
			</div>
			<div class="span2">
				<div id="result">
					<?php if($Ticket->ApprovalStatus=="Pending")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/Pending.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Approved")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/approved.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Rejected")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/rejected.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="ExceptionalApproved")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/ExceptionalApproved.png' width='100px' height='100px'></div>";?>
						
				</div><br/><br/>
			</div>
			<div class="span1">
				<?php if($Ticket->TicketStatus=="Open")
						echo "<h4>Open Ticket!</h4>";
					else
						if($Ticket->TicketStatus=="Closed")
						echo "<h4>Closed Ticket!</h4>";
					else
						if($Ticket->TicketStatus=="Resolved")
						echo "<h4>Resolved Ticket!</h4>";
					else
					if($Ticket->TicketStatus=="Update")
						echo "<h4>Update Ticket!</h4>";?>
			</div>
			<div class="span2">
				<div id="result">
					<?php if($Ticket->TicketStatus=="Open")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/open.jpg' width='100px' height='100px'></div>";
						else
						if($Ticket->TicketStatus=="Closed")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/closed.jpg' width='100px' height='100px'></div>";
						else
						if($Ticket->TicketStatus=="Resolved")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/Resolved.png' width='75px' height='75px'></div>";
						else
						if($Ticket->TicketStatus=="Update")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/Update.png' width='100px' height='100px'></div>";
						
						?>
				</div><br/><br/>
			</div>
			<div class="span3">
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
								<label class="control-label">Assigned engineer</label>
							</a>
						</div>
						<div id="collapseOne" class="accordion-body collapse in">
							<div class="accordion-inner">
								<?php if(strcmp($Ticket->Assigned,"")==0)
									echo '<input type="text" name="Assigned" disabled="disable" class="text" value="None"/>';
								else
									echo '<input type="text" name="Assigned" disabled="disable" class="text" value="'.$Ticket->Assigned.'"/>';
								?>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="span1"></div>
		</div>
		
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span10">
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Ticket No:</label>
							</div>
							<div class="span8">
								<input type="text" name="TicketNo" disabled="disable" class="text" value="<?php echo $Ticket->TicketNo; ?>"/></td>
								<input type="hidden" id="TicketNo" value="<?php echo $Ticket->TicketNo; ?>"/>
							</div>
							
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Ticket status:</label>
							</div>
							<div class="span8">
								<input type="text" name="TicketStatus" disabled="disable" class="text" value="<?php echo $Ticket->TicketStatus; ?>"/>
							</div>
							
						</div>
						
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Employee ID:</label>
							</div>
							<div class="span6">
								<input type="text" name="EmployeeID" disabled="disable" class="text" value="<?php echo $Ticket->EmployeeID; ?>"/>
							
								<input type="hidden" name="EmployeeID" value="<?php echo $Ticket->EmployeeID; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Contact Number:</label>
							</div>
							<div class="span6">
								<input type="text" name="ContactNumber" disabled="disable" class="text" value="<?php echo $Ticket->ContactNumber; ?>"/>
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
								<label class="control-label">Requested Date: </label>
							</div>
							<div class="span6">
								<input type="text" name="RequestedDate" disabled="disable" class="text" value="<?php echo $Ticket->RequestedDate; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Severity: </label>
							</div>
							<div class="span6">
								<input type="text" name="Severity" disabled="disable" class="text" value="<?php echo $Ticket->Severity; ?>"/>
				
								<div style="color:red;" id="SeverityError"></div>
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
								<label class="control-label">Impact:</label>
							</div>
							<div class="span6">
								<input type="text" name="Impact" disabled="disable" class="text" value="<?php echo $Ticket->Impact; ?>"/>
								<div style="color:red;" id="ImpactError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Device:</label>
							</div>
							<div class="span6">
								<input type="text" name="Device" disabled="disable" class="text" value="<?php echo $Ticket->Device; ?>"/>
								<div style="color:red;" id="DeviceError"></div>
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
								<label class="control-label">Expected closure Date:<span style="color:red;">*</span></label>
							</div>
							<div class="span6">
								<input type="text" name="ExpectedClosureDate" disabled="disable" class="text" value="<?php echo $Ticket->ExpectedClosureDate; ?>"/>
				
								<div style="color:red;" id="ExpectedClosureDateError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							
							<div class="span4">
								<label class="control-label">Issue description:<span style="color:red;">*</span></label>
							</div>
							<div class="span6">
								<textarea disabled="disable" style="width:85%;" name="IssueDescription" id="IssueDescription"><?php echo $Ticket->IssueDescription; ?></textarea>
								<div style="color:red;" id="IssueDescriptionError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
				</div>	
				
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							
							<div class="span11">
								<div class="accordion" id="accordion3">
									<div class="accordion-group" style="margin-right:20px;">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo">
												<label class="control-label">Commands</label>
											</a>
										</div>
										<div id="collapseTwo" class="accordion-body collapse in">
											<div class="accordion-inner" style="margin-right:0px;">
												<?php echo $Ticket->CommandsCompliance; ?>
												<div style="color:red;" id="CommandsError"></div>
											</div>
										</div>
									</div>
								</div>							
							</div>
							<div class="span1">
							</div>
						</div>
					</div>
				</div>	
				
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label">Analysis:<span style="color:red;">*</span></label>
							</div>
							<div class="span9">								
								<textarea  disabled="disable" style="width:95%;" name="Analysis" id="Analysis"><?php echo $Ticket->Analysis; ?></textarea>
								
								<div style="color:red;" id="AnalysisError"></div>								
							</div>
						</div>
					</div>
				</div>	
				
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label">Remarks:<span style="color:red;">*</span></label>
							</div>
							<div class="span9">								
								<textarea  style="width:95%;" disabled="disable" name="Remarks" id="Remarks"><?php echo $Ticket->Remarks; ?></textarea>
								<div style="color:red;" id="RemarksError"></div>
							</div>
						</div>
					</div>
				</div>	
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Created Date Time:</label>
							</div>
							<div class="span6">
								<input type="text" name="CreatedDatetTime" disabled="disable" class="text" value="<?php echo $Ticket->CreatedDateTime; ?>"/></td>
								
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Modified Date Time:</label>
							</div>
							<div class="span6">
								<input type="text" name="ModifiedDateTime" disabled="disable" class="text" value="<?php echo $Ticket->ModifiedDateTime; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
				</div>
				
				<br/>
				<div class="row-fluid">
					<div class="span3">
					</div>					
					<div class="span6">
					<div class="span4">
						<div class="input-prepend">
							<div class="btn-group">
								<input type="button" disabled class="btn btn-success btn-large" id="Approve" value="Approve"/>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="input-prepend">
							<div class="btn-group">
								<input type="button" disabled class="btn btn-danger btn-large" id="Reject" value="Reject"/>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="input-prepend">
							<div class="btn-group">
								<input type="button" disabled class="btn btn-warning btn-large" id="Pending" value="Pending"/>
							</div>
						</div>
					</div>
					</div>
					<div class="span3">
					</div>				
				</div>
			</div>
			<div class="span1">
			</div>
		</div><br/><br/>
		<div style="margin-left:40px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
	</div>
	

	
		
	
