<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function list($limit, $start, $search='')
    {
        // $query = $this->db->query('select * from mahasiswa join matakuliah on mahasiswa.kode = matakuliah.kode');
        // return $query->result();

        $this->db->select('*');
        $this->db->join('matakuliah', 'matakuliah.kode=mahasiswa.kode');
        
        if ($search != 'null')
        { 
            $this->db->like('nama', $search);
            $this->db->or_like('no', $search);
            $this->db->or_like('nama_matkul', $search);
        }
        
        $query = $this->db->get('mahasiswa', $limit, $start);
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function getTotal($search='')
    {
        $this->db->select('*');
        $this->db->join('matakuliah', 'matakuliah.kode=mahasiswa.kode');
        
        if ($search != 'null')
        { 
            $this->db->like('nama', $search);
            $this->db->or_like('no', $search);
            $this->db->or_like('nama_matkul', $search);
        }
        return $this->db->count_all_results('mahasiswa');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('mahasiswa', $data);
        return $result;
    }

    public function show($id)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa'); 
        $this->db->join('matakuliah', 'mahasiswa.kode=matakuliah.kode');
        $this->db->where('id',$id);     
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data = [])
    {
        // TODO: set data yang akan di update
        // https://www.codeigniter.com/userguide3/database/query_builder.html#updating-data

        $this->db->where('id', $id);
        $this->db->update('mahasiswa', $data);
        return result;
    }
    
    public function delete($id)
    {
        // TODO: tambahkan logic penghapusan data
        $this->db->where('id', $id);

        $this->db->delete('mahasiswa');
    }
}

/* End of file ModelName.php */