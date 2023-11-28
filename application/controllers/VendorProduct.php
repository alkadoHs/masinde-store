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

        $vendor_products = $this->db->select("vp.*, p.name, bp.inventory as bp_inventory, u.name as vendor")
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
            'orderitems' => $vendor_products,
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
            $cartItem = $this->db->get_where('vendorproduct', ['id' => $ids[$i]])->row();
            $branchProduct = $this->db->select("p.name, bp.inventory")->from('branchproduct bp')
                ->join('product p', 'bp.productId = p.id')
                ->where('bp.id', $cartItem->branchProductId)
                ->get()->row();

            if ($branchProduct->inventory < $quantities[$i]) {
                $this->session->set_flashdata('exceed_stock2', "Available <b>$branchProduct->name</b> is <b>$branchProduct->inventory</b>: but you're trying to transfer $quantities[$i]");
                break;
            }
            $this->db->update('vendorproduct', ['quantity' => $quantities[$i], 'inventory' => $quantities[$i]], ['id' => $ids[$i]]);
        }

        echo "success";
    }


    public function pending_stock()
    {
        $this->load->view('stock/pending_stock');
        
    }

}