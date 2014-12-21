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
	$(function() {
		 $( "#datepicker1" ).datepicker({
			showOn: "button",
			buttonImage: "../../assets/images/calendar.gif",
			format: 'Y-m-d',
			buttonImageOnly: true
		}); 
	});
	
	
	 $(document).ready(function() {
		$("#submit").click(function(event){
				/* var Severityv = $("#Severity").val();
				var Impactv = $("#Impact").val();
				var Devicev = $("#Device").val();
				var ExpectedClosureDatev = $("#datepicker1").val(); */
				var IssueDescriptionv = $("#IssueDescription").val();
				var Commandsv = "";
				/* var lines = $("#Commands").val().split('\n');
				for(var i = 0;i < lines.length;i++){
					//code here using lines[i] which will give you each line
					Commandsv = Commandsv+lines[i]+",";
				} */
				
				/* var Analysisv = $("#Analysis").val();
				var Remarksv = $("#Remarks").val(); */
				var EmployeeIDv = $("#EmployeeID").val();
				/* $('#SeverityError').html("");
				$('#ImpactError').html("");
				$('#DeviceError').html("");
				$('#ExpectedClosureDateError').html(""); */
				$('#IssueDescriptionError').html("");
				/* $('#CommandsError').html("");
				$('#AnalysisError').html("");
				$('#RemarksError').html(""); */
				/* if(Severityv=="Please select Severity")
				{
					$('#SeverityError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select severity.</h6></div>");
					//alert('hi');
					return false;
				}
				
				else
				if(Impactv=="Please select Impact")
				{
					$('#ImpactError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Impact.</h6></div>");
					return false;
				}
				else
				if(Devicev=="Please select device")
				{
					$('#DeviceError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select Device.</h6></div>");
					return false;
				}
				else
				if(ExpectedClosureDatev=="")
				{
					$('#ExpectedClosureDateError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please select ECD</h6></div>");
					return false;
				}
				else */
				if(IssueDescriptionv=="")
				{
					$('#IssueDescriptionError').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>Please enter Issue Description</h6></div>");
					return false;
				}
				/* else
				if(Commandsv=="")
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
				} */
				var url="ticketAdd";
				/* $('#dialog-confirm').html('<b>ECD: </b>'+ExpectedClosureDatev+'<br/><b>EmployeeID: </b>'+EmployeeIDv+'<br/><b>Severity: </b>'+Severityv+'<br/><b>Impact: </b>'+Impactv+'<br/><b>IssueDescription: </b>'+IssueDescriptionv
						+'<br/><b>Commands: </b>'+Commandsv+'<br/><b>Analysis: </b>'+Analysisv+'<br/><b>Remarks: </b>'+Remarksv+'<br/><b>Device: </b>'+Devicev);
				 */
				$('#dialog-confirm').html('<b>EmployeeID: </b>'+EmployeeIDv+'<br/><b>IssueDescription: </b>'+IssueDescriptionv);
				
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
						url,
						{IssueDescription: IssueDescriptionv,
						EmployeeID: EmployeeIDv, /* Severity: Severityv, ECD: ExpectedClosureDatev, 
						Impact: Impactv, Commands: Commandsv, Analysis: Analysisv, Remarks: Remarksv, Device: Devicev, */ },
						function(data) 
						{
							if(data.length==0)
							{
								window.location = "./dashboard/index"
								
							}
							else
							{
								
								$('#result').html(data);
								$('#submit').attr('disabled','disable');
								$('#submit').css("background-color","grey");
								$('#IssueDescription').attr('disabled','disable');
								$("html, body").animate({ scrollTop: 0 }, 500);
								//document.getElementById("myButton1").value="Close Curtain";							
							}
							//alert(data);
						}
					);
					},
					Cancel: function() {
					  $( this ).dialog( "close" );
					}
				 } //buttons close
				});//dialog close
			  });//function close
			});// submit button 
	   });
	</script>
	</head>
<body>
<div id="dialog-confirm" title="Confirm ticket details?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div id="container">
	
	<div class="container-fluid">
		<legend>Raise new ticket</legend>
	<div style="margin-left:20px;margin-bottom:20px;">
		<?php echo $link_back; ?>
		</div>
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span10">
				<div id="result">	
				</div>
			</div>
			<div class="span1">
			</div>
		</div>
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span10">
				<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>First Name:</b></label>
							</div>
							<div class="span6">
								<input type="text" disabled="disable" name="FirstName" id="FirstName" value="<?php echo  $User->FirstName; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Last Name:</b></label>
							</div>
							<div class="span6">
								<input type="text" disabled="disable" name="LastName" id="LastName" value="<?php echo  $User->LastName; ?>"/>
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
								<label class="control-label"><b>Employee ID:</b></label>
							</div>
							<div class="span6">
								<input type="text"  disabled="disable" name="EmployeeID" id="EmployeeID" value="<?php echo  $User->EmployeeID; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Contact Number:</b></label>
							</div>
							<div class="span6">
								<input type="text"  disabled="disable" name="ContactNumber" id="ContactNumber" value="<?php echo  $User->ContactNumber; ?>"/>
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
								<label class="control-label"><b>User Name:</b></label>
							</div>
							<div class="span6">
								<input type="text"  disabled="disable" name="UserName" id="UserName" value="<?php echo  $User->UserName; ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Request Date:</b></label>
							</div>
							<div class="span6">
								<input type="text"  disabled="disable" name="RequestDate" id="RequestDate" value="<?php echo  date('d-m-Y'); ?>"/>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>
					<!--<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Severity:</b></label>
							</div>
							<div class="span6">
								<select autofocus name="Severity" id="Severity" >
									<option selected="selected">Please select Severity</option>
									<option id="a">Low</option>
									<option id="b">Medium</option>
									<option id="c">High</option>
								</select>
								<div style="color:red;" id="SeverityError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>-->
				</div>
				<!--<div class="row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Impact:</b></label>
							</div>
							<div class="span6">
								<select autofocus name="Impact" id="Impact">
									<option selected="selected">Please select Impact</option>
									<option id="a">Low</option>
									<option id="b">Medium</option>
									<option id="c">High</option>
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
								<label class="control-label"><b>Device:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span6">
								<select autofocus name="Device" id="Device">
									<option selected="selected">Please select device</option>
									<option id="a">Router</option>
									<option id="b">Firewall</option>
									
								</select>
								<div style="color:red;" id="DeviceError"></div>
							</div>							
						</div>
					</div>
				</div>-->
				
				<div class="row-fluid">
					<!--<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="control-label"><b>Expected closure Date:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span6">
								<input type="text" id="datepicker1"  style="width:70%;"/>
								<div style="color:red;" id="ExpectedClosureDateError"></div>
							</div>
							<div class="span2">
							</div>
						</div>
					</div>-->
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label"><b>Issue description:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span10">
								<textarea rows="10" style="width:85%;" name="IssueDescription" id="IssueDescription"></textarea>
								<div style="color:red;width:87%;" id="IssueDescriptionError"></div>
							</div>						
						</div>
					</div>
				</div>	
				
				<!--<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span2">
								<label class="control-label"><b>Commands:</b><span style="color:red;">*</span><br/><span style="color:grey;">One command per line.</span></label>
							</div>
							<div class="span9">
								<textarea style="width:95%;" rows="10" name="Commands" id="Commands"></textarea>
								<div style="color:red;" id="CommandsError"></div>
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
								<label class="control-label"><b>Analysis:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span9">								
								<textarea  style="width:95%;" name="Analysis" id="Analysis"></textarea>
								<div style="color:red;" id="AnalysisError"></div>								
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
								<label class="control-label"><b>Remarks:</b><span style="color:red;">*</span></label>
							</div>
							<div class="span9">								
								<textarea  style="width:95%;" name="Remarks" id="Remarks"></textarea>
								<div style="color:red;" id="RemarksError"></div>
							</div>
							<div class="span1">
								
							</div>
						</div>
					</div>
				</div>	-->
				
				<br/>
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span5">
							</div>
							<div class="span2">
								<div class="input-prepend">
									<div class="btn-group">
										<input class="btn btn-large btn-primary" type="submit" name="submit" id="submit" value="submit"/>
									</div>
								</div>
							</div>
							<div class="span5">
							</div>
						</div>
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

