<?php

class Data_Jabatan_model extends CI_Model
{
    public function get_all_jabatan()
    {
        return $this->db->get('data_jabatan')->result();
    }

    public function insert_jabatan($data)
    {
        $this->db->insert('data_jabatan', $data);
    }

    public function get_jabatan_by_id($id)
    {
        $this->db->where('id_jabatan', $id);
        return $this->db->get('data_jabatan')->result();
    }

    public function update_jabatan($id, $data)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->update('data_jabatan', $data);
    }

    public function delete_jabatan($id)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->delete('data_jabatan');
    }
}
