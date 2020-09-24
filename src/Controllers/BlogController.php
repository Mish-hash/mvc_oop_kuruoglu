<?php

namespace Controllers;
//use Models\User;
use Models\User;
use View\View;
//use services\Db;
use Models\Post;
class BlogController
{

//    private $db;

    /*  public function __construct()
      {
          $this->db = new Db();
      }*/

    public function index()
    {


//        $posts = $this->db->query('SELECT * FROM posts', [], Post::class);
        $posts = Post::all();
//        echo '<pre>' . print_r($posts, true) . '</pre>';
        $title = 'BlogPage';
        View::render('blog/index', compact('posts', 'title'));
        //['posts'=> $post, 'title'=>$title]
    }

    public function show()
    {
//        var_dump($_GET['id']);
//        $post = $this->db->query('SELECT * FROM posts WHERE id=?', [$_GET['id']]);
        $id = $_GET['id'];
        $post = Post::getById($id);  // object или null

//        $author = User::getById($post->getAuthorId());
//        echo '<pre>' . print_r(\Models\User::all(), true) . '</pre>';
        if ($post == null) {
            throw new \Exceptions\NotFoundException();
        }
        View::render('blog/show', compact('post'));
//        var_dump(\services\Db::getInstanceCount());
    }

    public function editClick()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        var_dump($name);
        $post = Post::getById($id);
        $post->setName($name);
        $post->save();
    }

    public function edit()
    {

        $id = $_GET['id'];
        $post = Post::getById($id);
        $authors = User::all();
        $params['post'] = $post;
        $params['authors'] = $authors;
        if (!empty($_POST)) {
            try {
                $post->setName($_POST['name']);
                $post->setText($_POST['text']);
                $post->setAuthorId($_POST['author']);
                $post->save();
                echo '<pre>' . print_r($post, true) . '</pre>';
            } catch (\Exceptions\InvalidParamException $e) {
                $params['errors'] = $e->getMessage();
            }
        }

        View::render('blog/edit', $params);
    }

    public function delete()
    {
        $id = $_POST['id'];

        $post = Post::getById($id);
        $post->delete();
    }

    public function add()
    {
        $authors = User::all();
        $params = [];
        $params['authors'] = $authors;


        if (!empty($_POST)) {
            try {
                $post = new Post();
                $post->setName($_POST['title']);
                $post->setText($_POST['text']);
                $post->setAuthorId($_POST['author']);
                $post->save();


            } catch (\Exceptions\InvalidParamException $e) {
                $params['errors'] = $e->getMessage();
            }


        }
        View::render('blog/add', $params);
    }
}