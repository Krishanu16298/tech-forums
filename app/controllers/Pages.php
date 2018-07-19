<?php
    class Pages extends Controller {
        public function __construct(){
        }

        public function index(){
            $data = [
                'title' => 'Tech Forums'
            ];
            $this->view('pages/index',$data);
        }

        public function about(){
            $data = [
                'title1' => 'About this Website!',
                'content1' => '',
                'title2' => 'About this framework!',
                'content2' => ''
            ];
            $this->view('pages/about',$data);
        }
    }