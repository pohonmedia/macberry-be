<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_bank extends Member_Controller {

    public $_db, $bank;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Bank_m');
        $this->_db = $this->Bank_m;
        $this->load->library('pagination');
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'member/account');
        $this->bank = $this->_db->bank_admin_combo();
    }

    public function index($page = NULL) {
        $this->load->library('pagination');

        $config['base_url'] = '/webbinary/member/account/bank';
        $config['total_rows'] = $this->_db->get()->num_rows();
        $config['per_page'] = 2;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        if ($page > 0) {
            $offset = $page * $config['per_page'] - $config['per_page'];
        } else {
            $offset = 0;
        }
        $this->data['md_acc_bank'] = $this->_db->get($config['per_page'], $offset)->result_array();
        $this->data['pagination'] = $this->pagination->create_links();
        
        $params = array();
        $this->set_title('Bank Account');
        $this->breadcrumbs->push('Bank Account', 'member/account/bank');
        $this->data['subnav_active'] = 'bank';

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $new_qw = array('property' => 'bank_user_id', 'operator' => 'where', 'type' => 'int', 'value' => $this->user->id);
        array_push($params, $new_qw);
        $this->data['list'] = $this->_db->get_bank($params, NULL, NULL);

        $this->template->build('member_bank/index', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Selectetd Bank');
        $this->breadcrumbs->push('Edit', '/member/account/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Bank';

        $cat_detail = $this->_db->get_detail('id', $id);

        // validate form input
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required');
        $this->form_validation->set_rules('bank_cabang', 'Bank Cabang', 'required');
        $this->form_validation->set_rules('bank_norek', 'No.Rekening', 'required');
        $this->form_validation->set_rules('bank_pemilik_name', 'Nama Pemilik Rekening', 'required');

        //Validation Process
        if ($this->form_validation->run() === TRUE) {
            $upd_data = array(
                'bank_name' => $this->input->post('bank_name'),
                'bank_cabang' => $this->input->post('bank_cabang'),
                'bank_norek' => $this->input->post('bank_norek'),
                'bank_pemilik_name' => $this->input->post('bank_pemilik_name')
            );

//            $upd_data['id'] = $this->slug->create_uri($upd_data, $id); //INI G USAH->FUNGSI UNTUK MEMBUAT SLUG
            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', '<li>Data Bank has been Updated</li>');
            redirect("member/account/bank", 'refresh');
        }
        $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');

        //FORM FIELD
        $this->data['bank_name'] = array(
            'name' => 'bank_name',
            'type' => 'text',
            'placeholder' => 'Nama Bank',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bank_name', $cat_detail->bank_name)
        );
        $this->data['bank_cabang'] = array(
            'name' => 'bank_cabang',
            'type' => 'text',
            'placeholder' => 'Bank Cabang',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bank_cabang', $cat_detail->bank_cabang)
        );
        $this->data['bank_norek'] = array(
            'name' => 'bank_norek',
            'placeholder' => 'No.Rekening',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('bank_norek', $cat_detail->bank_norek)
        );
        $this->data['bank_pemilik_name'] = array(
            'name' => 'bank_pemilik_name',
            'placeholder' => 'Nama Pemilik Rekening',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('bank_pemilik_name', $cat_detail->bank_pemilik_name)
        );

        $this->template->build('/member_bank/edit', $this->data);
    }

    public function add() {
        $this->set_title('Tambah Bank');
        $this->breadcrumbs->push('Tambah', 'member/account/bank/add');
        $this->data['subnav_active'] = 'bank';

        $input = $this->input->post(NULL, TRUE); //untuk menginput data post dari suatu form
        //Validate input
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required');
        $this->form_validation->set_rules('bank_cabang', 'Bank Cabang', 'required');
        $this->form_validation->set_rules('bank_norek', 'No.Rekening', 'required');
        $this->form_validation->set_rules('bank_pemilik_name', 'Nama Pemilik Rekening', 'required');

        if ($this->form_validation->run($this) == TRUE) {

            $data = array(
                'bank_user_id' => $this->user->id,
                'bank_name' => $input['bank_name'],
                'bank_cabang' => $input['bank_cabang'],
                'bank_norek' => $input['bank_norek'],
                'bank_pemilik_name' => $input['bank_pemilik_name'],
                'is_default' => 0
            );
            $this->_db->create_bank($data); //ADDING TO DATABASE
            $this->session->set_flashdata('msg', '<li>Data Bank has been created</li>');
            redirect("member/account/bank", 'refresh');
        }

        $this->data['bank_name'] = array(//NAMA VARIABLE yang akan kita buat di view, biasanya disamakan dengan nama field
            'name' => 'bank_name', //nama field input
            'type' => 'text', //type input bisa text,number,email dll (referensi google)
            'placeholder' => 'Nama Bank', //Place holder atatu keterangan dalam field (refrensi bootstrap)
            'class' => 'form-control', //class dari bootstrap
            'required' => '', // menandakan bahwa field ini required, jika readonly bisa dtambahkan array item readonly, begitu juga jika disabled
            'value' => $this->form_validation->set_value('bank_name') //value otomatis dari form validation ci, sesuai dengan nama form
        );
        $this->data['bank_cabang'] = array(//NAMA VARIABLE yang akan kita buat di view, biasanya disamakan dengan nama field
            'name' => 'bank_cabang', //nama field input
            'type' => 'text', //type input bisa text,number,email dll (referensi google)
            'placeholder' => 'Bank Cabang', //Place holder atatu keterangan dalam field (refrensi bootstrap)
            'class' => 'form-control', //class dari bootstrap
            'required' => '', // menandakan bahwa field ini required, jika readonly bisa dtambahkan array item readonly, begitu juga jika disabled
            'value' => $this->form_validation->set_value('bank_cabang') //value otomatis dari form validation ci, sesuai dengan nama form
        );
        $this->data['bank_norek'] = array(//NAMA VARIABLE yang akan kita buat di view, biasanya disamakan dengan nama field
            'name' => 'bank_norek', //nama field input
            'type' => 'text', //type input bisa text,number,email dll (referensi google)
            'placeholder' => 'No.Rekening', //Place holder atatu keterangan dalam field (refrensi bootstrap)
            'class' => 'form-control', //class dari bootstrap
            'required' => '', // menandakan bahwa field ini required, jika readonly bisa dtambahkan array item readonly, begitu juga jika disabled
            'value' => $this->form_validation->set_value('bank_norek') //value otomatis dari form validation ci, sesuai dengan nama form
        );
        $this->data['bank_pemilik_name'] = array(//NAMA VARIABLE yang akan kita buat di view, biasanya disamakan dengan nama field
            'name' => 'bank_pemilik_name', //nama field input
            'type' => 'text', //type input bisa text,number,email dll (referensi google)
            'placeholder' => 'Nama Pemilik Rekening', //Place holder atatu keterangan dalam field (refrensi bootstrap)
            'class' => 'form-control', //class dari bootstrap
            'required' => '', // menandakan bahwa field ini required, jika readonly bisa dtambahkan array item readonly, begitu juga jika disabled
            'value' => $this->form_validation->set_value('bank_pemilik_name') //value otomatis dari form validation ci, sesuai dengan nama form
        );
        $this->template->build('member_bank/add', $this->data);
    }

    public function del($id) {
        $this->_db->delete('id', $id);
        $this->session->set_flashdata('msg', '<li>Data has been deleted !</li>');
        redirect("member/account/bank/", 'refresh');
    }

    public function unpublish($id) {
        $upd_data = array(
            'is_default' => 0,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', '<li>Data has been Updated</li>');
        redirect("member/account/bank/", 'refresh');
    }

    public function publish($id) {
        $this->_db->update_default();
        $upd_data = array(
            'is_default' => 1,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', '<li>Data has been Updated</li>');
        redirect("member/account/bank/", 'refresh');
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */