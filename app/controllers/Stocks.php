<?php
class Stocks extends Controller
{
    public function __construct()
    {
        $this->stockModel = $this->model('Stock');
    }

    public function index()
    {
        $stocks = $this->stockModel->getStocks();

        $data = [
            'stocks' => $stocks
        ];

        $this->view('stocks/index', $data);
    }

    public function add()
    {
        $data = [
            'name' => '',
            'phone'  => '',
            'address'  => '',
        ];
        $this->view('stocks/add', $data);
    }
}