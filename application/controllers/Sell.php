<?php

use Ramsey\Uuid\Uuid;


class Sell extends CI_Controller
{
    public function index()
    {
        if(!$this->session->userdata("userId")) {
            redirect("login");
        }
      
        $products = $this->db->select("bp.*, p.name as productName, p.brand, p.unit, p.buyPrice, p.retailPrice, p.wholePrice")
                          ->from("branchproduct bp")
                          ->join("product p","bp.productId = p.id","left")
                          ->where("bp.branchId", $this->session->userdata("branchId"))
                          ->get()->result();

        $cartItems = $this->db->select("ci.*, p.name")
                            ->from("cart c")
                            ->join("cartitem ci","ci.cartId = c.id")
                            ->join("branchProduct bp","bp.id = ci.branchProductId")
                            ->join("product p","p.id = bp.productId")
                            ->where("c.userId", $this->session->userdata("userId"))
                            ->get()->result();
        // echo "<pre>";
        // print_r($cartItems);
        // echo"</pre>";
        // exit("");

        $customers = $this->db->get('customer')->result();
        

        $data =  [
            "products"=> $products,
            "cartItems"=> $cartItems,
            "customers"=> $customers,
        ];
        $this->load->view("sales/sell", $data);
    }


    public function create_cart($product_id, $price)
    {
        $cartExist = $this->db->get_where('cart', ['userId' => $this->session->userdata('userId')])->row();
        if (!$cartExist) {
        $cartId = Uuid::uuid4()->toString();

        $userId = $this->session->userdata("userId");

        $this->db->trans_start();
        $this->db->insert("cart", ['id' => $cartId,'userId'=> $userId]);
        $this->db->insert('cartitem', ['cartId'=> $cartId, 'branchProductId' => $product_id, 'price' => $price, 'quantity' => 1]);
        $this->db->trans_complete();

        $this->session->set_flashdata('added_tocart', 'Product is added to the cart.');
        redirect('sell');
        } else {
            $cartitemExist = $this->db->select('ci.*')
                                ->from('cartitem ci')
                                ->join('cart c', 'ci.cartId = c.id')
                                ->where('ci.branchProductId', $product_id)
                                ->where('ci.price', $price)
                            ->get()->row();
            if($cartitemExist) {
                $this->db->set('quantity', 'quantity + 1', false);
                $this->db->where('cartId', $cartExist->id);
                $this->db->where('branchProductId', $product_id);
                $this->db->where('price', $price);
                $this->db->update('cartitem');
                redirect('sell');
            } else {
                $this->db->insert('cartitem', ['cartId'=> $cartExist->id, 'branchProductId' => $product_id, 'price' => $price, 'quantity' => 1]);
                redirect('sell');
            }
        }
        
    }


    public function update_cart()
    {
        $quantities = $this->input->post('quantity');
        $ids = $this->input->post('item_id');
        
        for($i = 0; $i < count($ids); $i++) {
            $this->db->update('cartitem', ['quantity' => $quantities[$i]], ['id' => $ids[$i]]);
        }
        echo "success";
        // foreach ($ids as $key => $id) {
        //     $this->db->update('purchaseorderitem', ['quantity' => $quantities[$key]], ['id' => $id]);
        // }
        return;
      
    }


    public function complete_order()
    {
        $orderId = Uuid::uuid4()->toString();

        $cartId = $this->input->post("cartId");
        $branchId = $this->session->userdata("branchId");
        $userId = $this->session->userdata("userId");
        $customer_id = $this->input->post("customerId");

        $customer = null;
        if($customer_id != "none") {
            $customer = $customer_id;
        }

        $data = [
            "id" => $orderId,
            "userId"=> $userId,
            "branchId" => $branchId,
            "customerId"=> $customer,
            "totalPrice"=> $this->input->post("total"),
            "amountPaid"=> $this->input->post("paid"),
            "paymentMethod"=> $this->input->post("paymentMethod"),
        ];

        // print_r($data);
        // exit();
        $this->db->trans_start();
        $cartItems = $this->db->get_where('cartitem', ['cartId' => $cartId])->result();
            $this->db->insert('order', $data);
            foreach ($cartItems as $cartItem) {
                $this->db->insert("orderitem", ['order_id' => $orderId,'branchProductId' => $cartItem->branchProductId, 'quantity' => $cartItem->quantity, 'price' => $cartItem->price]);
                $branchProduct = $this->db->get_where('branchProduct', ['id' => $cartItem->branchProductId])->row();
                $newInventory = $branchProduct->inventory - $cartItem->quantity;
                $this->db->update('branchProduct', ['inventory' => $newInventory], ['id' => $branchProduct->id]);
            }
            $this->db->delete('cart', ['id'=> $cartId]);
        $this->db->trans_complete();

        redirect('sell');
    }
}