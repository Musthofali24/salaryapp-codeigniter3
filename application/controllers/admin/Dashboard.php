<?php

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('id_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}

		$this->load->model('Dashboard_model', 'DModel');
	}

	public function index()
	{
		$data['title'] = "AE Salary | Dashboard";
		$data['pegawai'] = $this->DModel->get_total_pegawai();
		$data['admin'] = $this->DModel->get_total_admin();
		$data['jabatan'] = $this->DModel->get_total_jabatan();
		$data['kehadiran'] = $this->DModel->get_total_kehadiran();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('template_admin/footer');
	}
}
