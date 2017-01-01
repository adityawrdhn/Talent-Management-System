<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeTable extends CI_Model {

	var $table = 'hrm_employee';
	var $column_order = array('hrm_employee.pernr','hrm_employee.name','hrm_performancy.key_performance_indicator','hrm_potency.key_potency_indicator','hrm_employee.grade'); //set column field database for datatable orderable
	var $column_search = array('hrm_employee.pernr','hrm_employee.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('hrm_employee.pernr' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select("hrm_employee.pernr, hrm_employee.name, hrm_performancy.key_performance_indicator, hrm_potency.key_potency_indicator, hrm_employee.grade");
		$this->db->from('hrm_employee');
		$this->db->join('hrm_performancy','hrm_employee.pernr=hrm_performancy.pernr');
		$this->db->join('hrm_potency','hrm_employee.pernr=hrm_potency.pernr');
		$column_order = array('hrm_employee.pernr','hrm_employee.name','hrm_performancy.key_performance_indicator','hrm_potency.key_potency_indicator','hrm_employee.grade'); //set column field database for datatable orderable
		$column_search = array('hrm_employee.pernr','hrm_employee.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('hrm_employee.pernr' => 'asc'); // default order 

		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->select("hrm_employee.pernr, hrm_employee.name, hrm_performancy.key_performance_indicator, hrm_potency.key_potency_indicator, hrm_employee.grade");
		$this->db->from('hrm_employee');
		$this->db->join('hrm_performancy','hrm_employee.pernr=hrm_performancy.pernr');
		$this->db->join('hrm_potency','hrm_employee.pernr=hrm_potency.pernr');

		$this->db->where('hrm_employee.pernr',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($table,$data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($table,$where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($table,$id)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}


}
