<?php
    class Api extends Controller {
        public function __construct(){
        }
        
        public function news(){
            $newsList = file_get_contents('https://newsapi.org/v2/top-headlines?sources=techcrunch&language=en&apiKey=ef78fc01e2be410387990c7b8ae50ae3');
            echo $newsList;
        }
    }