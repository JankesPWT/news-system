<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AuthorModel;

class AuthorController extends Controller 
{
    public AuthorModel $authorModel;

    public function __construct()
    {
        $this->authorModel = new AuthorModel();
    }

    public function top() 
    {
        $top = $this->authorModel->getTopAuthorsLastWeek();
        $this->view(view: 'author/top', data: $top);
    }
    

}
