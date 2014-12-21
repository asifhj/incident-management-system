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
	$(function() {
		 $( "#datepicker1" ).datepicker({
			showOn: "button",
			buttonImage: "http://localhost/incident_management_system_new/assets/images/calendar.gif",
			format: 'Y-m-d',
			buttonImageOnly: true
		}); 
	});
	
	 $(document).ready(function() {
		$("#Update").click(function(event){
				var HostNamev= $("#HostName").val().trim();
				var HostIPAddressv= $("#HostIPAddress").val().trim();
				var Analysisv= $("#Analysis").val().trim();
				var Remarksv= $("#Remarks").val().trim();
				var Severityv = $("#Severity").val().trim();
				var Impactv = $("#Impact").val().trim();
				var ExpectedClosureDatev = $("#datepicker1").val().trim();
				var Commandsv = "";
				var lines = $("#Commands").val().trim().split('\n');
				for(var i = 0;i < lines.length;i++){
					//code here using lines[i] which will give you each line
					if(lines[i]!="")
					Commandsv = Commandsv+lines[i]+",";
				} 
				var Analysisv = $("#Analysis").val();
				var Remarksv = $("#Remarks").val();
				var EmployeeIDv = $("#EmployeeID").val();
				var Devicev=$('#Device').val();
				$('#SeverityError').html("");
				$('#ImpactError').html("");
				$('#DeviceError').html("");
				$('#ExpectedClosureDateError').html("");
				$('#IssueDescriptionError').html("");
				$('#CommandsError').html("");
				$('#AnalysisError').html("");
				$('#RemarksError').html(""); 
				$('#DeviceError').html(""); 
				$('#HostNameError').html(""); 
				$('#HostIPAddressError').html(""); 
				if(ExpectedClosureDatev=="")
				{
					$('#ExpectedClosureDateError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select ECD</h6></div>");
					return false;
				}
				else
				
				if(Devicev=="Please select device")
				{
					$('#DeviceError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Device.</h6></div>");
					return false;
				}
				else
				if(Impactv=="Please select Impact")
				{
					$('#ImpactError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Impact.</h6></div>");
					return false;
				}
				else
				if(Severityv=="Please select Severity")
				{
					$('#SeverityError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select severity.</h6></div>");
					return false;
				}
				else
				
				if($('#Commands').val()=="")
				{
					$('#CommandsError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Commands</h6></div>");
					
					return false;
				}
				else
				if(Analysisv=="")
				{
					$('#AnalysisError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter Analysis</h6></div>");
					return false;
				}
				else
				if(Remarksv=="")
				{
					$('#RemarksError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select remarks</h6></div>");
					return false;
				}
				else
				if(HostNamev=="" && HostIPAddressv=="" )
				{
					alert("Please enter HostName and HostIPAddress to update the ticket.");
					$("#HostNameError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostName</h6></div>");
					$("#HostIPAddressError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostIPAddress</h6></div>");
					return false;
				}
				else
				if(HostNamev=="")
				{
					alert("Please enter HostName to update the ticket.");
					$("#HostNameError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostName</h6></div>");
					return false;
				}
				else
				if(HostIPAddressv=="")
				{
					alert("Please enter HostIPAddress to update the ticket.");
					$("#HostIPAddressError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostIPAddress</h6></div>");
					return false;
				}
				
				var TN = $("#TicketNo").val();
				$('#dialog-confirm').html('<br/><b>Device: </b>'+Devicev+'<br/><b>Severity: </b>'+Severityv+
										  '<br/><b>Impact:  </b>'+Impactv+ '<br/><b>ExpectedClosureDate: </b>'+ExpectedClosureDatev+
										  '<br/><b>Commands: </b>'+Commandsv+ '<br/><b>HostName:  </b>'+HostNamev+
										  '<br/><b>HostIPAddress:  </b>'+HostIPAddressv+ '<br/><b>Analysis:  </b>'+Analysisv+
										  '<br/><b>Remarks:  </b>'+Remarksv);
				$('#message').html('');
				
				$(function() {
				$( "#dialog-confirm" ).dialog({
				  resizable: false,
				  height:250,
				  width:340,
				  modal: true,
				  buttons: {
					"Submit": function() {
					  $( this ).dialog( "close" );
					  $.post( 
							"../updateTicketEngineer",
							{TicketNo:TN, TicketStatus: "Update", Device: Devicev, Severity: Severityv, Impact: Impactv, ExpectedClosureDate: ExpectedClosureDatev, Commands: Commandsv, HostName: HostNamev, HostIPAddress: HostIPAddressv, Analysis: Analysisv, Remarks: Remarksv,},
							function(data) 
							{
								alert(data);
								$('#message').html('');
								if(data=="Update")
								{
									$('#TicketStatus').attr('src',"http://localhost/incident_management_system_new/assets/images/Update.png");
									$('#message').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket details updated!</h6></div>");
									location.reload(true);
									setTimeout($("html, body").animate({ scrollTop: 0 }, 500),1000000);
									//java.lang.Thread.sleep(1000000);
									
								}
								else
									$('#apdiv').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket update failed!</h6></div>");
							}
						);
					},
					Cancel: function() {
					  $( this ).dialog( "close" );
					}
				  } //buttons close
				});//dialog close
			  });//function close
			});// Update button close
			
		  $("#Resolved").click(function(event){
				var HostNamev= $("#HostName").val().trim();
				var HostIPAddressv= $("#HostIPAddress").val().trim();
				var Analysisv= $("#Analysis").val().trim();
				var Remarksv= $("#Remarks").val().trim();
				var Severityv = $("#Severity").val().trim();
				var Impactv = $("#Impact").val().trim();
				var ExpectedClosureDatev = $("#datepicker1").val().trim();
				var Commandsv = "";
				var lines = $("#Commands").val().trim().split('\n');
				for(var i = 0;i < lines.length;i++){
					//code here using lines[i] which will give you each line
					if(lines[i]!="")
					Commandsv = Commandsv+lines[i]+",";
				} 
				var Analysisv = $("#Analysis").val();
				var Remarksv = $("#Remarks").val();
				var EmployeeIDv = $("#EmployeeID").val();
				var Devicev=$('#Device').val();
				$('#SeverityError').html("");
				$('#ImpactError').html("");
				$('#DeviceError').html("");
				$('#ExpectedClosureDateError').html("");
				$('#IssueDescriptionError').html("");
				$('#CommandsError').html("");
				$('#AnalysisError').html("");
				$('#RemarksError').html(""); 
				$('#DeviceError').html(""); 
				$('#HostNameError').html(""); 
				$('#HostIPAddressError').html(""); 
				if(ExpectedClosureDatev=="")
				{
					$('#ExpectedClosureDateError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select ECD</h6></div>");
					return false;
				}
				else
				
				if(Devicev=="Please select device")
				{
					$('#DeviceError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Device.</h6></div>");
					return false;
				}
				else
				if(Impactv=="Please select Impact")
				{
					$('#ImpactError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Impact.</h6></div>");
					return false;
				}
				else
				if(Severityv=="Please select Severity")
				{
					$('#SeverityError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select severity.</h6></div>");
					return false;
				}
				else
				
				if($('#Commands').val()=="")
				{
					$('#CommandsError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Commands</h6></div>");
					
					return false;
				}
				else
				if(Analysisv=="")
				{
					$('#AnalysisError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter Analysis</h6></div>");
					return false;
				}
				else
				if(Remarksv=="")
				{
					$('#RemarksError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select remarks</h6></div>");
					return false;
				}
				else
				if(HostNamev=="" && HostIPAddressv=="" )
				{
					alert("Please enter HostName and HostIPAddress to update the ticket.");
					$("#HostNameError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostName</h6></div>");
					$("#HostIPAddressError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostIPAddress</h6></div>");
					return false;
				}
				else
				if(HostNamev=="")
				{
					alert("Please enter HostName to update the ticket.");
					$("#HostNameError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostName</h6></div>");
					return false;
				}
				else
				if(HostIPAddressv=="")
				{
					alert("Please enter HostIPAddress to update the ticket.");
					$("#HostIPAddressError").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter HostIPAddress</h6></div>");
					return false;
				}
				
				var TN = $("#TicketNo").val();
				$('#dialog-confirm').html('<br/><b>Device: </b>'+Devicev+'<br/><b>Severity: </b>'+Severityv+
										  '<br/><b>Impact:  </b>'+Impactv+ '<br/><b>ExpectedClosureDate: </b>'+ExpectedClosureDatev+
										  '<br/><b>Commands: </b>'+Commandsv+ '<br/><b>HostName:  </b>'+HostNamev+
										  '<br/><b>HostIPAddress:  </b>'+HostIPAddressv+ '<br/><b>Analysis:  </b>'+Analysisv+
										  '<br/><b>Remarks:  </b>'+Remarksv);
				$('#message').html('');
				
				$(function() {
				$( "#dialog-confirm" ).dialog({
				  resizable: false,
				  height:250,
				  width:340,
				  modal: true,
				  buttons: {
					"Submit": function() {
					    $( this ).dialog( "close" );
						$.post( 
						"../updateTicketEngineer",
						{
						TicketNo:TN, TicketStatus: "Resolved", Device: Devicev, Severity: Severityv, Impact: Impactv, ExpectedClosureDate: ExpectedClosureDatev, Commands: Commandsv, HostName: HostNamev, HostIPAddress: HostIPAddressv, Analysis: Analysisv, Remarks: Remarksv,
						},
						function(data) 
						{	
							alert(data);
							$('#message').html('');
							if(data=="Resolved")
							{
								$('#TicketStatus').attr('src',"http://localhost/incident_management_system_new/assets/images/resolved.png");
								$('#TicketStatus').attr('width',"100");
								$('#TicketStatus').attr('height',"100");
								$('#message').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket resolved!</h6></div>");
									
								$("html, body").animate({ scrollTop: 0 }, 500);
								$('#Update').removeAttr('disabled');
								$('#Resolved').removeAttr('disabled');
							}
							else
								$('#apdiv').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Ticket update failed!</h6></div>");
						}
					);
					},
					Cancel: function() {
					  $( this ).dialog( "close" );
					}
				  } //buttons close
				});//dialog close
			  });//function close
			});// Resolved button close
			});//JS close
	</script>


</head>
<body>
<div id="dialog-confirm" title="Confirm ticket details?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div id="container" style="margin-left:10%;margin-right:10%;">
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
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/open.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->TicketStatus=="Closed")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/closed.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->TicketStatus=="Resolved")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."assets/images/Resolved.png' width='200px' height='200px'></div>";
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
							<div class="span8">
								<input type="text" name="TicketNo" disabled="disable" class="text" value="<?php echo $Ticket->TicketNo; ?>"/></td>
								<input type="hidden" id="TicketNo" value="<?php echo $Ticket->TicketNo; ?>"/>
							</div>
							
						</div>
					</div>
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
				
				
				
				<div class="row-fluid">
					
					<div class="span12">
						<div class="row-fluid">
							
							<div class="span2">
								<label class="control-label">Issue description:<span style="color:red;">*</span></label>
							</div>
							<div class="span10">
								<textarea disabled="disable" rows="5" style="width:85%;" name="IssueDescription" id="IssueDescription"><?php echo $Ticket->IssueDescription; ?></textarea>
								<div style="color:red;" id="IssueDescriptionError"></div>
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
								<input type="text" id="datepicker1" style="width:70%;" value="<?php echo $Ticket->ExpectedClosureDate; ?>"/>
								<div style="color:red;" id="ExpectedClosureDateError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Device:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span6">
								<select autofocus name="Device" id="Device">
									
									<?php if(strcmp($Ticket->Device,"")==0)
									{
										echo '<option selected="selected">Please select device</option>';
										echo '<option id="a">Router</option>';
										echo '<option id="b">Firewall</option>';
									}
									else
									if(strcmp($Ticket->Device,"Router")==0)
									{
										echo '<option>Please select device</option>';
										echo '<option selected="selected" id="a">Router</option>';
										echo '<option id="b">Firewall</option>';
									}
									else
									if(strcmp($Ticket->Device,"Firewall")==0)
									{
										echo '<option>Please select device</option>';
										echo '<option id="a">Router</option>';
										echo '<option selected="selected" id="b">Firewall</option>';
									}
									?>
									
									
								</select>
								<div style="color:red;" id="DeviceError"></div>
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
								<select autofocus name="Impact" id="Impact">
									<?php if(strcmp($Ticket->Impact,"")==0)
									{									
										echo '<option selected="selected">Please select Impact</option>';
										echo '<option id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}else
									if(strcmp($Ticket->Impact,"Low")==0)
									{									
										echo '<option >Please select Impact</option>';
										echo '<option selected="selected" id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}else
									if(strcmp($Ticket->Impact,"Medium")==0)
									{									
										echo '<option>Please select Impact</option>';
										echo '<option id="a">Low</option>';
										echo '<option selected="selected" id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}
									else
									if(strcmp($Ticket->Impact,"High")==0)
									{									
										echo '<option>Please select Impact</option>';
										echo '<option id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option selected="selected" id="c">High</option>?>';
									}
									
									?>
								</select>
								<div style="color:red;" id="ImpactError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Severity:</label>
							</div>
							<div class="span6">
								<select autofocus name="Severity" id="Severity" >
									<?php if(strcmp($Ticket->Severity,"")==0)
									{									
										echo '<option selected="selected">Please select Severity</option>';
										echo '<option id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}else
									if(strcmp($Ticket->Severity,"Low")==0)
									{									
										echo '<option >Please select Impact</option>';
										echo '<option selected="selected" id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}else
									if(strcmp($Ticket->Severity,"Medium")==0)
									{									
										echo '<option>Please select Impact</option>';
										echo '<option id="a">Low</option>';
										echo '<option selected="selected" id="b">Medium</option>';
										echo '<option id="c">High</option>?>';
									}
									else
									if(strcmp($Ticket->Severity,"High")==0)
									{									
										echo '<option>Please select Impact</option>';
										echo '<option id="a">Low</option>';
										echo '<option id="b">Medium</option>';
										echo '<option selected="selected" id="c">High</option>?>';
									}
									
									?>
								</select>
								<div style="color:red;" id="SeverityError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span11">
					<div class="accordion" id="accordion3">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
									
										<label class="control-label"><b><?php if(!strcmp($Ticket->CommandsCompliance,"")==0) echo 'Commands compliance:';?></b><span style="color:red;"></span></label>
									
								</a>
							</div>
							<div id="collapseTwo" class="accordion-body collapse in">
								<div class="accordion-inner">
									
										<?php 
										if(!strcmp($Ticket->CommandsCompliance,"")==0) 
											echo $Ticket->CommandsCompliance; ?>
								</div>
							</div>
							</div>
						</div>
					</div>
					
					
					<div class="span1"></div>
					
				</div>
				<div class="row-fluid">
					<div class="span2">
						<label class="control-label"><b>Commands:</b><span style="color:red;"> *</span><br/><span style="color:grey;">One command per line.</span></label>
					</div>
			
					<div class="span9">
						<textarea style="width:95%;" rows="10" name="Commands" id="Commands"><?php $Commands=explode(',',$Ticket->Commands);foreach($Commands as $c)if(trim($c)!="")echo trim($c)."\n";?></textarea>
						
						<div style="color:red;" id="CommandsError"></div>
					</div>
					<div class="span1"></div>
					
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label">Analysis:<span style="color:red;">*</span></label>
							</div>
							<div class="span9">								
								<textarea  style="width:95%;" name="Analysis" id="Analysis"><?php echo $Ticket->Analysis; ?></textarea>
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
								<textarea  style="width:95%;" name="Remarks" id="Remarks"><?php echo $Ticket->Remarks; ?></textarea>
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
								<label class="control-label">Host Name:<span style="color:red;"> *</span></label>
							</div>
							<div class="span6">
								<input type="text" name="HostName" id="HostName"class="text" value="<?php echo $Ticket->HostName; ?>"/>
								<div style="color:red;" id="HostNameError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label">Host IP Address:<span style="color:red;"> *</span></label>
							</div>
							<div class="span6">
								<input type="text" name="HostIPAddress" id="HostIPAddress" class="text" value="<?php echo $Ticket->HostIPAddress; ?>"/>
								<div style="color:red;" id="HostIPAddressError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
				</div>
				<br/>
				<div class="row-fluid">
					<div class="span4">
					</div>					
					<div class="span4" >
						<div class="span6">
							<div class="input-prepend">
								<div class="btn-group">
								<?php 
								if (strcmp($Ticket->TicketStatus,"Closed") == 0 || strcmp($Ticket->TicketStatus,"Resolved") == 0 ) 
									echo '<input type="button" class="btn btn-large" id="Update" value="Update" disabled/>';
								else
									echo '<input type="button" class="btn btn-large" id="Update" value="Update"/>';
								
								?>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="input-prepend">
								<div class="btn-group">
								<?php 
								if (strcmp($Ticket->TicketStatus,"Closed") == 0 || strcmp($Ticket->TicketStatus,"Resolved") == 0 || strcmp($Ticket->ApprovalStatus,"Pending")==0)
									echo '<input type="button" class="btn btn-large" id="Resolved" value="Resolved" disabled/>';
								else
									echo '<input type="button" class="btn btn-success btn-large" id="Resolved" value="Resolved"/>';
								?>
								</div>
							</div>
						</div>
					</div>
					<div class="span4">
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
	

	
