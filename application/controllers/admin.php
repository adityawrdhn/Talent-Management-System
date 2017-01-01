<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EmployeeTable','talent_pool');
	}
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "Beranda - Sistem Informasi Akademik";
			$bc['empdata'] = $this->web_app_model->getAllDataEmployee();
			$bc['tp'] = $this->web_app_model->getAllAppraisal();
			$bc['stp'] = $this->web_app_model->getAllData('hrm_standardkey');
			
			$this->load->view('admin/bg_home',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		else
		{
			$this->session->set_flashdata("gaglog","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Periksa kembali Username dan Password
                  	</div>
					");
			header('location:'.base_url().'web');
		}
	}
	//start
	public function refresh()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			$query = $this->web_app_model->emptyTable("talent_pool");
        	$this->load->library('sap');
            $sap = new SAPConnection();
            $sap->Connect();
            if ($sap->GetStatus() == SAPRFC_OK ) $sap->Open ();
            if ($sap->GetStatus() != SAPRFC_OK ) {
            $sap->PrintStatus();
            exit;
            }
 
		    $fce = &$sap->NewFunction ("ZPD_GETDATA");
		    if ($fce == false ) {
		       $sap->PrintStatus();
		       exit;
		    }
		    $fce->Call();
		    if ($fce->GetStatus() == SAPRFC_OK) {
		        $fce->GD_TP->Reset();
		        while ($fce->GD_TP->Next()) {
		        	$id=$fce->GD_TP->row["ID"];
		        	$nm=$fce->GD_TP->row["NAME"];
		        	$value1=$fce->GD_TP->row["COMPETENCY"];
		        	$value2=$fce->GD_TP->row["PERFORMANCE"];
		        	$query = $this->web_app_model->manualQuery("SELECT * FROM standard WHERE ids='1'");
					foreach($query->result() as $data){
					    $stdcompetency =  $data->stdcompetency;
					    $stdperformance =  $data->stdperformance;
		        		if($value1>=$stdcompetency && $value2>=$stdperformance){
		        			$sql = "INSERT INTO talent_pool(id, nama, value1, value2, quadran) VALUES ('$id','$nm','$value1','$value2','Q1')";
			        		$this->web_app_model->manualQuery($sql);
						}
				 		elseif($value1<$stdcompetency && $value2>=$stdperformance){
				         	$sql = "INSERT INTO talent_pool(id, nama, value1, value2, quadran) VALUES ('$id','$nm','$value1','$value2','Q2')" ;
				         	$this->web_app_model->manualQuery($sql);
				 		}
				 		elseif($value1<$stdcompetency && $value2<$stdperformance){
				         	$sql = "INSERT INTO talent_pool(id, nama, value1, value2, quadran) VALUES ('$id','$nm','$value1','$value2','Q3')";
				         	$this->web_app_model->manualQuery($sql);
				 		}
				 		elseif($value1>=$stdcompetency && $value2<$stdperformance){
				         	$sql = "INSERT INTO talent_pool(id, nama, value1, value2, quadran) VALUES ('$id','$nm','$value1','$value2','Q4')" ;
				         	$this->web_app_model->manualQuery($sql);
				 		}
				 	}	
			    }
			    //
			    $this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
				header('location:'.base_url().'admin');
			}else
		        $fce->PrintStatus();
		 
		    $sap->Close();
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	public function ajax_list()
	{
		$list = $this->talent_pool->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $talent_pool) {
			$no++;
			$row = array();
			$row[] = $talent_pool->pernr;
			$row[] = $talent_pool->name;
			$row[] = $talent_pool->key_potency_indicator;
			$row[] = $talent_pool->key_performance_indicator;
			$row[] = $talent_pool->grade;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_talent_pool('."'".$talent_pool->pernr."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->talent_pool->count_all('hrm_employee'),
						"recordsFiltered" => $this->talent_pool->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->talent_pool->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$simpan['pernr'] = $this->input->post('pernr');
		$simpan['name'] = $this->input->post('name');
		$simpan['key_potency_indicator'] = $this->input->post('value1');
		$simpan['key_performance_indicator'] = $this->input->post('value2');
				// 'quadran' => $this->input->post('quadran'),
		
		$insert = $this->talent_pool->save($simpan);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$simpanEmp['pernr'] = $this->input->post('pernr');
		$simpanEmp['name'] = $this->input->post('name');
		$simpanPot['key_potency_indicator'] = $this->input->post('value1');
		$simpanPer['key_performance_indicator'] = $this->input->post('value2');
		$getSTD=$this->web_app_model->getAllData('hrm_standardkey');
		foreach($getSTD->result() as $row)
		{	
			$stdcompetency=$row->stdpote;
			$stdperformance=$row->stdperf;
				if($simpanPot['key_potency_indicator']>=$stdcompetency && $simpanPer['key_performance_indicator']>=$stdperformance){
					$simpanEmp['grade']="Q1";
		        	$this->talent_pool->update('hrm_employee',array('pernr' => $this->input->post('pernr')), $simpanEmp);
		        	$this->talent_pool->update('hrm_potency',array('pernr' => $this->input->post('pernr')), $simpanPot);
		        	$this->talent_pool->update('hrm_performancy',array('pernr' => $this->input->post('pernr')), $simpanPer);

				}
		 		elseif($simpanPot['key_potency_indicator']<$stdcompetency && $simpanPer['key_performance_indicator']>=$stdperformance){
		         	$simpanEmp['grade']="Q2";
		        	$this->talent_pool->update('hrm_employee',array('pernr' => $this->input->post('pernr')), $simpanEmp);
		        	$this->talent_pool->update('hrm_potency',array('pernr' => $this->input->post('pernr')), $simpanPot);
		        	$this->talent_pool->update('hrm_performancy',array('pernr' => $this->input->post('pernr')), $simpanPer);
		 		}
		 		elseif($simpanPot['key_potency_indicator']<$stdcompetency && $simpanPer['key_performance_indicator']<$stdperformance){
		         	$simpanEmp['grade']="Q3";
		        	$this->talent_pool->update('hrm_employee',array('pernr' => $this->input->post('pernr')), $simpanEmp);
		        	$this->talent_pool->update('hrm_potency',array('pernr' => $this->input->post('pernr')), $simpanPot);
		        	$this->talent_pool->update('hrm_performancy',array('pernr' => $this->input->post('pernr')), $simpanPer);
		 		}
		 		elseif($simpanPot['key_potency_indicator']>=$stdcompetency && $simpanPer['key_performance_indicator']<$stdperformance){
		         	$simpanEmp['grade']="Q4";
		        	$this->talent_pool->update('hrm_employee',array('pernr' => $this->input->post('pernr')), $simpanEmp);
		        	$this->talent_pool->update('hrm_potency',array('pernr' => $this->input->post('pernr')), $simpanPot);
		        	$this->talent_pool->update('hrm_performancy',array('pernr' => $this->input->post('pernr')), $simpanPer);
		 		}
		}
		// $this->talent_pool->update(array('pernr' => $this->input->post('id')), $simpan);
		 $this->session->set_flashdata("sukses","
					<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Data Updated
                  	</div>
					");
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->talent_pool->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function savestd()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$val['stdpote'] = $this->input->post('valuec');
			$val['stdperf'] = $this->input->post('valuep');
		
			$kd = '1234321';
			$where = array('ids'=>$kd);
			$this->web_app_model->updateDataMultiField("hrm_standardkey",$val,$where);
			$query = $this->web_app_model->getAllData('hrm_employee');
			foreach($query->result() as $row)
			{
				$getPernr = $row->pernr;
				$queryjoin = $this->web_app_model->manualQuery("SELECT * FROM hrm_employee a, hrm_potency b, hrm_performancy c, hrm_standardkey d WHERE a.pernr=$getPernr and b.pernr=a.pernr and c.pernr=a.pernr");
				foreach($queryjoin->result() as $data){
					$value1 = $data->key_potency_indicator;
					$value2 = $data->key_performance_indicator;
					$stdcompetency = $data->stdpote;
					$stdperformance = $data->stdperf;
					if($value1>=$stdcompetency && $value2>=$stdperformance){
			        	$sql = $this->web_app_model->manualQuery("UPDATE hrm_employee SET grade = 'Q1' WHERE pernr=$getPernr") ;
			        }
			 		elseif($value1<$stdcompetency && $value2>=$stdperformance){
			        	$sql = $this->web_app_model->manualQuery("UPDATE hrm_employee SET grade = 'Q2' WHERE pernr=$getPernr") ;
			 		}
			 		elseif($value1<$stdcompetency && $value2<$stdperformance){
			        	$sql = $this->web_app_model->manualQuery("UPDATE hrm_employee SET grade = 'Q3' WHERE pernr=$getPernr") ;
			 		}
			 		elseif($value1>=$stdcompetency && $value2<$stdperformance){
			        	$sql = $this->web_app_model->manualQuery("UPDATE hrm_employee SET grade = 'Q4' WHERE pernr=$getPernr") ;
			 		}

				}

			}
			
			header('location:'.base_url().'admin');
		}
		else
		{
			header('location:'.base_url().'web');
		}

	}

	//last
	public function tampil_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Manajemen Jadwal - Sistem Informasi Akademik ";
			
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
			$d['judul'] = "Manajemen Jadwal - Sistem Informasi Akademik ";
			
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
			$d['judul'] = "Daftar Dosen - Sistem Informasi Akademik ";
			
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
			$d['judul'] = "Daftar Dosen - Sistem Informasi Akademik ";
			
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
			$d['judul'] = "Daftar Dosen - Mata Kuliah - Sistem Informasi Akademik";
			
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
			$d['judul'] = "Daftar Mata Kuliah - Sistem Informasi Akademik";
			
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
			$d['judul'] = "Daftar Mata Kuliah - Sistem Informasi Akademik";
			
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
			$d['judul'] = "Daftar Mata Kuliah - Dosen - Sistem Informasi Akademik ";
			
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
			$d['judul'] = "Daftar Mahasiswa - Sistem Informasi Akademik";

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
			$d['judul'] = "Daftar Mahasiswa - Sistem Informasi Akademik";

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
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik";
		
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
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik ";
		
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
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik ";
		
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
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik";
			
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
			header('location:'.base_url().'admin/info');
				
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
			header('location:'.base_url().'admin/input_nilai/'.$dl['nim']);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */