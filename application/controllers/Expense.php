<?php

class Expense extends CI_Controller {
    public function index() {
        $userId = $this->session->userdata("userId");

        if(empty($userId)) {
            return redirect("login");
        }
        $expenses = $this->db->query("SELECT * FROM expense WHERE userId = '$userId' AND MONTH(createdAt) = MONTH(CURDATE())")->result();
        // $expenses = $this->db->get_where("expense", array("userId"=> $this->session->userdata("userId"), "MONTH(createdAt)" => "MONTH(CURDATE())"))->result();

        $data = [
            "expenses"=> $expenses,
        ];
        $this->load->view("expenses/add", $data);
    }


    public function create() {
        $userId = $this->session->userdata("userId");
        $branchId = $this->session->userdata("branchId");
        $data = [
            "userId"=> $userId,
            "branchId"=> $branchId,
            "description"=> $this->input->post("description"),
            "amount"=> $this->input->post("amount"),
        ];

        $this->db->trans_start();
            $this->db->set('total', 'total - ' . $data['amount'], false);
            $this->db->where('branchId', $branchId);
            $this->db->update('sales');

            $this->db->insert("expense", $data);
        $this->db->trans_complete();
        redirect("expense");
    }
}