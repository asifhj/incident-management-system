<?php
class Ticket_model extends CI_Model {
	
	private $tbl_user= 'tickets';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('TicketNo','asc');
		return $this->db->get($tbl_user);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){

		$this->db->order_by('TicketNo','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function get_all_tickets(){
		$this->db->order_by('TicketNo','asc');
		return $this->db->get($this->tbl_user);
	}
	
	function get_all_tickets_by_EmployeeID($EmployeeID)
	{
		$this->db->where('EmployeeID',$EmployeeID);
		//$this->db->order_by('TicketNo','asc');
		return $this->db->get($this->tbl_user);
	}
	function get_all_AssignedEngineers(){
		//$this->db->select('Assigned as Engineer_EmployeeID,count(TicketNo) as Assigned_Tickets, Users.UserName');
		//$this->db->join('Users','Users.EmployeeID = Assigned');// and Users.UserType="Engineer"');
		//$this->db->order_by('Assigned');
		//return $this->db->get($this->tbl_user);
		return $this->db->query("SELECT Assigned as Engineer_EmployeeID,count(TicketNo) as Assigned_Tickets, Users.UserName FROM `tickets` JOIN Users ON Users.EmployeeID=tickets.Assigned and Users.UserType='Engineer' group by Assigned ");
	}
	/* Above SQL equivalent query
		SELECT Assigned,count(TicketNo) FROM `tickets` JOIN Users ON Users.EmployeeID=tickets.Assigned and Users.UserType='Engineer' group by Assigned 
		*/
	function get_all_Engineers(){
		$this->db->where('UserType','Engineer');
		$this->db->order_by('EmployeeID');
		return $this->db->get('Users');		
	}
	function get_all_tickets_by_EmployeeID_and_Assigned($EmployeeID)
	{
		$this->db->where('Assigned',$EmployeeID);
		//$this->db->order_by('TicketNo','asc');
		return $this->db->get($this->tbl_user);
	}
	
	function get_by_TicketNo($TicketNo){
		$this->db->where('TicketNo', $TicketNo);
		return $this->db->get($this->tbl_user);
	}
	
	function get_all_approvers(){
		$this->db->select('Approver');
		$this->db->group_by('Approver');
		return $this->db->get($this->tbl_user);
	}
	
	function save($Ticket){
		
		return $this->db->insert($this->tbl_user, $Ticket);
	}
	
	function update($TicketNo, $Ticket){
		$this->db->where('TicketNo', $TicketNo);
		$this->db->update($this->tbl_user, $Ticket);
	}
	
	function delete($TicketNo){
		$this->db->where('TicketNo', $TicketNo);
		$this->db->delete($this->tbl_user);
	}
}
?>