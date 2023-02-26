<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\NewsModel;
use App\Models\AuthorModel;

class NewsController extends Controller
{
    private NewsModel $newsModel;
    public AuthorModel $authorModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->authorModel = new AuthorModel();
    }

    public function index() : void
    {
        $this->view(view: 'news/index', data: $this->newsModel->getAll());
    }

    public function show(array $params, array $matches)
    {
        $id = $matches['id'];
        $news = $this->newsModel->getById($id);
        $authors = $this->newsModel->getAuthorsOfNews($id);

        if (!$news) {
            // If the article with the specified ID doesn't exist, show a 404 error page.
            require '../Views/404.php';
            exit;
        }
        $this->view(view: 'news/show', data: [$news, $authors]);
    }

    public function create()
    {
        $this->view(view: 'news/create', data:'');
    }

    public function add()
    {
        $data = $_POST;
        $author = $this->authorModel->getByName($data['author']);
        $author_id = (!empty($author)) ? $author['author_id'] : $this->authorModel->createAuthor([$data['author']]);
        print_r($author_id);

        $newsId = $this->newsModel->createNews($data['title'], $data['text'], $author_id);
        
        header('Location: /news/'.$newsId);
    }

    public function edit(array $params, array $matches)
    {
        $newsId = $matches['id'];
        $news = $this->newsModel->getById($newsId);
        $authors = $this->newsModel->getAuthorsOfNews($newsId);
        if (!$news) {
            // If the article with the specified ID doesn't exist, show a 404 error page.
            require '../Views/404.php';
            exit;
        }

        $this->view(view: 'news/edit', data: [$news, $authors]);
    }

    public function update(array $params, array $matches)
    {
        $data = $_POST;
        print_r($data);
        $news = $this->newsModel->getById($matches['id']);
        if (!$news) {
            // If the article with the specified ID doesn't exist, show a 404 error page.
            require '../Views/404.php';
            exit;
        }
        
        $this->newsModel->update($matches['id'], $data['title'], $data['text']);
        header('Location: /news/' . $matches['id']);
    }

    public function delete(array $params, array $matches)
    {
        $id = $matches['id'];
        $news = $this->newsModel->getById($id);
        
        if (!$news) {
            // If the article with the specified ID doesn't exist, show a 404 error page.
            require '../Views/404.php';
            exit;
        }
        $this->newsModel->delete($id);
        header('Location: /news');        
    }
}
