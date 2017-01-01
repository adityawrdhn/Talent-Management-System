<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metode360model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query_kuis()
    {
		$this->db->select("*");
        $this->db->from('metode360_kuisioner');
 		$column_order = array('metode360_kuisioner.id_kuis','metode360_kuisioner.soal','metode360_kuisioner.variabel','metode360_kuisioner.jawaban_a','metode360_kuisioner.jawaban_b','metode360_kuisioner.jawaban_c','metode360_kuisioner.jawaban_d', 'metode360_kuisioner.jawaban_e','metode360_kuisioner.bobot_variabel'); //set column field database for datatable orderable
		$column_search = array('metode360_kuisioner.soal','metode360_kuisioner.variabel','metode360_kuisioner.jawaban_a','metode360_kuisioner.jawaban_b','metode360_kuisioner.jawaban_c','metode360_kuisioner.jawaban_d', 'metode360_kuisioner.jawaban_e'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('metode360_kuisioner.id_kuis' => 'asc'); // default order 	

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
		$this->db->select("metode360_penilaian.ID_PENILAIAN,metode360_penilaian.NAMA_PENILAI,hrm_employee.name,metode360_penilaian.PERCHAR,metode360_penilaian.JOBCOMP,metode360_penilaian.GENATTI,metode360_penilaian.PERCHAR,metode360_penilaian.LEVEL_PENILAIAN,metode360_penilaian.NILAI,metode360_penilaian.TIMESTAMP" );
        $this->db->from('metode360_penilaian');
		$this->db->join('hrm_employee','metode360_penilaian.PERNR = hrm_employee.pernr');
        // $column_order = array('metode360_penilaian.ID_PENILAIAN','metode360_penilaian.pernr','metode360_penilaian.tipe'); //set column field database for datatable orderable
        
        $column_order = array('metode360_penilaian.NAMA_PENILAI','hrm_employee.name','metode360_penilaian.PERCHAR','metode360_penilaian.JOBCOMP','metode360_penilaian.GENATTI','metode360_penilaian.PERCHAR','metode360_penilaian.LEVEL_PENILAIAN','metode360_penilaian.NILAI','metode360_penilaian.TIMESTAMP'); //set column field database for datatable orderable
		// $column_search = array('metode360_penilaian.ID_PENILAIAN','metode360_penilaian.pernr','metode360_penilaian.tipe'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$column_search = array('metode360_penilaian.NAMA_PENILAI','hrm_employee.name','metode360_penilaian.PERCHAR','metode360_penilaian.JOBCOMP','metode360_penilaian.GENATTI','metode360_penilaian.PERCHAR','metode360_penilaian.LEVEL_PENILAIAN','metode360_penilaian.NILAI','metode360_penilaian.TIMESTAMP'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('metode360_penilaian.TIMESTAMP' => 'asc'); // default order 	

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
    private function _get_datatables_query_myPenilaian()
    {
        // $this->db->select('*');
        $this->db->select("metode360_penilaian.ID_PENILAIAN,metode360_penilaian.NAMA_PENILAI,hrm_employee.name,metode360_penilaian.PERCHAR,metode360_penilaian.JOBCOMP,metode360_penilaian.GENATTI,metode360_penilaian.PERCHAR,metode360_penilaian.LEVEL_PENILAIAN,metode360_penilaian.NILAI,metode360_penilaian.TIMESTAMP" );
        $this->db->from('metode360_penilaian');
        $this->db->join('hrm_employee','metode360_penilaian.PERNR = hrm_employee.pernr');
        $this->db->where('metode360_penilaian.ID_PENILAI',$this->session->userdata('pernr'));
        // $column_order = array('metode360_penilaian.ID_PENILAIAN','metode360_penilaian.pernr','metode360_penilaian.tipe'); //set column field database for datatable orderable
        
        $column_order = array('metode360_penilaian.NAMA_PENILAI','hrm_employee.name','metode360_penilaian.PERCHAR','metode360_penilaian.JOBCOMP','metode360_penilaian.GENATTI','metode360_penilaian.PERCHAR','metode360_penilaian.LEVEL_PENILAIAN','metode360_penilaian.NILAI','metode360_penilaian.TIMESTAMP'); //set column field database for datatable orderable
        // $column_search = array('metode360_penilaian.ID_PENILAIAN','metode360_penilaian.pernr','metode360_penilaian.tipe'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $column_search = array('metode360_penilaian.NAMA_PENILAI','hrm_employee.name','metode360_penilaian.PERCHAR','metode360_penilaian.JOBCOMP','metode360_penilaian.GENATTI','metode360_penilaian.PERCHAR','metode360_penilaian.LEVEL_PENILAIAN','metode360_penilaian.NILAI','metode360_penilaian.TIMESTAMP'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        $order = array('metode360_penilaian.TIMESTAMP' => 'asc'); // default order  

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
    function get_datatables_kuis()
    {
        $this->_get_datatables_query_kuis();
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
    function get_datatables_myPenilaian()
    {
        $this->_get_datatables_query_myPenilaian();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
  
    function count_filtered_kuis()
    {
        $this->_get_datatables_query_kuis();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_filtered_test()
    {
        $this->_get_datatables_query_test();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_filtered_myPenilaian()
    {
        $this->_get_datatables_query_myPenilaian();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_all_where($table,$where)
    {
        $this->db->from($table);
        $this->db->where('ID_PENILAI',$where);
        return $this->db->count_all_results();
    }
 
	public function get_by_id($table,$id)
	{
		$this->db->from($table);
 		$this->db->where($id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_kuis($table,$data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_kuis($table,$where, $data)
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
