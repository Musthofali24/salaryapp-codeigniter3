<?php

class Data_Absensi extends CI_Controller
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

		$this->load->model('Data_absensi_model', 'model');
	}

	public function index()
	{
		$data['title'] = "Data Absensi Pegawai";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['absensi'] = $this->model->getAbsensiData($bulantahun);

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/data_absensi', $data);
		$this->load->view('template_admin/footer');
	}

	public function input_absensi()
	{
		if ($this->input->post('submit', TRUE) == 'submit') {
			$post = $this->input->post();

			foreach ($post['bulan'] as $key => $value) {
				if ($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
					$simpan[] = array(
						'bulan'			=> $post['bulan'][$key],
						'nik'			=> $post['nik'][$key],
						'id_pegawai'	=> $post['id_pegawai'][$key],
						'jenis_kelamin'	=> $post['jenis_kelamin'][$key],
						'id_jabatan'	=> $post['id_jabatan'][$key],
						'hadir'			=> $post['hadir'][$key],
						'sakit'			=> $post['sakit'][$key],
						'alpha'			=> $post['alpha'][$key],
					);
				}
			}
			$this->ModelPenggajian->insert_batch('data_kehadiran', $simpan);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_absensi');
		}

		$data['title'] = "Form Input Absensi";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['input_absensi'] = $this->model->getInputAbsensiData($bulantahun);

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/tambah_dataAbsensi', $data);
		$this->load->view('template_admin/footer');
	}
}
