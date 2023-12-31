<?php


class Mysales extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata("userId")) {
            return redirect("login");
        }

        $sellerId = $this->session->userdata("userId");
        $user = $this->db->get_where('user', array('id' => $sellerId))->row();

        $expenses = $this->db->select('*')
            ->from('expense')
            ->join('user', 'expense.userId = user.id', 'left')
            ->where('expense.userId', $sellerId)
            ->where("DATE(expense.createdAt)", date('Y-m-d'))
            ->get()->result_array();

        $this->db->select('o.*, p.name, p.buyPrice, oi.id as item_id, oi.quantity, oi.price');
        $this->db->from('order o');
        $this->db->join('orderitem oi', 'o.id = oi.order_id', 'left');
        $this->db->join('branchproduct bp', 'oi.branchProductId = bp.id');
        $this->db->join('product p', 'bp.productId = p.id');
        $this->db->where('o.userId', $sellerId);
        $this->db->where("DATE(o.createdAt)", date('Y-m-d'));
        $this->db->order_by('o.createdAt', 'DESC');
        $query = $this->db->get();

        $result = $query->result_array();

        $orders = [];
        $current_order_id = null;

        foreach ($result as $row) {
            if ($row['id'] !== $current_order_id) {
                // New order, initialize order array
                $orders[] = [
                    'id' => $row['id'],
                    'customerId' => $row['customerId'],
                    'total' => $row['totalPrice'],
                    'paid' => $row['amountPaid'],
                    'orderItems' => [],
                ];
                $current_order_id = $row['id'];
            }

            // Add order item to the current order
            $orders[count($orders) - 1]['orderItems'][] = [
                'id' => $row['item_id'],
                'product' => $row['name'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'net_price' => $row['quantity'] * $row['price'],
                'profit' => ($row['price'] - $row['buyPrice']) * $row['quantity'],
            ];
        }

        // echo "<pre>";
        // print_r($orders);
        // echo "</pre>";
        // die();

        $data = [
            'orders' => $orders,
            'expenses' => $expenses,
            'user' => $user,
            'date' => date('d-m-Y')
        ];

        $this->load->view('mysales', $data);

    }


    public function filter_seller_dashboard()
    {
        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');
        $userId = $this->input->post('userId');

        if (!$start_date || !$end_date) {
            return redirect('mysales/index', 'refresh');
        }

        $user = $this->db->get_where('user', array('id' => $userId))->row();


        $expenses = $this->db->select('expense.*, user.id, user.username, user.name')
            ->from('expense')
            ->join('user', 'expense.userId = user.id', 'left')
            ->where('expense.userId', $userId)
            ->where("DATE(expense.createdAt) BETWEEN '$start_date' AND '$end_date' ")
            ->get()->result_array();

        $this->db->select('o.*, p.name, p.buyPrice, oi.id as item_id, oi.quantity, oi.price');
        $this->db->from('order o');
        $this->db->join('orderitem oi', 'o.id = oi.order_id', 'left');
        $this->db->join('branchproduct bp', 'oi.branchProductId = bp.id');
        $this->db->join('product p', 'bp.productId = p.id');
        $this->db->where('o.userId', $userId);
        $this->db->where("DATE(o.createdAt) BETWEEN '$start_date' AND '$end_date' ");
        $this->db->order_by('o.createdAt', 'DESC');
        $query = $this->db->get();

        $result = $query->result_array();

        $orders = [];
        $current_order_id = null;

        foreach ($result as $row) {
            if ($row['id'] !== $current_order_id) {
                // New order, initialize order array
                $orders[] = [
                    'id' => $row['id'],
                    'customerId' => $row['customerId'],
                    'total' => $row['totalPrice'],
                    'paid' => $row['amountPaid'],
                    'orderItems' => [],
                ];
                $current_order_id = $row['id'];
            }

            // Add order item to the current order
            $orders[count($orders) - 1]['orderItems'][] = [
                'id' => $row['item_id'],
                'product' => $row['name'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'net_price' => $row['quantity'] * $row['price'],
                'profit' => ($row['price'] - $row['buyPrice']) * $row['quantity'],
            ];
        }

        // echo "<pre>";
        // print_r($orders);
        // echo "</pre>";
        // die();


        // Convert the string dates to DateTime objects
        $startDate = new DateTime($start_date);
        $endDate = new DateTime($end_date);

        // Format the dates as strings
        $formattedStartDate = $startDate->format('d/m/Y');
        $formattedEndDate = $endDate->format('d/m/Y');

        // Combine the formatted dates with a dash to create the desired output
        $renderedDateRange = $formattedStartDate . ' - ' . $formattedEndDate;

        $data = [
            'orders' => $orders,
            'expenses' => $expenses,
            'user' => $user,
            'date' => $renderedDateRange,
        ];

        $this->load->view('mysales', $data);


        // $orders = $this->db->where("DATE(createdAt) BETWEEN '$start_date' AND '$end_date' ")->get('order')->result();
        // var_dump([$orders]);
    }


}