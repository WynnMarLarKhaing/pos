<?php
/*
 * App Core Class
 * Creates URLs & Load core controller
 * URL Format - /controller/method/params
 */

class Core
{
    protected $currenController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //Check controller
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                //if exists, set as controller
                $this->currenController = ucwords($url[0]);

                //unset 0 index
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->currenController . '.php';

        //Instantiate controller class
        $this->currenController = new $this->currenController;

        //Check method
        if (isset($url[1])) {
            if (method_exists($this->currenController, $url[1])) {
                $this->currentMethod = $url[1];

                //unset 1 index
                unset($url[1]);
            }
        }

        //Get Params
        $this->params = $url ? array_values($url) : [''];

        //Call method
        call_user_func_array([$this->currenController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
