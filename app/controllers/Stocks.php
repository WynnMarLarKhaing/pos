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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name'                      => trim($_POST['name']),
                'name_zawgyi'               => trim($_POST['name_zawgyi']),
                'stocks_shortcut_id'        => trim($_POST['stocks_shortcut_id']),
                'customer_price'            => trim($_POST['customer_price']),
                'non_customer_price'        => trim($_POST['non_customer_price']),
                'name_err'                  => '',
                'stocks_shortcut_id_err'    => '',
                'customer_price_err'        => '',
                'non_customer_price_err'    => '',
            ];

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            //Validate stocks_shortcut_id
            if (empty($data['stocks_shortcut_id'])) {
                $data['stocks_shortcut_id_err'] = 'Please enter phone text';
            }

            //Validate customer_price
            if (empty($data['customer_price'])) {
                $data['customer_price_err'] = 'Please enter phone text';
            }

            //Validate non_customer_price
            if (empty($data['non_customer_price'])) {
                $data['non_customer_price_err'] = 'Please enter phone text';
            }

            //Validated
            if (empty($data['name_err']) && empty($data['stocks_shortcut_id_err']) && empty($data['customer_price_err']) && empty($data['non_customer_price_err'])) {
                if ($this->stockModel->addStock($data)) {
                    flash('post_message', 'Posting Added');
                    redirect('stocks');
                } else {
                    die("Something went wrong!");
                }
            } else {
                //Load view with errors
                $this->view('stocks/add', $data);
            }

        }else{
            $data = [
                'name' => '',
                'name_zawgyi' => '',
                'stocks_shortcut_id'  => '',
                'customer_price'  => '',
                'non_customer_price'  => '',
            ];
        }
        $this->view('stocks/add', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id'                        => $id,
                'name'                      => trim($_POST['name']),
                'name_zawgyi'               => trim($_POST['name_zawgyi']),
                'stocks_shortcut_id'        => trim($_POST['stocks_shortcut_id']),
                'customer_price'            => trim($_POST['customer_price']),
                'non_customer_price'        => trim($_POST['non_customer_price']),
                'name_err'                  => '',
                'stocks_shortcut_id_err'    => '',
                'customer_price_err'        => '',
                'non_customer_price_err'    => '',
            ];

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            //Validate stocks_shortcut_id
            if (empty($data['stocks_shortcut_id'])) {
                $data['stocks_shortcut_id_err'] = 'Please enter phone text';
            }

            //Validate customer_price
            if (empty($data['customer_price'])) {
                $data['customer_price_err'] = 'Please enter phone text';
            }

            //Validate non_customer_price
            if (empty($data['non_customer_price'])) {
                $data['non_customer_price_err'] = 'Please enter phone text';
            }

            //Validated
            if (empty($data['name_err']) && empty($data['stocks_shortcut_id_err']) && empty($data['customer_price_err']) && empty($data['non_customer_price_err'])) {
                if ($this->stockModel->updateStock($data)) {
                    flash('post_message', 'Posting Added');
                    redirect('stocks');
                } else {
                    die("Something went wrong!");
                }
            } else {
                //Load view with errors
                $this->view('stocks/add', $data);
            }

        } else {
            $post = $this->stockModel->getStockById($id);

            $data = [
                'id'    => $id,
                'name' => trim($post->name),
                'name_zawgyi' => trim($post->name_zawgyi),
                'stocks_shortcut_id'  => trim($post->stocks_shortcut_id),
                'customer_price'  => trim($post->customer_price),
                'non_customer_price'  => trim($post->non_customer_price),
            ];
        }
        $this->view('stocks/edit', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->stockModel->deleteStock($id)) {
                flash('post_message', 'Post deleted');
                redirect('stocks');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('stocks');
        }
    }
}