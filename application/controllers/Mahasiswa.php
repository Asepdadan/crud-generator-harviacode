<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_mahasiswa');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $mahasiswa = $this->Model_mahasiswa->get_all();

        $data = array(
            'mahasiswa_data' => $mahasiswa
        );

        $this->load->view('tbl_mahasiswa_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Model_mahasiswa->get_by_id($id);
        if ($row) {
            $data = array(
		'npm' => $row->npm,
		'nama' => $row->nama,
		'password' => $row->password,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'jenis_kelamin' => $row->jenis_kelamin,
		'alamat' => $row->alamat,
		'direktory_foto' => $row->direktory_foto,
		'nama_foto' => $row->nama_foto,
		'no_handphone' => $row->no_handphone,
	    );
            $this->load->view('tbl_mahasiswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mahasiswa/create_action'),
	    'npm' => set_value('npm'),
	    'nama' => set_value('nama'),
	    'password' => set_value('password'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'alamat' => set_value('alamat'),
	    'direktory_foto' => set_value('direktory_foto'),
	    'nama_foto' => set_value('nama_foto'),
	    'no_handphone' => set_value('no_handphone'),
	);
        $this->load->view('tbl_mahasiswa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'password' => $this->input->post('password',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'direktory_foto' => $this->input->post('direktory_foto',TRUE),
		'nama_foto' => $this->input->post('nama_foto',TRUE),
		'no_handphone' => $this->input->post('no_handphone',TRUE),
	    );

            $this->Model_mahasiswa->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_mahasiswa->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mahasiswa/update_action'),
		'npm' => set_value('npm', $row->npm),
		'nama' => set_value('nama', $row->nama),
		'password' => set_value('password', $row->password),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'alamat' => set_value('alamat', $row->alamat),
		'direktory_foto' => set_value('direktory_foto', $row->direktory_foto),
		'nama_foto' => set_value('nama_foto', $row->nama_foto),
		'no_handphone' => set_value('no_handphone', $row->no_handphone),
	    );
            $this->load->view('tbl_mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('npm', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'password' => $this->input->post('password',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'direktory_foto' => $this->input->post('direktory_foto',TRUE),
		'nama_foto' => $this->input->post('nama_foto',TRUE),
		'no_handphone' => $this->input->post('no_handphone',TRUE),
	    );

            $this->Model_mahasiswa->update($this->input->post('npm', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_mahasiswa->get_by_id($id);

        if ($row) {
            $this->Model_mahasiswa->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('direktory_foto', 'direktory foto', 'trim|required');
	$this->form_validation->set_rules('nama_foto', 'nama foto', 'trim|required');
	$this->form_validation->set_rules('no_handphone', 'no handphone', 'trim|required');

	$this->form_validation->set_rules('npm', 'npm', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_mahasiswa.xls";
        $judul = "tbl_mahasiswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Direktory Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "No Handphone");

	foreach ($this->Model_mahasiswa->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->direktory_foto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_foto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_handphone);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_mahasiswa.doc");

        $data = array(
            'tbl_mahasiswa_data' => $this->Model_mahasiswa->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_mahasiswa_doc',$data);
    }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-01-06 05:17:12 */
/* http://harviacode.com */