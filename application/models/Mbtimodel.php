<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbtimodel extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query_soal()
    {
		$this->db->select("*");
        $this->db->from('mbti_soal');
 		$column_order = array('mbti_soal.id_soal','mbti_soal.jawaban_a','mbti_soal.jawaban_b','mbti_soal.tipe_a','mbti_soal.tipe_b'); //set column field database for datatable orderable
		$column_search = array('mbti_soal.jawaban_a','mbti_soal.jawaban_b','mbti_soal.tipe_a','mbti_soal.tipe_b'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('mbti_soal.id_soal' => 'asc'); // default order 	

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
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	private function _get_datatables_query_test()
    {
		// $this->db->select('*');
		$this->db->select("mbti_test.ID_TEST,mbti_test.PERNR,hrm_employee.name,mbti_test.TIPE" );
        $this->db->from('mbti_test');
		$this->db->join('hrm_employee','mbti_test.PERNR = hrm_employee.pernr');
        // $column_order = array('mbti_test.id_test','mbti_test.pernr','mbti_test.tipe'); //set column field database for datatable orderable
        
        $column_order = array('mbti_test.id_test','mbti_test.pernr','hrm_employee.name','mbti_test.tipe'); //set column field database for datatable orderable
		// $column_search = array('mbti_test.id_test','mbti_test.pernr','mbti_test.tipe'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$column_search = array('mbti_test.id_test','mbti_test.pernr','hrm_employee.name','mbti_test.tipe'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('mbti_test.id_test' => 'asc'); // default order 	

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
  
    function get_datatables_soal()
    {
        $this->_get_datatables_query_soal();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	function get_datatables_test()
    {
        $this->_get_datatables_query_test();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
  
    function count_filtered_soal()
    {
        $this->_get_datatables_query_soal();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_filtered_test()
    {
        $this->_get_datatables_query_test();
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
		$this->db->from($table);
 		$this->db->where($id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_soal($table,$data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_soal($table,$where, $data)
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
