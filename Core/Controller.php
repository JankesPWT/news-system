<?php
namespace App\Core;

class Controller 
{
    public function model($model) 
    {
        require_once '../Models/' . $model . 'Model.php';
        return new $model;
    }

    public function view($view, $data)
    {
        require_once '../Views/template/head.php';
        require_once '../Views/' . $view . '.php';
        require_once '../Views/template/foot.php';
    }
}