<?php


class Customer extends CI_Controller {
    public function index() {
        $customers = $this->db->get("customer")->result();

        $data = [
            "users"=> $customers
        ];
        $this->load->view('customers/index', $data);
    }


    public function register() 
    {
        $data = [
            'name'=> $this->input->post('name'),
            'phone'=> $this->input->post('phone'),
            'address'=> $this->input->post('address'),
        ];

        $this->db->insert('customer', $data);
        redirect('customer');
    }
}