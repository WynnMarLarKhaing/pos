<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data =  [
            'title' => 'Share Posts',
            'description' => 'This is simple social network.',
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
