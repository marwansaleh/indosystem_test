<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct(){
        parent::__construct();
        
        $this->data['page_title'] = 'Guest Book';
        $this->data['active_menu'] = 'home';
    }
    
    public function index(){
        $this->data['page'] = 'home/index';
        $this->data['error'] = $this->session->flashdata('error');
        $this->load->view('layout_main', $this->data);
    }
    
    public function save(){
        $this->load->library('form_validation');
        $this->load->model('guest_m');
        $this->form_validation->set_rules($this->guest_m->rules);
        
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'name'  => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'phone'     => $this->input->post('phone', TRUE),
                'note'      => $this->input->post('note', TRUE)
            );
            
            if ($this->guest_m->save($data)){
                $this->session->set_flashdata('error', 'Data save successfully!');
            }else{
                $this->session->set_flashdata('error', $this->guest_m->get_last_message());
            }
        }
        
        redirect('home/index');
    }
}