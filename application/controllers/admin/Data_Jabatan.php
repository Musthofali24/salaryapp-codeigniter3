<?php

class Data_Jabatan extends CI_Controller
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

		$this->load->model('Data_jabatan_model', 'DJModel');
	}

	public function index()
	{
		$data['title'] = "AE Salary | Data Jabatan";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/data_jabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data['title'] = "AE Salary | Form Jabatan";

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/tambah_dataJabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan		= $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan,
				'gaji_pokok' 	=> $gaji_pokok,
				'tj_transport' 	=> $tj_transport,
				'uang_makan' 	=> $uang_makan,
			);

			$this->ModelPenggajian->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
		}
	}

	public function update_data($id)
	{
		$where = array('id_jabatan' => $id);
		$data['jabatan'] = $this->DJModel->get_jabatan_by_id($id);
		$data['title'] = "Update Data Jabatan";

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/update_dataJabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('id_jabatan'));
		} else {
			$id				= $this->input->post('id_jabatan');
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan		= $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan,
				'gaji_pokok' 	=> $gaji_pokok,
				'tj_transport' 	=> $tj_transport,
				'uang_makan' 	=> $uang_makan,
			);

			$where = array(
				'id_jabatan' => $id
			);

			$this->ModelPenggajian->update_data('data_jabatan', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
		$this->form_validation->set_rules('tj_transport', 'Tunjangan Transport', 'required');
		$this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required');
	}

	public function delete_data($id)
	{
		$where = array('id_jabatan' => $id);
		$this->ModelPenggajian->delete_data($where, 'data_jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('admin/data_jabatan');
	}
}
