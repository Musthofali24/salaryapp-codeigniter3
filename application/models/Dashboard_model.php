<?php

class Dashboard_model extends CI_Model
{
    public function get_total_pegawai()
    {
        return $this->db->count_all('data_pegawai');
    }

    public function get_total_admin()
    {
        return $this->db->where('id_jabatan', 'Admin')->count_all_results('data_pegawai');
    }

    public function get_total_jabatan()
    {
        return $this->db->count_all('data_jabatan');
    }

    public function get_total_kehadiran()
    {
        return $this->db->count_all('data_kehadiran');
    }
}
