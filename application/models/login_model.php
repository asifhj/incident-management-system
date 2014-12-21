<?php
class login_model extends CI_Model {
	
	private $tbl_person= 'Users';
	
	function __construct(){
		parent::__construct();
	}
	public function HashPassword($password)
	{
		 /*  mt_srand((double)microtime()*1000000);
		  $salt = mhash_keygen_s2k(MHASH_SHA1, $password, substr(pack('h*', md5(mt_rand())), 0, 8), 4);
		  $hash = "{SSHA}".base64_encode(mhash(MHASH_SHA1, $password.$salt).$salt);
		  return $hash; */
		  return(md5($password));
	}
	public function validate($UserName, $Password)
	{	
        // Prep the query
        $this->db->where('UserName', $UserName);
        $this->db->where('Password', $Password);
		//$this->db->where('isadmin','1');
        
        // Run the query
        $query = $this->db->get('users');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'Email' => $row->Email,
                    'FirstName' => $row->FirstName,
					'UserName' => $row->UserName,
					'LastName' => $row->LastName,
					'UserType'=> $row->UserType,
					'EmployeeID'=>$row->EmployeeID,
                    'validated' => true,
				   );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_person);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_person);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_person, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_person);
	}
	
	function save($person){
		$this->db->insert($this->tbl_person, $person);
		return $this->db->insert_id();
	}
	
	function update($id, $person){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_person, $person);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_person);
	}
}
?>