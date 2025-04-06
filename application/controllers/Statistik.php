<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Database $db
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property ModelStatistik $ms
 */
class Statistik extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

		//load model
		$this->load->model('ModelStatistik','ms');
    $this->load->model('ModelAset','ma');
	}

	public function index()
	{
		$data = array(
			'title' => 'Statistik Aset',
			'active_menu_statistik' => 'active',
      'label_kategori' => $this->ms->getNamaKategoriAset(),
      'kategori'=> $this->ms->getKodeKategoriAset(),
			'bw' => $this->ms->getAsetWujud(),
			'ph' => $this->ms->countAsetHapus(),  
		);

		$this->load->view('layouts/header',$data);
		$this->load->view('statistik/v_statistik',$data);
		$this->load->view('layouts/footer');
	}

}

/* End of file Statistik.php */
/* Location: ./application/controllers/Statistik.php */