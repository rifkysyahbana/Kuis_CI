<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Matakuliah_model');
        $this->load->model('Mahasiswa_model');
    }

    // public function index()
    // {


    //     $mahasiswa = $this->Mahasiswa_model->list();

    //     $data = [
    //                 'title' => 'Pemrograman Web Framework :: Data Mahasiswa',
    //                 'mahasiswa' => $mahasiswa,
    //             ];
    //     $this->load->view('mahasiswa/index', $data);
    // }

    public function create($error='')
    {
        $matakuliah = $this->Matakuliah_model->list();
        $data = [
            'error' => $error,
            'data' => $matakuliah
        ];
        $this->load->view('mahasiswa/create', $data);
    }

    public function show($id)
    {
        $mahasiswa = $this->Mahasiswa_model->show($id);
        $data = [
            'data' => $mahasiswa
        ];
        $this->load->view('mahasiswa/show', $data);
    }
    
    public function store()
    {
        // Ambil value 
        $nama = $this->input->post('nama');
        $matakuliah = $this->input->post('matakuliah');
        $no = $this->input->post('no');

        // Validasi Nama dan Matakuliah
        $dataval = $nama;
        $errorval = $this->validate($dataval);

        //tambah data
        $data = [
            'nama' => $nama,
            'kode' => $matakuliah,
            'no'   => $no
        ];

        $result = $this->Mahasiswa_model->insert($data);

        redirect(mahasiswa);
    }

    public function edit($id,$error='')
    {
      // TODO: tampilkan view edit data
        $mahasiswa = $this->Mahasiswa_model->show($id);
        $matakuliah = $this->Matakuliah_model->list();
        $data = [
            'data' => $mahasiswa,
            'datajab' => $matakuliah,
            'error' => $error
        ];
        $this->load->view('mahasiswa/edit', $data);
      
    }

    public function update($id)
    {
        //Ambil Value
        $id=$this->input->post('id');
        $nama = $this->input->post('nama');
        $no = $this->input->post('no');
        $matakuliah = $this->input->post('matakuliah');

        // Validasi Nama dan Matakuliah
        $dataval = [
            'nama' => $nama,
            'matakuliah' => $matakuliah,
            'no'   => $no
            ];
        $errorval = $this->validate($dataval);

        $data = [
            'nama' => $nama,
            'kode' => $matakuliah,
            'no'   => $no
            ];
        $result = $this->Mahasiswa_model->update($id,$data);

        redirect('mahasiswa');
    }

    public function destroy($id)
    {
        $mahasiswa = $this->Mahasiswa_model->show($id);
        
        $this->Mahasiswa_model->delete($id);

        redirect('mahasiswa');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Matakuliah
        $rules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|callback_alpha_space'
            ]
          ];

        $this->form_validation->set_rules($rules);

        if (! $this->form_validation->run())
        { return true; }
        else
        { return false; }
    } 

    public function alpha_space($str)
    {
        return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
    }

    public function index()
    {
        if($this->uri->segment(3))
        { 
            $search=$this->uri->segment(3); 
        }
        else
        {
            if($this->input->post("search"))
            { 
                $search = $this->input->post("search"); 
            }
            else
            {
                $search = 'null'; 
            }
        }
        $data = [];
        $total = $this->Mahasiswa_model->getTotal($search);
        if ($total > 0)
        {
            $limit = 2;
            $start = $this->uri->segment(4,0);
            $config = [
                'base_url' => site_url().'/mahasiswa/index/'.$search,
                'total_rows' => $total,
                'per_page' => $limit,
                'uri_segment' => 4,
                // Bootstrap 3 Pagination
                'first_link' => '&laquo;',
                'last_link' => '&raquo;',
                'next_link' => 'Next',
                'prev_link' => 'Prev',
                'full_tag_open' => '<ul class="pagination">',
                'full_tag_close' => '</ul>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><span>',
                'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'prev_tag_open' => '<li>',
                'prev_tag_close' => '</li>',
                'first_tag_open' => '<li>',
                'first_tag_close' => '</li>',
                'last_tag_open' => '<li>',
                'last_tag_close' => '</li>',
            ];
            $this->pagination->initialize($config);
            $data = [
                'mahasiswa' => $this->Mahasiswa_model->list($limit, $start, $search),
                'start' => $start,
                'links' => $this->pagination->create_links()
            ];
        }
        $this->load->view('mahasiswa/index', $data);
    }

}

/* End of file Controllername.php */