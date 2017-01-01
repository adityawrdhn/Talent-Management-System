<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk halaman awal ketika aplikasi krs web based diakses
	 **/
	public function _construct()
	{
		session_start();
	}
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			$d['judul'] = "Login | HRM";
			$this->load->view('global/bg_top_login',$d);
			$this->load->view('web/bg_login',$d);
		}
		else
		{
			$st = $this->session->userdata('stts');
			if($st=='mahasiswa')
			{
				header('location:'.base_url().'mahasiswa');
			}
			else if($st=='dosen')
			{
				header('location:'.base_url().'dosen');
			}
			else if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
		
		}
	}
	
	public function login()
	{
		$d['judul'] = "Login - Talent Management System";
		$usr = $this->input->post('pernr');
		$psw = $this->input->post('password');
		$u = $this->db->escape_str($usr, TRUE);
		$p = sha1($this->db->escape_str($psw, TRUE));
		$q_cek_login = $this->db->get_where('hrm_user', array('pernr' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				if($qck->stts=='employee')
				{
					$q_ambil_data = $this->web_app_model->manualQuery("SELECT * FROM hrm_employee a,hrm_emgroup b, hrm_emsubgroup c,hrm_empersa d,hrm_emorgunit e,hrm_emplans f,hrm_emjob g, hrm_empangkat h WHERE a.pernr='$u' and a.persgid=b.persgid and a.perssubgid=c.perssubgid and a.persaid=d.persaid and a.orguid=e.orguid and a.plans=f.plans and a.jobid=g.jobid and a.pangkat=h.pangkat");
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['pernr'] = $qad->pernr;
						$sess_data['name'] = $qad->name;
						$sess_data['gelar'] = $qad->gelar;
						$sess_data['birthdate'] = $qad->birthdate;
						$sess_data['birthplace'] = $qad->birthplace;
						$sess_data['persgid'] = $qad->persgid;
						$sess_data['persg_text'] = $qad->persg_text;
						$sess_data['perssubgid'] = $qad->perssubgid;
						$sess_data['persubg_text'] = $qad->persubg_text;
						$sess_data['persaid'] = $qad->persaid;
						$sess_data['persa_text'] = $qad->persa_text;
						$sess_data['orguid'] = $qad->orguid;
						$sess_data['org_text'] = $qad->org_text;
						$sess_data['plans'] = $qad->plans;
						$sess_data['plans_text'] = $qad->plans_text;
						$sess_data['jobid'] = $qad->jobid;
						$sess_data['job_text'] = $qad->job_text;
						$sess_data['grade'] = $qad->grade;
						$sess_data['pangkat'] = $qad->pangkat;
						$sess_data['pangkat_text'] = $qad->pangkat_text;
						$sess_data['golongan'] = $qad->golongan;
						$sess_data['ruang'] = $qad->ruang;
						$sess_data['atasan'] = $qad->atasan;
						$sess_data['tmt_kerja'] = $qad->tmt_kerja;
						$sess_data['gender_key'] = $qad->gender_key;
						$sess_data['gender_text'] = $qad->gender_text;
						$sess_data['stts'] = 'employee';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'employee');
				}
				else if($qck->stts=='hr')
				{
					$q_ambil_data = $this->web_app_model->manualQuery("SELECT * FROM hrm_employee a,hrm_emgroup b, hrm_emsubgroup c,hrm_empersa d,hrm_emorgunit e,hrm_emplans f,hrm_emjob g, hrm_empangkat h WHERE a.pernr='$u' and a.persgid=b.persgid and a.perssubgid=c.perssubgid and a.persaid=d.persaid and a.orguid=e.orguid and a.plans=f.plans and a.jobid=g.jobid and a.pangkat=h.pangkat");
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['pernr'] = $qad->pernr;
						$sess_data['name'] = $qad->name;
						$sess_data['gelar'] = $qad->gelar;
						$sess_data['birthdate'] = $qad->birthdate;
						$sess_data['birthplace'] = $qad->birthplace;
						$sess_data['persgid'] = $qad->persgid;
						$sess_data['persg_text'] = $qad->persg_text;
						$sess_data['perssubgid'] = $qad->perssubgid;
						$sess_data['persubg_text'] = $qad->persubg_text;
						$sess_data['persaid'] = $qad->persaid;
						$sess_data['persa_text'] = $qad->persa_text;
						$sess_data['orguid'] = $qad->orguid;
						$sess_data['org_text'] = $qad->org_text;
						$sess_data['plans'] = $qad->plans;
						$sess_data['plans_text'] = $qad->plans_text;
						$sess_data['jobid'] = $qad->jobid;
						$sess_data['job_text'] = $qad->job_text;
						$sess_data['grade'] = $qad->grade;
						$sess_data['pangkat'] = $qad->pangkat;
						$sess_data['pangkat_text'] = $qad->pangkat_text;
						$sess_data['golongan'] = $qad->golongan;
						$sess_data['ruang'] = $qad->ruang;
						$sess_data['atasan'] = $qad->atasan;
						$sess_data['tmt_kerja'] = $qad->tmt_kerja;
						$sess_data['gender_key'] = $qad->gender_key;
						$sess_data['gender_text'] = $qad->gender_text;
						$sess_data['stts'] = 'hr';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'hr');
				}
				else if($qck->stts=='admin')
				{
					$q_ambil_data = $this->web_app_model->manualQuery("SELECT * FROM hrm_employee a,hrm_emgroup b, hrm_emsubgroup c,hrm_empersa d,hrm_emorgunit e,hrm_emplans f,hrm_emjob g, hrm_empangkat h WHERE a.pernr='$u' and a.persgid=b.persgid and a.perssubgid=c.perssubgid and a.persaid=d.persaid and a.orguid=e.orguid and a.plans=f.plans and a.jobid=g.jobid and a.pangkat=h.pangkat");
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['pernr'] = $qad->pernr;
						$sess_data['name'] = $qad->name;
						$sess_data['gelar'] = $qad->gelar;
						$sess_data['birthdate'] = $qad->birthdate;
						$sess_data['birthplace'] = $qad->birthplace;
						$sess_data['persgid'] = $qad->persgid;
						$sess_data['persg_text'] = $qad->persg_text;
						$sess_data['perssubgid'] = $qad->perssubgid;
						$sess_data['persubg_text'] = $qad->persubg_text;
						$sess_data['persaid'] = $qad->persaid;
						$sess_data['persa_text'] = $qad->persa_text;
						$sess_data['orguid'] = $qad->orguid;
						$sess_data['org_text'] = $qad->org_text;
						$sess_data['plans'] = $qad->plans;
						$sess_data['plans_text'] = $qad->plans_text;
						$sess_data['jobid'] = $qad->jobid;
						$sess_data['job_text'] = $qad->job_text;
						$sess_data['grade'] = $qad->grade;
						$sess_data['pangkat'] = $qad->pangkat;
						$sess_data['pangkat_text'] = $qad->pangkat_text;
						$sess_data['golongan'] = $qad->golongan;
						$sess_data['ruang'] = $qad->ruang;
						$sess_data['atasan'] = $qad->atasan;
						$sess_data['tmt_kerja'] = $qad->tmt_kerja;
						$sess_data['gender_key'] = $qad->gender_key;
						$sess_data['gender_text'] = $qad->gender_text;
						$sess_data['stts'] = 'admin';
						$this->session->set_userdata($sess_data);

					}
					header('location:'.base_url().'admin');
				}
			}
		}
		else
		{
			header('location:'.base_url().'admin');
		}
	}
	
	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			// $this->session->sess_destroy();
			header('location:'.base_url().'web');
		}
		else
		{
			$this->session->sess_destroy();
			header('location:'.base_url().'web');
		}
	}
	public function fileNotfound()
	{
		
		$this->load->view('web/404');
		
	}

}

/* End of file web.php */
/* Location: ./application/controllers/web.php */