<?php
/*
*Base Controller
*Load models and views
*/
class Controller
{
    //Load Model
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . ".php";

        return new $model();
    }

    //Load view
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . ".php")) {
            require_once '../app/views/' . $view . ".php";
        } else {
            die('view does not exist.');
        }
    }
}
