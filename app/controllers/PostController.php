<?php

declare(strict_types=1);

class PostController extends Controller
{
    public function index()
    {
        $this->view('createPost');
    }

    public function createPost()
    {
        $post = '';
        $model = new Model('post');
        $data = [
            'author' => $_POST['author'],
            'text' => $_POST['text']
        ];
        $model->insert($data);

//        show($_POST);
//
//        if (count($_POST) > 1)
//        {
//            $post = new Post($_POST['name'], $_POST['textarea']);
//        }
//
//        $validatePost = $post->validate($_POST);
//        if (!$validatePost) {
//            $data['errors'] = $post->errors;
//        }
//
//        if (isset($data['errors'])) {
//            $this->view('createPost', $data);
//            die;
//        }
//
//        $data = [
//            'success' => 'true'
//        ];
//
        redirect('blog');
    }
}