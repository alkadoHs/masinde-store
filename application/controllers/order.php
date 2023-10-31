<?php


class Order extends CI_Controller
{
    public function index()
    {
        $this->load->view('orders/place_order');
    }
}
