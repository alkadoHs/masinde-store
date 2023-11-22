<?php

class VendorProduct extends CI_Controller
{
    public function index() 
    {
        $userId = $this->session->userdata("userId");
        $branchId = $this->session->userdata("branchId");

        if(empty($userId)) {
            return redirect("login");
        }

        $products = $this->db->select('p.name, bp.id')
                           ->from('branchproduct bp')
                           ->join('product p', 'bp.productId = p.id')
                           ->where('bp.branchId', $branchId)
                           ->get()->result();

        $vendors = $this->db->get_where('user', ['role' => 'vendor'])->result();

        $order = $this->db->select("vp.*, p.name, u.name as vendor")
                   ->from('vendorproduct vp')
                   ->join('branchproduct bp', 'vp.branchProductId = bp.id')
                   ->join('product p', 'bp.productId = p.id')
                   ->join('user u', 'vp.userId = u.id')
                   ->where('vp.branchId', $branchId)
                ->get()->result();
    //  echo "<pre>";
    //     print_r($products);
    //     echo "</pre>";
    //     return;
        $data = [
            'products' => $products,
            'orderitems' => $order,
            'vendors' => $vendors,
        ];
        $this->load->view('products/vendor_products', $data);
    }


    public function add_transfer()
    {
        $userId = $this->session->userdata('userId');
        $branchId = $this->session->userdata('branchId');

        $toUserId = $this->input->post('toUserId');
        $products = $this->input->post('product');


        $this->db->trans_start();

        foreach ($products as $productId) {
            // $product = $this->db->get_where('branchproduct', ['id' => $productId])->row();
            $this->db->insert('vendorproduct', [
                'branchProductId' => $productId,
                'branchId' => $branchId,
                'userId' => $toUserId,
                'quantity' => '0',
            ]);
        }
        $this->db->trans_complete();
        redirect('vendorProduct');
    }


    public function confirm_sales($id)
    {
        $this->db->delete('vendorproduct', ['id' => $id]);
        $this->session->set_flashdata('sales_confirmed', 'Successfully confirmed!');
        redirect('vendorProduct');
    }


    public function update()
    {
        $ids = $this->input->post('id');
        $quantities = $this->input->post('quantity');

        for($i = 0; $i < count($ids); $i++) {
            $this->db->update('vendorproduct', ['quantity' => $quantities[$i]], ['id' => $ids[$i]]);
        }

        echo "success";
    }

}