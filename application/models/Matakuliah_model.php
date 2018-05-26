<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_model extends CI_Model {

    public function list()
    {
        $query = $this->db->get('matakuliah');
        return $query->result();
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('matakuliah', $data);
        return $result;
    }

    public function show($kode)
    {
        $this->db->where('kode', $kode);
        $query = $this->db->get('matakuliah');
        return $query->row();
    }

    public function update($kode, $data = [])
    {
        // TODO: set data yang akan di update
        // https://www.codeigniter.com/userguide3/database/query_builder.html#updating-data

        $this->db->where('kode', $kode);
        $this->db->update('matakuliah', $data);
        return result;
    }

    public function delete($kode)
    {
        // TODO: tambahkan logic penghapusan data
        $this->db->where('kode', $kode);
        $this->db->delete('matakuliah');
    }
}