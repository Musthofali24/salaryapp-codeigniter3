<?php

class Data_pegawai_model extends CI_Model
{
    public function get_pegawai_by_id($id)
    {
        $this->db->where('id_pegawai', $id);
        return $this->db->get('data_pegawai')->result();
    }
}
