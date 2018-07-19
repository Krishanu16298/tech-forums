<?php
    class News {
        private $news;
        public function __construct(){
            $newsHandler = curl_init();
            curl_setopt($newsHandler, CURLOPT_URL, 'http://localhost/Forums/api/news');
            curl_setopt($newsHandler, CURLOPT_RETURNTRANSFER, true);
            $this->news = json_decode(curl_exec($newsHandler));
        }

        public function getNews(){
            if(isset($this->news) && $this->news->status == 'ok'){
                return $this->news->articles;
            }else{
                $this->news = array((object)array('title' => 'No news feed right now!!','url' => '#'));
                return $this->news;
            }
        }
    }