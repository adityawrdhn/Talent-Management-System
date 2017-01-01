<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mbtimodel');
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
			$bc['judul'] = "MBTI - HRIS";

		if(!empty($cek) && $stts=='admin')
		{
			$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
			$bc['hasil'] = $this->web_app_model->getAllData('mbti_test');
			$bc['hasilpribadi'] = $this->web_app_model->getSelectedData('mbti_test','pernr',$pernr);
			
			$this->load->view('admin/bg_mbti',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		elseif(!empty($cek) && $stts=='hr')
		{
			$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
			$bc['hasil'] = $this->web_app_model->getAllData('mbti_test');
			$bc['hasilpribadi'] = $this->web_app_model->getSelectedData('mbti_test','pernr',$pernr);
			
			$this->load->view('hr/bg_mbti',$bc);
			// $this->load->view('global/bg_footer',$bc);
		}
		elseif(!empty($cek) && $stts=='employee')
		{
			
			$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
			// $bc['hasil'] = $this->web_app_model->getAllData('mbti_test');
			$bc['hasilpribadi'] = $this->web_app_model->getSelectedData('mbti_test','pernr',$pernr);
			$this->load->view('employee/bg_mbti',$bc);
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
	
	public function ajax_list_soal()
	{
		$list = $this->Mbtimodel->get_datatables_soal();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mbti) {
			$no++;
			$row = array();
			$row[] = $mbti->ID_SOAL;
			$row[] = $mbti->JAWABAN_A;
			$row[] = $mbti->JAWABAN_B;
			$row[] = $mbti->TIPE_A;
			$row[] = $mbti->TIPE_B;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary btn-xs" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$mbti->ID_SOAL."'".')"><i class="glyphicon glyphicon-edit"></i></a>
				  	  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteFormSoal('."'".$mbti->ID_SOAL."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mbtimodel->count_all('mbti_soal'),
						"recordsFiltered" => $this->Mbtimodel->count_filtered_soal(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_list_test()
	{
		$list = $this->Mbtimodel->get_datatables_test();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mbti) {
			$no++;
			$row = array();
			$row[] = $mbti->ID_TEST;
			$row[] = $mbti->PERNR;
			$row[] = $mbti->name;
			$row[] = $mbti->TIPE;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteFormTest('."'".$mbti->ID_TEST."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mbtimodel->count_all('mbti_test'),
						"recordsFiltered" => $this->Mbtimodel->count_filtered_test(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_edit_soal($id)
	{
		$data = $this->Mbtimodel->get_by_id("mbti_soal", array('ID_SOAL' => $id));
		echo json_encode($data);
	}
	public function ajax_edit_test($id)
	{
		$data = $this->Mbtimodel->get_by_id("mbti_test", array('ID_TEST' => $id));
		echo json_encode($data);
	}

	public function ajax_add_soal()
	{
		$simpan['ID_SOAL'] = $this->input->post('id_soal');
		$simpan['JAWABAN_A'] = $this->input->post('jawaban_a');
		$simpan['JAWABAN_B'] = $this->input->post('jawaban_b');
		$simpan['TIPE_A'] = $this->input->post('tipe_a');
		$simpan['TIPE_B'] = $this->input->post('tipe_b');
				// 'quadran' => $this->input->post('quadran'),
		
		$insert = $this->Mbtimodel->save_soal("mbti_soal",$simpan);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_update_soal()
	{
		$simpan['ID_SOAL'] = $this->input->post('id_soal');
		$simpan['JAWABAN_A'] = $this->input->post('jawaban_a');
		$simpan['JAWABAN_B'] = $this->input->post('jawaban_b');
		$simpan['TIPE_A'] = $this->input->post('tipe_a');
		$simpan['TIPE_B'] = $this->input->post('tipe_b');
		$this->Mbtimodel->update_soal('mbti_soal',array('ID_SOAL' => $this->input->post('id_soal')), $simpan);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_soal()
	{
		// $simpan['ID_SOAL'] = $this->input->post('id_soal');
		$this->Mbtimodel->delete_by_id("mbti_soal", array('ID_SOAL' => $this->input->post('id_soal')));
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_test()
	{
		$this->Mbtimodel->delete_by_id("mbti_test", array('ID_TEST' => $this->input->post('id_test')));
		echo json_encode(array("status" => TRUE));
	}
	
    public function Test(){
    	$cek_id=$this->web_app_model->getSelectedData("mbti_test", "PERNR", $this->session->userdata("pernr"));
    	if($cek_id->num_rows()==0) {
	    	$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			$pernr = $this->session->userdata('pernr');
				$bc['name'] = $this->session->userdata('name');
				$bc['status'] = $this->session->userdata('stts');
				$bc['pernr'] = $this->session->userdata('pernr');
				$bc['gelar'] = $this->session->userdata('gelar');
				$bc['bio'] = $this->load->view('admin/bio', $bc, true);
				$bc['judul'] = "MBTI - HRIS";

			if(!empty($cek) && $stts=='admin')
			{
				$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
				$this->load->view('admin/bg_mbti_test',$bc);
			}
			elseif(!empty($cek) && $stts=='hr')
			{
				$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
				$this->load->view('hr/bg_mbti_test',$bc);
				// $this->load->view('global/bg_footer',$bc);
			}
			elseif(!empty($cek) && $stts=='employee')
			{
				
				$bc['soal'] = $this->web_app_model->getAllData('mbti_soal');
				$this->load->view('employee/bg_mbti_test',$bc);
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
		else 
		{
			$this->session->set_flashdata("sukses","
						<div class='alert alert-danger alert-dismissable'>
	                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	                    <h4><i class='icon-attention'></i> Alert!</h4>
	                   	Anda Sudah Melakukan Tes Psikologi MBTI
	                  	</div>
						");
			redirect('mbti');
		}
    }
    public function Add_Data_Test(){
        for($count=1; $count <= 60 ; $count++) {
            $soal[$count]=$this->input->post('opsino'.$count); 
        }
        $val = implode("", $soal);
        $i = substr_count($val, "1");
		$e = substr_count($val, "2");
		$s = substr_count($val, "3");
		$n = substr_count($val, "4");
		$t = substr_count($val, "5");
		$f = substr_count($val, "6");
		$j = substr_count($val, "7");
		$p = substr_count($val, "8");
		
        if ($i > $e) {
        	$hasil1 = "I";
        }
        else {
        	$hasil1 = "E";
        }

        if ($s > $n) {
        	$hasil2 = "S";
        }
        else {
        	$hasil2 = "N";
        }

		if ($t > $f) {
        	$hasil3 = "T";
        }
        else {
        	$hasil3 = "F";
        }

        if ($j > $p) {
        	$hasil4 = "J";
        }
        else {
        	$hasil4 = "P";
        }

        $file=array(
        	'PERNR' =>$this->session->userdata('pernr'),
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
            'SOAL20'  => $soal[20],
            'SOAL21'  => $soal[21],
            'SOAL22'  => $soal[22],
            'SOAL23'  => $soal[23],
            'SOAL24'  => $soal[24],
            'SOAL25'  => $soal[25],
            'SOAL26'  => $soal[26],
            'SOAL27'  => $soal[27],
            'SOAL28'  => $soal[28],
            'SOAL29'  => $soal[29],
            'SOAL30'  => $soal[30],
            'SOAL31'  => $soal[31],
            'SOAL32'  => $soal[32],
            'SOAL33'  => $soal[33],
            'SOAL34'  => $soal[34],
            'SOAL35'  => $soal[35],
            'SOAL36'  => $soal[36],
            'SOAL37'  => $soal[37],
            'SOAL38'  => $soal[38],
            'SOAL39'  => $soal[39],
            'SOAL40'  => $soal[40],
            'SOAL41'  => $soal[41],
            'SOAL42'  => $soal[42],
            'SOAL43'  => $soal[43],
            'SOAL44'  => $soal[44],
            'SOAL45'  => $soal[45],
            'SOAL46'  => $soal[46],
            'SOAL47'  => $soal[47],
            'SOAL48'  => $soal[48],
            'SOAL49'  => $soal[49],
            'SOAL50'  => $soal[50],
            'SOAL51'  => $soal[51],
            'SOAL52'  => $soal[52],
            'SOAL53'  => $soal[53],
            'SOAL54'  => $soal[54],
            'SOAL55'  => $soal[55],
            'SOAL56'  => $soal[56],
            'SOAL57'  => $soal[57],
            'SOAL58'  => $soal[58],
            'SOAL59'  => $soal[59],
            'SOAL60'  => $soal[60],
            'TIPE' => "$hasil1"."$hasil2"."$hasil3"."$hasil4",
            'STATUS' => "1"
            );
        $data['hasil']= $this->web_app_model->insertData('mbti_test', $file);
        redirect('mbti',$data);
		// print_r($file);
    }


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */