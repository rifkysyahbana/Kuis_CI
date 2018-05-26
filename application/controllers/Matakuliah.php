<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('Matakuliah_model');
    }

    public function index()
    {
        $matakuliah = $this->Matakuliah_model->list();

        $data = [
                    'title' => 'Pemrograman Web Framework :: Data Matakuliah',
                    'matakuliah' => $matakuliah,
                ];
        $this->load->view('matakuliah/index', $data);
    }

    public function create()
    {
        $error = array('error' => ' ' );
        $this->load->view('matakuliah/create', $error);
    }

    public function store()
    {
        // Ambil value 
        $matakuliah = $this->input->post('matakuliah');

        // Validasi Nama dan Matakuliah
        $dataval = $matakuliah;
        $errorval = $this->validate($dataval);

        // Pesan Error atau Upload
        if ($errorval==false)
        {
            
            // Insert data
            $data = [
                'nama_matkul' => $matakuliah,
                ];
            $result = $this->Matakuliah_model->insert($data);
            
            if ($result)
            {
                redirect(matakuliah);
            }
            else
            {
                $error = array('error' => 'Gagal');
                $this->load->view('matakuliah/create', $error);
            }
        }
        else
        {
            $error = ['error' => validation_errors()];
            $this->load->view('matakuliah/create', $error);
        }
    }

    public function edit($kode,$error='')
    {
      // TODO: tampilkan view edit data
        $matakuliah = $this->Matakuliah_model->show($kode);
        $data = [
            'data' => $matakuliah,
            'error' => $error
        ];
        $this->load->view('matakuliah/edit', $data);
      
    }

    public function update($id)
    {
        //Ambil Value
        $kode=$this->input->post('kode');
        $matakuliah = $this->input->post('matakuliah');

        // Validasi Nama dan Matakuliah
        $dataval = $matakuliah;
        $errorval = $this->validate($dataval);

        if ($errorval==false)
        {
            $data = [ 'nama_matkul' => $this->input->post('matakuliah') ];
            $result = $this->Matakuliah_model->update($kode,$data);

            if ($result)
            {
                redirect('matakuliah');
            }
            else
            {
                $data = array('error' => 'Gagal');
                $this->load->view('matakuliah/edit', $data);
            }
        }
        else
        {
            $error = validation_errors();
            $this->edit($kode,$error=' ');
        }

        
    }

    public function destroy($kode)
    {
        $matakuliah = $this->Matakuliah_model->show($kode);
        $data = [ 'data' => $matakuliah ];
        $this->Matakuliah_model->delete($kode);
        redirect('matakuliah');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Matakuliah
        $this->form_validation->set_rules('matakuliah','Matakuliah','trim|required|callback_alpha_space');

        if (! $this->form_validation->run())
        { return true; }
        else
        { return false; }
    } 

    public function alpha_space($str)
    {
        return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
    }
}