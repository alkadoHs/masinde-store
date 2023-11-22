<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        $userId = $this->session->userdata("userId");

        if(empty($userId)) {
            return redirect("login");
        }
        
        //general stock
        $products = $this->db->select('p.buyPrice, bp.inventory')
                          ->from('branchproduct bp')
                          ->join('product p', 'bp.productId = p.id', 'left')
                          ->get()->result();
        $general_stock = 0;
        $value = 0;
        foreach ($products as $product) {
          $general_stock += $product->inventory;
          $value += ($product->inventory * $product->buyPrice);
        }

        //today expenses
        $today_expenses = $this->db->select("SUM(amount) as total_expenses_today")->where('DATE(createdAt)', date('Y-m-d'))->get('expense')->row();
        
        //monthly expenses
        $monthly_expenses = $this->db->select("SUM(amount) as total_expenses_monthly")->where('MONTH(createdAt)', date('m'))->get('expense')->row();
        
        //today income
        $income = $this->db->select("SUM(amountPaid) as cash_total")->from('order')->where('DATE(createdAt)', date('Y-m-d'))->get()->row();

        //today_profit
        $order_items = $this->db->select("p.buyPrice, oi.price, oi.quantity")
                         ->from('orderitem oi')
                         ->join('branchproduct bp', 'oi.branchProductId = bp.id')
                         ->join('product p', 'bp.productId = p.id')
                         ->where('DATE(oi.createdAt)', date('Y-m-d'))
                         ->get()->result();
        $total_profit_today = 0;

        foreach ($order_items as $item) {
          $total_profit_today += (($item->price - $item->buyPrice) * $item->quantity);
        }

        //best selling products
        $top_products = $this->db->select("p.name, b.name as branch, SUM(oi.quantity) as quantity,")
                         ->from('orderitem oi')
                         ->join('branchproduct bp', 'oi.branchProductId = bp.id')
                         ->join('product p', 'bp.productId = p.id')
                         ->join('branch b', 'bp.branchId = b.id')
                         ->group_by('oi.branchProductId')
                         ->order_by('quantity', 'DESC')
                         ->limit(7)
                         ->get()->result();
        
        //monthly sales per branch (income, profit)
        $sales = $this->db->select("b.name as branch, COUNT(o.branchId), SUM(p.buyPrice) as buy_price, SUM(oi.quantity) as quantity, SUM(oi.price) as price")
                          ->from('order o')
                          ->join('orderitem oi', 'oi.order_id = o.id')
                          ->join('branchproduct bp', 'oi.branchProductId = bp.id')
                          ->join('product p', 'bp.productId = p.id')
                          ->join('branch b', 'o.branchId = b.id')
                          ->group_by('o.branchId')
                          ->where('MONTH(oi.createdAt)', date('m'))
                          ->get()->result();

        $data = [
          "general_stock" => $general_stock,
          "stock_value" => $value,
          "expenses_today" => $today_expenses->total_expenses_today,
          "expenses_monthly" => $monthly_expenses->total_expenses_monthly,
          "total_cash_income" => $income->cash_total,
          "profit_today" => $total_profit_today,
          "top_products" => $top_products,
          "sales" => $sales,
        ];
        
        $this->load->view('dashboard', $data);
    }
}