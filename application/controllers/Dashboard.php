<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        $userId = $this->session->userdata("userId");

        if(empty($userId)) {
            return redirect("login");
        }

        $totalProducts = $this->db->select_sum("inventory")->get('branchproduct')->row();
        $totalIncome = $this->db->select_sum('total')->get('sales')->row();
        $expensesToday = $this->db->select_sum('amount')->where('DATE(createdAt) =', date('Y-m-d'))->get('expense')->row();
        $totalRetailPrice = 0;
        $totalWholePrice = 0;

        $bproducts = $this->db->select("*")->from('branchproduct bp')->join('product p', 'bp.productId = p.id')->get()->result();

        foreach ($bproducts as $bproduct) {
            $totalWholePrice += ($bproduct->inventory - $bproduct->wholePrice);
            $totalRetailPrice += ($bproduct->inventory - $bproduct->retailPrice);
        }

        $branchSales = $this->db->select("*")->from('sales s')
                               ->join('branch b', 's.branchId = b.id')
                            ->get()->result();

        $topSelling = $this->db->select('p.name,p.brand, sum(oi.quantity) as totalSales')
                                ->from('orderitem oi')
                                  ->join('branchproduct bp', 'oi.branchProductId = bp.id')
                                  ->join('product p', 'bp.productId = p.id')
                                  ->group_by('oi.branchProductId')
                                  ->order_by('totalSales')
                                  ->limit(10)
                                ->get()->result();


        $todaySalesPerStaff = $this->db->select('o.userId, u.name, sum(oi.quantity) as totalSales')
                                ->from('orderitem oi')
                                  ->join('order o','oi.order_id = o.id')
                                  ->join('user u', 'o.userId = u.id')
                                  ->where('DATE(oi.createdAt)', date('Y-m-d'))
                                  ->group_by('o.userId')
                                  ->order_by('totalSales')
                                ->get()->result();

                                $firstDayOfMonth = date('Y-m-01'); // Get the first day of the current month
                                $lastDayOfMonth = date('Y-m-t'); // Get the last day of the current month
        
        $monthlySales = $this->db->select('o.userId, u.name, sum(oi.quantity) as totalSales')
                                ->from('orderitem oi')
                                  ->join('order o','oi.order_id = o.id')
                                  ->join('user u', 'o.userId = u.id')
                                  ->where('DATE(o.createdAt) >=', $firstDayOfMonth)
                                  ->where('DATE(o.createdAt) <=', $lastDayOfMonth)
                                  ->group_by('o.userId')
                                  ->order_by('totalSales')
                                ->get()->result();


        $todayExpensesPerStaff = $this->db->select('u.name, u.username, e.userId, sum(e.amount) as total')
                                        ->from('expense e')
                                        ->join('user u', 'e.userId = u.id')
                                        ->group_by('e.userId')
                                        ->where('DATE(e.createdAt) =', date('Y-m-d'))
                                    ->get()->result();


        
        $monthlyExpenses = $this->db->select('u.name, e.userId, sum(e.amount) as total')
                                ->from('expense e')
                                ->join('user u', 'e.userId = u.id')
                                ->group_by('e.userId')
                                ->where('DATE(e.createdAt) >=', $firstDayOfMonth)
                                ->where('DATE(e.createdAt) <=', $lastDayOfMonth)
                              ->get()->result();
        // echo "<pre>";
        // print_r($todayExpensesPerStaff);
        // echo "</pre>";
        // exit();

        $data = [
            "totalProducts" => $totalProducts->inventory,
            "totalIncome"=> $totalIncome->total,
            'totalRetail' => $totalRetailPrice,
            'totalWhole'=> $totalWholePrice,
            'expensesToday' => $expensesToday->amount,
            'branchSales' => $branchSales,
            'topSelling' => $topSelling,
            'todaySales' => $todaySalesPerStaff,
            'monthlySales' => $monthlySales,
            'todayExpenses' => $todayExpensesPerStaff,
            'monthlyExpenses' => $monthlyExpenses,
        ];
        
        $this->load->view('dashboard', $data);
    }
}