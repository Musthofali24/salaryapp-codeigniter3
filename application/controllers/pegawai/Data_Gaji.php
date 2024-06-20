<?php

class Data_Gaji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('id_akses') != '2') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}

		$this->load->model('Pegawai_model', 'Model');
	}
	public function index()
	{
		$data['title'] = "Data Gaji";
		$nik = $this->session->userdata('nik');
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['gaji'] = $this->Model->get_gaji_data_by_nik($nik);

		$this->load->view('template_pegawai/header', $data);
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/data_gaji', $data);
		$this->load->view('template_pegawai/footer');
	}

	public function cetak_slip($id)
	{
		$data['title'] = 'Cetak Slip Gaji';
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['print_slip'] = $this->Model->get_print_slip_data_by_id($id);
		$this->load->view('template_pegawai/header', $data);
		$this->load->view('pegawai/cetak_slip_gaji', $data);
	}
}
