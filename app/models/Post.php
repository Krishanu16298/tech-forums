<?php
    class Post {
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT *,
            posts.id as p_id
            FROM posts
            INNER JOIN users
            ON posts.user_id = users.id
            ORDER BY posted_at DESC');

            $posts = $this->db->resultSet();

            return $posts;
        }

        public function addPost($title,$body){
            $this->db->query('INSERT INTO posts(user_id, title, body, author) values(:id, :title, :body, :user)');
            $this->db->bind(':id',$_SESSION['user_id']);
            $this->db->bind(':title',$title);
            $this->db->bind(':body',$body);
            $this->db->bind(':user',$_SESSION['user_name']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            $this->db->bind(':id',$id);

            $user = $this->db->single();
            return $user;
        }

        public function updatePost($title,$body,$id){
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            $this->db->bind(':id',$id);
            $this->db->bind(':title',$title);
            $this->db->bind(':body',$body);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deletePostById($id){
            $this->db->query('DELETE FROM posts WHERE id = :id');
            $this->db->bind(':id',$id);
            
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }