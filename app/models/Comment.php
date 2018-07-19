<?php
    class Comment {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getComments(){
            $this->db->query('SELECT * FROM comments ORDER BY com_at DESC');

            $result = $this->db->resultSet();
            return $result;
        }

        public function getCommentByPostId($id){
            $this->db->query('SELECT * FROM comments WHERE post_id=:id ORDER BY com_at DESC');
            $this->db->bind(':id',$id);

            if($comments = $this->db->resultSet()){
                return $comments;
            }else{
                $comments = (object)array((object)array('comaut'=>'','comment'=>'No Commets Yet!!'));
                return $comments;
            }
        }

        public function addComment($id, $body, $name){
            $this->db->query('INSERT INTO comments(post_id, comment, comaut) VALUES(:id, :body, :name)');
            $this->db->bind(':id',$id);
            $this->db->bind(':body',$body);
            $this->db->bind(':name',$name);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteComments($id){
            $this->db->query('DELETE FROM comments WHERE post_id = :id');
            $this->db->bind(':id',$id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }