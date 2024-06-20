<?php

class Pegawai_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_pegawai_by_id($id)
    {
        $this->db->where('id_pegawai', $id);
        return $this->db->get('data_pegawai')->result();
    }

    public function get_gaji_data_by_nik($nik)
    {
        $this->db->select('data_pegawai.nama_pegawai, data_pegawai.nik, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran');
        $this->db->from('data_pegawai');
        $this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.id_jabatan');
        $this->db->where('data_kehadiran.nik', $nik);
        $this->db->order_by('data_kehadiran.bulan', 'DESC');

        return $this->db->get()->result();
    }

    public function get_print_slip_data_by_id($id)
    {
        $this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.bulan');
        $this->db->from('data_pegawai');
        $this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.id_jabatan');
        $this->db->where('data_kehadiran.id_kehadiran', $id);

        return $this->db->get()->result();
    }
}
