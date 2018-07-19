<?php
    class Posts extends Controller {
        public function __construct(){
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
            $this->comModel = $this->model('Comment');
            $this->newsModel = $this->model('News');
        }
        public function index(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($_POST['body'] != ''){
                    if($this->comModel->addComment($_POST['id'],$_POST['body'],$_POST['name'])){
                        redirect('posts');
                    }else{
                        flash('post_msg','Something Went Wrong!','alert alert-danger');
                    }
                }
            }
            $posts = $this->postModel->getPosts();
            $comm = $this->comModel->getComments();
            $news = $this->newsModel->getNews();
            $data = [
                'posts' => $posts,
                'comments' => $comm,
                'news' => $news
            ];
            $this->view('posts/index',$data);
        }

        public function add(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
                    'title' => $_POST['title'],
                    'body' => $_POST['body'],
                    'title_err' => '',
                    'body_err' => ''
                ];
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title!';
                }
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter the contents of the post!';
                }

                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postModel->addPost($data['title'],$data['body'])){
                        flash('post_msg','Post added successfully');
                        redirect('posts');
                    } else {
                        flash('post_msg','Something went wrong!','alert alert-danger');
                        $this->view('posts/add',$data);
                    }
                } else {
                    $this->view('posts/add',$data);
                }
            }else{
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                $this->view('posts/add',$data);
            }
        }

        public function show($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($_POST['body'] != ''){
                    if($this->comModel->addComment($_POST['id'],$_POST['body'],$_POST['name'])){
                        redirect('posts/show/'.$id);
                    }else{
                        flash('post_msg','Something Went Wrong!','alert alert-danger');
                    }
                }
            }

            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $com = $this->comModel->getCommentByPostId($id);

            $data = [
                'post' => $post,
                'com' => $com,
                'user' => $user
            ];
            $this->view('posts/show', $data);
        }

        public function edit($id){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
                    'id' => $id,
                    'title' => $_POST['title'],
                    'body' => $_POST['body'],
                    'title_err' => '',
                    'body_err' => ''
                ];
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title!';
                }
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter the contents of the post!';
                }

                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postModel->updatePost($data['title'],$data['body'],$id)){
                        flash('post_msg','Post Updated successfully');
                        redirect('posts/show/'.$id);
                    } else {
                        flash('post_msg','Something went wrong!','alert alert-danger');
                        $this->view('posts/edit',$data);
                    }
                } else {
                    $this->view('posts/edit',$data);
                }
            }else{
                $post = $this->postModel->getPostById($id);
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];
                $this->view('posts/edit',$data);
            }
        }

        public function delete($id){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            }

            if($this->postModel->deletePostById($id)){
                $this->comModel->deleteComments($id);
                flash('post_msg','Your post has been removed!');
                redirect('posts');
            }else{
                flash('post_msg','Your post has been removed!');
                redirect('posts/show/'.$id);
            }
        }
    }