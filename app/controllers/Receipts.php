<?php
class Receipts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->receiptModel = $this->model('Receipt');
        $this->customerModel = $this->model('Customer');
        $this->stockModel = $this->model('Stock');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $receipts = $this->receiptModel->getReceipts();

        $data = [
            'receipts' => $receipts
        ];
        // printPdf1();
        $this->view('receipts/index', $data);
    }

    public function add()
    {
        $customers = $this->customerModel->getCustomers();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $orderType = 1; //customer order
            $customer_id = $_POST['customer_id'];

            if($_POST['temp_save']){
                $saveType = 1; //temporary save
            }else if($_POST['save']){
                $saveType = 2; //save
            }

            $lastInsertId = $this->receiptModel->getLastInsertId()->receipt_id;

            foreach($_POST['stock_id'] as $key => $stock_id) {
                $data = [
                        'receipt_id'    => $lastInsertId,
                        'stock_id'      => $stock_id,
                        'customer_id'   => $customer_id,
                        'qty'           => $_POST['qty'][$key],
                        'order_type'    => $orderType,
                        'save_type'     => $saveType,
                    ];
                if ($this->receiptModel->addReceipt($data)) {
                    flash('post_message', 'Post Added');
                    redirect('receipts');
                } else {
                    die("Something went wrong!");
                }
            }

        } else {

            $stocks = $this->stockModel->getStocks();

            $data = [
                'stocks' => $stocks,
                'customers' => $customers
            ];
        }

        $this->view('receipts/add', $data);
    }

    public function edit($receipt_id)
    {
        $customers = $this->customerModel->getCustomers();

        $receipts = $this->receiptModel->getReceipt($receipt_id);

        $customer_id_list = array_column($receipts, 'customer_id');
        $customer_id = $customer_id_list[0];

        $save_type_list = array_column($receipts, 'save_type');
        $save_type = $save_type_list[0];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $orderType = 1; //customer order
            $customer_id = $_POST['customer_id'];

            if($_POST['temp_save']){
                $saveType = 1; //temporary save
            }else if($_POST['save']){
                $saveType = 2; //save
            }

            if($this->receiptModel->deleteReceipt($receipt_id)){

                foreach($_POST['stock_id'] as $key => $stock_id) {
                    $data = [
                            'receipt_id'    => $receipt_id,
                            'stock_id'      => $stock_id,
                            'customer_id'   => $customer_id,
                            'qty'           => $_POST['qty'][$key],
                            'order_type'    => $orderType,
                            'save_type'     => $saveType,
                        ];
                    if ($this->receiptModel->addReceipt($data)) {
                        flash('post_message', 'Post Added');
                        redirect('receipts');
                    } else {
                        die("Something went wrong!");
                    }
                }
            }

        } else {

            $stocks = $this->stockModel->getStocks();

            $data = [
                'stocks' => $stocks,
                'customers' => $customers,
                'receipts' => $receipts,
                'customer_id' => $customer_id,
                'receipt_id' => $receipt_id,
                'save_type' => $save_type
            ];

        }
        $this->view('receipts/edit', $data);
    }

    public function show($id)
    {
        $customer = $this->customerModel->getPostById($id);
        // $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'customer' => $customer,
        ];
        $this->view('customers/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->receiptModel->deleteReceipt($id)) {
                flash('post_message', 'Post deleted');
                redirect('customers');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('customers');
        }
    }

    public function download($receipt_id)
    {
        $receipts = $this->receiptModel->getReceipt($receipt_id);

        $data = [
            'receipts' => $receipts,
            'receipt_id' => $receipt_id,
        ];

        printReceipt($data, "D");
    }

    public function print($receipt_id)
    {
        $receipts = $this->receiptModel->getReceipt($receipt_id);

        $data = [
            'receipts' => $receipts,
            'receipt_id' => $receipt_id,
        ];

        printReceipt($data, "I");
    }
}
