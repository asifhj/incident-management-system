<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 // num of records per page
	private $limit = 10;
	function __construct()
	{
        parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url'); 
		// load model
		$this->load->model('User_model','',TRUE);
		$this->load->model('Ticket_model','',TRUE);
       
    }
	function checklogin()
	{
        if(!$this->session->userdata('validated'))
		{
			redirect('/login/index/session');
		}		
    }
	public function index()
	{
		
		$this->checklogin();
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['Users']='./user';
		$data['MenuHighlight']='Dashboard';
		
		// load data
		if($sess['UserType']=="Admin")
			$Tickets = $this->Ticket_model->get_all_tickets()->result();
		else
		if($sess['UserType']=="User")
			$Tickets = $this->Ticket_model->get_all_tickets_by_EmployeeID($sess['EmployeeID'])->result();
		else
		if($sess['UserType']=="Engineer")
			$Tickets = $this->Ticket_model->get_all_tickets_by_EmployeeID_and_Assigned($sess['EmployeeID'])->result();
		else
			redirect('/login/logout');
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('SNo', 'TNo', 'Name', 'EID', 'Req. Date', 'Severity', 'ECD', 'Status', 'App.Status', 'ContactNo', 'Email', 'Actions');
		$i = 0;
		foreach ($Tickets as $Ticket)
		{
			$Actions =  '<div class="btn-group">
						<a class="btn btn-primary" href="#"><i class="icon-tag icon-white"></i> Actions</a>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="'.base_url().'index.php/dashboard/view/'.$Ticket->TicketNo.'"><i class="icon-list"></i> View</a></li>
								<li><a href="'.base_url().'index.php/dashboard/update/'.$Ticket->TicketNo.'"><i class="icon-pencil"></i> Update</a></li>
								<li><a onclick="return confirm(\'Are you sure want to delete this ticket?\')" href="'.base_url().'index.php/dashboard/delete/'.$Ticket->TicketNo.'"><i class="icon-trash"></i> Delete</a></li>
							</ul>
						</div>';
			$Severity='';
			if(strcmp($Ticket->Severity,"High")==0)
				$Severity="<span style='color:rgb(197, 0, 0);font-weight:bold;'>".$Ticket->Severity."</span>";
			else
			if(strcmp($Ticket->Severity,"Medium")==0)
				$Severity="<span style='color:rgb(213, 145, 0);font-weight:bold;'>".$Ticket->Severity."</span>";
			else
				$Severity="<span style='color:green;font-weight:bold;'>".$Ticket->Severity."</span>";
			$Approval='';

			if(strcmp($Ticket->ApprovalStatus,"ExceptionalApproved")==0)
				$Approval="<span style='color:rgb(11, 0, 133);font-weight:bold;'>".$Ticket->ApprovalStatus."</span>";
			else
			if(strcmp($Ticket->ApprovalStatus,"Pending")==0)
				$Approval="<span style='color:rgb(213, 145, 0);font-weight:bold;'>".$Ticket->ApprovalStatus."</span>";
			else
			if(strcmp($Ticket->ApprovalStatus,"Rejected")==0)
				$Approval="<span style='color:rgb(197, 0, 0);font-weight:bold;'>".$Ticket->ApprovalStatus."</span>";
			else
				$Approval="<span style='color:green;font-weight:bold;'>".$Ticket->ApprovalStatus."</span>";
					
			
			$this->table->add_row(++$i, $Ticket->TicketNo,$Ticket->FirstName, $Ticket->EmployeeID, $Ticket->RequestedDate,
										$Severity, $Ticket->ExpectedClosureDate, $Ticket->TicketStatus, $Approval, $Ticket->ContactNumber,$Ticket->Email,$Actions);
		}
		
		/* anchor('dashboard/view/'.$Ticket->TicketNo,'view',array('class'=>'view')).' '.
				anchor('dashboard/update/'.$Ticket->TicketNo,'update',array('class'=>'update')).' '.
				anchor('dashboard/delete/'.$Ticket->TicketNo,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this User?')")) */
		
		
		$tmpl = array ( 'table_open'  => '<table class="table table-bordered" id="tickets" border="1" cellpadding="2" cellspacing="1">' );
		$this->table->set_template($tmpl);
		$data['table'] = $this->table->generate();
		
		$this->load->view('header',$data);
		$this->load->view('dashboard_view');
		$this->load->view('footer');
	}
	public function ticket()
	{
		$this->checklogin();
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['UserType']=$sess['UserType'];
		$data['User'] = $this->User_model->get_by_EmployeeID($sess['EmployeeID'])->row();
		$data['Users']='../user';
		$data['link_back'] = anchor('dashboard/','Back to list of Tickets',array('class'=>'back'));
		$data['MenuHighlight']='Ticket';
		
		$this->load->view('header',$data);
		$this->load->view('ticketAdd',$data);
		$this->load->view('footer');
	}
	
	public function ticketAdd()
	{
		$this->checklogin();
		$EmployeeID = $_POST['EmployeeID'];
		$sess=$this->session->all_userdata();
		//$ECD= explode("/", $_POST['ECD']);
		//$results=$this->guideCommands($_POST['Commands']);
		if($EmployeeID == $sess['EmployeeID'])
		{
			$User = $this->User_model->get_by_EmployeeID($sess['EmployeeID'])->row();
			$Ticket = array('FirstName' => $User->FirstName,'LastName' => $User->LastName,
						  'UserName' => $User->UserName,'EmployeeID' => $User->EmployeeID,
						  'ContactNumber' => $User->ContactNumber,'RequestedDate' => date('Y-m-d'),
						  'RequestedTime' => date('H:i:s'),
						  //'Severity' => $_POST['Severity'], 'Impact' => $_POST['Impact'], 
						  //'ExpectedClosureDate' => $ECD[2].'-'.$ECD[0].'-'.$ECD[1],
						  'IssueDescription' => $_POST['IssueDescription'], 
						  /* 'Commands' => $_POST['Commands'], 
						  'CommandsCompliance' => $results[0],'IsCommandCompliance' => $results[1],'Analysis' => $_POST['Analysis'],
						  'Remarks' => $_POST['Remarks'],'ApprovalStatus' => 'Pending', */ 
						  'IsCommandCompliance' => '', 'ExceptionalApprove' => '', 'ApprovalStatus'=>'', 'Device' => '', 'TicketStatus' => 'Open',
						  'OperatingSystem' => $_SERVER['HTTP_USER_AGENT'],'Assigned' => '2',
						  'IPAddress' => $_SERVER['REMOTE_ADDR'], 'CreatedDateTime' => date('Y-m-d H:i:s'), 
						  'Email' => $User->Email,); 
						  /* echo '<pre>';
						  echo print_r($User);
						  echo print_r($Ticket);
						  echo '</pre>'; */
			$id = $this->Ticket_model->save($Ticket); 			
			/* if($id==1)
				echo '<div class="success">Open ticket success</div>';
			else
				echo '<div class="error">Failed to open a ticket</div>';  */
			if($id==1)
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Open ticket success</h4></div>';//.$results[0];
			else
				echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Failed to open a ticket.</h4></div>';
			//echo "$results";
		}
		// set user message	
	}
	function view($TicketNo)
	{
		$this->checklogin();
		// set common properties
		$data['title'] = 'Ticket Details';
		$data['link_back'] = anchor('dashboard/','Back to list of Tickets',array('class'=>'back'));
		
		// get Ticket & User details	
		$Ticket = $this->Ticket_model->get_by_TicketNo($TicketNo)->row();
		$data['User'] = $this->User_model->get_by_EmployeeID($Ticket->EmployeeID)->row();
		$data['Ticket']=$Ticket;
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Ticket';
		
		// load view
		$this->load->view('header', $data);
		$this->load->view('ticketView', $data);
		$this->load->view('footer');
	}
	
	function update($TicketNo)
	{
		$this->checklogin();
			// prefill form values
			$Ticket = $this->Ticket_model->get_by_TicketNo($TicketNo)->row();
			$data['User'] = $this->User_model->get_by_EmployeeID($Ticket->EmployeeID)->row();
			$data['Ticket']=$this->Ticket_model->get_by_TicketNo($TicketNo)->row();
			$AssignedEngineers=$this->Ticket_model->get_all_AssignedEngineers()->result();
			$Engineers=$this->Ticket_model->get_all_Engineers()->result();
			$EngineersDetail="<table class='table'><tr><th>EngineerID</th><th>Username</th><th>Total Tickets</th></tr>";
			$EngineersDetailOption='';
			foreach ($AssignedEngineers as $AU)
			{
				$EngineersDetail.="<tr><td><a href='".base_url()."index.php/user/view/".$AU->Engineer_EmployeeID."'>".$AU->Engineer_EmployeeID."</a></td><td>".$AU->UserName."</td><td>".$AU->Assigned_Tickets."</td></tr>";
				
			}
			$EngineersDetail.="</table>";
			foreach ($Engineers as $E)
			{
				$EngineersDetailOption.="<option id='".$E->EmployeeID."'>".$E->EmployeeID."</option>";
			}
			$data['EngineerDetails']=$EngineersDetail;
			$data['EngineerDetailsOption']=$EngineersDetailOption;
			// set common properties
			$data['title'] = 'Update Ticket';
			$data['message'] = '';
			$data['link_back'] = anchor('dashboard/','Back to list of Tickets',array('class'=>'back'));
			
			//Identify User type
			// load view
			
			$sess=$this->session->all_userdata();
			$data['UserName']=$sess['UserName'];
			$data['EmployeeID']=$sess['EmployeeID'];
			$data['UserType']=$sess['UserType'];
			$data['MenuHighlight']='Ticket';
			$this->load->view('header', $data);
			if($sess['UserType']=="Admin")
				$this->load->view('ticketEdit', $data);
			else
			if($sess['UserType']=="Engineer")
				$this->load->view('ticketEditEngineer', $data);
			else
			if($sess['UserType']=="User")
				$this->load->view('ticketEditUser', $data);
			$this->load->view('footer');
	}
	function updateTicket()
	{
		$this->checklogin();
		$TicketNo = $_POST['TicketNo'];
		$Status = $_POST['Status'];
		$sess=$this->session->all_userdata();
		$AssignedEngineeerID='';
		if(isset($_POST['Assigned']))
			$AssignedEngineeerID=$_POST['Assigned'];
		else
			$AssignedEngineeerID='';
		$Ticket = array('ApprovalStatus' => $Status);
						  /* echo '<pre>';
						  echo print_r($User);
						  echo print_r($Ticket);
						  echo '</pre>'; */
			$id = $this->Ticket_model->update($TicketNo, $Ticket); 			
			if($id==0)
				echo $Status;
			else
				echo 'fail';
			return;
			//redirect('/login/index/session');
	}
	function delete($id)
	{
		// delete person
		$this->Ticket_model->delete($id);
		
		// redirect to person list page
		redirect('dashboard/index/','refresh');
	}
	function updateTicketEngineer()
	{
		$this->checklogin();
		$TicketNo = $_POST['TicketNo'];
		$Status = $_POST['TicketStatus'];
		$sess=$this->session->all_userdata();
		$ECD= explode("/", $_POST['ExpectedClosureDate']);
		//print $_POST['Commands'];
		if(strcmp($_POST["Device"],"Router")==0)
			$results=$this->guideRouterCommands($_POST['Commands']);
		else
			$results=$this->guideFirewallCommands($_POST['Commands']);

		//echo print_r($results);
		if($results!=false)
		{
			$Ticket = array('TicketStatus' => $Status, 
						'Severity' => $_POST['Severity'], 'Impact' => $_POST['Impact'], 
						'ExpectedClosureDate' => $_POST['ExpectedClosureDate'],//$ECD[2].'/'.$ECD[0].'/'.$ECD[1],
						'Commands' => $_POST['Commands'], 
						'CommandsCompliance' => $results[0],'IsCommandCompliance' => $results[1],'Analysis' => $_POST['Analysis'],
						'Remarks' => $_POST['Remarks'],'ApprovalStatus' => 'Pending',
						'Device' => $_POST['Device'], 'HostName' => $_POST['HostName'], 'HostIPAddress' =>$_POST['HostIPAddress'], );
						
			$id = $this->Ticket_model->update($TicketNo, $Ticket); 	
			if($Status=="Update")
				$Status="Update";
			if($id==0)
				echo $Status;
			else
				echo 'fail';
			return;
		}
		else
			echo 'fail';
			//return;
			//redirect('/login/index/session');
	}
	
	function updateTicketUser()
	{
		$this->checklogin();
		$TicketNo = $_POST['TicketNo'];
		$Status = $_POST['Status'];
		$sess=$this->session->all_userdata();
		
		$Ticket = array('TicketStatus' => $Status,);
						  /* echo '<pre>';
						  echo print_r($User);
						  echo print_r($Ticket);
						  echo '</pre>'; */
			$id = $this->Ticket_model->update($TicketNo, $Ticket); 	
			if($Status=="Open")
				$Status="Opened";
			if($id==0)
				echo $Status;
			else
				echo 'fail';
			//return;
			//redirect('/login/index/session');
	}
	
	public function guideRouterCommands($Commands_Input)
	{
		$CommandCompliance='<table class="table table-condensed"><tr><th>Severity</th><th>Command</th><th>Compliance</th></tr>';
		//var_dump($argv);
		$commands=explode(',',$Commands_Input);
		$commands_length=count($commands)-1;
		$commands_counter=0;
		$IsCommandCompliance='Yes';
		foreach($commands as $c)
		{
			$file_read=fopen("audit_alert_generator_guidelines.csv","r");
			$found=0;
		if($file_read!=false)
		{
			while(!feof($file_read))
			{
				
				$values=fgetcsv($file_read,1024);
				if($values[0]=="1")
				{
					if(trim($values[5])==trim($c))
					{
						//echo "Type 1 Found\n\t";
						//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>".$values[6]."</span></td></tr>";
						$found=1;
						if(trim($values[6])=="No")
							$IsCommandCompliance="No";
						break;
					}				
				}
				else
				if($values[0]=="2")
				{
					$MatchCount=$values[3];
					if($MatchCount=="")
					{
						$Command_Pattern=$values[4];
						$find=strpos($c, $Command_Pattern);
						if($find!==false)
						{
							//echo "Type 2 Found\n\t";
							//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							$row_color='';
							if($values[1]=="Low")
								$row_color='info';
							if($values[1]=="Medium")
								$row_color='warning';
							if($values[1]=="High")
								$row_color='error';
							$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>".$values[6]."</span></td></tr>";
							$found=1;
							if($values[6]=="No")
							$IsCommandCompliance="No";
							break;
						}
					}
					else
					{
						
						$match_locations=explode('&',$MatchCount);
						$input_command_part=explode(' ',trim($c));
						$guide_command_part=explode(' ',trim($values[5]));
						$match=0;
						
						if(count($input_command_part)==count($guide_command_part))
						for($i=0;$i<count($match_locations);$i++)
						{			
							//echo "length equal";
							if(trim($input_command_part[$match_locations[$i]])==trim($guide_command_part[$match_locations[$i]]))
								$match=1;
							else
							{						
								$match=0;
								break;
							}
						}
						if($match==1)
						{
							//echo "Type 2 Found\n\t";
							//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							$row_color='';
							if($values[1]=="Low")
								$row_color='info';
							if($values[1]=="Medium")
								$row_color='warning';
							if($values[1]=="High")
								$row_color='error';
							$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>".$values[6]."</span></td></tr>";
							$found=1;
							if($values[6]=="No")
								$IsCommandCompliance="No";
							break;
						}
					}
				}
				else
				if($values[0]=="3")
				{
					$match_count=$values[3];
					$match_locations=explode('&',$match_count);
					$input_command_part=explode(' ',trim($c));
					$guide_command_part=explode(' ',trim($values[5]));
					$match=0;
					//echo "hellowwww".$c." hiwww";
					//echo "\n".$c."\n";
					//echo $values[5]."\n";
					//echo "icp: ".count($input_command_part)." \tgcp: ".count($guide_command_part);
					if(count($input_command_part)==count($guide_command_part))
					
					for($i=0;$i<count($match_locations);$i++)
					{			
						if(trim($input_command_part[$match_locations[$i]])==trim($guide_command_part[$match_locations[$i]]))
							$match=1;
						else
						{						
							$match=0;
							break;
						}
						//echo "\n".trim($input_command_part[$match_locations[$i]])." ".trim($guide_command_part[$match_locations[$i]]);
					}
					if($match==1)
					{
						//echo "Type 3 Found\n\t";
						//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>".$values[6]."</span></td></tr>";
						if($values[6]=="No")
							$IsCommandCompliance="No";
						$found=1;
						break;
					}	
				}
				else
				if($values[0]=="4")
				{
					$match_count=$values[3];
					$match_locations=explode('&',$match_count);
					$input_command_part=explode(' ',trim($c));
					$guide_command_part=explode(' ',trim($values[5]));
					$match=0;
					//echo "1: ".$c."\n";
					$debug="";
					
					if(count($input_command_part)==count($guide_command_part))
					for($i=0;$i<count($match_locations);$i++)
					{			
						$debug.=trim($input_command_part[$i])."  ".trim($guide_command_part[$i])."\n";
						if(trim($input_command_part[$match_locations[$i]])==trim($guide_command_part[$match_locations[$i]]))
							$match=1;
						else
						{						
							$match=0;
							break;
						}
					}
					//echo "2: ".$debug;
					
					
					if($match==1)
					{
						//echo "Type 4 Found\n\t";
						//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>Yes</span></td></tr>";
						if($values[6]=="No")
							$IsCommandCompliance="No";

						$found=1;
						break;
					}				
				}
				
				}
			fclose($file_read);
		}	
		else
			return false;
			
			if($found==0 && !empty($c))
			{
				$CommandCompliance.="<tr class='error' style='background-color:red;'><td>Not found</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>Not Compliance</span></td></tr>";
				$IsCommandCompliance='No';
			}
			$commands_counter++;
			if($commands_length==$commands_counter)
				break;
			//echo $c."\n";
		}
		$CommandCompliance.="</table>";
		$res=array($CommandCompliance,$IsCommandCompliance);
		return $res;
}
	
public function guideFirewallCommands($Commands_Input)
{
	$CommandCompliance='<table class="table table-condensed"><tr><th>Severity</th><th>Command</th><th>Compliance</th></tr>';
		//var_dump($argv);
		$commands=explode(',',$Commands_Input);
		$commands_length=count($commands)-1;
		$commands_counter=0;
		$IsCommandCompliance='';
		$pattern='';
		
		foreach($commands as $c)
		{
			$file_read=fopen("firewall_alert_generator_guidelines.csv","r");
			$found=0;
			if($file_read!=false)
			{
			while(!feof($file_read))
			{				
				$values=fgetcsv($file_read,1024);
				$pattern=$values[2];
				if($values[0]=="1")
				{
					if(trim($values[3])==trim($c))
					{
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$values[3]."</td><td>".$values[4]."</td></tr>";
						$found=1;
						break;
					}				
				}
				else
				if($values[0]=="2")
				{
						
						$find=strpos($c, $values[2]);
						if($find!==false)
						{
							//echo "Type 2 Found\n\t";
							//$CommandCompliance.="Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							//echo "Command type: ".$values[0]."\tSeverity: ".$values[1]."\tMatchCount: ".$values[2]."\tPattern: ".$values[4]."\tMessage: ".$values[5]."\n\n";
							$row_color='';
							if($values[1]=="Low")
								$row_color='info';
							if($values[1]=="Medium")
								$row_color='warning';
							if($values[1]=="High")
								$row_color='error';
							$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$values[3]."</td><td>".$values[4]."</td></tr>";
							$found=1;
							break;
						}
				}
				else
				if($values[0]=="3" && strcmp(substr(trim($c),0,strlen(trim($pattern))),trim($pattern))==0)
				{
					//echo trim($c)."<br/>";
					if(strcmp(trim($c),trim($values[3]))==0)
					{	
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$values[3]."</td><td>".$values[4]."</td></tr>";
						$found=1;
						break;						
					}
					else
					{						
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$values[3]."</td><td>".$values[4]."</td></tr>";
						$found=1;
						break;
					}					
				}
				else
				if($values[0]=="4")
				{
					$input_command_part=explode(' ',trim($c));
					$guide_command_part=explode(' ',$values[3]);
					$match=0;
					if(count($input_command_part)==count($guide_command_part))
					for($i=0;$i<count($input_command_part);$i++)
					{			
					if(trim($input_command_part[$i])==trim($guide_command_part[$i]))
							$match=1;
						else
						{						
							$match=0;
							break;
						}
					}
					if($match==1)
					{
						$row_color='';
						if($values[1]=="Low")
							$row_color='info';
						if($values[1]=="Medium")
							$row_color='warning';
						if($values[1]=="High")
							$row_color='error';
						$CommandCompliance.="<tr class='".$row_color."'><td>".$values[1]."</td><td>".$values[5]."</td><td>".$values[4]."</td></tr>";
						$found=1;
						break;
					}				
				}
				
			}fclose($file_read);
			}				
			else
			return false;
			
			if($found==0 && !empty($c))
			{
				$CommandCompliance.="<tr class='error' style='background-color:red;'><td>Not found</td><td>".$c."</td><td><span style='font-size:10pt;font-weight:bold;'>Not Compliance</span></td><td>".$values[4]."</td></tr>";
				$IsCommandCompliance='No';
			}
			$commands_counter++;
			if($commands_length==$commands_counter)
				break;
		}
	
		$CommandCompliance.="</table>";
		
		$res=array($CommandCompliance,$IsCommandCompliance);
		return $res;
}

}