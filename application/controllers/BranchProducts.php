<?php


class BranchProducts extends CI_Controller
{
    public function index()
    {
        $main_products = $this->db->get("product")->result();
        $mainbranch_products = $this->db->select("p.*, bp.quantity as branch_quantity, bp.inventory as branch_inventory, bp.damages as branch_damages, bp.stockLimit as branch_stockLimit, bp.id as branch_product_id, bp.updatedAt as last_updated")
                                ->from("product p")
                                ->join("branchproduct bp", "p.id = bp.productId")
                                ->where("bp.branchId", 1)
                                ->get()
                            ->result();

        $uyoleshop_products = $this->db->select("p.*, bp.quantity as branch_quantity, bp.inventory as branch_inventory, bp.damages as branch_damages, bp.stockLimit as branch_stock, bp.id as branch_product_id, bp.updatedAt as last_updated")
                                ->from("product p")
                                ->join("branchproduct bp", "p.id = bp.productId")
                                ->where("bp.branchId", 2)
                                ->get()
                            ->result();
        $mbalizi_products = $this->db->select("p.*, bp.quantity as branch_quantity, bp.inventory as branch_inventory, bp.damages as branch_damages, bp.stockLimit as branch_stock, bp.id as branch_product_id, bp.updatedAt as last_updated")
                                ->from("product p")
                                ->join("branchproduct bp", "p.id = bp.productId")
                                ->where("bp.branchId", 3)
                                ->get()
                            ->result();

        $data = [
            "main_products" => $main_products,
            "mainbranch_products" => $mainbranch_products,
            "uyoleshop_products" => $uyoleshop_products,
            "mbalizi_products" => $mbalizi_products,
        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $this->load->view("branch_products/index", $data);
    }


    public function create() {
        $product_id = $this->input->post('productId');
        $branch_id = $this->input->post('branchId');

        $data = [
            "productId"=> $product_id,
            "branchId"=> $branch_id,
            "quantity"=> $this->input->post("quantity"),
            "inventory"=> $this->input->post("quantity"),
            "damages"=> $this->input->post("damages"),
            "stockLimit"=> $this->input->post("stockLimit"),
        ];

        $product = $this->db->get_where('branchproduct', ['productId'=> $product_id, 'branchId' => $branch_id])->row_array();
        if ($product) {
            $data["quantity"] += $product['inventory'];
            $data["inventory"] += $product['inventory'];
            $this->db->update("branchproduct", $data, ['productId'=> $product_id, 'branchId' => $branch_id]);
            $this->session->set_flashdata("update_branchproduct_success', 'Product is updated successfully!");
            
            redirect('branchproducts/index');
        } else {
            $this->db->insert("branchproduct", $data);
            $this->session->set_flashdata("create_branchproduct_success", "New stock is added successfully!" );
            redirect('branchproducts/index');
        }

    }
}