<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	private $msg='';
	function __construct()
	{
        parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url'); 
		
       
    }
	public function index($msg=NULL)
	{
        // Load our view to be displayed to the user
		
		$this->check_isvalidated();
		if($msg=='session')
        $data['msg'] = '<font color=red>Session expired please login again.</font><br />';
		else
		if($msg=='invalid')
        $data['msg'] = '<font color=red>Invalid username and/or password.</font><br />';
		else
		if($msg=='logout')
        $data['msg'] = '<font color=red>You are logged out successfully.</font><br />';

		else
		$data['msg'] = '<font color=red>Please login.</font><br />';
		$this->load->view('login', $data);
    }
	
	public function check()
	{
		$UserName= $this->security->xss_clean($this->input->post('UserName'));
		$Password= md5($this->security->xss_clean($this->input->post('Password')));
		// Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate($UserName, $Password);
        // Now we verify the result
		if(! $result)
		{
            // If user did not validate, then show them login page again
			//echo '<font color=red>Invalid username and/or password.</font><br />';
            $this->index('invalid');
        }else{
            // If user did validate,  Send them to members area
			redirect('/dashboard','refresh');	
        }        
		
	} 
	public function logout()
	{
        $this->session->sess_destroy();
		
        redirect('login/index/logout');
    }
	public function check_isvalidated()
	{
        if($this->session->userdata('validated'))
		{
            redirect('/dashboard');
        }else
		{
			
			$this->msg='';
		}
		
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */