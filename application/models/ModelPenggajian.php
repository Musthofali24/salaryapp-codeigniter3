<?php

class ModelPenggajian extends CI_model
{

	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table, $data, $whare)
	{
		$this->db->update($table, $data, $whare);
	}

	public function delete_data($whare, $table)
	{
		$this->db->where($whare);
		$this->db->delete($table);
	}

	public function insert_batch($table = null, $data = array())
	{
		$jumlah = count($data);
		if ($jumlah > 0) {
			$this->db->insert_batch($table, $data);
		}
	}

	public function get_gaji_data($bulantahun)
	{
		$this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.sakit');
		$this->db->from('data_pegawai');
		$this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
		$this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.id_jabatan');
		$this->db->where('data_kehadiran.bulan', $bulantahun);
		$this->db->order_by('data_pegawai.nama_pegawai', 'ASC');

		return $this->db->get()->result();
	}

	public function get_cetak_gaji_data($bulantahun)
	{
		$this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.sakit');
		$this->db->from('data_pegawai');
		$this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
		$this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.id_jabatan');
		$this->db->where('data_kehadiran.bulan', $bulantahun);
		$this->db->order_by('data_pegawai.nama_pegawai', 'ASC');

		return $this->db->get()->result();
	}

	public function get_lap_kehadiran_data($bulantahun)
	{
		$this->db->where('bulan', $bulantahun);
		$this->db->order_by('id_pegawai', 'ASC');

		return $this->db->get('data_kehadiran')->result();
	}

	public function get_print_slip_data($bulantahun, $nama)
	{
		$this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.bulan');
		$this->db->from('data_pegawai');
		$this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
		$this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.id_jabatan');
		$this->db->where('data_kehadiran.bulan', $bulantahun);
		$this->db->where('data_kehadiran.id_pegawai', $nama);

		return $this->db->get()->result();
	}

	public function get_data_pegawai_with_jabatan()
	{
		$this->db->select('data_pegawai.*, data_jabatan.nama_jabatan');
		$this->db->from('data_pegawai');
		$this->db->join('data_jabatan', 'data_pegawai.id_jabatan = data_jabatan.id_jabatan');
		return $this->db->get()->result();
	}

	public function get_data_pegawai_dan_hak_akses()
	{
		$this->db->select('data_pegawai.*, hak_akses.keterangan');
		$this->db->from('data_pegawai');
		$this->db->join('hak_akses', 'data_pegawai.id_akses = hak_akses.id_akses');
		return $this->db->get()->result();
	}

	public function cek_login()
	{
		$username = set_value('username');
		$password = set_value('password');

		$result = $this->db->where('username', $username)
			->where('password', md5($password))
			->limit(1)
			->get('data_pegawai');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
	}
}
