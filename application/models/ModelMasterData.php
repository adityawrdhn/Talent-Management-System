<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMasterData extends CI_Model {

	// var $table = 'hrm_employee';
	// var $column_order = array('hrm_employee.pernr','hrm_employee.name','hrm_performancy.key_performance_indicator','hrm_potency.key_potency_indicator','hrm_employee.grade'); //set column field database for datatable orderable
	// var $column_search = array('hrm_employee.pernr','hrm_employee.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	// var $order = array('hrm_employee.pernr' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($table)
	{
		
		$this->db->select("*");
		$this->db->from($table);
		if ($table=="hrm_emgroup") {
			$column_order = array('persgid','persg_text',null); //set column field database for datatable orderable
			$column_search = array('persgid','persg_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('persgid' => 'asc'); // default order 
		}
		elseif ($table=="hrm_emsubgroup") {
			$this->db->join('hrm_emgroup', 'hrm_emsubgroup.persgid=hrm_emgroup.persgid');
			$column_order = array('hrm_emsubgroup.perssubgid','hrm_emsubgroup.persubg_text','hrm_emgroup.persg_text', null); //set column field database for datatable orderable
			$column_search = array('hrm_emsubgroup.perssubgid','hrm_emsubgroup.persubg_text','hrm_emgroup.persg_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('hrm_emsubgroup.perssubgid' => 'asc'); // default order 
		}
		elseif ($table=="hrm_empersa") {
			$column_order = array('persaid','persa_text',null); //set column field database for datatable orderable
			$column_search = array('persaid','persa_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('persaid' => 'asc'); // default order 
		}
		elseif ($table=="hrm_emorgunit") {
			$column_order = array('orguid','org_text',null); //set column field database for datatable orderable
			$column_search = array('orguid','org_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('orguid' => 'asc'); // default order 
		}
		elseif ($table=="hrm_emjob") {
			$column_order = array('jobid','job_text',null); //set column field database for datatable orderable
			$column_search = array('jobid','job_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('jobid' => 'asc'); // default order 
		}
		elseif ($table=="hrm_emplans") {
			$column_order = array('plans','plans_text',null); //set column field database for datatable orderable
			$column_search = array('plans','plans_text'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('plans' => 'asc'); // default order 
		}
		elseif ($table=="hrm_empangkat") {
			$column_order = array('pangkat','pangkat_text','golongan','ruang',null); //set column field database for datatable orderable
			$column_search = array('pangkat','pangkat_text','golongan','ruang'); //set column field database for datatable searchable just firstname , lastname , address are searchable
			$order = array('pangkat' => 'asc'); // default order 
		}

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

	function get_datatables($table)
	{
		$this->_get_datatables_query($table);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($table)
	{
		$this->_get_datatables_query($table);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}

	public function get_by_id($table,$id)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where($id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getID($id,$table)
    {
        $q = $this->db->query("select MAX($id) as id_max from $table");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->id_max)+1;
                $kd = $tmp;
            }
        }
        else
        {
            $kd = "1";
        }
        return $kd;
    }
    public function getIDESG($id,$table)
    {
        $q = $this->db->query("select MAX(RIGHT($id,3)) as id_max from $table");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->id_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return "SG".$kd;
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
		$this->db->where($id);
		$this->db->delete($table);
	}
}