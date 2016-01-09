<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $login = $this->Login_model->get_all();

        $data = array(
            'login_data' => $login
        );

        $this->load->view('login_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Login_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idlogin' => $row->idlogin,
		'npm' => $row->npm,
		'password' => $row->password,
		'waktu_terakhir' => $row->waktu_terakhir,
	    );
            $this->load->view('login_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('login/create_action'),
	    'idlogin' => set_value('idlogin'),
	    'npm' => set_value('npm'),
	    'password' => set_value('password'),
	    'waktu_terakhir' => set_value('waktu_terakhir'),
	);
        $this->load->view('login_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'password' => $this->input->post('password',TRUE),
		'waktu_terakhir' => $this->input->post('waktu_terakhir',TRUE),
	    );

            $this->Login_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('login'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Login_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('login/update_action'),
		'idlogin' => set_value('idlogin', $row->idlogin),
		'npm' => set_value('npm', $row->npm),
		'password' => set_value('password', $row->password),
		'waktu_terakhir' => set_value('waktu_terakhir', $row->waktu_terakhir),
	    );
            $this->load->view('login_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idlogin', TRUE));
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'password' => $this->input->post('password',TRUE),
		'waktu_terakhir' => $this->input->post('waktu_terakhir',TRUE),
	    );

            $this->Login_model->update($this->input->post('idlogin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('login'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Login_model->get_by_id($id);

        if ($row) {
            $this->Login_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('npm', 'npm', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('waktu_terakhir', 'waktu terakhir', 'trim|required');

	$this->form_validation->set_rules('idlogin', 'idlogin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "login.xls";
        $judul = "login";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Npm");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Waktu Terakhir");

	foreach ($this->Login_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->waktu_terakhir);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=login.doc");

        $data = array(
            'login_data' => $this->Login_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('login_doc',$data);
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-01-06 05:19:20 */
/* http://harviacode.com */