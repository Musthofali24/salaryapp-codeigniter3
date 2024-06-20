<?php

class Data_absensi_model extends CI_Model
{
    public function getAbsensiData($bulantahun)
    {
        $this->db->select('data_kehadiran.*, data_pegawai.id_pegawai, data_pegawai.jenis_kelamin, data_pegawai.id_jabatan');
        $this->db->from('data_kehadiran');
        $this->db->join('data_pegawai', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_pegawai.id_jabatan = data_jabatan.id_jabatan');
        $this->db->where('data_kehadiran.bulan', $bulantahun);
        $this->db->order_by('data_pegawai.id_pegawai', 'ASC');

        return $this->db->get()->result();
    }

    public function getInputAbsensiData($bulantahun)
    {
        $this->db->select('data_pegawai.*, data_jabatan.id_jabatan');
        $this->db->from('data_pegawai');
        $this->db->join('data_jabatan', 'data_pegawai.id_jabatan = data_jabatan.id_jabatan');
        $this->db->where('NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan="' . $bulantahun . '" AND data_pegawai.nik=data_kehadiran.nik)');
        $this->db->order_by('data_pegawai.id_pegawai', 'ASC');

        return $this->db->get()->result();
    }
}
