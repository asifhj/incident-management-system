<?php
class User_model extends CI_Model {
	
	private $tbl_user= 'users';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('EmployeeID','asc');
		return $this->db->get($tbl_user);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('EmployeeID','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	function get_all_users(){
		
		return $this->db->get($this->tbl_user);
	}
	
	function get_by_EmployeeID($EmployeeID){
		$this->db->where('EmployeeID', $EmployeeID);
		return $this->db->get($this->tbl_user);
	}
	function get_all_approvers(){
		$this->db->select('Approver');
		$this->db->group_by('Approver');
		return $this->db->get($this->tbl_user);
	}
	
	function save($User){
		
		return $this->db->insert($this->tbl_user, $User);
	}
	
	function update($EmployeeID, $person){
		$this->db->where('EmployeeID', $EmployeeID);
		$this->db->update($this->tbl_user, $person);
	}
	
	function delete($EmployeeID){
		$this->db->where('EmployeeID', $EmployeeID);
		$this->db->delete($this->tbl_user);
	}
}
?>