<?php

declare(strict_types=1);

class Blog extends Controller
{
    public function index()
    {
//        $post = new Post('test', 'test');

//        if (count($_POST) > 1)
//        {
//            $post = new Post($_POST['name'], $_POST['textarea']);
//        }


        $model = new Model('post');
        $posts = $model->findAll();

        if (array_key_exists('delete', $_GET)) {
            $model->delete((int) $_GET['delete']);
            header('Location: ' . ROOT);
            exit;
        }

        $data = [];
        if ($posts) {
            foreach ($posts as $post) {
                $data[] = new Post((int) $post->id, $post->author, $post->text);
            }
        }


//        if (count($_POST) > 1)
//        {
//            $post = new Model('post');
//        }
//        $post = new Model('post');
//        $post->validate($_POST);
//        $data['errors'] = $posts->errors;

//        $post = new Post($_POST['name'], $_POST['textarea']);

        $this->view('blog', $data);
    }

    public function deletePost($data)
    {
        $model = new Model('post');
        $model->delete((int) $data);
        header('Location: ' . ROOT);
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

        $post = new Model('post');
        $validatePost = $post->validate($_POST);
        if (!$validatePost) {
            $data['errors'] = $post->errors;
        }

        if (isset($data['errors'])) {
            header('Location: ' . ROOT);
            die;
        }

        $data = [
            'success' => 'true'
        ];

        redirect('blog');
    }
}