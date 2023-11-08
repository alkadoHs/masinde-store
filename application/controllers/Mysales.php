<?php


class Mysales extends CI_Controller {
    public function index()
    {
        $user_id = $this->session->userdata("userId");
        $branchId = $this->session->userdata("branchId");


        if(empty($user_id)) {
            return redirect("login");
        }


        $userId = $this->db->escape($user_id); // Escape the user ID

        $mysales = $this->db->query("SELECT p.name as productName, SUM(oi.quantity) as quantity 
                            FROM orderitem oi
                            JOIN `order` o ON oi.order_id = o.id
                            JOIN branchproduct bp ON oi.branchProductId = bp.id
                            JOIN product p ON bp.productId = p.id
                            WHERE o.userId = $userId AND DATE(o.createdAt) = CURDATE()
                            GROUP BY oi.branchProductId")
                     ->result();


        $income = $this->db->query("SELECT SUM(amountPaid) as amountPaid FROM `order` WHERE userId = $userId AND DATE(createdAt) = CURDATE()")->row();
        $expenses = $this->db->query("SELECT SUM(amount) as total FROM expense WHERE userId = $userId AND DATE(createdAt) = CURDATE()")->row();
        // echo "<pre>";
        // print_r($income);
        // echo "</pre>";
        // exit();
        $data = [
            "products"=> $mysales,
            "income" => $income->amountPaid,
            "expenses"=> $expenses->total,
        ];

        $this->load->view("mysales", $data);
    }
}