<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('customers');
        }

        $data =  [
            'title' => 'မင်္ဂလာပါ',
            'description' => 'အန်တီလေးဆိုင်မှကြိုဆိုပါတယ်...',
        ];
        $this->view('pages/index', $data);
    }

    public function about($params)
    {
        $data =  [
            'title' => 'About Us',
            'description' => 'App to share posts with other users.',
        ];
        $this->view('pages/about', $data);
    }
}
