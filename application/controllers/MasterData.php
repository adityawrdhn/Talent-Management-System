<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterData extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelMasterEmployee','master_employee');
		$this->load->model('ModelMasterData','master_data');

	}
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			header('location:'.base_url().'masterData/ViewEmployee');
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmployee()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			$bc['employee'] = $this->web_app_model->getAllDataEmployee();
			$bc['emgroup'] = $this->web_app_model->getAllData('hrm_emgroup');
			$bc['emsubgroup'] = $this->web_app_model->getAllData('hrm_emsubgroup');
			$bc['empersa'] = $this->web_app_model->getAllData('hrm_empersa');
			$bc['emorgunit'] = $this->web_app_model->getAllData('hrm_emorgunit');
			$bc['emplans'] = $this->web_app_model->getAllData('hrm_emplans');
			$bc['emjob'] = $this->web_app_model->getAllData('hrm_emjob');
			$bc['empangkat'] = $this->web_app_model->getAllData('hrm_empangkat');
			$bc['getPernr'] = $this->master_employee->getPernr();

			$this->load->view('master/bg_master_employee',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	//start
	public function ViewEmgroup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			// $bc['employee'] = $this->web_app_model->getAllDataEmployee();
			$bc['emgroup'] = $this->web_app_model->getAllData('hrm_emgroup');
			$bc['getid'] = $this->master_data->getID('persgid','hrm_emgroup');
			$this->load->view('master/bg_master_emgroup',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmsubgroup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			// $bc['employee'] = $this->web_app_model->getAllDataEmployee();
			$bc['emsubgroup'] = $this->web_app_model->getAllData('hrm_emsubgroup');
			$bc['getid'] = $this->master_data->getIDESG('perssubgid','hrm_emsubgroup');
			$bc['emgroup'] = $this->web_app_model->getAllData('hrm_emgroup');
			$this->load->view('master/bg_master_emsubgroup',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmpersa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			// $bc['employee'] = $this->web_app_model->getAllDataEmployee();
			$bc['empersa'] = $this->web_app_model->getAllData('hrm_empersa');
			$bc['getid'] = $this->master_data->getID('persaid','hrm_empersa');
						
			$this->load->view('master/bg_master_empersa',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmorgunit()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			// $bc['employee'] = $this->web_app_model->getAllDataEmployee();
			$bc['emorgunit'] = $this->web_app_model->getAllData('hrm_emorgunit');
			$bc['getid'] = $this->master_data->getID('orguid','hrm_emorgunit');
						
			$this->load->view('master/bg_master_emorgunit',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmjob()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			$bc['emjob'] = $this->web_app_model->getAllData('hrm_emjob');
			$bc['getid'] = $this->master_data->getID('jobid','hrm_emjob');
						
			$this->load->view('master/bg_master_emjob',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmplans()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			$bc['emplans'] = $this->web_app_model->getAllData('hrm_emplans');
			$bc['getid'] = $this->master_data->getID('plans','hrm_emplans');
			$this->load->view('master/bg_master_emplans',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function ViewEmpangkat()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Master Data - HRIS";
			$bc['empangkat'] = $this->web_app_model->getAllData('hrm_empangkat');
			$bc['getid'] = $this->master_data->getID('pangkat','hrm_empangkat');
			
			$this->load->view('master/bg_master_empangkat',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	
	public function ajax_list_employee()
	{
		$list = $this->master_employee->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_employee) {
			$no++;
			$row = array();
			$row[] = $master_employee->pernr;
			$row[] = $master_employee->name;
			$row[] = $master_employee->gelar;
			$row[] = $master_employee->birthplace;
			$row[] = $master_employee->birthdate;
			$row[] = $master_employee->persg_text;
			$row[] = $master_employee->persubg_text;
			$row[] = $master_employee->persa_text;
			$row[] = $master_employee->org_text;
			$row[] = $master_employee->job_text;
			$row[] = $master_employee->plans_text;
			$row[] = $master_employee->grade;
			$row[] = $master_employee->pangkat_text;
			$row[] = $master_employee->golongan;
			$row[] = $master_employee->ruang;
			$row[] = $master_employee->atasan;
			$row[] = $master_employee->tmt_kerja;
			$row[] = $master_employee->tmt_mutasi;
			$row[] = $master_employee->tmt_pensiun;
			$row[] = $master_employee->gender_text;


			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_employee->pernr."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_employee->pernr."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_employee->count_all('hrm_employee'),
						"recordsFiltered" => $this->master_employee->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_employee($id)
	{
		$data = $this->master_employee->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_delete_employee()
	{
		$id=$this->input->post("pernr");
		$id_ses= $this->session->userdata('pernr');
		if ($id==$id_ses) {
			$this->session->set_flashdata("sukses","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    You cannot Delete yourself!
                  	</div>
					");
			echo json_encode(array("status" => TRUE));
			

		}else
		{
			$this->master_employee->delete_by_id('hrm_potency',$id);
			$this->master_employee->delete_by_id('hrm_performancy',$id);
			$this->master_employee->delete_by_id('hrm_user',$id);
			$this->master_employee->delete_by_id('hrm_employee',$id);
			$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
			echo json_encode(array("status" => TRUE));
		}
	}
	//emgroup
	public function ajax_list_emgroup()
	{
		$list = $this->master_data->get_datatables("hrm_emgroup");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->persgid;
			$row[] = $master_data->persg_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->persgid."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->persgid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_emgroup'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_emgroup'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_emgroup($id)
	{
		$data = $this->master_data->get_by_id('hrm_emgroup',array('persgid'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_emgroup()
	{
		$id=$this->input->post("persgid");
		$this->master_data->delete_by_id('hrm_emsubgroup',array('persgid'=>$id));
		$this->master_data->delete_by_id('hrm_emgroup',array('persgid'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//emsubgroup
	public function ajax_list_emsubgroup()
	{
		$list = $this->master_data->get_datatables("hrm_emsubgroup");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->perssubgid;
			$row[] = $master_data->persubg_text;
			$row[] = $master_data->persg_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->perssubgid."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->perssubgid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_emsubgroup'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_emsubgroup'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_emsubgroup($id)
	{
		$data = $this->master_data->get_by_id('hrm_emsubgroup',array('perssubgid'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_emsubgroup()
	{
		$id=$this->input->post("perssubgid");
		// $this->master_data->delete_by_id('hrm_employee',array('perssubgid'=>$id));
		$this->master_data->delete_by_id('hrm_emsubgroup',array('perssubgid'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//empersa
	public function ajax_list_empersa()
	{
		$list = $this->master_data->get_datatables("hrm_empersa");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->persaid;
			$row[] = $master_data->persa_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->persaid."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->persaid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_empersa'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_empersa'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_empersa($id)
	{
		$data = $this->master_data->get_by_id('hrm_empersa',array('persaid'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_empersa()
	{
		$id=$this->input->post("persaid");
		$this->master_data->delete_by_id('hrm_empersa',array('persaid'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//emorgunit
	public function ajax_list_emorgunit()
	{
		$list = $this->master_data->get_datatables("hrm_emorgunit");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->orguid;
			$row[] = $master_data->org_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->orguid."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->orguid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_emorgunit'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_emorgunit'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_emorgunit($id)
	{
		$data = $this->master_data->get_by_id('hrm_emorgunit',array('orguid'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_emorgunit()
	{
		$id=$this->input->post("orguid");
		$this->master_data->delete_by_id('hrm_emorgunit',array('orguid'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//emjob
	public function ajax_list_emjob()
	{
		$list = $this->master_data->get_datatables("hrm_emjob");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->jobid;
			$row[] = $master_data->job_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->jobid."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->jobid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_emjob'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_emjob'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit_emjob($id)
	{
		$data = $this->master_data->get_by_id('hrm_emjob',array('jobid'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_emjob()
	{
		$id=$this->input->post("jobid");
		$this->master_data->delete_by_id('hrm_emjob',array('jobid'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//emplans
	public function ajax_list_emplans()
	{
		$list = $this->master_data->get_datatables("hrm_emplans");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->plans;
			$row[] = $master_data->plans_text;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->plans."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->plans."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_emplans'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_emplans'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit_emplans($id)
	{
		$data = $this->master_data->get_by_id('hrm_emplans',array('plans'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_emplans()
	{
		$id=$this->input->post("plans");
		$this->master_data->delete_by_id('hrm_emplans',array('plans'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	//empangkat
	public function ajax_list_empangkat()
	{
		$list = $this->master_data->get_datatables("hrm_empangkat");
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_data) {
			$no++;
			$row = array();
			$row[] = $master_data->pangkat;
			$row[] = $master_data->pangkat_text;
			$row[] = $master_data->golongan;
			$row[] = $master_data->ruang;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_data->pangkat."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_data->pangkat."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_data->count_all('hrm_empangkat'),
						"recordsFiltered" => $this->master_data->count_filtered('hrm_empangkat'),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit_empangkat($id)
	{
		$data = $this->master_data->get_by_id('hrm_empangkat',array('pangkat'=>$id));
		echo json_encode($data);
	}
	public function ajax_delete_empangkat()
	{
		$id=$this->input->post("pangkat");
		$this->master_data->delete_by_id('hrm_empangkat',array('pangkat'=>$id));
		$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}
	public function saveEmployee()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["pernr"] = $this->input->post("pernr");
			$simpan["name"] = strtoupper($this->input->post("name"));
			$simpan["gelar"] = strtoupper($this->input->post("gelar"));
			$simpan["birthplace"] = strtoupper($this->input->post("birthplace"));
			$simpan["birthdate"] = $this->input->post("birthdate");
			$simpan["persgid"] = strtoupper($this->input->post("persgid"));
			$simpan["perssubgid"] = strtoupper($this->input->post("perssubgid"));
			$simpan["persaid"] = strtoupper($this->input->post("persaid"));
			$simpan["orguid"] = strtoupper($this->input->post("orguid"));
			$simpan["plans"] = strtoupper($this->input->post("plans"));
			$simpan["jobid"] = strtoupper($this->input->post("jobid"));
			$simpan["pangkat"] = strtoupper($this->input->post("pangkat"));
			$simpan["atasan"] = strtoupper($this->input->post("atasan"));
			$simpan["gender_key"] = strtoupper($this->input->post("gender_key"));
			if ($simpan["gender_key"]=="L") {
				$simpan["gender_text"]= strtoupper("Laki-Laki");
			}
			elseif ($simpan["gender_key"]=="P") {
				$simpan["gender_text"]=strtoupper("Perempuan");
			}
			$simpan["tmt_kerja"] = $this->input->post("tmt_kerja");
			$simpan["tmt_mutasi"] = $this->input->post("tmt_mutasi");
			$simpan["tmt_pensiun"] = $this->input->post("tmt_pensiun");
			$simpan["grade"] = strtoupper($this->input->post("grade"));
			if($st=="edit")
			{
				$pernr = $this->input->post('pernr');
				$where = array('pernr'=>$pernr);
				$this->web_app_model->updateDataMultiField("hrm_employee",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmployee');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_employee',$simpan);
				$simpanuser["pernr"]= $this->input->post("pernr");
				$simpanuser["password"]= sha1($this->input->post("pernr"));
				$simpanuser["stts"]= "employee";
				$this->web_app_model->insertData('hrm_user',$simpanuser);
				$simpanpot["pernr"]= $this->input->post("pernr");
				$simpanpot["key_potency_indicator"]= 0;
				$this->web_app_model->insertData('hrm_potency',$simpanpot);
				$simpanper["pernr"]= $this->input->post("pernr");
				$year= Date("Y");
				$simpanper["tahun"]=$year; 
				$simpanper["periode"]= "S1";
				$simpanper["key_performance_indicator"]= 0;
				$this->web_app_model->insertData('hrm_performancy',$simpanper);

			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmployee');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmgroup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["persgid"] = strtoupper($this->input->post("persgid"));
			$simpan["persg_text"] = strtoupper($this->input->post("persg_text"));
			if($st=="edit")
			{
				$where = array('persgid'=>$simpan["persgid"]);
				$this->web_app_model->updateDataMultiField("hrm_emgroup",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmgroup');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_emgroup',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Saved
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmgroup');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmsubgroup()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["perssubgid"] = strtoupper($this->input->post("perssubgid"));
			$simpan["persubg_text"] = strtoupper($this->input->post("persubg_text"));
			$simpan["persgid"] = strtoupper($this->input->post("persgid"));
			if($st=="edit")
			{
				$where = array('perssubgid'=>$simpan["perssubgid"]);
				$this->web_app_model->updateDataMultiField("hrm_emsubgroup",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				// echo json_encode(array("status" => TRUE));
				
				header('location:'.base_url().'MasterData/ViewEmsubgroup');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_emsubgroup',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmsubgroup');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmpersa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["persaid"] = strtoupper($this->input->post("persaid"));
			$simpan["persa_text"] = strtoupper($this->input->post("persa_text"));
			// $simpan["persgid"] = strtoupper($this->input->post("persgid"));
			if($st=="edit")
			{
				$where = array('persaid'=>$simpan["persaid"]);
				$this->web_app_model->updateDataMultiField("hrm_empersa",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmpersa');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_empersa',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmpersa');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmorgunit()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["orguid"] = strtoupper($this->input->post("orguid"));
			$simpan["org_text"] = strtoupper($this->input->post("org_text"));
			// $simpan["persgid"] = strtoupper($this->input->post("persgid"));
			if($st=="edit")
			{
				$where = array('orguid'=>$simpan["orguid"]);
				$this->web_app_model->updateDataMultiField("hrm_emorgunit",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmorgunit');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_emorgunit',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmorgunit');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmjob()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["jobid"] = strtoupper($this->input->post("jobid"));
			$simpan["job_text"] = strtoupper($this->input->post("job_text"));
			// $simpan["persgid"] = strtoupper($this->input->post("persgid"));
			if($st=="edit")
			{
				$where = array('jobid'=>$simpan["jobid"]);
				$this->web_app_model->updateDataMultiField("hrm_emjob",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmjob');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_emjob',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmjob');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmplans()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["plans"] = strtoupper($this->input->post("plans"));
			$simpan["plans_text"] = strtoupper($this->input->post("plans_text"));
			// $simpan["persgid"] = strtoupper($this->input->post("persgid"));
			if($st=="edit")
			{
				$where = array('plans'=>$simpan["plans"]);
				$this->web_app_model->updateDataMultiField("hrm_emlans",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmplans');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_emplans',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmplans');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	public function saveEmpangkat()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["pangkat"] = strtoupper($this->input->post("pangkat"));
			$simpan["pangkat_text"] = strtoupper($this->input->post("pangkat_text"));
			$simpan["golongan"] = strtoupper($this->input->post("golongan"));
			$simpan["ruang"] = strtoupper($this->input->post("ruang"));
			if($st=="edit")
			{
				$where = array('pangkat'=>$simpan["pangkat"]);
				$this->web_app_model->updateDataMultiField("hrm_empersa",$simpan,$where);
				$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'MasterData/ViewEmpangkat');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('hrm_empangkat',$simpan);
				
			 	$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");

				header('location:'.base_url().'MasterData/ViewEmpangkat');
			}
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Silahkan Melakukan Login Lagi
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}

// last master data
	public function tampil_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Manajemen Jadwal - HRIS ";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['jadwal'] = $this->web_app_model->getSemuaJadwal();
			$bc['mata_kuliah'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['tahun_ajaran'] = $this->web_app_model->getSelectedData('tbl_thn_ajaran','stts',1);
			

			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_jadwal',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_jadwal' => $id);
			$this->web_app_model->deleteData('tbl_jadwal',$hapus);
			header('location:'.base_url().'admin/tampil_jadwal');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function peserta()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d = explode("_",$this->uri->segment(3));
			$bc['peserta'] = $this->web_app_model->getPeserta($d[0],$d[1]);
			
			$this->load->view('admin/bg_peserta',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Manajemen Jadwal - HRIS ";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['jadwal'] = $this->web_app_model->getSemuaJadwal();
			$bc['mata_kuliah'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['tahun_ajaran'] = $this->web_app_model->getSelectedData('tbl_thn_ajaran','stts',1);
			$bc['edit'] = $this->web_app_model->getEditJadwal($this->uri->segment('3'));
			

			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_edit_jadwal',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['mata_kuliah'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['tahun_ajaran'] = $this->web_app_model->getSelectedData('tbl_thn_ajaran','stts',1);
			
			$this->load->view('admin/bg_tambah_jadwal',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$hari = $this->input->post('hari');
			$mulai = clear($this->input->post('jam_mulai'));
			$akhir = clear($this->input->post('jam_akhir'));
			$ruangan = clear($this->input->post('ruang'));
			$jadwal = $hari.' / '.$mulai.'-'.$akhir.' / '.$ruangan;
			
			$simpan["kd_mk"] = $this->input->post("kd_mk");
			$simpan["kd_dosen"] = $this->input->post("kd_dosen");
			$simpan["kd_tahun"] = $this->input->post("kd_tahun");
			$simpan["jadwal"] = $jadwal;
			$simpan["kapasitas"] = $this->input->post("kapasitas");
			$simpan["kelas_program"] = $this->input->post("kelas_program");
			$simpan["kelas"] = $this->input->post("kelas");
			
			if($st=="edit")
			{
				$kd_jadwal = $this->input->post('kd_jadwal');
				$where = array('kd_jadwal'=>$kd_jadwal);
				$this->web_app_model->updateDataMultiField("tbl_jadwal",$simpan,$where);
				header('location:'.base_url().'admin/tampil_jadwal');

			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('tbl_jadwal',$simpan);
					header('location:'.base_url().'admin/tampil_jadwal');
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Dosen - HRIS ";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_dosen',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_dosen');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Dosen - HRIS ";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			
			$bc['edit_dosen'] = $this->web_app_model->getSelectedData('tbl_dosen','kd_dosen',$this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_edit_dosen',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nidn"] = $this->input->post("nidn");
			$simpan["nama_dosen"] = $this->input->post("nama_dosen");
			
			if($st=="edit")
			{
				$kd_dosen = $this->input->post('kd_dosen');
				$where = array('kd_dosen'=>$kd_dosen);
				$this->web_app_model->updateDataMultiField("tbl_dosen",$simpan,$where);
				header('location:'.base_url().'admin/dosen');
				
			}
			else if($st=="tambah")
			{
				$simpan["kd_dosen"] = $this->input->post("kd_dosen");
				if($this->web_app_model->cekKodeDosenMax($simpan["kd_dosen"])==0)
				{
					$this->web_app_model->insertData('tbl_dosen',$simpan);
					$lg['username'] = $this->input->post("kd_dosen");
					$lg['password'] = md5($lg['username']);
					$lg['stts'] = "dosen";
					$this->web_app_model->insertData('tbl_login',$lg);
					header('location:'.base_url().'admin/dosen');
				
				}
				else
				{
					$this->session->set_flashdata("save_dosen","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Kode Dosen Sudah Terpakai
                  </div>
					");
				header('location:'.base_url().'admin/dosen');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_dosen' => $id);
			$hapus2 = array('username' => $id);
			$this->web_app_model->deleteData('tbl_dosen',$hapus);
			$this->web_app_model->deleteData('tbl_dosen_wali',$hapus);
			$this->web_app_model->deleteData('tbl_login',$hapus2);
			header('location:'.base_url().'admin/dosen');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function dosen_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Dosen - Mata Kuliah - HRIS";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['dosen_mk'] = $this->web_app_model->getDosenMk($this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_dosen_mk',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mata Kuliah - HRIS";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['mk'] = $this->web_app_model->getAllData('tbl_mk');
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mk',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_mk');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mata Kuliah - HRIS";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['mk'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['edit_mk'] = $this->web_app_model->getSelectedData('tbl_mk','kd_mk',$this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_edit_mk',$bc);
			$this->load->view('global/bg_footer',$d);

		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nama_mk"] = $this->input->post("nama_mk");
			$simpan["jum_sks"] = $this->input->post("jum_sks");
			$simpan["semester"] = $this->input->post("semester");
			$simpan["prasyarat_mk"] = $this->input->post("prasyarat_mk");
			$simpan["kode_jur"] = $this->input->post("kode_jur");
			
			if($st=="edit")
			{
				$kd_mk = $this->input->post('kd_mk');
				$where = array('kd_mk'=>$kd_mk);
				$this->web_app_model->updateDataMultiField("tbl_mk",$simpan,$where);
				header('location:'.base_url().'admin/mk');
				
			}
			else if($st=="tambah")
			{
				$simpan["kd_mk"] = $this->input->post("kd_mk");
				if($this->web_app_model->cekKodeMkMax($simpan["kd_mk"])==0)
				{
					$this->web_app_model->insertData('tbl_mk',$simpan);
					header('location:'.base_url().'admin/mk');
				}
				else
				{
					$this->session->set_flashdata("save_mk","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Kode Mata Kuliah Sudah Terpakai
                  </div>
					");
				header('location:'.base_url().'admin/mk');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_mk' => $id);
			$this->web_app_model->deleteData('tbl_mk',$hapus);
			$this->web_app_model->deleteData('tbl_jadwal',$hapus);
			header('location:'.base_url().'admin/mk');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mk_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mata Kuliah - Dosen - HRIS ";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['mk_dosen'] = $this->web_app_model->getMkDosen($this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mk_dosen',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mahasiswa - HRIS";

			$page=$this->uri->segment(3);
			$limit=20;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$tot_hal = $this->web_app_model->getAllData("tbl_mahasiswa");
			$config['base_url'] = base_url() . 'admin/mahasiswa/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = "<i class='fa fa-chevron-right'></i>";
			$config['prev_link'] = "<i class='fa fa-chevron-left'></i>";
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['mahasiswa'] = $this->web_app_model->getAllDataLimited('tbl_mahasiswa',$offset,$limit);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mahasiswa',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mahasiswa - HRIS";

			$page=$this->uri->segment(3);
			$limit=20;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$tot_hal = $this->web_app_model->getAllData("tbl_mahasiswa");
			$config['base_url'] = base_url() . 'admin/mahasiswa/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = "<i class='icon-right-circled'></i>";
			$config['prev_link'] = "<i class='icon-left-circled'></i>";
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');

			$bc['mahasiswa'] = $this->web_app_model->getAllData('tbl_mahasiswa');
			
			// $bc['mahasiswa'] = $this->web_app_model->getAllDataLimited('tbl_mahasiswa',$offset,$limit);
			$bc['emahasiswa'] = $this->web_app_model->getEditMahasisiwa($this->uri->segment(3));

			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_edit_mahasiswa',$bc);
			$this->load->view('global/bg_footer',$d);

		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$this->load->view('admin/bg_tambah_mahasiswa',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nama_mahasiswa"] = $this->input->post("nama_mahasiswa");
			$simpan["angkatan"] = $this->input->post("angkatan");
			$simpan["jurusan"] = $this->input->post("jurusan");
			$simpan["kelas_program"] = $this->input->post("kelas_program");
			$simpan2["kd_dosen"] = $this->input->post("kd_dosen");
			
			if($st=="edit")
			{
				$nim = $this->input->post('nim');
				$where = array('nim'=>$nim);
				$this->web_app_model->updateDataMultiField("tbl_mahasiswa",$simpan,$where);
				$this->web_app_model->updateDataMultiField("tbl_dosen_wali",$simpan2,$where);
				header('location:'.base_url().'admin/mahasiswa');
			}
			else if($st=="tambah")
			{
				$simpan["nim"] = $this->input->post("nim");
				$simpan2["nim"] = $this->input->post("nim");
				$simpan2["kd_dosen"] = $this->input->post("kd_dosen");
				$simpan3["username"] = $this->input->post("nim");
				$simpan3["password"] = md5($this->input->post("nim"));
				$simpan3["stts"] = "mahasiswa";
				if($this->web_app_model->cekNimMax($simpan["nim"])==0)
				{
					$this->web_app_model->insertData('tbl_mahasiswa',$simpan);
					$this->web_app_model->insertData('tbl_dosen_wali',$simpan2);
					$this->web_app_model->insertData('tbl_login',$simpan3);
				header('location:'.base_url().'admin/mahasiswa');
				
				}
				else
				{
					$this->session->set_flashdata("save_mahasiswa","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    NIM Sudah Terpakai
                  </div>
					");
				header('location:'.base_url().'admin/mahasiswa');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('nim' => $id);
			$hapus2 = array('username' => $id);
			$this->web_app_model->deleteData('tbl_mahasiswa',$hapus);
			$this->web_app_model->deleteData('tbl_login',$hapus2);
			$this->web_app_model->deleteData('tbl_dosen_wali',$hapus);
			header('location:'.base_url().'admin/mahasiswa');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Info Kampus - HRIS";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$bc['info'] = $this->web_app_model->getAllDataLimitedinfo('tbl_info',$offset,$limit);
			$tot_hal =  $this->web_app_model->getAllDatainfo('tbl_info');

			$config['base_url'] = base_url() . 'admin/info/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = "<i class='icon-right-circled'></i>";
			$config['prev_link'] = "<i class='icon-left-circled'></i>";
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_info',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['info'] = $this->web_app_model->getSelectedData('tbl_info','kd_info',$this->uri->segment(3));
			$this->load->view('admin/bg_edit_info',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_info');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_info' => $id);
			$this->web_app_model->deleteData('tbl_info',$hapus);
			header('location:'.base_url().'admin/info');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["judul"] = $this->input->post("judul");
			$simpan["isi"] = $this->input->post("isi");
			
			if($st=="edit")
			{
				$kd_info = $this->input->post('kd_info');
				$where = array('kd_info'=>$kd_info);
				$this->web_app_model->updateDataMultiField("tbl_info",$simpan,$where);
			header('location:'.base_url().'admin/info');
				
			}
			else if($st=="tambah")
			{
				$simpan["waktu_post"] = strtotime(date('Y-m-d H:i:s'));
				$this->web_app_model->insertData('tbl_info',$simpan);
			header('location:'.base_url().'admin/info');
				
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function akun()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Info Kampus - HRIS ";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_akun',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_akun()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$username = $this->session->userdata('username');
			$pass_lama = $this->input->post('pass_lama');
			$pass_baru = $this->input->post('pass_baru');
			$ulangi_pass = $this->input->post('ulangi_pass');
			
			$data['username'] = $username;
			$data['password'] = md5($pass_lama);
			$cek = $this->web_app_model->getSelectedDataMultiple('tbl_login',$data);
			if($cek->num_rows()>0)
			{
				if($pass_baru==$ulangi_pass)
				{
					$simpan['password'] = md5($pass_baru);
					$where = array('username'=>$username);
					$this->web_app_model->updateDataMultiField("tbl_login",$simpan,$where);
					$this->session->set_flashdata("save_akun","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>	<i class='icon-check'></i> Alert!</h4>
                    Berhasil Ganti Password.
                  	</div>
					");
					header('location:'.base_url().'admin/akun');
				}
				else
				{
					$this->session->set_flashdata("save_akun","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Password Baru Tidak Sama
                  </div>
					");
					header('location:'.base_url().'admin/akun');
				}
			}
			else
			{
				$this->session->set_flashdata("save_akun","
				    <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Password Lama Salah.
                  </div>
");
				header('location:'.base_url().'admin/akun');
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Input Nilai Mahasiswa - HRIS ";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$tot_hal =  $this->web_app_model->getAllData('tbl_nilai');
			$config['base_url'] = base_url() . 'admin/nilai/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = "<i class='icon-right-circled'></i>";
			$config['prev_link'] = "<i class='icon-left-circled'></i>";
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			$bc['mhs'] = $this->web_app_model->getDaftarMahasiswa($offset,$limit);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_daftar_mahasiswa',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function input_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Input Nilai Mahasiswa - HRIS";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$nim = $this->uri->segment(3);
			
			$dt_mhs = $this->web_app_model->getSelectedData("tbl_mahasiswa","nim",$nim);
			foreach($dt_mhs->result() as $dm)
			{
				$bc['nama_mhs'] = $dm->nama_mahasiswa;
				$bc['program'] = $dm->kelas_program;
				$bc['jurusan'] = $dm->jurusan;
				$bc['kelas_program'] = $dm->kelas_program;
			}
			
			$bc['detailfrs'] = $this->web_app_model->getDetailKrsPersetujuan($nim,$bc['kelas_program']);
			$bc['khs'] = $this->web_app_model->getNilai($nim);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_input_nilai',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$nim = $this->uri->segment(3);
			$kd_mk = $this->uri->segment(4);
			$bc['edit'] = $this->web_app_model->getEditDetailNilai($nim,$kd_mk);
			
			$this->load->view('admin/bg_edit_nilai',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function form_input_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$nim = $this->uri->segment(3);
			$kd_jdw = $this->uri->segment(4);
			$cek_smt = $this->web_app_model->getSelectedData('tbl_perwalian_header','nim',$nim);
			$bc['smt'] = "";
			foreach($cek_smt->result() as $c)
			{
				$bc['smt'] = $c->semester;
			}
			$bc['input'] = $this->web_app_model->getInputDetailNilai($nim,$kd_jdw);
			
			$this->load->view('admin/bg_form_input_nilai',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post('stts');
			
			if($st=='edit')
			{
				//$di['nim'] = $this->input->post('nim');
				//$di['kd_mk'] = $this->input->post('kd_mk');
				$nim = $this->input->post('nim');
				$kd_mk = $this->input->post('kd_mk');
				$di['kd_dosen'] = $this->input->post('kd_dosen');
				$di['kd_tahun'] = $this->input->post('kd_tahun');
				$di['semester_ditempuh'] = $this->input->post('semester_ditempuh');
				$di['grade'] = $this->input->post('grade');
				$this->web_app_model->updateDataMultiField('tbl_nilai',$di,array('nim'=>$nim, 'kd_mk'=>$kd_mk));
			header('location:'.base_url().'admin/input_nilai');
				
			}
			
			else if($st=='tambah')
			{
				$di['nim'] = $this->input->post('nim');
				$di['kd_mk'] = $this->input->post('kd_mk');
				$di['kd_dosen'] = $this->input->post('kd_dosen');
				$di['kd_tahun'] = $this->input->post('kd_tahun');
				$di['semester_ditempuh'] = $this->input->post('semester_ditempuh');
				$di['grade'] = $this->input->post('grade');
				$this->web_app_model->insertData('tbl_nilai',$di);
			header('location:'.base_url().'MasterData/info');
				
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$dl['nim'] = $this->uri->segment(3);
			$dl['kd_mk'] = $this->uri->segment(4);
			$this->web_app_model->deleteData('tbl_nilai',$dl);
			header('location:'.base_url().'MasterData/input_nilai/'.$dl['pernr']);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	public function ajax_list_appraisal()
	{
		$list = $this->master_employee->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_employee) {
			$no++;
			$row = array();
			$row[] = $master_employee->pernr;
			$row[] = $master_employee->name;
			$row[] = $master_employee->gelar;
			$row[] = $master_employee->birthplace;
			$row[] = $master_employee->birthdate;
			$row[] = $master_employee->persg_text;
			$row[] = $master_employee->persubg_text;
			$row[] = $master_employee->persa_text;
			$row[] = $master_employee->org_text;
			$row[] = $master_employee->job_text;
			$row[] = $master_employee->plans_text;
			$row[] = $master_employee->grade;
			$row[] = $master_employee->pangkat_text;
			$row[] = $master_employee->golongan;
			$row[] = $master_employee->ruang;
			$row[] = $master_employee->tmt_kerja;
			$row[] = $master_employee->tmt_mutasi;
			$row[] = $master_employee->tmt_pensiun;
			$row[] = $master_employee->gender_text;


			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$master_employee->pernr."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$master_employee->pernr."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->master_employee->count_all('hrm_employee'),
						"recordsFiltered" => $this->master_employee->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_get_appraisal($id)
	{
		$data = $this->master_employee->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_delete_appraisal()
	{
		$id=$this->input->post("pernr");
		$id_ses= $this->session->userdata('pernr');
		if ($id==$id_ses) {
			$this->session->set_flashdata("sukses","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    You can't Delete yourself!
                  	</div>
					");
			echo json_encode(array("status" => TRUE));
			

		}
		else
		{
			$this->master_employee->delete_by_id('hrm_potency',$id);
			$this->master_employee->delete_by_id('hrm_performancy',$id);
			$this->master_employee->delete_by_id('hrm_user',$id);
			$this->master_employee->delete_by_id('hrm_employee',$id);
			$this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Deleted
                  	</div>
					");
			echo json_encode(array("status" => TRUE));
		}
	}
}
/* End of file masterdata.php */
/* Location: ./application/controllers/MasterData.php */