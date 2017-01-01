<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bsc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bscmodel');
	}
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		$pernr = $this->session->userdata('pernr');
			$bc['name'] = $this->session->userdata('name');
			$bc['status'] = $this->session->userdata('stts');
			$bc['pernr'] = $this->session->userdata('pernr');
			$bc['gelar'] = $this->session->userdata('gelar');
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['judul'] = "BSC - TMS";

		if(!empty($cek) && $stts=='admin')
		{
			$bc['kpi'] = $this->web_app_model->getAllData('bsc_kpi');
			$bc['kpiuser'] = $this->web_app_model->getAllData('bsc_kpiuser');
			$bc['kpientry'] = $this->web_app_model->getSelectedData('bsc_kpientry','PERNR',$pernr);
			$bc['mykpi'] = $this->web_app_model->manualQuery("SELECT * FROM bsc_kpiuser join bsc_kpi on bsc_kpiuser.KPI_ID = bsc_kpi.KPI_ID where bsc_kpiuser.PERNR='$pernr'");
			$bc['usergetArr'] = $this->web_app_model->getSelectedData('hrm_employee', 'atasan',$pernr);
			// $bc['kpiArr'] = $this->web_app_model->manualQuery("SELECT * FROM bsc_kpi join bsc_kpiuser on bsc_kpiuser.KPI_ID = bsc_kpi.KPI_ID where bsc_kpiuser.PERNR='$pernr'");
			foreach ($mykpi->result() as $row) {
				$kpi_id= $row->KPI_ID;
				$bc['kpiArrChild'] = $this->web_app_model->manualQuery("SELECT * FROM bsc_kpi where KPI_PARENT='$kpi_id'");

			}
			// $bc['performance'] = $this->web_app_model->getSelectedData('hrm_performance','pernr',$pernr);
			
			$this->load->view('admin/bg_bsc',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		elseif(!empty($cek) && $stts=='hr')
		{
			$bc['kpi'] = $this->web_app_model->getAllData('bsc_kpi');
			$bc['kpiuser'] = $this->web_app_model->getAllData('bsc_kpiuser');
			// $bc['kpientry'] = $this->web_app_model->getSelectedData('bsc_kpientry','PERNR',$pernr);
			
			$this->load->view('hr/bg_bsc',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		elseif(!empty($cek) && $stts=='employee')
		{
			
			// $bc['soal'] = $this->web_app_model->getAllData('bsc_kpi');
			// $bc['hasil'] = $this->web_app_model->getAllData('bsc_kpiuser');
			$bc['kpientry'] = $this->web_app_model->getSelectedData('bsc_kpientry','PERNR',$pernr);
			$this->load->view('employee/bg_bsc',$bc);
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
	
	public function ajax_list_kuis()
	{
		$list = $this->Metode360model->get_datatables_kuis();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $metode360) {
			$no++;
			$row = array();
			$row[] = $metode360->ID_KUIS;
			$row[] = $metode360->SOAL;
			$row[] = $metode360->VARIABEL;
			$row[] = $metode360->JAWABAN_A;
			$row[] = $metode360->JAWABAN_B;
			$row[] = $metode360->JAWABAN_C;
			$row[] = $metode360->JAWABAN_D;
			$row[] = $metode360->JAWABAN_E;
			$row[] = $metode360->BOBOT_VARIABEL;
			$row[] = $metode360->NILAI_A;
			$row[] = $metode360->NILAI_B;
			$row[] = $metode360->NILAI_C;
			$row[] = $metode360->NILAI_D;
			$row[] = $metode360->NILAI_E;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$metode360->ID_KUIS."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  	  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteForm('."'".$metode360->ID_KUIS."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Metode360model->count_all('Metode360_kuisioner'),
						"recordsFiltered" => $this->Metode360model->count_filtered_kuis(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_list_penilaian()
	{
		$list = $this->Metode360model->get_datatables_test();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $metode360) {
			$no++;
			$row = array();
			// $row[] = $metode360->ID_PENILAIAN;
			$row[] = $metode360->NAMA_PENILAI;
			$row[] = $metode360->name;
			// $row[] = $metode360->ATASAN;
			$row[] = $metode360->PERCHAR;
			$row[] = $metode360->JOBCOMP;
			$row[] = $metode360->GENATTI;
			$row[] = $metode360->LEVEL_PENILAIAN;
			$row[] = $metode360->NILAI;
			// $row[] = $metode360->STATUS;
			$row[] = $metode360->TIMESTAMP;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteFormPenilaian('."'".$metode360->ID_PENILAIAN."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Metode360model->count_all('Metode360_penilaian'),
						"recordsFiltered" => $this->Metode360model->count_filtered_test(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	public function ajax_list_myPenilaian()
	{
		$list = $this->Metode360model->get_datatables_myPenilaian();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $metode360) {
			$no++;
			$row = array();
			// $row[] = $metode360->ID_PENILAIAN;
			$row[] = $metode360->NAMA_PENILAI;
			$row[] = $metode360->name;
			// $row[] = $metode360->ATASAN;
			$row[] = $metode360->PERCHAR;
			$row[] = $metode360->JOBCOMP;
			$row[] = $metode360->GENATTI;
			$row[] = $metode360->LEVEL_PENILAIAN;
			$row[] = $metode360->NILAI;
			// $row[] = $metode360->STATUS;
			$row[] = $metode360->TIMESTAMP;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteFormPenilaian('."'".$metode360->ID_PENILAIAN."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Metode360model->count_all_where('Metode360_penilaian',$this->session->userdata('pernr')),
						"recordsFiltered" => $this->Metode360model->count_filtered_myPenilaian(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_edit_kuis($id)
	{
		$data = $this->Metode360model->get_by_id("metode360_kuisioner", array('ID_KUIS' => $id));
		echo json_encode($data);
	}
	public function ajax_edit_penilaian($id)
	{
		$data = $this->Metode360model->get_by_id("metode360_penilaian", array('ID_PENILAIAN' => $id));
		echo json_encode($data);
	}
		

	public function ajax_add_kuis()
	{
		$simpan['ID_KUIS'] = $this->input->post('id_kuis');
		$simpan['SOAL'] = $this->input->post('soal');
		$simpan['LEVEL_SOAL'] = $this->input->post('level_soal');
		$simpan['JAWABAN_A'] = $this->input->post('jawaban_a');
		$simpan['JAWABAN_B'] = $this->input->post('jawaban_b');
		$simpan['JAWABAN_C'] = $this->input->post('jawaban_c');
		$simpan['JAWABAN_D'] = $this->input->post('jawaban_d');
		$simpan['JAWABAN_E'] = $this->input->post('jawaban_e');
				// 'quadran' => $this->input->post('quadran'),
		
		$insert = $this->Metode360model->save_kuis("metode360_kuisioner",$simpan);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_update_kuis()
	{
		$simpan['ID_KUIS'] = $this->input->post('id_kuis');
		$simpan['SOAL'] = $this->input->post('soal');
		$simpan['LEVEL_SOAL'] = $this->input->post('level_soal');
		$simpan['JAWABAN_A'] = $this->input->post('jawaban_a');
		$simpan['JAWABAN_B'] = $this->input->post('jawaban_b');
		$simpan['JAWABAN_C'] = $this->input->post('jawaban_c');
		$simpan['JAWABAN_D'] = $this->input->post('jawaban_d');
		$simpan['JAWABAN_E'] = $this->input->post('jawaban_e');
		$this->Metode360model->update_kuis('metode360_kuisioner',array('ID_KUIS' => $this->input->post('id_kuis')), $simpan);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_kuis()
	{
		$this->Metode360model->delete_by_id("metode360_kuisioner", array('ID_KUIS' => $this->input->post('id_kuis')));
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_penilaian()
	{
		$data['ID_TEST'] = $this->input->post('id_test');
		// $data['PERNR'] = $this->input->post('pernr');
		$this->web_app_model->deleteData("metode360_penilaian", $data);
		$this->web_app_model->deleteData("metode360_test", $data);
		echo json_encode(array("status" => TRUE));
	}
	
    public function isikuesioner(){
    	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		$pernr = $this->session->userdata('pernr');
		$atasan = $this->session->userdata('atasan');
		$bc['name'] = $this->session->userdata('name');
		$bc['status'] = $this->session->userdata('stts');
		$bc['pernr'] = $this->session->userdata('pernr');
		$bc['gelar'] = $this->session->userdata('gelar');
		$bc['bio'] = $this->load->view('admin/bio', $bc, true);
		$bc['judul'] = "360 - HRIS";
		$bc['penilai1'] = $this->web_app_model->getSelectedData('hrm_employee', 'pernr',$atasan);
		$bc['penilai2'] = $this->web_app_model->manualQuery("SELECT * FROM hrm_employee WHERE atasan='$atasan' AND pernr<>'$pernr'");
		$bc['penilai3'] = $this->web_app_model->getSelectedData('hrm_employee', 'atasan',$pernr);
		$bc['penilai4'] = $this->web_app_model->getSelectedData('hrm_employee', 'pernr',$pernr);
		if(!empty($cek) && $stts=='admin')
		{
			$bc['soal'] = $this->web_app_model->getAllData('metode360_kuisioner');
			$this->load->view('admin/bg_metode360_penilaian',$bc);
		}
		elseif(!empty($cek) && $stts=='hr')
		{
			$bc['soal'] = $this->web_app_model->getAllData('metode360_kuisioner');
			$this->load->view('hr/bg_metode360_penilaian',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		elseif(!empty($cek) && $stts=='employee')
		{
			$bc['soal'] = $this->web_app_model->getAllData('metode360_kuisioner');
			$this->load->view('employee/bg_metode360_penilaian',$bc);
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
	public function Add_Data_Test(){
        $cek['ID_PENILAI'] = $this->session->userdata('pernr');
        $cek['PERNR'] = $this->input->post('pernr');
        // $cek['STATUS'] ="1";
        // print_r($cek);
        $cekstatus=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
        // echo "$cekstatus->num_rows()";
        if ($cekstatus->num_rows() == 0) {
	        for ($count=1; $count <= 20 ; $count++) { 
			   	$soal[$count]=$this->input->post('opsino'.$count); 
			   	// $variabel[$count]=$this->input->post('opsino'.$count); 
			}
			$file=array(
	        	'ID_PENILAI' => $this->session->userdata('pernr'),
	        	'NAMA_PENILAI' => $this->session->userdata('name'),
	        	'PERNR' => $this->input->post('pernr'),
	        	'ATASAN' => $this->input->post('atasan'),
	        	'SOAL1'  => $soal[1],
	            'SOAL2'  => $soal[2],
	            'SOAL3'  => $soal[3],
	            'SOAL4'  => $soal[4],
	            'SOAL5'  => $soal[5],
	            'SOAL6'  => $soal[6],
	            'SOAL7'  => $soal[7],
	            'SOAL8'  => $soal[8],
	            'SOAL9'  => $soal[9],
	            'SOAL10'  => $soal[10],
	            'SOAL11'  => $soal[11],
	            'SOAL12'  => $soal[12],
	            'SOAL13'  => $soal[13],
	            'SOAL14'  => $soal[14],
	            'SOAL15'  => $soal[15],
	            'SOAL16'  => $soal[16],
	            'SOAL17'  => $soal[17],
	            'SOAL18'  => $soal[18],
	            'SOAL19'  => $soal[19],
	            'SOAL20'  => $soal[20]
			);
			// $d['ID_PENILAI'] = $this->session->userdata('pernr');
			// $d['PERNR'] = $this->input->post('pernr');
			$data= $this->web_app_model->insertData('metode360_test', $file);
	        $getdata=$this->web_app_model->getSelectedDataMultiple('metode360_test',$cek);
	        $getbobotp=$this->web_app_model->manualQuery("SELECT BOBOT_VARIABEL FROM Metode360_kuisioner WHERE VARIABEL='Personality Characteristic'");
	        $getbobotj=$this->web_app_model->manualQuery("SELECT BOBOT_VARIABEL FROM Metode360_kuisioner WHERE VARIABEL='Job Competency'");
	        $getbobotg=$this->web_app_model->manualQuery("SELECT BOBOT_VARIABEL FROM Metode360_kuisioner WHERE VARIABEL='General Attitude'");
	        foreach ($getbobotp->result() as $row) {
	        	$bobotp=$row->BOBOT_VARIABEL;
	        }
	        foreach ($getbobotj->result() as $row) {
	        	$bobotj=$row->BOBOT_VARIABEL;
	        }
	        foreach ($getbobotg->result() as $row) {
	        	$bobotg=$row->BOBOT_VARIABEL;
	        }
	        foreach ($getdata->result() as $row) {
	        	$jumlahp=0; 
	        	$jumlahj=0; 
	        	$jumlahg=0; 
				for ($counter=1; $counter <= 20;$counter++) {  
					$soal="SOAL".$counter;
					$panjang[$counter]=$row->$soal; 
					if ($counter<=9) {
						$jumlahp +=$panjang[$counter]; 
					}
					elseif ($counter<=16) {
						$jumlahj +=$panjang[$counter]; 
					}
					elseif ($counter<=20) {
						$jumlahg +=$panjang[$counter]; 
					}
				}
				$hitung_p = ($jumlahp/9)*$bobotp/100;
				$hitung_j = ($jumlahj/7)*$bobotj/100;
				$hitung_g = ($jumlahg/4)*$bobotg/100;
				$filepenilaian=array(
				'ID_TEST' =>$row->ID_TEST,
	        	'ID_PENILAI' => $this->session->userdata('pernr'),
	        	'NAMA_PENILAI' => $this->session->userdata('name'),
	        	'PERNR' => $this->input->post('pernr'),
	        	'ATASAN' => $this->input->post('atasan'),
	        	'PERCHAR'  => number_format($hitung_p,2),
	            'JOBCOMP'  => number_format($hitung_j,2),
	            'GENATTI'  => number_format($hitung_g,2),
	            'LEVEL_PENILAIAN'  => $this->input->post('stts'),
	            'NILAI'  => number_format($hitung_p+$hitung_j+$hitung_g,2),
	            'STATUS'  => "1"
	            );

				$data= $this->web_app_model->insertData('metode360_penilaian', $filepenilaian);
				// $data= $this->web_app_model->insertData('metode360_penilaian', $filepenilaian);
				$pernr=$this->input->post('pernr');
				$cekbawahan = $this->web_app_model->getSelectedData('hrm_employee', 'atasan',$pernr);
				if ($cekbawahan->num_rows() <> 0) {
					$cekComp= $this->web_app_model->getSelectedData('hrm_competency', 'pernr',$pernr);
					if ($cekComp->num_rows()==0) {
						$cekLevel=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
				        foreach($cekLevel->result() as $row){
				        	$nilai= $row->NILAI;
				        	if ($row->LEVEL_PENILAIAN == 'atasan' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','atasan');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result1=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result atasan ="."$result1";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result1,2)));
				        		}
				        	}
				        	elseif ($row->LEVEL_PENILAIAN == 'peer' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','peer');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result2=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result peer ="."$result2";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result2,2)));
				        		}
				        	}
				        	elseif ($row->LEVEL_PENILAIAN == 'bawahan' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','bawahan');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result3=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result bawahan ="."$result3";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result3,2)));
				        		}
				        	}
				        	elseif ($row->LEVEL_PENILAIAN == 'dirisendiri' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','dirisendiri');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result4=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result SELF="."$result4";
				        			
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result4,2)));
				        		}
				        	}
				        }
					}else{
						$result1=0;
						$result2=0;
						$result3=0;
						$result4=0;
						$sumatasan= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
						$sumpeer= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
						$sumbawahan= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
						$sumdirisendiri= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
						foreach ($sumatasan->result() as $value) {
							$sum1=$value->sumNilai;
						}
						foreach ($sumpeer->result() as $value) {
							$sum2=$value->sumNilai;
						}
						foreach ($sumbawahan->result() as $value) {
							$sum3=$value->sumNilai;
						}
						foreach ($sumdirisendiri->result() as $value) {
							$sum4=$value->sumNilai;
						}
						$countatasan= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
						$countpeer= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
						$countbawahan= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
						$countdirisendiri= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
						foreach ($countatasan->result() as $value) {
							$count1=$value->countNilai;
						}
						foreach ($countpeer->result() as $value) {
							$count2=$value->countNilai;
						}
						foreach ($countbawahan->result() as $value) {
							$count3=$value->countNilai;
						}
						foreach ($countdirisendiri->result() as $value) {
							$count4=$value->countNilai;
						}
						$lvlbobot1=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','atasan');
						foreach ($lvlbobot1->result() as $key) {
							$result1=($sum1/$count1)*($key->BOBOT/100);
						}
						$lvlbobot2=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','peer');
						foreach ($lvlbobot2->result() as $key) {
							$result2=($sum2/$count2)*($key->BOBOT/100);
						}
						$lvlbobot3=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','bawahan');
						foreach ($lvlbobot3->result() as $key) {
							$result3=($sum3/$count3)*($key->BOBOT/100);
				     	}
						$lvlbobot4=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','dirisendiri');
						foreach ($lvlbobot4->result() as $key) {
							$result4=($sum4/$count4)*($key->BOBOT/100);
				     	}

						// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
						// $updateData['data']=$this->web_app_model->updateData('hrm_competency',array('competency'=>number_format($result1,2)), 'pernr', $pernr);
				        $competency=$result1+$result2+$result3+$result4;
				        echo "$result1"."+"."$result2"."+"."$result3"."+"."$result4"."="."$competency";
				        $updateData['data']=$this->web_app_model->updateData('hrm_competency',array('competency'=>number_format($competency,2)), $pernr, 'pernr');
					
					}
				}else{
					$cekComp= $this->web_app_model->getSelectedData('hrm_competency', 'pernr',$pernr);
					if ($cekComp->num_rows()==0) {
						$cekLevel=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
				        foreach($cekLevel->result() as $row){
				        	$nilai= $row->NILAI;
				        	if ($row->LEVEL_PENILAIAN == 'atasan' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_atasan');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result1=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result tb_atasan ="."$result1";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result1,2)));
				        		}
				        	}
				        	elseif ($row->LEVEL_PENILAIAN == 'peer' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_peer');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result2=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result tb_peer ="."$result2";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result2,2)));
				        		}
				        	}
				        	elseif ($row->LEVEL_PENILAIAN == 'dirisendiri' ) {
				        		$lvl=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_dirisendiri');
				        		foreach ($lvl->result() as $rows) {
				        			$bobot= $rows->BOBOT;
				        			$sumNilai= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
			        				$countNilai= $this->web_app_model->manualQuery("SELECT COUNT(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
			        				foreach ($sumNilai->result() as $sum) {
			        					$sumNilai= $sum->sumNilai;
			        				}
			        				foreach ($countNilai->result() as $sum) {
			        					$countNilai= $sum->countNilai;
			        				}
			        				$result4=($sumNilai/$countNilai)*($bobot/100);
				        			// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
				        			echo "result tb_self ="."$result4";
				        			$insertData['data']=$this->web_app_model->insertData('hrm_competency',array('pernr'=>$pernr,'competency'=>number_format($result4,2)));
				        		}
				        	}
				        }
					}else{
						$result1=0;
						$result2=0;
						// $result3=0;
						$result4=0;
						$sumatasan= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
						$sumpeer= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
						// $sumbawahan= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
						$sumdirisendiri= $this->web_app_model->manualQuery("SELECT SUM(NILAI) as sumNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
						foreach ($sumatasan->result() as $value) {
							$sum1=$value->sumNilai;
						}
						foreach ($sumpeer->result() as $value) {
							$sum2=$value->sumNilai;
						}
						// foreach ($sumbawahan->result() as $value) {
						// 	$sum3=$value->sumNilai;
						// }
						foreach ($sumdirisendiri->result() as $value) {
							$sum4=$value->sumNilai;
						}
						$countatasan= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='atasan' AND PERNR='$pernr'");
						$countpeer= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='peer' AND PERNR='$pernr'");
						// $countbawahan= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='bawahan' AND PERNR='$pernr'");
						$countdirisendiri= $this->web_app_model->manualQuery("SELECT count(NILAI) as countNilai FROM metode360_penilaian WHERE LEVEL_PENILAIAN='dirisendiri' AND PERNR='$pernr'");
						foreach ($countatasan->result() as $value) {
							$count1=$value->countNilai;
						}
						foreach ($countpeer->result() as $value) {
							$count2=$value->countNilai;
						}
						// foreach ($countbawahan->result() as $value) {
						// 	$count3=$value->countNilai;
						// }
						foreach ($countdirisendiri->result() as $value) {
							$count4=$value->countNilai;
						}
						$lvlbobot1=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_atasan');
						foreach ($lvlbobot1->result() as $key) {
							$result1=($sum1/$count1)*($key->BOBOT/100);
						}
						$lvlbobot2=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_peer');
						foreach ($lvlbobot2->result() as $key) {
							$result2=($sum2/$count2)*($key->BOBOT/100);
						}
						// $lvlbobot3=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','bawahan');
						// foreach ($lvlbobot3->result() as $key) {
						// 	$result3=$sum2/$count2*($key->bobot/100);
				  //    	}
						$lvlbobot4=$this->web_app_model->getSelectedData('metode360_bobot','LEVEL_PENILAIAN','tb_dirisendiri');
						foreach ($lvlbobot4->result() as $key) {
							$result4=($sum4/$count4)*($key->BOBOT/100);
				     	}

						// $this->web_app_model->updateDataMultifield('metode360_penilaian',$result1,$cek);
						// $updateData['data']=$this->web_app_model->updateData('hrm_competency',array('competency'=>number_format($result1,2)), 'pernr', $pernr);
				        $competency=$result1+$result2+$result4;
				        echo "$result1"."+"."$result2"."+"."$result4"."="."$competency";
				        $updateData['data']=$this->web_app_model->updateData('hrm_competency',array('competency'=>number_format($competency,2)), $pernr,'pernr');
					
					}	
				}
	        }
	        header('location:'.base_url().'Metode360/isikuesioner');
        }
    	else{
        	$this->session->set_flashdata("sukses","
					<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon-attention'></i> Alert!</h4>
                    Anda Sudah Melakukan Tes Kepada Orang tersebut
                  	</div>
					");
			header('location:'.base_url().'Metode360/isikuesioner');
        }
    }
}

/* End of file metode360.php */
/* Location: ./application/controllers/metode360.php */