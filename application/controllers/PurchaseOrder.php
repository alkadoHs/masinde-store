<?php

use Ramsey\Uuid\Uuid;

class PurchaseOrder extends CI_Controller
{
    public function index()
    {
        $products = $this->db->get('product')->result();
        $suppliers = $this->db->get('suppliers')->result();
        
        //get purchase order items join with product
        $order = $this->db->select('poi.*, po.id as purchaseorderId, p.buyPrice, p.name as product_name, s.name as supplier_name')
                   ->from('purchaseorderitem poi')
                    ->join('product p', 'p.id = poi.productId')
                    ->join('purchaseorder po','poi.purchaseorderId = po.id')
                    ->join('suppliers s', 's.id = po.supplierId')
                   ->where('po.status', 'pending')
                ->get()->result();
    //  echo "<pre>";
    //     print_r($order);
    //     echo "</pre>";
    //     return;
        $data = [
            'products' => $products,
            'suppliers' => $suppliers,
            'orderitems' => $order,
        ];
        $this->load->view('purchase_orders/place_order', $data);
    }
    

    public function create()
    {
        $orderItems = $this->input->post('order_items');
        $supplierId = $this->input->post('supplierId');
        $purchaseorder_id = Uuid::uuid4()->toString();

        $this->db->trans_start();
        $this->db->insert('purchaseorder', [
            'id' => $purchaseorder_id,
            'supplierId' => $supplierId,
            'paid' => '0',
            'total' => '0',
            'status' => 'pending',
        ]);

        foreach ($orderItems as $orderItem) {
            $this->db->insert('purchaseorderitem', [
                'purchaseorderId' => $purchaseorder_id,
                'productId' => $orderItem,
                'quantity' => '1',
            ]);
        }
        $this->db->trans_complete();
        
        redirect('purchaseorder/index');
    }


    public function cancel_order($id)
    {
        $this->db->delete('purchaseorderitem', ['id' => $id]);
        $this->session->set_flashdata('purchaseorderitem_canceled', 'The purchase order item has been canceld!');
        redirect('purchaseorder/index');
    }


    public function update_order()
    {
        $quantities = $this->input->post('quantity');
        $ids = $this->input->post('order_item_id');
        
        for($i = 0; $i < count($ids); $i++) {
            $this->db->update('purchaseorderitem', ['quantity' => $quantities[$i]], ['id' => $ids[$i]]);
        }

        echo "success";

        // foreach ($ids as $key => $id) {
        //     $this->db->update('purchaseorderitem', ['quantity' => $quantities[$key]], ['id' => $id]);
        // }
        return;
      
    }


    public function complete_order()
    {
        $id = $this->input->post('purchaseorderId');
        $total = $this->input->post('total');
        $paid = $this->input->post('paid');
        $status = $this->input->post('status');

        $this->db->update('purchaseorder', [
            'total' => $total,
            'paid' => $paid,
            'status' => $status,
        ], ['id' => $id]);

        $this->session->set_flashdata('complete_purchaseorder_success', 'The purchase order has been completed successfully!');
        redirect('purchaseorder/index');
    }



    public function credit_orders()
    {
       $orders = $this->db->select('po.*, s.name as supplier_name')
                ->from('purchaseorder po')
                ->join('suppliers s', 's.id = po.supplierId')
                ->where('po.paid != po.total')
                ->where('po.status', 'complete')
                ->order_by('po.createdAt', 'desc')
                ->get()
                ->result();

        $data = [
            'orders' => $orders,
        ];
        $this->load->view('purchase_orders/credit_orders', $data);
    }


    public function pay_credit_order()
    {
        $id = $this->input->post('purchaseorder_id');
        $data = [
            'paid'=> $this->input->post('paid'),
            'total' => $this->input->post('total'),
            'supplierId' => $this->input->post('supplierId'),
            'status'=> $this->input->post('status'),
        ];
        
        //increment the paid amount
        $this->db->set('paid', 'paid + ' . $data['paid'], false);
        $this->db->where('id', $id);
        $this->db->update('purchaseorder');

        $this->session->set_flashdata('pay_credit_order_success', 'The credit order has been paid successfully!');
        redirect('purchaseorder/credit_orders');
    }


    public function order_history()
    {
        $orders = $this->db->select('po.*, s.name as supplier_name')
                ->from('purchaseorder po')
                ->join('suppliers s', 's.id = po.supplierId')
                ->where('po.paid = po.total')
                ->where('po.status', 'complete')
                ->order_by('po.createdAt', 'desc')
                ->get()
                ->result();

        $data = [
            'orders' => $orders,
        ];
        $this->load->view('purchase_orders/order_history', $data);
    }
}
