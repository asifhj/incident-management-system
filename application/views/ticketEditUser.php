<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Update ticket in IMS</title>

<link href="<?php echo base_url(); ?>vendor/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>vendor/js/jquery-1.9.1.js"></script>
	<script src="<?php echo base_url();?>vendor/js/jquery-ui.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>vendor/css/bootstrap.css" />
	<script src="<?php echo base_url();?>vendor/js/bootstrap.js"></script>	
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
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system/vendor/images/approved.jpg");
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
								$('#ApprovalStatus').attr('src',"http://localhost/incident_management_system/vendor/images/approved.jpg");
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
		$("#Close").click(function(event){
				var TN = $("#TicketNo").val();
				$.post( 
						"../updateTicketUser",
						{TicketNo:TN, Status: "Closed", },
						function(data) 
						{
							if(data=="Closed")
								$('#TicketStatus').attr('src',"http://localhost/incident_management_system/vendor/images/close.png");
							alert(data);
						}
					);
		  });
		  $("#Open").click(function(event){
				var TN = $("#TicketNo").val();
				$.post( 
						"../updateTicketUser",
						{TicketNo:TN, Status: "Open", },
						function(data) 
						{
							if(data=="Opened")
								$('#TicketStatus').attr('src',"http://localhost/incident_management_system/vendor/images/open.jpg");
							alert("Opened");
						}
					);
		  });
		  $("#Resolve").click(function(event){
				var TN = $("#TicketNo").val();
				$.post( 
						"../updateTicketUser",
						{TicketNo:TN, Status: "Resolved", },
						function(data) 
						{
							if(data=="Resolved")
								$('#TicketStatus').attr('src',"http://localhost/incident_management_system/vendor/images/resolved.png");
								$
							alert(data);
						}
					);
		  });
	   });
	</script>


</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		
		<div class="data">
		<table>
			<tr>
				<td width="30%"><?php if($Ticket->ApprovalStatus=="Pending")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/Pending.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Approved")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/approved.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->ApprovalStatus=="Rejected")
							echo "<div id='apdiv'><img id='ApprovalStatus' src='".base_url()."vendor/images/rejected.jpg' width='200px' height='200px'></div>";?>
				</td>
				<td>
					<?php if($Ticket->TicketStatus=="Open")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/open.jpg' width='200px' height='200px'></div>";
						else
						if($Ticket->TicketStatus=="Close")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/close.png' width='200px' height='200px'></div>";
						else
						if($Ticket->TicketStatus=="Resolved")
							echo "<div id='apdiv'><img id='TicketStatus' src='".base_url()."vendor/images/resolved.png' width='200px' height='200px'></div>";
						
						?>
				</td>
			</tr>
			<tr>
				<td width="30%">Ticket No</td>
				<td><input type="text" name="TicketNo" disabled="disable" class="text" value="<?php echo $Ticket->TicketNo; ?>"/></td>
				<input type="hidden" id="TicketNo" value="<?php echo $Ticket->TicketNo; ?>"/>
			</tr>
			<tr>
				<td width="30%">Ticket Status</td>
				<td><input type="text" name="TicketStatus" disabled="disable" class="text" value="<?php echo $Ticket->TicketStatus; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Employee ID</td>
				<td><input type="text" name="EmployeeID" disabled="disable" class="text" value="<?php echo $Ticket->EmployeeID; ?>"/></td>
				<input type="hidden" name="EmployeeID" value="<?php echo $Ticket->EmployeeID; ?>"/>
			</tr>
			<tr>
				<td valign="top">First Name</td>
				<td><input type="text" name="FirstName" disabled="disable" class="text" value="<?php echo $Ticket->FirstName; ?>"/></td>
			</tr>
			<tr>
				<td valign="top">Last Name</td>
				<td><input type="text" name="LastName" disabled="disable" class="text" value="<?php echo $Ticket->LastName; ?>"/></td>
			</tr>
			<tr>
				<td valign="top">User Name</td>
				<td><input type="text" name="UserName" disabled="disable" class="text" value="<?php echo $Ticket->UserName; ?>"/></td>
			</tr>
			<tr>
				<td valign="top">Contact Number</td>
				<td><input type="text" name="ContactNumber" disabled="disable" class="text" value="<?php echo $Ticket->ContactNumber; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Requested Date</td>
				<td><input type="text" name="RequestedDate" disabled="disable" class="text" value="<?php echo $Ticket->RequestedDate; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Requested Time</td>
				<td><input type="text" name="RequestedTime" disabled="disable" class="text" value="<?php echo $Ticket->RequestedTime; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Severity</td>
				<td><input type="text" name="Severity" disabled="disable" class="text" value="<?php echo $Ticket->Severity; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Impact</td>
				<td><input type="text" name="Impact" disabled="disable" class="text" value="<?php echo $Ticket->Impact; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Expected Closure Date</td>
				<td><input type="text" name="ExpectedClosureDate" disabled="disable" class="text" value="<?php echo $Ticket->ExpectedClosureDate; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Issue Description</td>
				<td><input type="text" name="IssueDescription" disabled="disable" class="text" value="<?php echo $Ticket->IssueDescription; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Commands</td>
				<td><input type="text" name="Commands" disabled="disable" class="text" value="<?php echo $Ticket->Commands; ?>"/></td>
			</tr>
			<tr>
				<td width="30%">Analysis</td>
				<td><input type="text" name="Analysis" disabled="disable" class="text" value="<?php echo $Ticket->Analysis; ?>"/></td>
			</tr>
			<tr>
				<td valign="top">Email</td>
				<td><input type="text" name="Email" disabled="disable" class="text" value="<?php echo $Ticket->Email; ?>"/></td>
			</tr>
			<tr>
				<td valign="top">Created Date And Time</td>
				<td><input type="text" disabled="disable" name="CreatedDateTime" class="text" value="<?php echo $Ticket->CreatedDateTime; ?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">Modified Date and Time</td>
				<td><input type="text" disabled="disable" name="ModifiedDateTime" class="text" value="<?php echo $Ticket->ModifiedDateTime; ?>"/>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="button" id="Close" value="Close Ticket"/><input type="button" id="Resolve" value="Ticket resolved"/><input type="button" id="Open" value="Open Ticket"/></td>
				
			</tr>
		</table>
		</div>
		
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>