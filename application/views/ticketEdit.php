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
<script>
	/*  $(document).ready(function() {
		$("#Approve").click(function(event){
				var res=confirm("Are you sure ?");
				if(res)
				{
				var TicketNov = $("#TicketNo").val();
								var base_url = 'http://localhost/incident_management_system/index.php/dashboard/updateTicket/';
				$.ajax({  
				type: "POST",  
				 url: base_url, 
				 data: "TN="+ TicketNo,
				 success: function(response) {
							if(response=="fail")
							{
								window.location = "./dashboard/index"
								
							}
							else
							{
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system/assets/images/approved.jpg");
								//$('#body').html(data);
							}

					}
				});
				/* $.post( 
						base_url,
						{TN: TicketNov, },
						function(data) 
						{
							if(data=="fail")
							{
								window.location = "./dashboard/index"
								
							}
							else
							{
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system/assets/images/approved.jpg");
								//$('#body').html(data);
							}
							//alert(data);
						}
					); 
				}
		  });
	   }); */
	   
	</script>
	<script>
	 $(document).ready(function() {
		$("#Approve").click(function(event){
				var AssignedEngineer= $("#AssignedEngineer").val();
				/* if(AssignedEngineer=="None")
				{
					alert("Please select Engineer to resolve the ticket.");
					return false;
				} */
				
				var TN = $("#TicketNo").val();
				$.post( 
						"../updateTicket",
						{TicketNo:TN, Status: "Approved", Assigned: AssignedEngineer, },
						function(data) 
						{
							alert(data);
							$('#message').html('');
							if(data=="Approved")
							{
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system_new/assets/images/approved.jpg");
								$('#Approve').attr('disabled','disable');
								$('#message').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket approved!</h6></div>");
								$('#Reject').removeAttr('disabled');
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
							else
								$('#apdiv').html("Failed to update");
						}
					);
		  });
		  $("#Reject").click(function(event){
				var TN = $("#TicketNo").val();
				$.post( 
						"../updateTicket",
						{TicketNo:TN, Status: "Rejected",},
						function(data) 
						{	
							alert(data);
							$('#message').html('');
							if(data=="Rejected")
							{
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system_new/assets/images/rejected.jpg");
								$('#Reject').attr('disabled','disable');
								$('#ApprovalStatusMsg').html('<h4>Rejected</h4>');
								$('#message').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket rejected!</h6></div>");
								
								if($('#IsCommandCompliance').val()=="No")
									$('#ExceptionalApprove').removeAttr('disabled');
								else
									$('#Approve').removeAttr('disabled');
									
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
							else
								$('#apdiv').html("Failed to update");
						}
					);
		  });
		  $("#ExceptionalApprove").click(function(event){
				var TN = $("#TicketNo").val();
				var AssignedEngineer= $("#AssignedEngineer").val();
				
				$.post( 
						"../updateTicket",
						{TicketNo:TN, Status: "ExceptionalApproved", Assigned: AssignedEngineer,},
						function(data) 
						{
							alert(data);
							$('#message').html('');
							if(data=="ExceptionalApproved")
							{
								
								$('#message').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket has exceptionally approved!</h6></div>");
								$('#ApprovalStatusMsg').html('<h4>Approved with Exception!</h4>');
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system_new/assets/images/exceptionalapproved.png");
								$('#ApprovalStatus').attr('width','100');
								$('#ApprovalStatus').attr('height','100');
								$('#ExceptionalApprove').attr('disabled','disable');
								$('#Reject').removeAttr('disabled');
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
							else
								$('#apdiv').html("Failed to update");
						}
					);
		  });
	   });
	</script>


</head>
<body>
<div id="dialog-confirm" title="Confirm ticket details?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div id="container" style="margin-left:10%;margin-right:13%;">
	<div class="container-fluid">
		<legend><?php echo $title; ?>
				<?php echo $message; ?>
		</legend>
		<div style="margin-left:20px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
		<div class="row-fluid">
			<div class="span1"></div>
			<div class="span1">
				<?php if($Ticket->ApprovalStatus=="ExceptionalApproved")
						echo "<span id='ApprovalStatusMsg'><h4>Approved with exception!</h4></span>";
					else
					if($Ticket->ApprovalStatus=="Approved")
						echo "<span id='ApprovalStatusMsg'><h4>Approved!</h4></span>";
					else
					if($Ticket->ApprovalStatus=="Pending")
						echo "<span id='ApprovalStatusMsg'><h4>Pending!</h4></span>";
					else
					if($Ticket->ApprovalStatus=="Rejected")
						echo "<span id='ApprovalStatusMsg'><h4>Rejected!</h4></span>";
						?>
			</div>
			<div class="span2">
				<div id="result">
					<?php if($Ticket->ApprovalStatus=="Pending")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."assets/images/Pending.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Approved")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."assets/images/approved.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Rejected")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."assets/images/rejected.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="ExceptionalApproved")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."assets/images/ExceptionalApproved.png' width='100px' height='100px'></div>";?>
						
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
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/open.jpg' width='100px' height='100px'></div>";
						else
						if($Ticket->TicketStatus=="Closed")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/closed.jpg' width='100px' height='100px'></div>";
						else
						if($Ticket->TicketStatus=="Resolved")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/Resolved.png' width='100px' height='100px'></div>";
						else
						if($Ticket->TicketStatus=="Update")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/Update.png' width='100px' height='100px'></div>";
						
						?>
				</div><br/><br/>
			</div>
			<div class="span3">
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
								<label class="control-label">Assigned engineer : <span style="font-size:12pt;font-weight:bold;"><?php echo strcmp($Ticket->Assigned,"")==0?"None":$Ticket->Assigned; ?></span></label>
							</a>
						</div>
						<!--<div id="collapseOne" class="accordion-body collapse in">
							<div class="accordion-inner">
								<select autofocus name="AssignedEngineer" id="AssignedEngineer" >
										<option selected="selected">None</option>
										<?php //echo $EngineerDetailsOption; ?>
								</select>
							</div>
						</div>-->
					</div>
					<!--<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
								Engineers detail
							</a>
						</div>
						<div id="collapseTwo" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php echo $EngineerDetails; ?>
							</div>
						</div>
					</div>-->
				</div>
			</div>
			<div class="span1"></div>
		</div>
		<div class="row-fluid">
				<div class="span1"></div>
				<div class="span9">
					<div id="message"></div>
				</div>
				<div class="span2"></div>
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
							<div class="span6">
								<input type="text" name="TicketNo" disabled="disable" class="text" value="<?php echo $Ticket->TicketNo; ?>"/></td>
								<input type="hidden" id="TicketNo" value="<?php echo $Ticket->TicketNo; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Ticket status:</label>
							</div>
							<div class="span6">
								<input type="text" name="TicketStatus" disabled="disable" class="text" value="<?php echo $Ticket->TicketStatus; ?>"/>
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
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label">Issue description:<span style="color:red;">*</span></label>
							</div>
							<div class="span9">
								<textarea disabled="disable" style="width:95%;" name="IssueDescription" id="IssueDescription"><?php echo $Ticket->IssueDescription; ?></textarea>
								<div style="color:red;" id="IssueDescriptionError"></div>
							</div>
							<div class="span1"></div>
						</div>
					</div>
				</div>	
				
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label">Commands:<span style="color:red;">*</span></label>
							</div>
							<div class="span9">
								<div class="row-fluid">
									<div class="span12">
										<div class="accordion" id="accordion4">
											<div class="accordion-group" style="margin-right:20px;">
												<div class="accordion-heading">
													<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseThree">
														<label class="control-label">Commands</label>
													</a>
												</div>
												<div id="collapseThree" class="accordion-body collapse in">
													<div class="accordion-inner" style="margin-right:0px;">
														<?php echo $Ticket->CommandsCompliance; ?>
														<div style="color:red;" id="CommandsError"></div>
													</div>
												</div>
											</div>
										</div>							
									</div>								
								</div>
							</div>
							<div class="span1">
							<input type="hidden" id="IsCommandCompliance" value="<?php echo $Ticket->IsCommandCompliance;?>"/>
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
							<div class="span1"></div>
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
							<div class="span1"></div>
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
								<input type="text" name="CreatedDatetTime" disabled="disable" class="text" value="<?php echo $Ticket->CreatedDateTime; ?>"/>								
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
					<div class="span3">
						<div class="input-prepend">
							<div class="btn-group">
							<?php 
							if (strpos($Ticket->CommandsCompliance,'No') !== false) 
								echo '<input type="button" class="btn btn-success btn-large" id="Approve" value="Approve" disabled/>';
							else
							{
								if(strcmp($Ticket->ApprovalStatus,"Approved")==0)
									echo '<input type="button" class="btn btn-success btn-large" id="Approve" value="Approve" disabled/>';
								else
									echo '<input type="button" class="btn btn-success btn-large" id="Approve" value="Approve"/>';
							}
							?>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="input-prepend">
							<div class="btn-group">
							<?php 
							if(strcmp($Ticket->ApprovalStatus,"Rejected")==0)
								echo '<input type="button" class="btn btn-danger btn-large" id="Reject" value="Reject" disabled/>'; 
							else
								echo '<input type="button" class="btn btn-danger btn-large" id="Reject" value="Reject"/>';?>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="input-prepend">
							<div class="btn-group">
								<?php if (strpos($Ticket->CommandsCompliance,'No') !== false) 
									{
										if(strcmp($Ticket->ApprovalStatus,"ExceptionalApproved")==0)
											echo '<input type="button" class="btn btn-warning btn-large" id="ExceptionalApprove" value="Exceptional approve" disabled/>';
										else
											echo '<input type="button" class="btn btn-warning btn-large" id="ExceptionalApprove" value="Exceptional approve"/>';
									}
									else
										echo '<input type="button" class="btn btn-warning btn-large" id="ExceptionalApprove" value="Exceptional approve" disabled/>';
								?>
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
		</div>
		<div style="margin-left:40px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
	</div>
	

	
