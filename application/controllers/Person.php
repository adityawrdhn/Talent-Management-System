<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('person_model','talent_pool');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('person_view');
	}

	public function ajax_list()
	{
		$list = $this->talent_pool->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $talent_pool) {
			$no++;
			$row = array();
			$row[] = $talent_pool->id;
			$row[] = $talent_pool->nama;
			$row[] = $talent_pool->value1;
			$row[] = $talent_pool->value2;
			$row[] = $talent_pool->quadran;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_talent_pool('."'".$talent_pool->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_talent_pool('."'".$talent_pool->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->talent_pool->count_all(),
						"recordsFiltered" => $this->talent_pool->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->talent_pool->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'id' => $this->input->post('id'),
				'nama' => $this->input->post('nama'),
				'value1' => $this->input->post('value1'),
				'value2' => $this->input->post('value2'),
			);
		$insert = $this->talent_pool->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'id' => $this->input->post('id'),
				'nama' => $this->input->post('nama'),
				'value1' => $this->input->post('value1'),
				'value2' => $this->input->post('value2'),
			);
		$this->talent_pool->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->talent_pool->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
