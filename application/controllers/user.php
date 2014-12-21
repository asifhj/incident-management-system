<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('User_model','',TRUE);
	}
	function checklogin()
	{
        if(!$this->session->userdata('validated'))
		{
			redirect('/login/index/session');
		}		
		$sess=$this->session->all_userdata();
		if($sess['UserType']=="User" || $sess['UserType']=="Engineer")
			redirect('/dashboard');
    }
	function index($offset = 0)
	{
		$this->checklogin();
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$Users = $this->User_model->get_all_users()->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('User/index/');
 		$config['total_rows'] = $this->User_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'EmployeeID','User Name', 'UserType', 'ContactNumber', 'Email', 'FirstName', 'LastName', 'Actions');
		$i = 0 + $offset;
		foreach ($Users as $User)
		{
			$Actions =  '<div class="btn-group">
						<a class="btn btn-primary" href="#"><i class="icon-tag icon-white"></i> Actions</a>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="'.base_url().'index.php/User/view/'.$User->EmployeeID.'"><i class="icon-list"></i> View</a></li>
								<li><a href="'.base_url().'index.php/User/update/'.$User->EmployeeID.'"><i class="icon-pencil"></i> Update</a></li>
								<li><a onclick="return confirm(\'Are you sure want to delete this user?\')" href="'.base_url().'index.php/User/delete/'.$User->EmployeeID.'"><i class="icon-trash"></i> Delete</a></li>
							</ul>
						</div>';
			$this->table->add_row(++$i,  $User->EmployeeID, $User->UserName, $User->UserType, $User->ContactNumber, $User->Email, $User->FirstName, $User->LastName, $Actions
				);
		}
		$tmpl = array ( 'table_open'  => '<table class="table table-bordered" id="tickets" border="1" cellpadding="2" cellspacing="1">' );
		$this->table->set_template($tmpl);
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('header',$data);
		$this->load->view('UserList', $data);
		$this->load->view('footer');
	}
	
	function add()
	{
		$this->checklogin();
		// set empty default form field values
		$this->form_data=new stdClass;
		$this->form_data->EmployeeID = '';
		$this->form_data->FirstName = '';
		$this->form_data->LastName = '';
		$this->form_data->UserName = '';
		$this->form_data->ContactNumber= '';
		$this->form_data->Email = '';
		$this->form_data->Password= '';
		$this->form_data->ConfirmPassword = '';
		
		// run validation
		$this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required');
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|alpha');
		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|alpha');
		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('ContactNumber', 'ContactNumber', 'trim|required|min_length[10]|max_length[10]|numeric');
		//$this->form_validation->set_rules('UserType', 'UserType', 'trim|required');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required');
		$this->form_validation->set_rules('ConfirmPassword', 'ConfirmPassword', 'trim|required|matches[Password]');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('alpha', '* should be alphabetic');
		$this->form_validation->set_message('alpha_numeric', '* only alpha numeric');
		$this->form_validation->set_message('min_length', '* minimum 10 digits');
		$this->form_validation->set_message('max_length', '* maximum 10 digits');
		$this->form_validation->set_message('valid_email', '* valid email');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		//$Approvers = $this->User_model->get_all_approvers()->result();
		
		// set common properties
		$data['title'] = 'Add new User';
		$data['message'] = '';
		$data['action'] = site_url('User/addUser');
		$data['link_back'] = anchor('User/index/','Back to list of Users',array('class'=>'back'));
		
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		// get User details
		/* $Approvers = $this->User_model->get_all_approvers()->result();
		$data['Approver']='<select name="Approver">';
		foreach($Approvers as $Approver)
			$data['Approver'].='<option id="">'.$Approver->Approver.'</option>';
		$data['Approver'].='</select>';				
		
		$data['UserType']='<select name="UserType">';
		$data['UserType'].='<option selected="selected" id="Approver">Approver</option>';
		$data['UserType'].='<option id="Raiser">Raiser</option>';
		$data['UserType'].='<option id="Engineer">Engineer</option>';
		$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		$data['UserType'].='</select>'; */
				
		// load view
		$this->load->view('header', $data);
		$this->load->view('UserAdd', $data);
		$this->load->view('footer');
	}
	
	function addUser()
	{
		$this->checklogin();
		// set common properties
		$data['title'] = 'Add new User';
		$data['message'] = '';
		$data['action'] = site_url('User/addUser');
		$data['link_back'] = anchor('User/index/','Back to list of Users',array('class'=>'back'));
		
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		$data['UserTypeSelection']=$this->input->post('UserType');
		
		// set empty default form field values
		$this->form_data=new stdClass;
		$this->form_data->EmployeeID = '';
		$this->form_data->FirstName = '';
		$this->form_data->LastName = '';
		$this->form_data->UserName = '';
		$this->form_data->ContactNumber= '';
		$this->form_data->Email = '';
		$this->form_data->Password= '';
		$this->form_data->ConfirmPassword= '';
		
		// run validation
		$this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required');
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|alpha');
		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|alpha');
		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('ContactNumber', 'ContactNumber', 'trim|required|min_length[10]|max_length[10]|numeric');
		//$this->form_validation->set_rules('UserType', 'UserType', 'trim|required');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required');
		$this->form_validation->set_rules('ConfirmPassword', 'ConfirmPassword', 'trim|required|matches[Password]');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('matches', '* both password does not match.');
		$this->form_validation->set_message('alpha', '* should be alphabetic');
		$this->form_validation->set_message('alpha_numeric', '* only alpha numeric');
		$this->form_validation->set_message('min_length', '* minimum 10 digits');
		$this->form_validation->set_message('max_length', '* maximum 10 digits');
		$this->form_validation->set_message('valid_email', '* valid email');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$css1="<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>";
		$css2="</h6></div>";
		$this->form_validation->set_error_delimiters($css1, $css2);
		/* $Approvers = $this->User_model->get_all_approvers()->result();
		$data['Approver']='<select name="Approver">';

			foreach($Approvers as $Approver)
				if(trim($this->input->post('Approver'))==trim($Approver->Approver))
				{
					
					$data['Approver'].='<option selected="selected" id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
				}
				else
					$data['Approver'].='<option id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
		$data['Approver'].='</select>';
		
		$data['UserType']='<select name="UserType">';
		if($this->input->post('UserType')=="SuperUser")
		{
			$data['UserType'].='<option selected="selected" id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($this->input->post('UserType')=="Engineer")
		{
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option selected="selected" id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($this->input->post('UserType')=="Raiser")
		{
			$data['UserType'].='<option selected="selected" id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		else
		if($this->input->post('UserType')=="Approver")
		{
			$data['UserType'].='<option selected="selected" id="Approver">Approver</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		$data['UserType'].='</select>'; */
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$User = array('EmployeeID' => $this->input->post('EmployeeID'),'FirstName' => $this->input->post('FirstName'),
						  'LastName' => $this->input->post('LastName'),'Password' => md5($this->input->post('Password')), 'UserType' => 'User',
						  'UserName' => $this->input->post('UserName'), 'OperatingSystem' =>$this->input->user_agent(), 'IPAddress'=>$this->input->ip_address(),
						  'ContactNumber' => $this->input->post('ContactNumber'),'UserType' => $this->input->post('UserType'),'Email' => $this->input->post('Email'),
						  'CreatedDateTime' => date('Y-m-d H:i:s'),'ModifiedDateTime' => date('Y-m-d H:i:s'));
			$id = $this->User_model->save($User);
			
			// set user message
			$data['message'] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6></h6>add new User success</div>";
			// get User details
			
		}
		
		// load view
		$this->load->view('header', $data);
		$this->load->view('UserAdd', $data);
		$this->load->view('footer');
	}
	
	function view($EmployeeID)
	{
		$this->checklogin();
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		
		// set common properties
		$data['title'] = 'User Details';
		$data['link_back'] = anchor('User/index/','Back to list of Users',array('class'=>'back'));
		
		// get User details
		$data['User'] = $this->User_model->get_by_EmployeeID($EmployeeID)->row();
		
		// load view
		$this->load->view('header', $data);
		$this->load->view('UserView', $data);
		$this->load->view('footer');
	}
	
	function update($EmployeeID)
	{
		$this->checklogin();
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$User = $this->User_model->get_by_EmployeeID($EmployeeID)->row();
		$this->form_data=new stdClass;
		$this->form_data->EmployeeID = $User->EmployeeID;
		$this->form_data->FirstName = $User->FirstName;
		$this->form_data->LastName = $User->LastName;
		$this->form_data->UserName = $User->UserName;
		$this->form_data->ContactNumber= $User->ContactNumber;
		$this->form_data->Email = $User->Email;
		$this->form_data->CreatedDateTime = $User->CreatedDateTime;
		$this->form_data->ModifiedDateTime = $User->ModifiedDateTime;
		$this->form_data->Password= '';
		$this->form_data->ConfirmPassword= '';
		
		/* $Approvers = $this->User_model->get_all_approvers()->result();
		$data['Approver']='<select name="Approver">';
			foreach($Approvers as $Approver)
				if(trim($User->Approver)==trim($Approver->Approver))
				{
					
					$data['Approver'].='<option selected="selected" id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
				}
				else
					$data['Approver'].='<option id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
		$data['Approver'].='</select>';
		
		$data['UserType']='<select name="UserType">';
		if($User->UserType=="SuperUser")
		{
			$data['UserType'].='<option selected="selected" id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($User->UserType=="Engineer")
		{
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option selected="selected" id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($User->UserType=="Raiser")
		{
			$data['UserType'].='<option selected="selected" id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		else
		if($User->UserType=="Approver")
		{
			$data['UserType'].='<option selected="selected" id="Approver">Approver</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		$data['UserType'].='</select>'; */
		
		// set common properties
		$data['title'] = 'Update User';
		$data['message'] = '';
		$data['action'] = site_url('User/updateUser',$data);
		$data['link_back'] = anchor('User/index/','Back to list of Users',array('class'=>'back'));
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		
		// load view
		$this->load->view('header', $data);
		$this->load->view('UserEdit', $data);
		$this->load->view('footer');
	}
	
	function updateUser()
	{
		$this->checklogin();
		// set common properties
		$data['title'] = 'Update User';
		$data['action'] = site_url('User/updateUser');
		$data['link_back'] = anchor('User/index/','Back to list of Users',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		
		// run validation
		$this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required');
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|alpha');
		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|alpha');
		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('ContactNumber', 'ContactNumber', 'trim|required|numeric|min_length[10]|max_length[10]');
		//$this->form_validation->set_rules('UserType', 'UserType', 'trim|required');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'trim');
		$this->form_validation->set_rules('ConfirmPassword', 'ConfirmPassword', 'trim|matches[Password]');
		$this->form_validation->set_rules('CreatedDateTime', 'CreatedDateTime', 'trim|required');
		$this->form_validation->set_rules('ModifiedDateTime', 'MOdifiedDateTime', 'trim|required');
		
		$css1="<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>";
		$css2="</h6></div>";
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('matches', '* both password does not match.');
		$this->form_validation->set_message('alpha', '* should be alphabetic');
		$this->form_validation->set_message('alpha_numeric', '* only alpha numeric');
		$this->form_validation->set_message('min_length', '* minimum 10 digits');
		$this->form_validation->set_message('max_length', '* maximum 10 digits');
		$this->form_validation->set_message('valid_email', '* valid email');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters($css1, $css2);
		/* $Approvers = $this->User_model->get_all_approvers()->result();
		$data['Approver']='<select name="Approver">';

			foreach($Approvers as $Approver)
				if(trim($this->input->post('Approver'))==trim($Approver->Approver))
				{
					
					$data['Approver'].='<option selected="selected" id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
				}
				else
					$data['Approver'].='<option id="'.$Approver->Approver.'">'.$Approver->Approver.'</option>';
		$data['Approver'].='</select>';
		
		$data['UserType']='<select name="UserType">';
		if($this->input->post('UserType')=="SuperUser")
		{
			$data['UserType'].='<option selected="selected" id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($this->input->post('UserType')=="Engineer")
		{
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
			$data['UserType'].='<option selected="selected" id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
		}
		else
		if($this->input->post('UserType')=="Raiser")
		{
			$data['UserType'].='<option selected="selected" id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="Approver">Approver</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		else
		if($this->input->post('UserType')=="Approver")
		{
			$data['UserType'].='<option selected="selected" id="Approver">Approver</option>';
			$data['UserType'].='<option id="Raiser">Raiser</option>';
			$data['UserType'].='<option id="Engineer">Engineer</option>';
			$data['UserType'].='<option id="SuperUser">SuperUser</option>';
		}
		$data['UserType'].='</select>'; */
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
			
		}
		else
		{
			// save data
			$EmployeeID = $this->input->post('EmployeeID');
			if($this->input->post('Password')=='')
				$User = array('FirstName' => $this->input->post('FirstName'),'LastName' => $this->input->post('LastName'),
						  'UserName' => $this->input->post('UserName'),
						  'ContactNumber' => $this->input->post('ContactNumber'),'Email' => $this->input->post('Email'),
						  'ModifiedDateTime' => date('Y-m-d H:i:s'));
			else
				$User = array('FirstName' => $this->input->post('FirstName'),'LastName' => $this->input->post('LastName'),
						  'UserName' => $this->input->post('UserName'),'Password' => md5($this->input->post('Password')),
						  'ContactNumber' => $this->input->post('ContactNumber'),'Email' => $this->input->post('Email'),
						  'ModifiedDateTime' => date('Y-m-d H:i:s'));
			$this->User_model->update($EmployeeID,$User);
			
			// set user message
			$data['message'] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><h6>update User success</h6></div>";
		}
		
		$sess=$this->session->all_userdata();
		$data['UserName']=$sess['UserName'];
		$data['EmployeeID']=$sess['EmployeeID'];
		$data['UserType']=$sess['UserType'];
		$data['MenuHighlight']='Users';
		
		// load view
		$this->load->view('header', $data);
		$this->load->view('UserEdit', $data);
		$this->load->view('footer');
	}
	
	function delete($EmployeeID)
	{
		$this->checklogin();
		// delete User
		$this->User_model->delete($EmployeeID);
		
		// redirect to User list page
		redirect('User/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data=new stdClass;
		$this->form_data->EmployeeID = '';
		$this->form_data->FirstName = '';
		$this->form_data->LastName = '';
		$this->form_data->UserName = '';
		$this->form_data->ContactNumber= '';
		//$this->form_data->UserType = '';
		//$this->form_data->Approver = '';
		$this->form_data->Email = '';
		$this->form_data->CreatedDateTime = '';
		$this->form_data->ModifiedDateTime = '';
		$this->form_data->Password = '';
		$this->form_data->ConfirmPassword = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required');
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|alpha');
		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|alpha');
		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('ContactNumber', 'ContactNumber', 'trim|required|min_length[10]|max_length[10]|numeric');
		//$this->form_validation->set_rules('UserType', 'UserType', 'trim|required');
		//$this->form_validation->set_rules('Approver', 'Approver', 'trim|required');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('ModifiedDateTime', 'ModifiedDateTime', 'trim|required');
		$this->form_validation->set_rules('CreatedDateTime', 'CreatedDateTime', 'trim|required');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('alpha', '* should be alphabetic');
		$this->form_validation->set_message('alpha_numeric', '* only alpha numeric');
		$this->form_validation->set_message('min_length', '* minimum 10 digits');
		$this->form_validation->set_message('max_length', '* maximum 10 digits');
		$this->form_validation->set_message('valid_email', '* valid email');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>