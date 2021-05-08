<?php
class Customers extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->customerModel = $this->model('Customer');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $customers = $this->customerModel->getCustomers();

        $data = [
            'customers' => $customers
        ];
        $this->view('customers/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'name_zawgyi' => trim($_POST['name_zawgyi']),
                'phone'  => trim($_POST['phone']),
                'name_err' => '',
                'phone_err'  => '',
                'address'  => trim($_POST['address']),
            ];

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            //Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Please enter phone text';
            }

            //Validated
            if (empty($data['name_err']) && empty($data['phone_err'])) {
                if ($this->customerModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('customers');
                } else {
                    die("Something went wrong!");
                }
            } else {
                //Load view with errors
                $this->view('customers/add', $data);
            }
        } else {

            $data = [
                'name' => '',
                'name_zawgyi' => '',
                'phone'  => '',
                'address'  => '',
            ];
        }

        $this->view('customers/add', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id'        => $id,
                'name'     => trim($_POST['name']),
                'name_zawgyi'     => trim($_POST['name_zawgyi']),
                'phone'      => trim($_POST['phone']),
                'name_err' => '',
                'phone_err'  => '',
                'address'  => trim($_POST['address']),
            ];

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            //Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Please enter phone text';
            }

            //Validated
            if (empty($data['name_err']) && empty($data['phone_err'])) {
                if ($this->customerModel->updatePost($data)) {
                    flash('post_message', 'Post updated');
                    redirect('customers');
                } else {
                    die("Something went wrong!");
                }
            } else {
                //Load view with errors
                $this->view('customers/edit', $data);
            }
        } else {

            //Get existing post from model
            $post = $this->customerModel->getPostById($id);

            // if ($post->user_id != $_SESSION['user_id']) {
            //     redirect('posts');
            // }

            $data = [
                'id'    => $id,
                'name' => trim($post->name),
                'name_zawgyi' => trim($post->name_zawgyi),
                'phone'  => trim($post->phone),
                'address'  => trim($post->address),
            ];
        }
        $this->view('customers/edit', $data);
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
            if ($this->customerModel->deletePost($id)) {
                flash('post_message', 'Post deleted');
                redirect('customers');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('customers');
        }
    }

    public function download($id)
    {
        printPdf1();
    }
}
