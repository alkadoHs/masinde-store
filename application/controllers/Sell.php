<?php

class Sell extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata("userId")) {
            return redirect("login");
        } elseif ($this->session->userdata("position") == "VENDOR") {
            redirect('vendorCart');
        }

        $cartitems_count = $this->db->select('count(ci.id) as amount')->from('cart c')->join('cartitem ci', 'ci.cartId = c.id')->where('c.userId', $this->session->userdata("userId"))->get()->row();
        // var_dump($cartitems_count);
        // exit();
        if ($cartitems_count->amount == "0") {
            $this->db->delete('cart', ['userId' => $this->session->userdata("userId")]);
        }

       
        $products = $this->db->select("bp.*, p.name as productName, p.buyPrice, p.retailPrice, p.wholePrice")
            ->from("branchproduct bp")
            ->join("product p", "bp.productId = p.id", "left")
            ->where("bp.branchId", $this->session->userdata("branchId"))
            ->get()->result();


        $cartItems = $this->db->select("ci.*, p.name")
            ->from("cart c")
            ->join("cartitem ci", "ci.cartId = c.id")
            ->join("branchproduct bp", "bp.id = ci.branchProductId")
            ->join("product p", "p.id = bp.productId")
            ->where("c.userId", $this->session->userdata("userId"))
            ->get()->result();
        // echo "<pre>";
        // print_r($vendors);
        // echo"</pre>";
        // exit();

        $customers = $this->db->get('customer')->result();


        $data = [
            "products" => $products,
            "cartItems" => $cartItems,
            "customers" => $customers,
        ];
        $this->load->view("sales/sell", $data);
    }


    public function create_cart($product_id, $price)
    {
        $productStock = $this->db->get_where('branchproduct', ['id' => $product_id])->row();
        if ($productStock->inventory < 1) {
            $this->session->set_flashdata('less_stock', 'Stock not enough!');

            return redirect('sell');
        }
        $cartExist = $this->db->get_where('cart', ['userId' => $this->session->userdata('userId')])->row();
        if (!$cartExist) {
            $cartId = uniqid('MS-');

            $userId = $this->session->userdata("userId");

            $this->db->trans_start();
            $this->db->insert("cart", ['id' => $cartId, 'userId' => $userId]);
            $this->db->insert('cartitem', ['cartId' => $cartId, 'branchProductId' => $product_id, 'price' => $price, 'quantity' => 1]);
            $this->db->trans_complete();

            $this->session->set_flashdata('added_tocart', 'Product is added to the cart.');
            return redirect('sell');
        } else {
            $cartitemExist = $this->db->select('ci.*')
                ->from('cartitem ci')
                ->join('cart c', 'ci.cartId = c.id')
                ->where('ci.branchProductId', $product_id)
                ->where('ci.price', $price)
                ->get()->row();
            if ($cartitemExist) {
                $this->db->set('quantity', 'quantity + 1', false);
                $this->db->where('cartId', $cartExist->id);
                $this->db->where('branchProductId', $product_id);
                $this->db->where('price', $price);
                $this->db->update('cartitem');

                $this->session->set_flashdata('cartitem_updated', 'Item is updated successfully!');

                redirect('sell');
            } else {
                $this->db->insert('cartitem', ['cartId' => $cartExist->id, 'branchProductId' => $product_id, 'price' => $price, 'quantity' => 1]);
                $this->session->set_flashdata('added_toExistCart', 'Product added to the cart.');

                redirect('sell');
            }
        }

    }


    public function cancel_item($item_id)
    {
        $this->db->where('id', $item_id);
        $this->db->delete('cartitem');

        $this->session->set_flashdata('cartitem_cancelled', 'CartItem is cancelled');

        redirect('sell');
    }


    public function update_cart()
    {
        $quantities = $this->input->post('quantity');
        $ids = $this->input->post('item_id');

        for ($i = 0; $i < count($ids); $i++) {
            $cartItem = $this->db->get_where('cartitem', ['id' => $ids[$i]])->row();
            $branchProduct = $this->db->select("p.name, bp.inventory")->from('branchproduct bp')
                ->join('product p', 'bp.productId = p.id')
                ->where('bp.id', $cartItem->branchProductId)
                ->get()->row();

            if ($branchProduct->inventory < $quantities[$i]) {
                $this->session->set_flashdata('exceed_stock', "Available <b>$branchProduct->name</b> is <b>$branchProduct->inventory</b>: but you're trying to sell $quantities[$i]");
                break;
            }

            $this->db->update('cartitem', ['quantity' => $quantities[$i]], ['id' => $ids[$i]]);
        }
        $this->session->set_flashdata('cartitems_updated', "Items updated successfully!");

        echo "success";
        // foreach ($ids as $key => $id) {
        //     $this->db->update('purchaseorderitem', ['quantity' => $quantities[$key]], ['id' => $id]);
        // }
        return;

    }


    public function complete_order()
    {
        $orderId = uniqid('INV-');

        $cartId = $this->input->post("cartId");
        $branchId = $this->session->userdata("branchId");
        $userId = $this->session->userdata('userId');
        $customer_id = $this->input->post("customerId");

        $customer = null;
        if ($customer_id != "none") {
            $customer = $customer_id;
        }

        $data = [
            "id" => $orderId,
            "userId" => $userId,
            "branchId" => $branchId,
            "customerId" => $customer,
            "totalPrice" => $this->input->post("total"),
            "amountPaid" => $this->input->post("paid"),
        ];

        $this->db->trans_start();
        $cartItems = $this->db->get_where('cartitem', ['cartId' => $cartId])->result();
        $this->db->insert('order', $data);
        foreach ($cartItems as $cartItem) {
            $branchProduct = $this->db->get_where('branchproduct', ['id' => $cartItem->branchProductId])->row();
           
                $this->db->insert("orderitem", ['order_id' => $orderId, 'branchProductId' => $cartItem->branchProductId, 'quantity' => $cartItem->quantity, 'price' => $cartItem->price]);

                $newInventory = $branchProduct->inventory - $cartItem->quantity;

                $this->db->update('branchproduct', ['inventory' => $newInventory], ['id' => $branchProduct->id]);
        }

        $this->db->set('total', 'total + ' . $data['amountPaid'], false);
        $this->db->where('branchId', 1);
        $this->db->update('sales');

        $this->db->delete('cart', ['id' => $cartId]);
        $this->db->trans_complete();

        redirect('sell');
    }


    public function credit_sales()
    {
        $branchId = $this->session->userdata('branchId');
        $userId = $this->session->userdata('userId');
        $position = $this->session->userdata('position');

        if (empty($userId)) {
            return redirect('login');
        }

        $orders = [];

        if ($position == "ADMIN") {
            $orders = $this->db->select('o.*, u.name as seller')
                ->from('order o')
                ->join('user u', 'o.userId = u.id')
                ->where('o.amountPaid != o.totalPrice')
                ->order_by('o.createdAt', 'desc')
                ->get()
                ->result();
        } elseif ($position == "VENDOR") {
            $orders = $this->db->select('o.*, u.name as seller')
                ->from('order o')
                ->join('user u', 'o.userId = u.id')
                ->where('o.amountPaid != o.totalPrice')
                ->where('o.userId', $userId)
                ->order_by('o.createdAt', 'DESC')
                ->get()
                ->result();
        } else {
            $orders = $this->db->select('o.*, u.name as seller')
                ->from('order o')
                ->join('user u', 'o.userId = u.id')
                ->where('o.amountPaid != o.totalPrice')
                ->where('o.branchId', $branchId)
                ->order_by('o.createdAt', 'desc')
                ->get()
                ->result();
        }


        $data = [
            'orders' => $orders
        ];

        $this->load->view('sales/credit_sales', $data);
    }


    public function pay_credit_sales()
    {
        $id = $this->input->post('order_id');

        $data = [
            'amountPaid' => $this->input->post('amountPaid'),
            'totalPrice' => $this->input->post('totalPrice'),
            'customerId' => $this->input->post('customerId'),
        ];

        //increment the amountPaid amount
        $this->db->trans_start();
        $this->db->set('amountPaid', 'amountPaid + ' . $data['amountPaid'], false);
        $this->db->where('id', $id);
        $this->db->update('order');

        $this->db->set('total', 'total + ' . $data['amountPaid'], false);
        $this->db->where('branchId', 1);
        $this->db->update('sales');
        $this->db->trans_complete();

        $this->session->set_flashdata('pay_credit_sales_success', 'The credit sale has been paid successfully!');
        redirect('sell/credit_sales');
    }
}